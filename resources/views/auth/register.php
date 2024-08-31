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
  <link rel="stylesheet" href="<?= ASSET; ?>/css/auth.css?v=<?php echo time(); ?>">

  <!-- Icons -->
  <link rel="stylesheet" href="<?= ASSET; ?>/vendor/boxicons/css/boxicons.min.css">
</head>

<body>

  <section class="register-container" id="register-container" style="background: url('<?= ASSET; ?>/img/destinations/<?= $data['random_image']; ?>'); background-size: cover; background-repeat: no-repeat; background-position: center">
    <div class="card">
      <div class="title">
        <h1>Registration</h1>
        <p>Register and get started with our service</p>
      </div>

      <form method="POST" action="<?= BASEURL; ?>/auth/registerUser">
        <div class="form-row">
          <div class="form-input">
            <input
              type="text"
              name="full_name"
              id="full_name"
              class="input-field"
              required />
            <label for="full_name">Full Name</label>
          </div>
          <div class="form-input">
            <input
              type="text"
              name="username"
              id="username"
              class="input-field"
              required />
            <label for="username">Username</label>
          </div>
        </div>
        <div class="form-input">
          <input
            type="email"
            name="email"
            id="email"
            class="input-field"
            required />
          <label for="email">Email</label>
        </div>
        <div class="form-input">
          <input
            type="password"
            name="password"
            id="password"
            class="input-field"
            required />
          <label for="password">Password</label>
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
      </form>
      <p class="log-link">Already have an account? <a href="<?= BASEURL; ?>/auth">Login here</a></p>
    </div>
  </section>

  <!-- JS -->
  <script src="<?= ASSET; ?>/js/script.js?v=<?php echo time(); ?>"></script>
</body>

</html>