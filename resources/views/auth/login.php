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
  <section class="login-container" id="login-container" style="background: url('<?= ASSET; ?>/img/destinations/<?= $data['random_image']; ?>'); background-size: cover; background-repeat: no-repeat; background-position: center">
    <div class="card">
      <div class="title">
        <h1>Welcome</h1>
        <p>We are happy to have you back!</p>
      </div>
      <form method="POST" action="<?= BASEURL; ?>/auth/login" class="content">
        <div class="form-input">
          <input
            type="text"
            name="identifier"
            id="identifier"
            class="input-field"
            required />
          <label for="identifier">Username or email</label>
          <i class='bx bxs-user'></i>
        </div>
        <div class="form-input">
          <input
            type="password"
            name="password"
            id="password"
            class="input-field"
            required />
          <label for="password">Password</label>
          <i class="bx bxs-lock pass-icon"></i>
        </div>
        <div class="remember-forgot">
          <section class="remember">
            <input type="checkbox" name="checkbox" id="checkbox" />
            <label for="checkbox">Remember</label>
          </section>
          <section class="forgot">
            <a href="" class="forgot-link">Forgot Password?</a>
          </section>
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Login</button>
      </form>
      <p class="reg-link">Don't have an account? <a href="<?= BASEURL; ?>/auth/register">Sign Up</a></p>
    </div>
  </section>

  <script>
    const password = document.querySelector('#password');
    const passwordIcon = document.querySelector('.pass-icon');

    passwordIcon.addEventListener('click', () => {
      if (password.type === 'password') {
        password.type = 'text';
        passwordIcon.classList.remove('bxs-lock');
        passwordIcon.classList.add('bxs-lock-open');
        passwordIcon.classList.add('active');
      } else {
        password.type = 'password';
        passwordIcon.classList.remove('bxs-lock-open');
        passwordIcon.classList.add('bxs-lock');
      }
    });
  </script>

  <!-- JS -->
  <script src="<?= ASSET; ?>/js/script.js?v=<?php echo time(); ?>"></script>
</body>

</html>