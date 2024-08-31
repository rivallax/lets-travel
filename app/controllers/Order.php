<?php

class Order extends Controller
{
  public function index($id)
  {
    $user = $_SESSION['user'];

    if (!isset($user)) {
      header('Location: ' . BASEURL . '/auth');
      exit;
    }

    $ordersModel = $this->model('Orders_model');
    $orderDetails = $ordersModel->getOrderDetails($id);

    $qrCodeUrl = $this->generateQRCodeUrl($orderDetails);

    $data = [
      'title' => 'Order Details',
      'order' => $orderDetails['order'],
      'qr_code_url' => $qrCodeUrl
    ];

    $this->view('order/index', $data);
  }

  public function handle($id)
  {
    $pax = $_POST['pax'] ?? null;
    $totalPrice = $_POST['total_price'] ?? null;

    $destinationsModel = $this->model('Destinations_model');
    $destination = $destinationsModel->getDestination($id);
  }

  private function generateQRCodeUrl($orderDetails)
  {
    $ticketId = $orderDetails['order']['id'];
    $destination = $orderDetails['order']['details']['name'] ?? 'Unknown Destination';
    $pax = $orderDetails['order']['details']['quantity'] ?? 'Unknown Pax';

    // Combine data into a string
    $qrCodeContent = "Ticket ID: $ticketId\nDestination: $destination\nPax: $pax";

    // Encode the string and generate QR code URL
    $apiUrl = 'https://quickchart.io/qr?text=' . urlencode($qrCodeContent) . '&size=300';

    return $apiUrl;
  }

  public function history()
  {
    $userId = $_SESSION['user']['id'];

    if (!isset($userId)) {
      header('Location: ' . BASEURL . '/auth');
      exit;
    }

    $ordersModel = $this->model('Orders_model');
    $orders = $ordersModel->getOrdersByUserId($userId);

    $data = [
      'title' => 'History',
      'orders' => $orders,
    ];

    $this->view('order/history', $data);
  }
}
