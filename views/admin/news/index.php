<div style="margin-bottom:1rem;display:flex;justify-content:flex-end">
  <a class="btn btn-primary btn-sm" href="<?= base_path('admin/actualites/create') ?>">Ajouter</a>
</div>
<div class="table-wrap">
  <table>
    <thead><tr><th>Titre</th><th>Catégorie</th><th>Statut</th><th>Actions</th></tr></thead>
    <tbody>
      <?php foreach ($items as $item): ?>
        <tr>
          <td><?= e($item['title']) ?></td>
          <td><?= e($item['category']) ?></td>
          <td><?= $item['is_published'] ? 'Publié' : 'Brouillon' ?></td>
          <td style="display:flex;gap:.5rem">
            <a class="btn btn-outline btn-sm" href="<?= base_path('admin/actualites/edit/' . $item['id']) ?>">Modifier</a>
            <form method="post" action="<?= base_path('admin/actualites/delete') ?>" onsubmit="return confirm('Supprimer ?')">
              <?= Csrf::field() ?>
              <input type="hidden" name="id" value="<?= (int) $item['id'] ?>">
              <button class="btn btn-sm" style="background:#fdecea;color:#b71c1c;border:0">Supprimer</button>
            </form>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
