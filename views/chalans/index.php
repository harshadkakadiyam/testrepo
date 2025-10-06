<?php global $L; ?>
<section>
  <div style="display:flex;justify-content:space-between;align-items:center;gap:12px">
    <h2><?= Util::e($L['chalan_list']) ?></h2>
    <div class="actions">
      <a class="btn btn-primary" href="<?= Util::baseUrl('index.php?m=chalans&a=create') ?>">+ <?= Util::e($L['chalan_add']) ?></a>
    </div>
  </div>

  <table class="table">
    <thead>
      <tr>
        <th><?= Util::e($L['chalan_no']) ?></th>
        <th><?= Util::e($L['chalan_date']) ?></th>
        <th><?= Util::e($L['chalan_customer']) ?></th>
        <th><?= Util::e($L['chalan_total']) ?></th>
        <th><?= Util::e($L['actions']) ?></th>
      </tr>
    </thead>
    <tbody>
      <?php foreach (($items ?? []) as $it): ?>
        <tr>
          <td><?= Util::e($it['chalan_no']) ?></td>
          <td><?= Util::e($it['chalan_date']) ?></td>
          <td><?= Util::e($it['customer_name']) ?></td>
          <td><?= Util::e($it['total_amount'] + $it['total_gst']) ?></td>
          <td class="actions">
            <a class="btn" href="<?= Util::baseUrl('index.php?m=chalans&a=view&id=' . urlencode((string)$it['id'])) ?>"><?= Util::e($L['btn_print']) ?></a>
            <a class="btn btn-danger" href="<?= Util::baseUrl('index.php?m=chalans&a=delete&id=' . urlencode((string)$it['id'])) ?>" onclick="return confirm('Delete?')"><?= Util::e($L['btn_delete']) ?></a>
          </td>
        </tr>
      <?php endforeach; ?>
      <?php if (empty($items ?? [])): ?>
        <tr><td colspan="5">No chalans</td></tr>
      <?php endif; ?>
    </tbody>
  </table>
</section>
