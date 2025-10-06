<?php global $L; $month = $month ?? date('Y-m'); ?>
<section>
  <h2><?= Util::e($L['report_monthly_gst']) ?></h2>
  <form method="get" style="margin:8px 0;display:flex;gap:8px">
    <input type="hidden" name="m" value="reports" />
    <input type="hidden" name="a" value="gst_monthly" />
    <input type="month" name="month" value="<?= Util::e($month) ?>" />
    <button class="btn" type="submit"><?= Util::e($L['search']) ?></button>
  </form>
  <table class="table">
    <thead>
      <tr>
        <th><?= Util::e($L['invoice_no']) ?></th>
        <th><?= Util::e($L['invoice_date']) ?></th>
        <th>Taxable</th>
        <th>CGST</th>
        <th>SGST</th>
        <th>IGST</th>
        <th>Total</th>
      </tr>
    </thead>
    <tbody>
      <?php $sumT=0;$sumC=0;$sumS=0;$sumI=0;$sumTot=0; foreach (($items ?? []) as $it): $sumT+=$it['taxable_value'];$sumC+=$it['cgst'];$sumS+=$it['sgst'];$sumI+=$it['igst'];$sumTot+=$it['total_amount']; ?>
        <tr>
          <td><?= Util::e($it['invoice_no']) ?></td>
          <td><?= Util::e($it['invoice_date']) ?></td>
          <td><?= Util::e($it['taxable_value']) ?></td>
          <td><?= Util::e($it['cgst']) ?></td>
          <td><?= Util::e($it['sgst']) ?></td>
          <td><?= Util::e($it['igst']) ?></td>
          <td><?= Util::e($it['total_amount']) ?></td>
        </tr>
      <?php endforeach; ?>
      <tr>
        <th colspan="2">Total</th>
        <th><?= Util::e($sumT) ?></th>
        <th><?= Util::e($sumC) ?></th>
        <th><?= Util::e($sumS) ?></th>
        <th><?= Util::e($sumI) ?></th>
        <th><?= Util::e($sumTot) ?></th>
      </tr>
    </tbody>
  </table>
</section>
