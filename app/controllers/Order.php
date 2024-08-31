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

    if (empty($pax) || empty($totalPrice) || empty($destination)) {
      echo json_encode(['error' => 'Invalid input']);
      return;
    }

    $itemDetails = [
      [
        'id' => $destination['id'],
        'name' => $destination['name'],
        'price' => $destination['price'],
        'quantity' => $pax
      ]
    ];

    $transaction = [
      'transaction_details' => [
        'order_id' => uniqid(),
        'gross_amount' => $totalPrice
      ],
      'item_details' => $itemDetails,
      'customer_details' => [
        'first_name' => $_SESSION['user']['full_name'],
        'email' => $_SESSION['user']['email'],
      ],
      'enabled_payments' => ['gopay', 'dana', 'bank_transfer']
    ];

    try {
      $snapToken = \Midtrans\Snap::getSnapToken($transaction);
      echo json_encode(['token' => $snapToken]);
    } catch (Exception $e) {
      echo json_encode(['error' => $e->getMessage()]);
    }
  }

  public function saveTransaction()
  {
    $input = json_decode(file_get_contents('php://input'), true);

    $orderId = $input['order_id'] ?? null;
    $userId = $input['user_id'] ?? null;
    $destinationId = $input['destination_id'] ?? null;
    $totalPrice = $input['total_price'] ?? null;
    $quantity = $input['quantity'] ?? null;

    if (!$orderId || !$userId || !$destinationId || !$totalPrice || !$quantity) {
      echo json_encode(['status' => false, 'message' => 'Invalid input']);
      return;
    }

    $ordersModel = $this->model('Orders_model');
    $result = $ordersModel->createOrder($orderId, $userId, $destinationId, $totalPrice, $quantity);

    if (!$result) {
      echo json_encode(['status' => false, 'message' => 'Database insert failed']);
    } else {
      echo json_encode(['status' => true, 'order_id' => $orderId]);
    }
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
