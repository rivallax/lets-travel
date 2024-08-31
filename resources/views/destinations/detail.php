<section class="destination-detail" id="destination-detail">
  <div class="thumbnail">
    <img src="<?= ASSET; ?>/img/destinations/<?= $data['destination']['image']; ?>" alt="<?= $data['destination']['name']; ?>">
  </div>
  <div class="content">
    <h1><?= $data['destination']['name']; ?></h1>
    <div class="info">
      <div class="rating">
        <div class="stars">
          <?= $data['destination']['rating']; ?>
          <?php for ($i = 0; $i < floor($data['destination']['rating']); $i++) : ?>
            <i class='bx bxs-star full'></i>
          <?php endfor; ?>
          <?php if ($data['destination']['rating'] - floor($data['destination']['rating']) >= 0.5) : ?>
            <i class='bx bxs-star-half half'></i>
          <?php endif; ?>
          <?php for ($i = ceil($data['destination']['rating']); $i < 5; $i++) : ?>
            <i class='bx bx-star empty'></i>
          <?php endfor; ?>
        </div>
      </div>
    </div>
    <div class="destination-detail-info">
      <div class="attractions">
        <h3><i class='bx bx-notepad'></i> Attractions</h3>
        <ul>
          <?php foreach ($data['attractions'] as $attraction) : ?>
            <li><?= $attraction; ?></li>
          <?php endforeach; ?>
        </ul>
      </div>
      <div class="location">
        <h3><i class='bx bx-map'></i> Address:</h3>
        <p><?= $data['address']; ?></p>
      </div>
    </div>
    <div class="description">
      <h3><i class='bx bx-detail'></i> Description:</h3>
      <p><?= $data['destination']['description']; ?></p>
    </div>
    <div class="price">
      <h2>Rp. <?= number_format($data['destination']['price'], 0, ',', '.'); ?>/<span>pax</span></h2>
      <h4><?= $data['order_count']; ?> Total Pemesanan</h4>
    </div>
    <div class="cta">
      <a class="btn outline-btn cart-btn-cta" data-id="<?= $data['destination']['id']; ?>" data-price="<?= $data['destination']['price']; ?>" data-session="<?= json_encode(isset($_SESSION['user'])); ?>" data-login-url="<?= BASEURL; ?>/auth">
        <i class='bx bx-cart-add'></i>
        <span>Masukkan Keranjang</span>
      </a>
      <button class="btn btn-primary" id="order-btn" data-id="<?= $data['destination']['id']; ?>" data-price="<?= $data['destination']['price']; ?>">Pesan Sekarang</button>
    </div>
  </div>
</section>

<section class="reviews" id="reviews">
  <div class="title">
    <i class='bx bx-message-square'></i>
    <h1>Reviews</h1>
  </div>
  <div class="content">
    <?php if (!empty($data['reviews'])) : ?>
      <?php foreach ($data['reviews'] as $review) : ?>
        <div class="review">
          <div class="review-header">
            <div class="user-info">
              <div class="thumbnail">
                <img src="<?= ASSET; ?>/img/users/<?= $review['image']; ?>" alt="<?= $review['name']; ?>">
              </div>
              <div class="review-info">
                <h3 class="truncate-name"><?= $review['full_name']; ?></h3>
                <p><?= $review['created_at']; ?></p>
              </div>
            </div>
            <div class="rating">
              <?= $review['rating']; ?>
              <?php for ($i = 0; $i < floor($review['rating']); $i++) : ?>
                <i class='bx bxs-star full'></i>
              <?php endfor; ?>
              <?php if ($review['rating'] - floor($review['rating']) >= 0.5) : ?>
                <i class='bx bxs-star-half half'></i>
              <?php endif; ?>
              <?php for ($i = ceil($review['rating']); $i < 5; $i++) : ?>
                <i class='bx bx-star empty'></i>
              <?php endfor; ?>
            </div>
          </div>
          <p class="comment-text"><?= $review['comment']; ?></p>
          <a href="javascript:void(0);" class="show-more">Lihat selengkapnya</a>
        </div>
      <?php endforeach; ?>
    <?php else : ?>
      <p>Tidak ada review</p>
    <?php endif; ?>
  </div>
</section>

<div id="transaction-modal" class="modal">
  <div class="modal-content">
    <span class="close close-btn">&times;</span>
    <div class="modal-title">
      <h2><?= htmlspecialchars($data['destination']['name']); ?> - Order</h2>
    </div>
    <div class="modal-body">
      <form id="transaction-form" method="POST" action="<?= htmlspecialchars(BASEURL); ?>/order/handle/<?= htmlspecialchars($data['destination']['id']); ?>" onsubmit="return false;">
        <input type="text" class="price-order" hidden>
        <div class="form-group">
          <label for="pax-order">Pax</label>
          <input type="number" name="pax" id="pax-order" class="form-control" value="1" required />
        </div>
        <div class="form-group">
          <label>Total Price:</label>
          <p id="total-price-order">Rp. 0,00</p>
          <input type="hidden" name="total_price" class="total-price-input-order" value="0">
        </div>
        <button type="button" class="btn btn-primary" id="pay">Order</button>
      </form>
      <input type="hidden" id="snap-token" value="">
    </div>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const orderBtn = document.getElementById("order-btn");
    const transactionModal = document.getElementById("transaction-modal");
    const priceInput = document.querySelector('.price-order');
    const paxInput = document.getElementById('pax-order');
    const totalPriceElement = document.getElementById('total-price-order');
    const totalPriceInput = document.querySelector('.total-price-input-order');

    function formatRupiah(amount) {
      return amount.toLocaleString('id-ID', {
        style: 'currency',
        currency: 'IDR',
        minimumFractionDigits: 2
      }).replace('Rp ', 'Rp. ');
    }

    function updateTotalPrice() {
      const paxValue = parseInt(paxInput.value, 10) || 1;
      const price = parseFloat(priceInput.value) || 0;
      const totalPrice = paxValue * price;

      totalPriceElement.textContent = formatRupiah(totalPrice);
      totalPriceInput.value = totalPrice.toFixed(2);
    }

    function openTransactionModal() {
      if (!isLoggedIn) {
        window.location.href = '<?= BASEURL; ?>/auth';
        return;
      }

      transactionModal.style.display = 'block';
      priceInput.value = orderBtn.getAttribute('data-price') || '0';
      paxInput.value = paxInput.value || 1;
      updateTotalPrice();
    }

    if (orderBtn) {
      orderBtn.addEventListener('click', openTransactionModal);
    }

    paxInput.addEventListener('input', updateTotalPrice);

    const closeButtons = document.querySelectorAll('.close-btn');
    closeButtons.forEach(button => {
      button.addEventListener('click', () => {
        transactionModal.style.display = 'none';
      });
    });

    window.addEventListener('click', (event) => {
      if (event.target === transactionModal) {
        transactionModal.style.display = 'none';
      }
    });

    const isLoggedIn = <?= json_encode(isset($_SESSION['user'])); ?>;
    const userId = <?= json_encode($_SESSION['user']['id'] ?? null); ?>;
    const payButton = document.getElementById('pay');

    if (payButton) {
      payButton.addEventListener('click', function() {
        if (!isLoggedIn) {
          window.location.href = '<?= BASEURL; ?>/auth';
          return;
        }
        alert(
          "Fitur masih dalam tahap pengembangan \nMohon maaf atas ketidak nyamanannya!"
        );
      });
    }
  });
</script>