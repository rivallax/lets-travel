<?php

class Reviews_model
{

  private $table = 'reviews';
  private $db;

  public function __construct()
  {
    $this->db = new Database;
  }

  public function getAllReviews()
  {
    $query = 'SELECT * FROM ' . $this->table;
    $this->db->query($query);
    return $this->db->resultSet();
  }

  public function getReviewsByDestinationId($destinationId)
  {
    $query = 'SELECT 
                    r.*, 
                    u.username, 
                    u.full_name, 
                    u.email, 
                    u.image, 
                    u.created_at as user_created_at 
                  FROM ' . $this->table . ' r
                  JOIN users u ON r.user_id = u.id
                  WHERE r.destination_id = :destination_id';
    $this->db->query($query);
    $this->db->bind(':destination_id', $destinationId, PDO::PARAM_INT);
    return $this->db->resultSet();
  }
}
