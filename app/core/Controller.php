<?php

class Controller
{
  private function getCartCount($userId)
  {
    $cartsModel = $this->model('Carts_model');
    $carts = $cartsModel->getCartsByUserId($userId);
    return count($carts);
  }

  public function view($view, $data = [])
  {
    $userId = $_SESSION['user']['id'] ?? null;

    if ($userId) {
      $data['cart_count'] = $this->getCartCount($userId);
    } else {
      $data['cart_count'] = null;
    }

    require_once '../resources/templates/header.php';
    require_once '../resources/views/' . $view . '.php';
    require_once '../resources/templates/footer.php';
  }

  public function singleView($view, $data = [])
  {
    require_once '../resources/views/' . $view . '.php';
  }

  public function model($model)
  {
    require_once '../app/models/' . $model . '.php';
    return new $model;
  }
}
