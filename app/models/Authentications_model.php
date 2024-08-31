<?php

class Authentications_model
{
  private $table = 'users';
  private $db;

  public function __construct()
  {
    $this->db = new Database;
  }

  public function getUserByEmailOrUsername($identifier)
  {
    $query = 'SELECT * FROM ' . $this->table . ' WHERE email = :identifier OR username = :identifier';
    $this->db->query($query);
    $this->db->bind('identifier', $identifier);
    return $this->db->single();
  }

  public function registerUser($full_name, $username, $email, $password)
  {
    $query = 'INSERT INTO ' . $this->table . ' (full_name, username, email, password) VALUES (:full_name, :username, :email, :password)';
    $this->db->query($query);
    $this->db->bind('email', $email);
    $this->db->bind('username', $username);
    $this->db->bind('password', $password);
    $this->db->bind('full_name', $full_name);

    return $this->db->execute();
  }
}
