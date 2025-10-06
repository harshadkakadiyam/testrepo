<?php global $L; $item = $item ?? null; ?>
<section>
  <h2><?= Util::e($item ? $L['product_edit'] : $L['product_add']) ?></h2>
  <?php if (!empty($error ?? '')): ?>
    <div style="padding:8px;border:1px solid #dc3545;color:#842029;background:#f8d7da;margin-bottom:12px">
      <?= Util::e($error) ?>
    </div>
  <?php endif; ?>
  <form method="post">
    <?php if (!$item): ?>
      <div class="form-group">
        <label><?= Util::e($L['product_id']) ?></label>
        <input name="id" value="<?= Util::e($id ?? '') ?>" required />
      </div>
    <?php endif; ?>
    <div class="form-group">
      <label><?= Util::e($L['product_name']) ?></label>
      <input name="name" value="<?= Util::e($item['name'] ?? ($name ?? '')) ?>" required />
    </div>
    <div class="form-group">
      <label><?= Util::e($L['product_price']) ?></label>
      <input type="number" step="0.01" name="price" value="<?= Util::e((string)($item['price'] ?? ($price ?? '0'))) ?>" />
    </div>
    <div class="form-group">
      <label><?= Util::e($L['product_majuri']) ?></label>
      <input type="number" step="0.01" name="majuri" value="<?= Util::e((string)($item['majuri'] ?? ($majuri ?? '0'))) ?>" />
    </div>
    <div class="form-group">
      <label><?= Util::e($L['product_hsn']) ?></label>
      <input name="hsn_code" value="<?= Util::e($item['hsn_code'] ?? ($hsn ?? '')) ?>" />
    </div>
    <div class="form-group">
      <label><?= Util::e($L['product_gst']) ?></label>
      <input type="number" step="0.01" name="gst_percentage" value="<?= Util::e((string)($item['gst_percentage'] ?? ($gst ?? '0'))) ?>" />
    </div>
    <div class="actions">
      <button class="btn btn-primary" type="submit"><?= Util::e($L['btn_save']) ?></button>
      <a class="btn" href="<?= Util::baseUrl('index.php?m=products') ?>"><?= Util::e($L['btn_cancel']) ?></a>
    </div>
  </form>
</section>
