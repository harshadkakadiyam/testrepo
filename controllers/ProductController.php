<?php
require_once __DIR__ . '/../libs/Database.php';
require_once __DIR__ . '/../libs/Util.php';

function products_index(): void {
    $pdo = Database::getConnection();
    $q = trim($_GET['q'] ?? '');
    if ($q !== '') {
        $stmt = $pdo->prepare('SELECT * FROM products WHERE id LIKE ? OR name LIKE ? ORDER BY name');
        $like = "%$q%";
        $stmt->execute([$like, $like]);
    } else {
        $stmt = $pdo->query('SELECT * FROM products ORDER BY name');
    }
    $items = $stmt->fetchAll();
    view('products/index', ['items' => $items, 'q' => $q]);
}

function products_create(): void {
    global $L;
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = trim($_POST['id'] ?? '');
        $name = trim($_POST['name'] ?? '');
        $price = (float)($_POST['price'] ?? 0);
        $majuri = (float)($_POST['majuri'] ?? 0);
        $hsn = trim($_POST['hsn_code'] ?? '');
        $gst = (float)($_POST['gst_percentage'] ?? 0);
        if ($id === '' || $name === '') {
            $error = 'ID અને નામ જરૂરી છે';
            view('products/form', compact('error', 'id', 'name', 'price', 'majuri', 'hsn', 'gst'));
            return;
        }
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare('INSERT INTO products (id, name, price, majuri, hsn_code, gst_percentage) VALUES (?, ?, ?, ?, ?, ?)');
        try {
            $stmt->execute([$id, $name, $price, $majuri, $hsn, $gst]);
            Util::redirect('index.php?m=products');
        } catch (PDOException $e) {
            $error = 'સાચવો શક્ય નથી: ' . $e->getMessage();
            view('products/form', compact('error', 'id', 'name', 'price', 'majuri', 'hsn', 'gst'));
        }
        return;
    }
    view('products/form');
}

function products_edit(): void {
    $pdo = Database::getConnection();
    $id = $_GET['id'] ?? '';
    if ($id === '') { Util::redirect('index.php?m=products'); }
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = trim($_POST['name'] ?? '');
        $price = (float)($_POST['price'] ?? 0);
        $majuri = (float)($_POST['majuri'] ?? 0);
        $hsn = trim($_POST['hsn_code'] ?? '');
        $gst = (float)($_POST['gst_percentage'] ?? 0);
        $stmt = $pdo->prepare('UPDATE products SET name=?, price=?, majuri=?, hsn_code=?, gst_percentage=? WHERE id=?');
        $stmt->execute([$name, $price, $majuri, $hsn, $gst, $id]);
        Util::redirect('index.php?m=products');
        return;
    }
    $stmt = $pdo->prepare('SELECT * FROM products WHERE id=?');
    $stmt->execute([$id]);
    $item = $stmt->fetch();
    if (!$item) { Util::redirect('index.php?m=products'); }
    view('products/form', ['item' => $item]);
}

function products_delete(): void {
    $pdo = Database::getConnection();
    $id = $_GET['id'] ?? '';
    if ($id !== '') {
        $stmt = $pdo->prepare('DELETE FROM products WHERE id=?');
        try { $stmt->execute([$id]); } catch (Throwable $e) {}
    }
    Util::redirect('index.php?m=products');
}
