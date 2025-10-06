<?php global $L; ?>
<section>
  <h2><?= Util::e($L['reports']) ?></h2>
  <ul>
    <li><a href="<?= Util::baseUrl('index.php?m=reports&a=gst_monthly') ?>"><?= Util::e($L['report_monthly_gst']) ?></a></li>
    <li><a href="<?= Util::baseUrl('index.php?m=reports&a=chalan_monthly') ?>"><?= Util::e($L['report_monthly_chalan']) ?></a></li>
    <li><a href="<?= Util::baseUrl('index.php?m=reports&a=chalan_by_customer') ?>"><?= Util::e($L['report_customer_chalan']) ?></a></li>
  </ul>
</section>
