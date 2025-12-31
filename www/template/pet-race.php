<?php
require_once "bootstrap.php";

if (isset($_POST['spec-sel']) && !empty($_POST['spec-sel'])) {
    $result = $dbh->getRace($_POST['spec-sel']);
}

if (isset($result) && $result instanceof mysqli_result) {
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<option value="' . htmlspecialchars($row['ID_Razza'], ENT_QUOTES) . '">' . htmlspecialchars($row['nomerazza'], ENT_QUOTES) . '</option>';
        }
    } else {
        echo '<option value="">Nessuna razza trovata</option>';
    }
} else {
    echo '<option value="">Nessuna razza selezionata/option>';
}

require "template/base.php";
?>