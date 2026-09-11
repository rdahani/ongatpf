<div class="table-wrap">
  <table>
    <thead><tr><th>Expéditeur</th><th>Sujet</th><th>Message</th><th>Date</th><th></th></tr></thead>
    <tbody>
      <?php foreach ($items as $item): ?>
        <tr>
          <td>
            <strong><?= e($item['full_name']) ?></strong><br>
            <?= e($item['email']) ?><br>
            <?= e($item['organization'] ?: '') ?>
          </td>
          <td><?= e($item['subject']) ?></td>
          <td style="max-width:320px"><?= e(truncate($item['message'], 160)) ?></td>
          <td><?= e(format_date($item['created_at'])) ?></td>
          <td>
            <?php if (!$item['is_read']): ?>
              <form method="post" action="<?= base_path('admin/messages/read') ?>">
                <?= Csrf::field() ?>
                <input type="hidden" name="id" value="<?= (int) $item['id'] ?>">
                <button class="btn btn-outline btn-sm">Marquer lu</button>
              </form>
            <?php else: ?>
              <span class="badge-muted badge">Lu</span>
            <?php endif; ?>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
