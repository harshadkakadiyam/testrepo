<?php global $L; $month = $month ?? date('Y-m'); ?>
<section>
  <h2><?= Util::e($L['report_monthly_chalan']) ?></h2>
  <form method="get" style="margin:8px 0;display:flex;gap:8px">
    <input type="hidden" name="m" value="reports" />
    <input type="hidden" name="a" value="chalan_monthly" />
    <input type="month" name="month" value="<?= Util::e($month) ?>" />
    <button class="btn" type="submit"><?= Util::e($L['search']) ?></button>
  </form>
  <table class="table">
    <thead>
      <tr>
        <th><?= Util::e($L['chalan_no']) ?></th>
        <th><?= Util::e($L['chalan_date']) ?></th>
        <th><?= Util::e($L['chalan_customer']) ?></th>
        <th><?= Util::e($L['chalan_total']) ?></th>
      </tr>
    </thead>
    <tbody>
      <?php $sum=0; foreach (($items ?? []) as $it): $sum += ($it['total_amount'] + $it['total_gst']); ?>
        <tr>
          <td><?= Util::e($it['chalan_no']) ?></td>
          <td><?= Util::e($it['chalan_date']) ?></td>
          <td><?= Util::e($it['customer_name']) ?></td>
          <td><?= Util::e($it['total_amount'] + $it['total_gst']) ?></td>
        </tr>
      <?php endforeach; ?>
      <tr>
        <th colspan="3">Total</th>
        <th><?= Util::e($sum) ?></th>
      </tr>
    </tbody>
  </table>
</section>
