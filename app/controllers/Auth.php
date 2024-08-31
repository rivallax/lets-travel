<?php

class Auth extends Controller
{
  public function index()
  {
    $destinationsModel = $this->model('Destinations_model');
    $random_image = $destinationsModel->getRandomImage();

    if (isset($_SESSION['user'])) {
      header('Location: ' . BASEURL . '/destinations');
      exit;
    }

    $data = [
      'title' => 'Sign In',
      'random_image' => $random_image['image']
    ];

    $this->singleView('auth/login', $data);
  }

  public function register()
  {
    $destinationsModel = $this->model('Destinations_model');
    $random_image = $destinationsModel->getRandomImage();

    if (isset($_SESSION['user'])) {
      header('Location: ' . BASEURL . '/destinations');
      exit;
    }

    $data = [
      'title' => 'Sign Up',
      'random_image' => $random_image['image']
    ];

    $this->singleView('auth/register', $data);
  }

  public function login()
  {
    if (isset($_POST['submit'])) {
      $identifier = htmlspecialchars(trim($_POST['identifier']));
      $password = htmlspecialchars(trim($_POST['password']));

      if (empty($identifier) || empty($password)) {
        Flasher::setFlash('Email dan password harus diisi!', 'error');
        header('Location: ' . BASEURL . '/auth');
        exit;
      }

      $authModel = $this->model('Authentications_model');
      $user = $authModel->getUserByEmailOrUsername($identifier);

      $cartsModel = $this->model('Carts_model');

      if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user'] = $user;

        Flasher::setFlash('Login berhasil', 'success');
        header('Location: ' . BASEURL);
        exit;
      } else {
        Flasher::setFlash('Email atau password salah', 'error');
        header('Location: ' . BASEURL . '/auth');
        exit;
      }
    }
  }

  public function registerUser()
  {
    if (isset($_POST['submit'])) {
      $full_name = htmlspecialchars(trim($_POST['full_name']));
      $username = htmlspecialchars(trim($_POST['username']));
      $email = htmlspecialchars(trim($_POST['email']));
      $password = htmlspecialchars(trim($_POST['password']));

      if (empty($full_name) || empty($email) || empty($username) || empty($password)) {
        Flasher::setFlash('Semua kolom harus diisi!', 'error');
        header('Location: ' . BASEURL . '/auth/register');
        exit;
      }

      $hashed_password = password_hash($password, PASSWORD_DEFAULT);

      $authModel = $this->model('Authentications_model');
      if ($authModel->registerUser($full_name, $username, $email, $hashed_password)) {
        Flasher::setFlash('Registrasi berhasil', 'success');
        header('Location: ' . BASEURL . '/auth');
        exit;
      } else {
        Flasher::setFlash('Registrasi gagal', 'danger');
        header('Location: ' . BASEURL . '/auth/register');
        exit;
      }
    }
  }

  public function logout()
  {
    session_unset();
    session_destroy();

    Flasher::setFlash('Anda telah logout', 'success');
    header('Location: ' . BASEURL . '/auth');
    exit;
  }
}
