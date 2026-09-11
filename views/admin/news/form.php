<form class="admin-form" method="post" action="<?= base_path('admin/actualites/save') ?>">
  <?= Csrf::field() ?>
  <?php if ($item): ?><input type="hidden" name="id" value="<?= (int) $item['id'] ?>"><?php endif; ?>
  <div class="form-group"><label>Titre</label><input name="title" required value="<?= e($item['title'] ?? '') ?>"></div>
  <div class="form-group"><label>Slug</label><input name="slug" value="<?= e($item['slug'] ?? '') ?>"></div>
  <div class="form-group"><label>Catégorie</label><input name="category" value="<?= e($item['category'] ?? 'Actualité') ?>"></div>
  <div class="form-group"><label>Extrait</label><textarea name="excerpt" rows="3" required><?= e($item['excerpt'] ?? '') ?></textarea></div>
  <div class="form-group"><label>Contenu HTML</label><textarea name="content" rows="10" required><?= e($item['content'] ?? '') ?></textarea></div>
  <div class="form-group"><label>Image</label><input name="cover_image" value="<?= e($item['cover_image'] ?? '') ?>"></div>
  <label><input type="checkbox" name="is_published" <?= !empty($item['is_published']) ? 'checked' : '' ?>> Publier</label>
  <button class="btn btn-primary" type="submit">Enregistrer</button>
</form>
