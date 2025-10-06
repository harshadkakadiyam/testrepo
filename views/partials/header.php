<?php global $L; $config = require __DIR__.'/../../config/config.php'; ?>
<!DOCTYPE html>
<html lang="gu">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title><?= Util::e($L['app_title']) ?></title>
  <link rel="stylesheet" href="<?= Util::baseUrl('style.css') ?>">
</head>
<body>
  <header class="app-header">
    <h1><?= Util::e($L['app_title']) ?></h1>
    <nav>
      <a href="<?= Util::baseUrl('index.php?m=home') ?>"><?= Util::e($L['nav_home']) ?></a>
      <a href="<?= Util::baseUrl('index.php?m=products') ?>"><?= Util::e($L['nav_products']) ?></a>
      <a href="<?= Util::baseUrl('index.php?m=customers') ?>"><?= Util::e($L['nav_customers']) ?></a>
      <a href="<?= Util::baseUrl('index.php?m=chalans') ?>"><?= Util::e($L['nav_chalans']) ?></a>
      <a href="<?= Util::baseUrl('index.php?m=invoices') ?>"><?= Util::e($L['nav_invoices']) ?></a>
      <a href="<?= Util::baseUrl('index.php?m=reports') ?>"><?= Util::e($L['nav_reports']) ?></a>
    </nav>
  </header>
  <main class="container">
