<div style="margin-bottom:1rem;display:flex;justify-content:flex-end">
  <a class="btn btn-primary btn-sm" href="<?= base_path('admin/projets/create') ?>">Ajouter un projet</a>
</div>
<div class="table-wrap">
  <table>
    <thead>
      <tr><th>Titre</th><th>Statut</th><th>Publication</th><th>Actions</th></tr>
    </thead>
    <tbody>
      <?php foreach ($items as $item): ?>
        <tr>
          <td><strong><?= e($item['title']) ?></strong></td>
          <td><span class="badge"><?= e($item['status']) ?></span></td>
          <td><?= $item['is_published'] ? 'Publié' : 'Brouillon' ?></td>
          <td style="display:flex;gap:.5rem">
            <a class="btn btn-outline btn-sm" href="<?= base_path('admin/projets/edit/' . $item['id']) ?>">Modifier</a>
            <form method="post" action="<?= base_path('admin/projets/delete') ?>" onsubmit="return confirm('Supprimer ce projet ?')">
              <?= Csrf::field() ?>
              <input type="hidden" name="id" value="<?= (int) $item['id'] ?>">
              <button class="btn btn-sm" type="submit" style="background:#fdecea;color:#b71c1c;border:0">Supprimer</button>
            </form>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
