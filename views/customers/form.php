<?php global $L; $item = $item ?? null; ?>
<section>
  <h2><?= Util::e($item ? $L['customer_edit'] : $L['customer_add']) ?></h2>
  <?php if (!empty($error ?? '')): ?>
    <div style="padding:8px;border:1px solid #dc3545;color:#842029;background:#f8d7da;margin-bottom:12px">
      <?= Util::e($error) ?>
    </div>
  <?php endif; ?>
  <form method="post">
    <div class="form-group">
      <label><?= Util::e($L['customer_name']) ?></label>
      <input name="name" value="<?= Util::e($item['name'] ?? ($name ?? '')) ?>" required />
    </div>
    <div class="form-group">
      <label><?= Util::e($L['customer_phone']) ?></label>
      <input name="phone" value="<?= Util::e($item['phone'] ?? ($phone ?? '')) ?>" />
    </div>
    <div class="form-group">
      <label><?= Util::e($L['customer_address']) ?></label>
      <input name="address" value="<?= Util::e($item['address'] ?? ($address ?? '')) ?>" />
    </div>
    <div class="form-group">
      <label><?= Util::e($L['customer_gstin']) ?></label>
      <input name="gstin" value="<?= Util::e($item['gstin'] ?? ($gstin ?? '')) ?>" />
    </div>
    <div class="actions">
      <button class="btn btn-primary" type="submit"><?= Util::e($L['btn_save']) ?></button>
      <a class="btn" href="<?= Util::baseUrl('index.php?m=customers') ?>"><?= Util::e($L['btn_cancel']) ?></a>
    </div>
  </form>
</section>
