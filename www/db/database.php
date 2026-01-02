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
  public function getUserFromEmail($email): array
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
  public function getNextPTSessionsFromUser($user_id): array
  {
    $query =
      "SELECT id_prenotazione, DATE_FORMAT(p.data, '%d/%m/%Y') as data, TIME_FORMAT(p.ora, '%H:%i') as ora, l.nome as luogo
       FROM prenotazioni p, luoghi l
       WHERE p.luogo = l.codice
       AND utente = ?
       AND TIMESTAMP(p.data, p.ora) >= CURRENT_TIMESTAMP()
       ORDER BY p.data, p.ora;
    ";
    $stmt = $this->db->prepare($query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
  }

  public function getPTSessionsFromDate($date): array
  {
    $query =
      "SELECT id_prenotazione, TIME_FORMAT(p.ora, '%H:%i') as ora, l.nome as luogo, utente, email
       FROM prenotazioni p, luoghi l, utenti u
       WHERE p.luogo = l.codice
       AND p.utente = u.id_utente
       AND p.data = ?
       ORDER BY p.ora;
    ";
    $stmt = $this->db->prepare($query);
    $stmt->bind_param("s", $date);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
  }

  public function getUserOfSession($app_id): array|bool|null
  {
    $query =
      "SELECT id_utente, nome, cognome FROM prenotazioni p, utenti u
       WHERE p.utente = u.id_utente
       AND p.id_prenotazione = ?;
    ";
    $stmt = $this->db->prepare($query);
    $stmt->bind_param("i", $app_id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
  }

  public function deleteSession($app_id): bool
  {
    $query = "DELETE FROM prenotazioni WHERE id_prenotazione = ?;";
    $stmt = $this->db->prepare($query);
    $stmt->bind_param('i', $app_id);
    return $stmt->execute();
  }

  public function getAvailableTimes($date): array
  {
    $query =
      "SELECT TIME_FORMAT(orario, '%H:%i') as orario 
       FROM orari
       WHERE orario not in (SELECT ora
                            FROM prenotazioni
                            WHERE data = ?)
       AND TIMESTAMP(?, orario) > CURRENT_TIMESTAMP();
    ";
    $stmt = $this->db->prepare($query);
    $stmt->bind_param("ss", $date, $date);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    $times = [];
    foreach ($result as $time) {
      $times[] = $time["orario"];
    }
    return $times;
  }

  public function addReservation($user_id, $date, $time): bool
  {
    $query = "INSERT INTO prenotazioni(data, ora, utente, luogo) 
              VALUES (?, ?, ?, (SELECT codice 
                                FROM luoghi 
                                ORDER BY RAND() 
                                LIMIT 1));";
    $stmt = $this->db->prepare($query);
    $stmt->bind_param('sss', $date, $time, $user_id);
    return $stmt->execute();
  }

  public function getPetList(): array
  {
    $query = "SELECT * FROM pet P ,razze R , specie S WHERE P.ID_Razza = R.ID_Razza  AND R.ID_Specie = S.ID_Specie;";
    $stmt = $this->db->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
  }
  public function getSinglePet($pet_id): array
  {
    $query = "SELECT * FROM pet P ,razze R , specie S WHERE P.ID_Razza = R.ID_Razza  AND R.ID_Specie = S.ID_Specie and P.ID_Pet = ?;";
    $stmt = $this->db->prepare($query);
    $stmt->bind_param('i', $pet_id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
  }

  public function getSpecie(): array
  {
    $query = "SELECT * FROM specie";
    $stmt = $this->db->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
  }

  public function getRace(): array
  {
    $query = "SELECT * FROM razze r , specie s where R.ID_Specie = S.ID_Specie; ";
    $stmt = $this->db->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
  }

  public function getRaceFromSpecie($id_specie): array
  {
    $query = "SELECT * FROM razze r , specie s where R.ID_Specie = S.ID_Specie and R.ID_Specie =?; ";
    $stmt = $this->db->prepare($query);

    $stmt->bind_param('i', $id_specie);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
  }

  public function addPet($nome, $datanascita, $nomerazza, $descrizione, $img, $descrizioneimg): bool
  {
    $query = "INSERT INTO Pet (
        Nomepet,
        DataDiNascita,
        Descrizione,
        Immagine,
        DescrizioneImmagine,
        Disponibile,
        ID_Razza
    )
VALUES (
        ?,?,?,?,?,
        1,
        ?
    )";
    $stmt = $this->db->prepare($query);
    $stmt->bind_param('ssssss', $nome, $datanascita, $descrizione, $img, $descrizioneimg, $nomerazza);
    return $stmt->execute();
  }

  public function modifyPet($nome, $datanascita, $nomerazza, $descrizione, $img, $descrizioneimg, $disponibile, $idpet ): bool
  {

    if(str_contains($disponibile ,"true")){
      $dispo = 1;
    }
    else{
      $dispo = 0;
    }
    $query = "UPDATE Pet
    SET Nomepet = ?,
      DataDiNascita = ?,
      Descrizione = ?,
      Immagine = ?,
      DescrizioneImmagine = ?,
      Disponibile = ?,
      ID_Razza = ?
    WHERE ID_Pet = ?;";
    $stmt = $this->db->prepare($query);
    $stmt->bind_param('sssssiii', $nome, $datanascita, $descrizione, $img, $descrizioneimg, $dispo, $nomerazza, $idpet);
    return $stmt->execute();
  }

  public function deletePet($pet_id): bool
  {
    $query = "DELETE FROM pet WHERE ID_Pet = ?;";
    $stmt = $this->db->prepare($query);
    $stmt->bind_param('i', $pet_id);
    return $stmt->execute();
  }
}
