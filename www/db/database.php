<?php
class DatabaseHelper{
    private $db;

    public function __construct($servername, $username, $password, $dbname, $port) {
        $this->db = new mysqli($servername, $username, $password, $dbname, $port);
        if ($this->db->connect_error) {
            die("Connection failed: " . $this->db->connect_error);
        }        
    }

    // LOGIN / REGISTRAZIONE -- DA RIFARE
    public function getUserPasswordHash($username): bool|string {
        $query = "SELECT password FROM utenti WHERE e_mail = ?;";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s',$username);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_column();
    }

    public function doesUserExist($username): bool {
        $query = "SELECT e_mail FROM utenti WHERE e_mail = ?;";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s',$username);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_column() ? true : false;
    }

    public function registerUser($username, $passwordHash): bool {
        $query = "INSERT INTO utenti(e_mail, password) VALUES (?, ?);";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ss',$username, $passwordHash);
        return $stmt->execute();
    }

    // CURIOSITÀ
    public function getRandomFacts($n): array {
        $query = "SELECT titolo, descrizione FROM curiosita ORDER BY RAND() LIMIT ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $n);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
