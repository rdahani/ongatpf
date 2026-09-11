<p style="color:var(--muted);margin-bottom:1rem">Ne publiez que des chiffres validés par ATPF. Utilisez « — » tant que la donnée n’est pas confirmée.</p>
<form class="admin-form" method="post" action="<?= base_path('admin/chiffres/save') ?>">
  <?= Csrf::field() ?>
  <?php foreach ($items as $item): ?>
    <div class="form-grid" style="border-bottom:1px solid var(--line);padding-bottom:1rem;margin-bottom:1rem">
      <input type="hidden" name="stats[<?= (int) $item['id'] ?>][id]" value="<?= (int) $item['id'] ?>">
      <div class="form-group">
        <label>Clé</label>
        <input value="<?= e($item['stat_key']) ?>" disabled>
      </div>
      <div class="form-group">
        <label>Libellé</label>
        <input name="stats[<?= (int) $item['id'] ?>][label]" value="<?= e($item['label']) ?>">
      </div>
      <div class="form-group">
        <label>Valeur affichée</label>
        <input name="stats[<?= (int) $item['id'] ?>][value_display]" value="<?= e($item['value_display']) ?>">
      </div>
      <div class="form-group">
        <label>Valeur numérique (optionnel)</label>
        <input name="stats[<?= (int) $item['id'] ?>][numeric_value]" value="<?= e((string) ($item['numeric_value'] ?? '')) ?>">
      </div>
      <div class="form-group full">
        <label>Notes / source</label>
        <input name="stats[<?= (int) $item['id'] ?>][notes]" value="<?= e($item['notes'] ?? '') ?>">
      </div>
      <label><input type="checkbox" name="stats[<?= (int) $item['id'] ?>][is_published]" <?= $item['is_published'] ? 'checked' : '' ?>> Publié</label>
    </div>
  <?php endforeach; ?>
  <button class="btn btn-primary" type="submit">Enregistrer les chiffres</button>
</form>
