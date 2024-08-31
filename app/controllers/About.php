<?php

class About extends Controller
{
  public function index()
  {
    $destinationsModel = $this->model('Destinations_model');
    $orderModel = $this->model('Orders_model');

    $allDestinations = $destinationsModel->getAllDestinations();
    $totalDestinations = count($allDestinations);

    $allOrders = $orderModel->getOrders();
    $totalOrders = count($allOrders);

    $data = [
      'title' => 'About Us',
      'totalDestinations' => $totalDestinations,
      'totalOrders' => $totalOrders
    ];
    $this->view('about/index', $data);
  }
}
