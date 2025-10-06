<?php
require_once __DIR__ . '/../libs/Database.php';
require_once __DIR__ . '/../libs/Util.php';

function reports_index(): void {
    view('reports/index');
}

function reports_gst_monthly(): void {
    $pdo = Database::getConnection();
    $month = $_GET['month'] ?? date('Y-m');
    $start = $month . '-01';
    $end = date('Y-m-t', strtotime($start));
    $stmt = $pdo->prepare('SELECT * FROM invoices WHERE invoice_date BETWEEN ? AND ? ORDER BY invoice_date');
    $stmt->execute([$start, $end]);
    $items = $stmt->fetchAll();
    view('reports/gst_monthly', ['items' => $items, 'month' => $month]);
}

function reports_chalan_monthly(): void {
    $pdo = Database::getConnection();
    $month = $_GET['month'] ?? date('Y-m');
    $start = $month . '-01';
    $end = date('Y-m-t', strtotime($start));
    $stmt = $pdo->prepare('SELECT c.*, cu.name AS customer_name FROM chalans c JOIN customers cu ON cu.id=c.customer_id WHERE chalan_date BETWEEN ? AND ? ORDER BY chalan_date');
    $stmt->execute([$start, $end]);
    $items = $stmt->fetchAll();
    view('reports/chalan_monthly', ['items' => $items, 'month' => $month]);
}

function reports_chalan_by_customer(): void {
    $pdo = Database::getConnection();
    $customer_id = (int)($_GET['customer_id'] ?? 0);
    $customers = $pdo->query('SELECT id, name FROM customers ORDER BY name')->fetchAll();
    $items = [];
    if ($customer_id > 0) {
        $stmt = $pdo->prepare('SELECT * FROM chalans WHERE customer_id=? ORDER BY chalan_date DESC');
        $stmt->execute([$customer_id]);
        $items = $stmt->fetchAll();
    }
    view('reports/chalan_by_customer', ['customers' => $customers, 'items' => $items, 'customer_id' => $customer_id]);
}
