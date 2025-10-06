<?php global $L; ?>
<section>
  <div style="display:flex;justify-content:space-between;align-items:center;gap:12px">
    <h2><?= Util::e($L['customer_list']) ?></h2>
    <div class="actions">
      <a class="btn btn-primary" href="<?= Util::baseUrl('index.php?m=customers&a=create') ?>">+ <?= Util::e($L['customer_add']) ?></a>
    </div>
  </div>

  <form method="get" action="" style="margin:12px 0;display:flex;gap:8px">
    <input type="hidden" name="m" value="customers" />
    <input type="text" name="q" value="<?= isset($q) ? Util::e($q) : '' ?>" placeholder="<?= Util::e($L['search']) ?>" />
    <button class="btn" type="submit"><?= Util::e($L['search']) ?></button>
  </form>

  <table class="table">
    <thead>
      <tr>
        <th>ID</th>
        <th><?= Util::e($L['customer_name']) ?></th>
        <th><?= Util::e($L['customer_phone']) ?></th>
        <th><?= Util::e($L['customer_gstin']) ?></th>
        <th><?= Util::e($L['actions']) ?></th>
      </tr>
    </thead>
    <tbody>
      <?php foreach (($items ?? []) as $it): ?>
        <tr>
          <td><?= Util::e((string)$it['id']) ?></td>
          <td><?= Util::e($it['name']) ?></td>
          <td><?= Util::e($it['phone']) ?></td>
          <td><?= Util::e($it['gstin']) ?></td>
          <td class="actions">
            <a class="btn" href="<?= Util::baseUrl('index.php?m=customers&a=edit&id=' . urlencode((string)$it['id'])) ?>"><?= Util::e($L['btn_edit']) ?></a>
            <a class="btn btn-danger" href="<?= Util::baseUrl('index.php?m=customers&a=delete&id=' . urlencode((string)$it['id'])) ?>" onclick="return confirm('Delete?')"><?= Util::e($L['btn_delete']) ?></a>
          </td>
        </tr>
      <?php endforeach; ?>
      <?php if (empty($items ?? [])): ?>
        <tr><td colspan="5">No customers</td></tr>
      <?php endif; ?>
    </tbody>
  </table>
</section>
