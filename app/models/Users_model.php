<?php

class Users_model
{

  private $table = 'users';
  private $db;

  public function __construct()
  {
    $this->db = new Database;
  }

  public function getUsers()
  {
    $query = 'SELECT * FROM ' . $this->table;
    $this->db->query($query);
    return $this->db->resultSet();
  }

  public function getUser($id)
  {
    $query = 'SELECT * FROM ' . $this->table . ' WHERE id = :id';
    $this->db->query($query);
    $this->db->bind('id', $id);
    return $this->db->single();
  }
}
