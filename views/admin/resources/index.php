<form class="admin-form" method="post" action="<?= base_path('admin/ressources/save') ?>" style="margin-bottom:1.5rem">
  <?= Csrf::field() ?>
  <h2 style="font-size:1.15rem;margin:0">Ajouter une publication</h2>
  <div class="form-grid">
    <div class="form-group"><label>Titre</label><input name="title" required></div>
    <div class="form-group"><label>Type</label>
      <select name="resource_type">
        <option value="rapport">Rapport</option>
        <option value="publication">Publication</option>
        <option value="brochure">Brochure</option>
        <option value="media">Média</option>
        <option value="autre">Autre</option>
      </select>
    </div>
    <div class="form-group"><label>Année</label><input name="year" type="number" min="2001" max="2100"></div>
    <div class="form-group"><label>Fichier / URL externe</label><input name="external_url" placeholder="https://..."></div>
    <div class="form-group"><label>Chemin fichier local</label><input name="file_path" placeholder="uploads/resources/..."></div>
    <div class="form-group full"><label>Description</label><textarea name="description" rows="2"></textarea></div>
  </div>
  <label><input type="checkbox" name="is_published"> Publier</label>
  <button class="btn btn-primary btn-sm" type="submit">Enregistrer</button>
</form>

<div class="table-wrap">
  <table>
    <thead><tr><th>Titre</th><th>Type</th><th>Statut</th></tr></thead>
    <tbody>
      <?php foreach ($items as $item): ?>
        <tr>
          <td><?= e($item['title']) ?></td>
          <td><?= e($item['resource_type']) ?></td>
          <td><?= $item['is_published'] ? 'Publié' : 'Brouillon' ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
