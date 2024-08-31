<?php

class Carts_model
{
  private $table = 'carts';
  private $db;

  public function __construct()
  {
    $this->db = new Database;
  }

  public function getCartsByUserId($userId)
  {
    $this->db->query("SELECT carts.*, 
                             destinations.name AS destination_name, 
                             destinations.price AS destination_price, 
                             destinations.image AS destination_image
                      FROM " . $this->table . " 
                      JOIN destinations ON carts.destination_id = destinations.id 
                      WHERE carts.user_id = :user_id");
    $this->db->bind(':user_id', $userId);
    return $this->db->resultSet();
  }

  public function addCart($userId, $destinationId, $quantity, $totalPrice)
  {
    $this->db->query('INSERT INTO ' . $this->table . ' (user_id, destination_id, quantity, total_price, created_at) VALUES (:user_id, :destination_id, :quantity, :total_price, NOW())');
    $this->db->bind(':user_id', $userId);
    $this->db->bind(':destination_id', $destinationId);
    $this->db->bind(':quantity', $quantity);
    $this->db->bind(':total_price', $totalPrice);

    return $this->db->execute();
  }

  public function removeCartItem($cartId)
  {
    $this->db->query("DELETE FROM carts WHERE id = :id");
    $this->db->bind(':id', $cartId);
    return $this->db->execute();
  }
}
