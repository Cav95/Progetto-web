<?php
class DatabaseHelper
{
  private $db;

  public function __construct($servername, $username, $password, $dbname, $port)
  {
    $this->db = new mysqli($servername, $username, $password, $dbname, $port);
    if ($this->db->connect_error) {
      die("Connection failed: " . $this->db->connect_error);
    }
  }

  // LOGIN / REGISTRAZIONE
  public function getUser($email): array
  {
    $query = "SELECT * FROM utenti WHERE email = ?;";
    $stmt = $this->db->prepare($query);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
  }

  public function doesUserExist($email): bool
  {
    $query = "SELECT email FROM utenti WHERE email = ?;";
    $stmt = $this->db->prepare($query);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();

    return $result->fetch_column() ? true : false;
  }

  public function registerUser($email, $name, $surname, $password_hash): bool
  {
    $query = "INSERT INTO utenti(email, nome, cognome, password) VALUES (?, ?, ?, ?);";
    $stmt = $this->db->prepare($query);
    $stmt->bind_param('ssss', $email, $name, $surname, $password_hash);
    return $stmt->execute();
  }

  // CURIOSITÀ
  public function getRandomFacts($n): array
  {
    $query = "SELECT titolo, descrizione FROM curiosita ORDER BY RAND() LIMIT ?";
    $stmt = $this->db->prepare($query);
    $stmt->bind_param("i", $n);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
  }
}
