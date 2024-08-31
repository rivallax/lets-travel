<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $data['title']; ?></title>

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&family=Josefin+Sans:ital,wght@0,100..700;1,100..700&family=Lilita+One&family=Oswald:wght@200..700&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

  <!-- Styles -->
  <link rel="stylesheet" href="<?= ASSET; ?>/css/style.css?v=<?php echo time(); ?>">
  <link rel="stylesheet" href="<?= ASSET; ?>/css/components.css?v=<?php echo time(); ?>">

  <!-- Page Style -->
  <link rel="stylesheet" href="<?= ASSET; ?>/css/home.css?v=<?php echo time(); ?>">
  <link rel="stylesheet" href="<?= ASSET; ?>/css/header.css?v=<?php echo time(); ?>">

  <!-- Icons -->
  <link rel="stylesheet" href="<?= ASSET; ?>/vendor/boxicons/css/boxicons.min.css">
</head>

<body>
  <header class="header" id="header">
    <div class="overlay">
      <a href="<?= ASSET; ?>" class="logo">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
          <path d="M432 96a48 48 0 1 0 0-96 48 48 0 1 0 0 96zM347.7 200.5c1-.4 1.9-.8 2.9-1.2l-16.9 63.5c-5.6 21.1-.1 43.6 14.7 59.7l70.7 77.1 22 88.1c4.3 17.1 21.7 27.6 38.8 23.3s27.6-21.7 23.3-38.8l-23-92.1c-1.9-7.8-5.8-14.9-11.2-20.8l-49.5-54 19.3-65.5 9.6 23c4.4 10.6 12.5 19.3 22.8 24.5l26.7 13.3c15.8 7.9 35 1.5 42.9-14.3s1.5-35-14.3-42.9L505 232.7l-15.3-36.8C472.5 154.8 432.3 128 387.7 128c-22.8 0-45.3 4.8-66.1 14l-8 3.5c-32.9 14.6-58.1 42.4-69.4 76.5l-2.6 7.8c-5.6 16.8 3.5 34.9 20.2 40.5s34.9-3.5 40.5-20.2l2.6-7.8c5.7-17.1 18.3-30.9 34.7-38.2l8-3.5zm-30 135.1l-25 62.4-59.4 59.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L340.3 441c4.6-4.6 8.2-10.1 10.6-16.1l14.5-36.2-40.7-44.4c-2.5-2.7-4.8-5.6-7-8.6zM256 274.1c-7.7-4.4-17.4-1.8-21.9 5.9l-32 55.4L147.7 304c-15.3-8.8-34.9-3.6-43.7 11.7L40 426.6c-8.8 15.3-3.6 34.9 11.7 43.7l55.4 32c15.3 8.8 34.9 3.6 43.7-11.7l64-110.9c1.5-2.6 2.6-5.2 3.3-8L261.9 296c4.4-7.7 1.8-17.4-5.9-21.9z" />
        </svg>
        <span>Lets Travel</span>
      </a>

      <nav class="navbar">
        <ul>
          <li>
            <a class="<?= ($data['title'] === 'Home') ? 'active' : '' ?>" href="<?= BASEURL; ?>">Home</a>
          </li>
          <li>
            <a class="<?= ($data['title'] === 'Destinations') ? 'active' : '' ?>" href="<?= BASEURL; ?>/destinations">Destinations</a>
          </li>
          <li>
            <a class="<?= ($data['title'] === 'History') ? 'active' : '' ?>" href="<?= BASEURL; ?>/order/history">History</a>
          </li>
        </ul>
      </nav>

      <div class="nav-right-btn">
        <?php if (isset($_SESSION['user'])) : ?>
          <a class="btn carts-btn <?= ($data['title'] === 'My Carts') ? 'active' : '' ?>" href="<?= BASEURL; ?>/carts">
            <i class='bx bx-cart'></i>
            <?php if ($data['cart_count'] >= 1 && isset($data['cart_count'])) : ?>
              <span class="notification"><?= $data['cart_count']; ?></span>
            <?php endif; ?>
          </a>
          <div class="dropdown">
            <button class="dropdown-toggle">
              <div class="profile-thumbnail">
                <img src="<?= ASSET; ?>/img/users/<?= $_SESSION['user']['image']; ?>" alt="<?= $_SESSION['user']['name']; ?>">
              </div>
            </button>
            <ul class="dropdown-menu">
              <li><strong class="dropdown-item active"><?= $_SESSION['user']['full_name']; ?></strong></li>
              <li><a class="dropdown-item" href="#">Profile</a></li>
              <li><a class="dropdown-item" href="<?= BASEURL ?>/auth/logout">Logout</a></li>
            </ul>
          </div>
        <?php else : ?>
          <a href="<?= BASEURL ?>/auth" class="btn btn-primary">Login</a>
        <?php endif; ?>

        <button class="menu-toggle" id="menu-toggle" type="button" aria-controls="navbar-search" aria-expanded="false">
          <span class="sr-only">Open main menu</span>
          <svg class="menu-icon" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 17 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15" />
          </svg>
        </button>
      </div>
    </div>
  </header>

  <div id="cart-modal" class="modal">
    <div class="modal-content">
      <span class="close close-btn">&times;</span>
      <div class="modal-title">
        <h2>Add to cart</h2>
      </div>
      <div class="modal-body">
        <form id="cart-form" method="POST" action="<?= BASEURL; ?>/carts/add/" onsubmit="return false;">
          <input type="text" class="price-input" hidden>
          <div class="form-group">
            <label for="pax">Pax</label>
            <input type="number" name="pax" id="pax" class="form-control" value="1" required />
          </div>
          <div class="form-group">
            <label>Total Price:</label>
            <p class="total-price">Rp. 0.00</p>
            <input type="hidden" name="total_price" class="total-price-input" value="0">
          </div>
          <input type="hidden" name="user_id" value="<?= $_SESSION['user']['id']; ?>">
          <input type="hidden" name="destination_id" id="destination-id" value="">
          <button type="button" class="btn btn-primary add-to-cart">Add To Cart</button>
        </form>
      </div>
    </div>
  </div>