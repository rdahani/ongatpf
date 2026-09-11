<form class="admin-form" method="post" action="<?= base_path('admin/partenaires/save') ?>" style="margin-bottom:1.5rem">
  <?= Csrf::field() ?>
  <h2 style="font-size:1.15rem;margin:0">Ajouter un partenaire</h2>
  <div class="form-grid">
    <div class="form-group"><label>Nom</label><input name="name" required></div>
    <div class="form-group"><label>Site web</label><input name="website" placeholder="https://"></div>
    <div class="form-group"><label>Type</label>
      <select name="partner_type">
        <option value="bailleur">Bailleur</option>
        <option value="technique">Technique</option>
        <option value="institutionnel">Institutionnel</option>
        <option value="reseau">Réseau</option>
        <option value="autre">Autre</option>
      </select>
    </div>
    <div class="form-group"><label>Logo (chemin)</label><input name="logo" placeholder="uploads/partners/..."></div>
    <div class="form-group full"><label>Description</label><textarea name="description" rows="2"></textarea></div>
  </div>
  <label><input type="checkbox" name="is_published" checked> Publié</label>
  <button class="btn btn-primary btn-sm" type="submit">Ajouter</button>
</form>

<div class="table-wrap">
  <table>
    <thead><tr><th>Nom</th><th>Type</th><th>Statut</th><th></th></tr></thead>
    <tbody>
      <?php foreach ($items as $item): ?>
        <tr>
          <td><?= e($item['name']) ?></td>
          <td><?= e($item['partner_type']) ?></td>
          <td><?= $item['is_published'] ? 'Publié' : 'Masqué' ?></td>
          <td>
            <form method="post" action="<?= base_path('admin/partenaires/delete') ?>" onsubmit="return confirm('Supprimer ?')">
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
