<?php
require_once __DIR__ . '/../libs/Database.php';
require_once __DIR__ . '/../libs/Util.php';
require_once __DIR__ . '/../libs/Seq.php';

function chalans_index(): void {
    $pdo = Database::getConnection();
    $stmt = $pdo->query('SELECT c.*, cu.name AS customer_name FROM chalans c JOIN customers cu ON cu.id=c.customer_id ORDER BY c.chalan_date DESC, c.id DESC');
    $items = $stmt->fetchAll();
    view('chalans/index', ['items' => $items]);
}

function chalans_create(): void {
    $pdo = Database::getConnection();
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $customer_id = (int)($_POST['customer_id'] ?? 0);
        $date = $_POST['chalan_date'] ?? date('Y-m-d');
        $lines = $_POST['lines'] ?? [];
        if ($customer_id <= 0 || empty($lines)) {
            $error = 'ગ્રાહક અને લાઇન આઇટમ્સ જરૂરી છે';
            return _chalan_form($error);
        }
        $pdo->beginTransaction();
        try {
            $chalan_no = sprintf('CH%05d', Seq::next('chalan_no'));
            $stmt = $pdo->prepare('INSERT INTO chalans (chalan_no, chalan_date, customer_id, total_amount, total_gst) VALUES (?, ?, ?, 0, 0)');
            $stmt->execute([$chalan_no, $date, $customer_id]);
            $chalan_id = (int)$pdo->lastInsertId();

            $total = 0.0; $totalGst = 0.0;
            $ins = $pdo->prepare('INSERT INTO chalan_items (chalan_id, product_id, product_name, qty, price, majuri, gst_percentage, line_total) VALUES (?,?,?,?,?,?,?,?)');
            foreach ($lines as $ln) {
                $product_id = trim($ln['product_id'] ?? '');
                $product_name = trim($ln['product_name'] ?? '');
                $qty = (float)($ln['qty'] ?? 0);
                $price = (float)($ln['price'] ?? 0);
                $majuri = (float)($ln['majuri'] ?? 0);
                $gstp = (float)($ln['gst_percentage'] ?? 0);
                if ($qty <= 0) { continue; }
                $amount = ($price * $qty) + $majuri;
                $gstAmt = $amount * ($gstp/100.0);
                $lineTotal = $amount + $gstAmt;
                $ins->execute([$chalan_id, $product_id, $product_name, $qty, $price, $majuri, $gstp, $lineTotal]);
                $total += $amount; $totalGst += $gstAmt;
            }
            $pdo->prepare('UPDATE chalans SET total_amount=?, total_gst=? WHERE id=?')->execute([$total, $totalGst, $chalan_id]);
            $pdo->commit();
            Util::redirect('index.php?m=chalans&a=view&id=' . $chalan_id);
        } catch (Throwable $e) {
            $pdo->rollBack();
            _chalan_form('સાચવું નિષ્ફળ: ' . $e->getMessage());
        }
        return;
    }
    _chalan_form();
}

function _chalan_form(string $error = ''): void {
    $pdo = Database::getConnection();
    $customers = $pdo->query('SELECT id, name FROM customers ORDER BY name')->fetchAll();
    $products = $pdo->query('SELECT id, name, price, majuri, gst_percentage FROM products ORDER BY name')->fetchAll();
    view('chalans/form', ['customers' => $customers, 'products' => $products, 'error' => $error]);
}

function chalans_view(): void {
    $pdo = Database::getConnection();
    $id = (int)($_GET['id'] ?? 0);
    $stmt = $pdo->prepare('SELECT c.*, cu.name AS customer_name, cu.gstin, cu.address FROM chalans c JOIN customers cu ON cu.id=c.customer_id WHERE c.id=?');
    $stmt->execute([$id]);
    $chalan = $stmt->fetch();
    if (!$chalan) { Util::redirect('index.php?m=chalans'); }
    $items = $pdo->prepare('SELECT * FROM chalan_items WHERE chalan_id=?');
    $items->execute([$id]);
    $lines = $items->fetchAll();
    view('chalans/view', ['chalan' => $chalan, 'lines' => $lines]);
}

function chalans_delete(): void {
    $pdo = Database::getConnection();
    $id = (int)($_GET['id'] ?? 0);
    if ($id > 0) {
        $stmt = $pdo->prepare('DELETE FROM chalans WHERE id=?');
        try { $stmt->execute([$id]); } catch (Throwable $e) {}
    }
    Util::redirect('index.php?m=chalans');
}
