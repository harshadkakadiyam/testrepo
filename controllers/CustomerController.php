<?php
require_once __DIR__ . '/../libs/Database.php';
require_once __DIR__ . '/../libs/Util.php';

function customers_index(): void {
    $pdo = Database::getConnection();
    $q = trim($_GET['q'] ?? '');
    if ($q !== '') {
        $stmt = $pdo->prepare('SELECT * FROM customers WHERE name LIKE ? OR phone LIKE ? ORDER BY name');
        $like = "%$q%";
        $stmt->execute([$like, $like]);
    } else {
        $stmt = $pdo->query('SELECT * FROM customers ORDER BY name');
    }
    $items = $stmt->fetchAll();
    view('customers/index', ['items' => $items, 'q' => $q]);
}

function customers_create(): void {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = trim($_POST['name'] ?? '');
        $phone = trim($_POST['phone'] ?? '');
        $address = trim($_POST['address'] ?? '');
        $gstin = trim($_POST['gstin'] ?? '');
        if ($name === '') {
            $error = 'નામ જરૂરી છે';
            view('customers/form', compact('error', 'name', 'phone', 'address', 'gstin'));
            return;
        }
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare('INSERT INTO customers (name, phone, address, gstin) VALUES (?, ?, ?, ?)');
        try {
            $stmt->execute([$name, $phone, $address, $gstin]);
            Util::redirect('index.php?m=customers');
        } catch (PDOException $e) {
            $error = 'સાચવો શક્ય નથી: ' . $e->getMessage();
            view('customers/form', compact('error', 'name', 'phone', 'address', 'gstin'));
        }
        return;
    }
    view('customers/form');
}

function customers_edit(): void {
    $pdo = Database::getConnection();
    $id = (int)($_GET['id'] ?? 0);
    if ($id <= 0) { Util::redirect('index.php?m=customers'); }
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = trim($_POST['name'] ?? '');
        $phone = trim($_POST['phone'] ?? '');
        $address = trim($_POST['address'] ?? '');
        $gstin = trim($_POST['gstin'] ?? '');
        $stmt = $pdo->prepare('UPDATE customers SET name=?, phone=?, address=?, gstin=? WHERE id=?');
        $stmt->execute([$name, $phone, $address, $gstin, $id]);
        Util::redirect('index.php?m=customers');
        return;
    }
    $stmt = $pdo->prepare('SELECT * FROM customers WHERE id=?');
    $stmt->execute([$id]);
    $item = $stmt->fetch();
    if (!$item) { Util::redirect('index.php?m=customers'); }
    view('customers/form', ['item' => $item]);
}

function customers_delete(): void {
    $pdo = Database::getConnection();
    $id = (int)($_GET['id'] ?? 0);
    if ($id > 0) {
        $stmt = $pdo->prepare('DELETE FROM customers WHERE id=?');
        try { $stmt->execute([$id]); } catch (Throwable $e) {}
    }
    Util::redirect('index.php?m=customers');
}
