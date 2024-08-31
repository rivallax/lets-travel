<section class="carts" id="carts">
  <div class="title">
    <i class='bx bx-cart'></i>
    <h1>My Carts</h1>
    <p>Manage your carts here</p>
  </div>

  <div class="<?= (!empty($data['cartItems']) ? 'content' : 'empty') ?>">
    <?php if (!empty($data['cartItems'])) : ?>
      <table cellspacing="0">
        <thead>
          <th class="checkbox">
            <input type="checkbox" name="check-all" class="check-all">
          </th>
          <th>Product</th>
          <th>Unit Price</th>
          <th>Pax</th>
          <th>Total Price</th>
          <th>Action</th>
        </thead>
        <tbody>
          <?php foreach ($data['cartItems'] as $item) : ?>
            <tr>
              <td class="checkbox">
                <input type="checkbox" name="check-item" id="check-item">
              </td>
              <td>
                <div class="product">
                  <div class="thumbnail">
                    <img src="<?= ASSET; ?>/img/destinations/<?= $item['destination_image'] ?>" alt="<?= $item['destination_name'] ?>">
                  </div>
                  <div class="info">
                    <p><?= $item['destination_name'] ?></p>
                  </div>
                </div>
              </td>
              <td>Rp. <?= number_format($item['destination_price'], 2, ',', '.') ?></td>
              <td>
                <div class="input-counter">
                  <button type="button" class="decrement-btn">-</button>
                  <input type="text" class="quantity-input" value="<?= $item['quantity'] ?>" data-pax="<?= $item['quantity'] ?>" />
                  <button type="button" class="increment-btn">+</button>
                </div>
              </td>
              <td>Rp. <?= number_format($item['total_price'], 0, ',', '.') ?></td>
              <td>
                <a href="<?= BASEURL; ?>/carts/delete/<?= $item['id']; ?>" class="delete" class="btn btn-danger">Delete</a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    <?php else : ?>
      <div class="empty-info">
        <p>Tidak ada item di keranjang.</p>
      </div>
    <?php endif; ?>
  </div>
</section>

<div class="order-nav">
  <div class="content">
    <div class="left-nav">
      <div class="checker">
        <input type="checkbox" name="check-all" class="check-all" id="check-all">
        <label for="check-all">Pilih semua(3)</label>
      </div>
      <a href="<?= BASEURL; ?>/carts/delete/<?= $item['id']; ?>" class="delete" class="btn btn-danger">Delete</a>
    </div>
    <div class="right-nav">
      <p>Total(0 Destination): <span>Rp. 0.00</span></p>
      <a href="<?= BASEURL; ?>/carts/checkout" class="btn btn-primary" id="checkout-btn">Checkout</a>
    </div>
  </div>
</div>