<?php

class Destinations extends Controller
{
  public function index($page = 1)
  {
    $perPage = 8;
    $offset = ($page - 1) * $perPage;

    $destinationsModel = $this->model('Destinations_model');

    $allDestinations = $destinationsModel->getAllDestinations();
    $totalDestinations = count($allDestinations);
    $totalPages = ceil($totalDestinations / $perPage);

    $totalPages = ($totalDestinations > 0) ? $totalPages : 1;

    $destinations = $destinationsModel->getDestinations($offset, $perPage);

    $data = [
      'title' => 'Destinations',
      'destinations' => $destinations,
      'currentPage' => $page,
      'totalPages' => $totalPages
    ];

    $this->view('destinations/index', $data);
  }

  public function detail($id)
  {
    $destinationsModel = $this->model('Destinations_model');
    $ordersModel = $this->model('Orders_model');
    $reviewModel = $this->model('Reviews_model');

    $destination = $destinationsModel->getDestination($id);
    $orderCount = $ordersModel->getOrderCount($id);
    $reviews = $reviewModel->getReviewsByDestinationId($id);

    $address = getAddressFromLatLng($destination['latlng']);

    $attractions = explode(',', $destination['attractions']);

    $data = [
      'title' => $destination['name'] . ' - Details',
      'destination' => $destination,
      'address' => $address,
      'attractions' => $attractions,
      'order_count' => $orderCount['order_count'],
      'reviews' => $reviews,
    ];

    $this->view('destinations/detail', $data);
  }
}
