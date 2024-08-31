<section class="destinations" id="destinations">
  <div class="title">
    <i class='bx bxs-plane-take-off'></i>
    <h1>Destinations</h1>
    <p>Temukan Destinasi Impian Anda dengan Mudah dan Cepat</p>
  </div>
  <div class="search-container">
    <div class="search-icon">
      <i class='bx bx-search icon'></i>
      <span class="sr-only">Search icon</span>
    </div>
    <input type="text" id="search-navbar" class="search-input" placeholder="Mau ke mana ?">
  </div>
  <div class="content">
    <?php foreach ($data['destinations'] as $destination) : ?>
      <div class="card">
        <img src="<?= ASSET; ?>/img/destinations/<?= $destination['image']; ?>" alt="<?= $destination['name']; ?>">
        <div class="caption">
          <h3><?= $destination['name']; ?></h3>
          <p><?= $destination['description']; ?></p>
          <div class="pricing">
            <h4>Rp. <?= number_format($destination['price'], 0, ',', '.'); ?></h4>
            <p>
              <i class='bx bxs-star'></i>
              <span><?= $destination['rating']; ?></span>
            </p>
          </div>
          <div class="cta">
            <a href="<?= BASEURL; ?>/destinations/detail/<?= $destination['id']; ?>" class="btn btn-primary">Detail</a>
            <a class="btn-icon cart-btn-cta" data-id="<?= $destination['id']; ?>" data-price="<?= $destination['price']; ?>" data-session="<?= json_encode(isset($_SESSION['user'])); ?>" data-login-url="<?= BASEURL; ?>/auth">
              <i class='bx bx-cart-add'></i>
            </a>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>

  <!-- Pagination -->
  <div class="pagination">
    <?php if ($data['currentPage'] > 1): ?>
      <a href="<?= BASEURL; ?>/destinations/index/<?= $data['currentPage'] - 1; ?>" class="btn btn-primary">&laquo; Previous</a>
    <?php endif; ?>

    <?php
    $totalPages = $data['totalPages'];
    $currentPage = $data['currentPage'];
    $showPages = 3;

    if ($totalPages > $showPages) {
      if ($currentPage <= $showPages) {
        for ($i = 1; $i <= $showPages; $i++) {
          echo '<a href="' . BASEURL . '/destinations/index/' . $i . '" class="btn outline-btn ' . ($i == $currentPage ? 'btn-active' : '') . '">' . $i . '</a>';
        }
        echo '<span>...</span>';
        echo '<a href="' . BASEURL . '/destinations/index/' . $totalPages . '" class="btn outline-btn">' . $totalPages . '</a>';
      } elseif ($currentPage > $showPages && $currentPage < $totalPages - $showPages + 1) {
        echo '<a href="' . BASEURL . '/destinations/index/1" class="outline-btn">1</a>';
        echo '<span>...</span>';
        for ($i = $currentPage - 1; $i <= $currentPage + 1; $i++) {
          echo '<a href="' . BASEURL . '/destinations/index/' . $i . '" class="btn outline-btn ' . ($i == $currentPage ? 'btn-active' : '') . '">' . $i . '</a>';
        }
        echo '<span>...</span>';
        echo '<a href="' . BASEURL . '/destinations/index/' . $totalPages . '" class="btn outline-btn">' . $totalPages . '</a>';
      } else {
        echo '<a href="' . BASEURL . '/destinations/index/1" class="btn outline-btn">1</a>';
        echo '<span>...</span>';
        for ($i = $totalPages - $showPages + 1; $i <= $totalPages; $i++) {
          echo '<a href="' . BASEURL . '/destinations/index/' . $i . '" class="btn outline-btn ' . ($i == $currentPage ? 'btn-active' : '') . '">' . $i . '</a>';
        }
      }
    } else {
      for ($i = 1; $i <= $totalPages; $i++) {
        echo '<a href="' . BASEURL . '/destinations/index/' . $i . '" class="btn outline-btn ' . ($i == $currentPage ? 'btn-active' : '') . '">' . $i . '</a>';
      }
    }
    ?>

    <?php if ($data['currentPage'] < $totalPages): ?>
      <a href="<?= BASEURL; ?>/destinations/index/<?= $data['currentPage'] + 1; ?>" class="btn btn-primary">Next &raquo;</a>
    <?php endif; ?>
  </div>
</section>


<div id="destinations-modal" class="modal">
  <div class="modal-content">
    <span class="close close-btn">&times;</span>
    <div class="modal-title">
      <h2><?= $data['title']; ?></h2>
    </div>
    <div class="modal-body">
      <h4>Mulailah Perjalanan Anda!</h4>
      <br>
      <p>Temukan destinasi terbaik sesuai minat Anda, dan buat kenangan indah di setiap langkah.</p>
    </div>
    <div class="modal-footer">
      <a class="btn btn-primary close-btn">Close</a>
    </div>
  </div>
</div>