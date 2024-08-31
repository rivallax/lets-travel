<?php

class Destinations_model
{
  private $table = 'destinations';
  private $db;

  public function __construct()
  {
    $this->db = new Database;
  }

  public function getAllDestinations()
  {
    $query = 'SELECT * FROM ' . $this->table;
    $this->db->query($query);
    return $this->db->resultSet();
  }

  public function getDestinations($offset, $perPage)
  {
    $query = 'SELECT * FROM ' . $this->table . ' LIMIT :offset, :perPage';
    $this->db->query($query);
    $this->db->bind(':offset', $offset, PDO::PARAM_INT);
    $this->db->bind(':perPage', $perPage, PDO::PARAM_INT);
    return $this->db->resultSet();
  }

  public function getDestination($id)
  {
    $query = 'SELECT * FROM ' . $this->table . ' WHERE id = :id';
    $this->db->query($query);
    $this->db->bind(':id', $id, PDO::PARAM_INT);
    return $this->db->single();
  }

  public function getRandomImage()
  {
    $query = 'SELECT image FROM destinations ORDER BY RAND() LIMIT 1';
    $this->db->query($query);
    return $this->db->single();
  }

  public function getTopDestinations()
  {
    $query = "
        SELECT d.id, d.name, d.latlng, d.description, d.attractions, d.price, d.rating, d.image, 
               IFNULL(COUNT(o.id), 0) AS order_count
        FROM destinations d
        JOIN orders o ON d.id = o.destination_id
        GROUP BY d.id
        ORDER BY order_count DESC
        LIMIT 3
    ";
    $this->db->query($query);
    return $this->db->resultSet();
  }
}
