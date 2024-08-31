<section class="history" id="history">
  <div class="title">
    <h1>History</h1>
    <p>Manage your orders here</p>
  </div>

  <div class="<?= (!empty($data['orders']) ? 'content' : 'empty') ?>">
    <?php if (!empty($data['orders'])) : ?>
      <table>
        <thead>
          <tr>
            <th>No</th>
            <th>Destination</th>
            <th>Total Price</th>
            <th>Pax</th>
            <th>Created At</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php $i = 1; ?>
          <?php foreach ($data['orders'] as $order) : ?>
            <tr>
              <td><?= $i; ?></td>
              <td><?= $order['destination_name']; ?></td>
              <td>Rp. <?= number_format($order['total_price'], 0, ',', '.') ?></td>
              <td><?= $order['quantity']; ?></td>
              <td style="color: #686868;"><?= $order['created_at']; ?></td>
              <td>
                <?php if (is_null($order['expired_at'])): ?>
                  <span class="badge badge-success">Not Yet Used</span>
                <?php else: ?>
                  <span class="badge badge-danger">Used</span>
                <?php endif; ?>
              </td>
              <td>
                <a href="<?= BASE_URL; ?>/order/<?= $order['id']; ?>" class="btn btn-primary">Detail</a>
              </td>
            </tr>
            <?php $i++; ?>
          <?php endforeach; ?>
        </tbody>
      </table>
    <?php else : ?>
      <div class="empty-info">
        <p>Tidak ada item di history.</p>
      </div>
    <?php endif; ?>
  </div>
</section>