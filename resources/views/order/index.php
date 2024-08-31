<section class="order-details" id="order-details">
  <div class="qr-code">
    <h1>Scan QR Code</h1>
    <div class="thumbnail">
      <img src="<?= $data['qr_code_url']; ?>" alt="<?= $data['destination']['name']; ?>">
    </div>
    <a href="<?= $data['qrCodeUrl']; ?>" download="ticket-qr-code.png" class="btn btn-primary">Download QR Code</a>
  </div>
  <div class="card">
    <h1>Order Details</h1>
    <ul>
      <li><strong>Ticket ID:</strong> <?= $data['order']['id']; ?></li>
      <li><strong>Destination:</strong> <?= $data['order']['details']['name']; ?></li>
      <li><strong>Pax:</strong> <?= $data['order']['details']['quantity']; ?></li>
      <li><strong>Total Price:</strong> Rp. <?= number_format($data['order']['total_price'], 0, ',', '.'); ?></li>
      <li><strong>Created At:</strong> <?= $data['order']['created_at']; ?></li>
    </ul>
  </div>
</section>

</body>

</html>