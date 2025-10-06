<?php global $L; ?>
<section>
  <h2><?= Util::e($L['invoice_list']) ?></h2>
  <table class="table">
    <thead>
      <tr>
        <th><?= Util::e($L['invoice_no']) ?></th>
        <th><?= Util::e($L['invoice_date']) ?></th>
        <th><?= Util::e($L['chalan_no']) ?></th>
        <th><?= Util::e($L['chalan_total']) ?></th>
        <th><?= Util::e($L['actions']) ?></th>
      </tr>
    </thead>
    <tbody>
      <?php foreach (($items ?? []) as $it): ?>
        <tr>
          <td><?= Util::e($it['invoice_no']) ?></td>
          <td><?= Util::e($it['invoice_date']) ?></td>
          <td><?= Util::e($it['chalan_no']) ?></td>
          <td><?= Util::e($it['total_amount']) ?></td>
          <td class="actions">
            <a class="btn" href="<?= Util::baseUrl('index.php?m=invoices&a=view&id=' . urlencode((string)$it['id'])) ?>"><?= Util::e($L['btn_print']) ?></a>
          </td>
        </tr>
      <?php endforeach; ?>
      <?php if (empty($items ?? [])): ?>
        <tr><td colspan="5">No invoices</td></tr>
      <?php endif; ?>
    </tbody>
  </table>
</section>
