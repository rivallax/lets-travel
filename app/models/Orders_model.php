<?php

class Orders_model
{
  private $table = 'orders';
  private $db;

  public function __construct()
  {
    $this->db = new Database;
  }

  public function getOrders()
  {
    $query = 'SELECT * FROM ' . $this->table;
    $this->db->query($query);
    return $this->db->resultSet();
  }

  public function getOrderCount($destinationId)
  {
    $query = "
            SELECT COUNT(*) AS order_count
            FROM orders
            WHERE destination_id = :destination_id
        ";
    $this->db->query($query);
    $this->db->bind(':destination_id', $destinationId, PDO::PARAM_INT);
    return $this->db->single();
  }

  public function getOrdersByUserId($user_id)
  {
    $query = "SELECT o.id, o.destination_id, o.total_price, o.quantity, o.created_at, o.expired_at, 
                     d.name as destination_name 
              FROM orders o 
              JOIN destinations d ON o.destination_id = d.id 
              WHERE o.user_id = :user_id";

    $this->db->query($query);
    $this->db->bind('user_id', $user_id);
    return $this->db->resultSet();
  }

  public function createOrder($orderId, $userId, $destinationId, $totalPrice, $quantity)
  {
    $query = "INSERT INTO orders (id, user_id, destination_id, total_price, quantity) VALUES (:id, :user_id, :destination_id, :total_price, :quantity)";
    $this->db->query($query);
    $this->db->bind(':id', $orderId);
    $this->db->bind(':user_id', $userId);
    $this->db->bind(':destination_id', $destinationId);
    $this->db->bind(':total_price', $totalPrice);
    $this->db->bind(':quantity', $quantity);

    return $this->db->execute();
  }

  public function getOrderDetails($orderId)
  {
    $query = 'SELECT o.id as order_id, o.total_price, o.quantity, d.name, d.price
                  FROM orders o
                  JOIN destinations d ON o.destination_id = d.id
                  WHERE o.id = :order_id';

    $this->db->query($query);
    $this->db->bind(':order_id', $orderId);

    $result = $this->db->resultSet();

    $orderDetails = [
      'order' => [
        'id' => $orderId,
        'total_price' => $result[0]['total_price'],
        'quantity' => $result[0]['quantity'],
        'created_at' => date('Y-m-d H:i:s'),
        'details' => []
      ]
    ];

    foreach ($result as $row) {
      $orderDetails['order']['details'] = [
        'name' => $row['name'],
        'quantity' => $row['quantity'],
        'price' => $row['price']
      ];
    }

    return $orderDetails;
  }
}
