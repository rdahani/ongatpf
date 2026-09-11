<form class="admin-form" method="post" action="<?= base_path('admin/projets/save') ?>">
  <?= Csrf::field() ?>
  <?php if ($item): ?><input type="hidden" name="id" value="<?= (int) $item['id'] ?>"><?php endif; ?>
  <div class="form-grid">
    <div class="form-group full">
      <label>Titre *</label>
      <input name="title" required value="<?= e($item['title'] ?? '') ?>">
    </div>
    <div class="form-group">
      <label>Slug</label>
      <input name="slug" value="<?= e($item['slug'] ?? '') ?>" placeholder="auto">
    </div>
    <div class="form-group">
      <label>Statut</label>
      <select name="status">
        <?php foreach (['draft','active','completed','planned'] as $s): ?>
          <option value="<?= $s ?>" <?= (($item['status'] ?? '') === $s) ? 'selected' : '' ?>><?= $s ?></option>
        <?php endforeach; ?>
      </select>
    </div>
    <div class="form-group full">
      <label>Résumé *</label>
      <textarea name="summary" rows="3" required><?= e($item['summary'] ?? '') ?></textarea>
    </div>
    <div class="form-group full">
      <label>Contenu (HTML simple autorisé : p, strong, em, ul, li, a)</label>
      <textarea name="content" rows="8"><?= e($item['content'] ?? '') ?></textarea>
    </div>
    <div class="form-group">
      <label>Zone</label>
      <input name="zone" value="<?= e($item['zone'] ?? '') ?>">
    </div>
    <div class="form-group">
      <label>Période (libellé)</label>
      <input name="period_label" value="<?= e($item['period_label'] ?? '') ?>">
    </div>
    <div class="form-group">
      <label>Partenaire</label>
      <input name="partner_name" value="<?= e($item['partner_name'] ?? '') ?>">
    </div>
    <div class="form-group">
      <label>Image de couverture (chemin)</label>
      <input name="cover_image" value="<?= e($item['cover_image'] ?? '') ?>" placeholder="uploads/projects/...">
    </div>
    <div class="form-group full">
      <label>Régions</label>
      <div style="display:flex;flex-wrap:wrap;gap:.75rem">
        <?php foreach ($regions as $r): ?>
          <label style="font-weight:600"><input type="checkbox" name="regions[]" value="<?= (int) $r['id'] ?>" <?= in_array($r['id'], $selectedRegions) ? 'checked' : '' ?>> <?= e($r['name']) ?></label>
        <?php endforeach; ?>
      </div>
    </div>
    <div class="form-group full">
      <label>Domaines</label>
      <div style="display:flex;flex-wrap:wrap;gap:.75rem">
        <?php foreach ($domains as $d): ?>
          <label style="font-weight:600"><input type="checkbox" name="domains[]" value="<?= (int) $d['id'] ?>" <?= in_array($d['id'], $selectedDomains) ? 'checked' : '' ?>> <?= e($d['title']) ?></label>
        <?php endforeach; ?>
      </div>
    </div>
    <div class="form-group">
      <label><input type="checkbox" name="is_featured" <?= !empty($item['is_featured']) ? 'checked' : '' ?>> Mis en avant</label>
    </div>
    <div class="form-group">
      <label><input type="checkbox" name="is_published" <?= !empty($item['is_published']) ? 'checked' : '' ?>> Publié</label>
    </div>
  </div>
  <button class="btn btn-primary" type="submit">Enregistrer</button>
</form>
