<?php global $L; $invoice = $invoice ?? []; $lines = $lines ?? []; ?>
<section>
  <div style="display:flex;justify-content:space-between;align-items:center;gap:12px">
    <h2><?= Util::e($L['invoice']) ?>: <?= Util::e($invoice['invoice_no'] ?? '') ?></h2>
    <div class="actions">
      <button class="btn" onclick="window.print()"><?= Util::e($L['btn_print']) ?></button>
      <a class="btn" href="<?= Util::baseUrl('index.php?m=invoices') ?>"><?= Util::e($L['btn_back']) ?></a>
    </div>
  </div>
  <div>
    <div><strong><?= Util::e($L['invoice_date']) ?>:</strong> <?= Util::e($invoice['invoice_date'] ?? '') ?></div>
    <div><strong><?= Util::e($L['chalan_no']) ?>:</strong> <?= Util::e($invoice['chalan_no'] ?? '') ?></div>
    <div><strong><?= Util::e($L['customer']) ?>:</strong> <?= Util::e($invoice['customer_name'] ?? '') ?></div>
    <div><strong>GSTIN:</strong> <?= Util::e($invoice['gstin'] ?? '') ?></div>
    <div><strong>સરનામું:</strong> <?= Util::e($invoice['address'] ?? '') ?></div>
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
    <div>Taxable: <?= Util::e($invoice['taxable_value'] ?? '0') ?></div>
    <div>CGST: <?= Util::e($invoice['cgst'] ?? '0') ?>, SGST: <?= Util::e($invoice['sgst'] ?? '0') ?>, IGST: <?= Util::e($invoice['igst'] ?? '0') ?></div>
    <div><strong><?= Util::e($L['chalan_total']) ?>:</strong> <?= Util::e($invoice['total_amount'] ?? '0') ?></div>
  </div>
</section>
<style>@media print{.app-header,.app-footer,.actions{display:none}.container{max-width:100%;margin:0;padding:0}}</style>
