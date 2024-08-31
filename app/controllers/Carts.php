<?php

class Carts extends Controller
{
  public function index()
  {
    $userId = $_SESSION['user']['id'];

    if (!isset($userId)) {
      header('Location: ' . BASEURL . '/auth');
      exit;
    }

    $cartModel = $this->model('Carts_model');
    $cartItems = $cartModel->getCartsByUserId($userId);

    $data = [
      'title' => 'My Carts',
      'cartItems' => $cartItems,
    ];

    $this->view('carts/index', $data);
  }

  public function add()
  {
    $userId = $_POST['user_id'];
    $destinationId = $_POST['destination_id'];
    $quantity = $_POST['pax'];
    $totalPrice = $_POST['total_price'];

    $cartModel = $this->model('Carts_model');
    $result = $cartModel->addCart($userId, $destinationId, $quantity, $totalPrice);

    if ($result) {
      Flasher::setFlash('Item added to cart successfully!', 'success', 'absolute');
    } else {
      Flasher::setFlash('Failed to add item to cart.', 'error', 'absolute');
    }

    header('Location: ' . BASEURL . '/carts');
    exit;
  }
}
