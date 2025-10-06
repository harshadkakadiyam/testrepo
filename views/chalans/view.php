<?php global $L; $chalan = $chalan ?? []; $lines = $lines ?? []; ?>
<section>
  <div style="display:flex;justify-content:space-between;align-items:center;gap:12px">
    <h2><?= Util::e($L['chalan']) ?>: <?= Util::e($chalan['chalan_no'] ?? '') ?></h2>
    <div class="actions">
      <button class="btn" onclick="window.print()"><?= Util::e($L['btn_print']) ?></button>
      <a class="btn" href="<?= Util::baseUrl('index.php?m=invoices&a=generate&chalan_id=' . urlencode((string)$chalan['id'])) ?>"><?= Util::e($L['invoice_generate']) ?></a>
      <a class="btn" href="<?= Util::baseUrl('index.php?m=chalans') ?>"><?= Util::e($L['btn_back']) ?></a>
    </div>
  </div>
  <div>
    <div><strong><?= Util::e($L['chalan_date']) ?>:</strong> <?= Util::e($chalan['chalan_date'] ?? '') ?></div>
    <div><strong><?= Util::e($L['chalan_customer']) ?>:</strong> <?= Util::e($chalan['customer_name'] ?? '') ?></div>
    <div><strong>GSTIN:</strong> <?= Util::e($chalan['gstin'] ?? '') ?></div>
    <div><strong>સરનામું:</strong> <?= Util::e($chalan['address'] ?? '') ?></div>
  </div>
  <table class="table" style="margin-top:12px">
    <thead>
      <tr>
        <th>#</th>
        <th><?= Util::e($L['product_name']) ?></th>
        <th><?= Util::e($L['chalan_qty']) ?></th>
        <th><?= Util::e($L['chalan_price']) ?></th>
        <th><?= Util::e($L['chalan_majuri']) ?></th>
        <th><?= Util::e($L['product_gst']) ?> %</th>
        <th><?= Util::e($L['chalan_total']) ?></th>
      </tr>
    </thead>
    <tbody>
      <?php $i=1; foreach ($lines as $ln): ?>
        <tr>
          <td><?= $i++ ?></td>
          <td><?= Util::e($ln['product_name']) ?></td>
          <td><?= Util::e($ln['qty']) ?></td>
          <td><?= Util::e($ln['price']) ?></td>
          <td><?= Util::e($ln['majuri']) ?></td>
          <td><?= Util::e($ln['gst_percentage']) ?></td>
          <td><?= Util::e($ln['line_total']) ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  <div style="text-align:right;margin-top:8px">
    <div>Taxable: <?= Util::e($chalan['total_amount'] ?? '0') ?></div>
    <div>GST: <?= Util::e($chalan['total_gst'] ?? '0') ?></div>
    <div><strong><?= Util::e($L['chalan_total']) ?>:</strong> <?= Util::e(($chalan['total_amount'] ?? 0) + ($chalan['total_gst'] ?? 0)) ?></div>
  </div>
</section>
<style>@media print{.app-header,.app-footer,.actions{display:none}.container{max-width:100%;margin:0;padding:0}}</style>
