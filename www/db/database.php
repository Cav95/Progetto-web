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

  // PRENOTAZIONI
  public function getUserNextSessions($user_id): array {
    $query = 
      "SELECT id_prenotazione, DATE_FORMAT(data, '%d/%m/%Y') as data, TIME_FORMAT(ora, '%H:%i') as ora, stanza 
       FROM prenotazioni 
       WHERE utente = ?
       AND TIMESTAMP(data, ora) >= CURRENT_TIMESTAMP();
    ";
    $stmt = $this->db->prepare($query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
  }

  public function getUserOfSession($app_id): array {
    $query = 
      "SELECT id_utente, nome, cognome FROM prenotazioni p, utenti u
       WHERE p.utente = u.id_utente
       AND p.id_prenotazione = ?;
    ";
    $stmt = $this->db->prepare($query);
    $stmt->bind_param("i", $app_id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
  }

  public function deleteSession($app_id): bool {
    $query = "DELETE FROM prenotazioni WHERE id_prenotazione = ?;";
    $stmt = $this->db->prepare($query);
    $stmt->bind_param('i', $app_id);
    return $stmt->execute();
  }

  public function getPetList():array{
    $query= "SELECT * FROM pet P ,razze R , specie S WHERE P.ID_Razza = R.ID_Razza  AND R.ID_Specie = S.ID_Specie;";
    $stmt = $this->db->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
  }

}
