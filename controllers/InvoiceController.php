<?php
require_once __DIR__ . '/../libs/Database.php';
require_once __DIR__ . '/../libs/Util.php';
require_once __DIR__ . '/../libs/Seq.php';

function invoices_index(): void {
    $pdo = Database::getConnection();
    $stmt = $pdo->query('SELECT i.*, c.chalan_no FROM invoices i JOIN chalans c ON c.id=i.chalan_id ORDER BY i.invoice_date DESC, i.id DESC');
    $items = $stmt->fetchAll();
    view('invoices/index', ['items' => $items]);
}

function invoices_generate(): void {
    $pdo = Database::getConnection();
    $chalan_id = (int)($_GET['chalan_id'] ?? 0);
    if ($chalan_id <= 0) { Util::redirect('index.php?m=chalans'); }

    $cstmt = $pdo->prepare('SELECT * FROM chalans WHERE id=?');
    $cstmt->execute([$chalan_id]);
    $chalan = $cstmt->fetch();
    if (!$chalan) { Util::redirect('index.php?m=chalans'); }

    // Create invoice if not exists
    $pdo->beginTransaction();
    try {
      $exists = $pdo->prepare('SELECT * FROM invoices WHERE chalan_id=?');
      $exists->execute([$chalan_id]);
      $inv = $exists->fetch();
      if ($inv) {
        $invoice_id = (int)$inv['id'];
      } else {
        $invoice_no = sprintf('INV%05d', Seq::next('invoice_no'));
        $taxable = (float)$chalan['total_amount'];
        $gst = (float)$chalan['total_gst'];
        $cgst = round($gst/2, 2); $sgst = $gst - $cgst; $igst = 0.00;
        $total = $taxable + $gst;
        $pdo->prepare('INSERT INTO invoices (invoice_no, invoice_date, chalan_id, taxable_value, cgst, sgst, igst, total_amount) VALUES (?, ?, ?, ?, ?, ?, ?, ?)')
            ->execute([$invoice_no, date('Y-m-d'), $chalan_id, $taxable, $cgst, $sgst, $igst, $total]);
        $invoice_id = (int)$pdo->lastInsertId();
      }
      $pdo->commit();
      Util::redirect('index.php?m=invoices&a=view&id=' . $invoice_id);
    } catch (Throwable $e) {
      $pdo->rollBack();
      Util::redirect('index.php?m=chalans');
    }
}

function invoices_view(): void {
    $pdo = Database::getConnection();
    $id = (int)($_GET['id'] ?? 0);
    $stmt = $pdo->prepare('SELECT i.*, c.chalan_no, c.chalan_date, cu.name AS customer_name, cu.gstin, cu.address FROM invoices i JOIN chalans c ON c.id=i.chalan_id JOIN customers cu ON cu.id=c.customer_id WHERE i.id=?');
    $stmt->execute([$id]);
    $invoice = $stmt->fetch();
    if (!$invoice) { Util::redirect('index.php?m=invoices'); }

    $items = $pdo->prepare('SELECT product_name, qty, price, majuri, gst_percentage, line_total FROM chalan_items WHERE chalan_id=?');
    $items->execute([$invoice['chalan_id']]);
    $lines = $items->fetchAll();
    view('invoices/view', ['invoice' => $invoice, 'lines' => $lines]);
}
