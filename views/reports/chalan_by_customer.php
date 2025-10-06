<?php global $L; $customer_id = (int)($customer_id ?? 0); ?>
<section>
  <h2><?= Util::e($L['report_customer_chalan']) ?></h2>
  <form method="get" style="margin:8px 0;display:flex;gap:8px;align-items:center">
    <input type="hidden" name="m" value="reports" />
    <input type="hidden" name="a" value="chalan_by_customer" />
    <label><?= Util::e($L['customer']) ?>:</label>
    <select name="customer_id">
      <option value="0">-- બધા --</option>
      <?php foreach (($customers ?? []) as $c): ?>
        <option value="<?= Util::e((string)$c['id']) ?>" <?= $customer_id===(int)$c['id']?'selected':'' ?>><?= Util::e($c['name']) ?></option>
      <?php endforeach; ?>
    </select>
    <button class="btn" type="submit"><?= Util::e($L['search']) ?></button>
  </form>
  <table class="table">
    <thead>
      <tr>
        <th><?= Util::e($L['chalan_no']) ?></th>
        <th><?= Util::e($L['chalan_date']) ?></th>
        <th><?= Util::e($L['chalan_total']) ?></th>
      </tr>
    </thead>
    <tbody>
      <?php $sum=0; foreach (($items ?? []) as $it): $sum += ($it['total_amount'] + $it['total_gst']); ?>
        <tr>
          <td><?= Util::e($it['chalan_no']) ?></td>
          <td><?= Util::e($it['chalan_date']) ?></td>
          <td><?= Util::e($it['total_amount'] + $it['total_gst']) ?></td>
        </tr>
      <?php endforeach; ?>
      <?php if (empty($items ?? [])): ?>
        <tr><td colspan="3">No data</td></tr>
      <?php else: ?>
      <tr>
        <th colspan="2">Total</th>
        <th><?= Util::e($sum) ?></th>
      </tr>
      <?php endif; ?>
    </tbody>
  </table>
</section>
