<div class="dash-grid">
  <div class="dash-card"><strong><?= (int) $counts['projects_active'] ?></strong><span>Projets actifs</span></div>
  <div class="dash-card"><strong><?= (int) $counts['projects_completed'] ?></strong><span>Projets terminés</span></div>
  <div class="dash-card"><strong><?= (int) $counts['news'] ?></strong><span>Actualités</span></div>
  <div class="dash-card"><strong><?= (int) $counts['partners'] ?></strong><span>Partenaires</span></div>
  <div class="dash-card"><strong><?= (int) $counts['publications'] ?></strong><span>Publications</span></div>
  <div class="dash-card"><strong><?= (int) $counts['messages'] ?></strong><span>Messages non lus</span></div>
  <div class="dash-card"><strong><?= (int) $counts['regions'] ?></strong><span>Régions</span></div>
  <div class="dash-card"><strong>—</strong><span>Bénéficiaires (à valider)</span></div>
</div>

<div class="table-wrap">
  <table>
    <thead>
      <tr><th>Messages récents</th><th>Organisation</th><th>Date</th><th></th></tr>
    </thead>
    <tbody>
      <?php if (empty($recentMessages)): ?>
        <tr><td colspan="4">Aucun message.</td></tr>
      <?php else: foreach ($recentMessages as $m): ?>
        <tr>
          <td><strong><?= e($m['full_name']) ?></strong><br><span style="color:var(--muted)"><?= e($m['subject']) ?></span></td>
          <td><?= e($m['organization'] ?: '—') ?></td>
          <td><?= e(format_date($m['created_at'])) ?></td>
          <td><?= $m['is_read'] ? '<span class="badge-muted badge">Lu</span>' : '<span class="badge">Nouveau</span>' ?></td>
        </tr>
      <?php endforeach; endif; ?>
    </tbody>
  </table>
</div>
