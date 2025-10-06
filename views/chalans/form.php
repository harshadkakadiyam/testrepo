<?php global $L; ?>
<section>
  <h2><?= Util::e($L['chalan_add']) ?></h2>
  <?php if (!empty($error ?? '')): ?>
    <div style="padding:8px;border:1px solid #dc3545;color:#842029;background:#f8d7da;margin-bottom:12px">
      <?= Util::e($error) ?>
    </div>
  <?php endif; ?>
  <form method="post">
    <div class="form-group">
      <label><?= Util::e($L['chalan_customer']) ?></label>
      <select name="customer_id" required>
        <option value="">-- પસંદ કરો --</option>
        <?php foreach (($customers ?? []) as $c): ?>
          <option value="<?= Util::e((string)$c['id']) ?>"><?= Util::e($c['name']) ?></option>
        <?php endforeach; ?>
      </select>
    </div>
    <div class="form-group">
      <label><?= Util::e($L['chalan_date']) ?></label>
      <input type="date" name="chalan_date" value="<?= Util::e(date('Y-m-d')) ?>" required />
    </div>

    <h3>લાઇન આઇટમ્સ</h3>
    <div id="lines"></div>
    <button type="button" class="btn" onclick="addLine()">+ લાઇન ઉમેરો</button>

    <div class="actions" style="margin-top:12px">
      <button class="btn btn-primary" type="submit"><?= Util::e($L['btn_save']) ?></button>
      <a class="btn" href="<?= Util::baseUrl('index.php?m=chalans') ?>"><?= Util::e($L['btn_cancel']) ?></a>
    </div>
  </form>
</section>
<script>
const products = <?= json_encode($products ?? []) ?>;
function addLine() {
  const idx = document.querySelectorAll('#lines .line').length;
  const div = document.createElement('div');
  div.className = 'line';
  div.style.marginBottom = '8px';
  div.innerHTML = `
  <div style="display:grid;grid-template-columns:2fr 1fr 1fr 1fr 1fr;gap:8px;align-items:end">
    <div>
      <label>પ્રોડક્ટ</label>
      <select name="lines[${idx}][product_id]" onchange="onProdChange(this)">
        <option value="">Custom</option>
        ${products.map(p => `<option value="${p.id}" data-name="${p.name}" data-price="${p.price}" data-majuri="${p.majuri}" data-gst="${p.gst_percentage}">${p.name}</option>`).join('')}
      </select>
      <input name="lines[${idx}][product_name]" placeholder="નામ" />
    </div>
    <div>
      <label><?= Util::e($L['chalan_qty']) ?></label>
      <input type="number" step="0.001" name="lines[${idx}][qty]" value="1" />
    </div>
    <div>
      <label><?= Util::e($L['chalan_price']) ?></label>
      <input type="number" step="0.01" name="lines[${idx}][price]" />
    </div>
    <div>
      <label><?= Util::e($L['chalan_majuri']) ?></label>
      <input type="number" step="0.01" name="lines[${idx}][majuri]" />
    </div>
    <div>
      <label><?= Util::e($L['product_gst']) ?> %</label>
      <input type="number" step="0.01" name="lines[${idx}][gst_percentage]" />
    </div>
  </div>`;
  document.getElementById('lines').appendChild(div);
}

function onProdChange(sel) {
  const opt = sel.options[sel.selectedIndex];
  const line = sel.closest('.line');
  const nameInput = line.querySelector('input[name$="[product_name]"]');
  const priceInput = line.querySelector('input[name$="[price]"]');
  const majuriInput = line.querySelector('input[name$="[majuri]"]');
  const gstInput = line.querySelector('input[name$="[gst_percentage]"]');
  nameInput.value = opt.dataset.name || '';
  priceInput.value = opt.dataset.price || '';
  majuriInput.value = opt.dataset.majuri || '';
  gstInput.value = opt.dataset.gst || '';
}

addLine();
</script>
