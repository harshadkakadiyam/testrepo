<?php global $L; ?>
<section>
  <div style="display:flex;justify-content:space-between;align-items:center;gap:12px">
    <h2><?= Util::e($L['product_list']) ?></h2>
    <div class="actions">
      <a class="btn btn-primary" href="<?= Util::baseUrl('index.php?m=products&a=create') ?>">+ <?= Util::e($L['product_add']) ?></a>
    </div>
  </div>

  <form method="get" action="" style="margin:12px 0;display:flex;gap:8px">
    <input type="hidden" name="m" value="products" />
    <input type="text" name="q" value="<?= isset($q) ? Util::e($q) : '' ?>" placeholder="<?= Util::e($L['search']) ?>" />
    <button class="btn" type="submit"><?= Util::e($L['search']) ?></button>
  </form>

  <table class="table">
    <thead>
      <tr>
        <th><?= Util::e($L['product_id']) ?></th>
        <th><?= Util::e($L['product_name']) ?></th>
        <th><?= Util::e($L['product_price']) ?></th>
        <th><?= Util::e($L['product_majuri']) ?></th>
        <th><?= Util::e($L['product_hsn']) ?></th>
        <th><?= Util::e($L['product_gst']) ?></th>
        <th><?= Util::e($L['actions']) ?></th>
      </tr>
    </thead>
    <tbody>
      <?php foreach (($items ?? []) as $it): ?>
        <tr>
          <td><?= Util::e($it['id']) ?></td>
          <td><?= Util::e($it['name']) ?></td>
          <td><?= Util::e($it['price']) ?></td>
          <td><?= Util::e($it['majuri']) ?></td>
          <td><?= Util::e($it['hsn_code']) ?></td>
          <td><?= Util::e($it['gst_percentage']) ?>%</td>
          <td class="actions">
            <a class="btn" href="<?= Util::baseUrl('index.php?m=products&a=edit&id=' . urlencode($it['id'])) ?>"><?= Util::e($L['btn_edit']) ?></a>
            <a class="btn btn-danger" href="<?= Util::baseUrl('index.php?m=products&a=delete&id=' . urlencode($it['id'])) ?>" onclick="return confirm('Delete?')"><?= Util::e($L['btn_delete']) ?></a>
          </td>
        </tr>
      <?php endforeach; ?>
      <?php if (empty($items ?? [])): ?>
        <tr><td colspan="7">No products</td></tr>
      <?php endif; ?>
    </tbody>
  </table>
</section>
