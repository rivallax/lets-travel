<?php

class Home extends Controller
{

  public function index()
  {
    $destinationsModel = $this->model('Destinations_model');
    $destinations = $destinationsModel->getAllDestinations();
    $random_image = $destinationsModel->getRandomImage();
    $topDestinations = $destinationsModel->getTopDestinations();

    if (empty($destinations)) {
      $this->view('error/404');
      return;
    }

    $data = [
      'title' => 'Home',
      'destinations' => $destinations,
      'random_image' => $random_image['image'],
      'topDestinations' => $topDestinations
    ];

    $this->view('home/index', $data);
  }

  public function test()
  {
    $this->singleView('home/test');
  }
}
