<?php

session_start();
define("UPLOAD_DIR", "./upload/");
$dbh = new DatabaseHelper("localhost", "root", "", "giugno", 3307);

class DatabaseHelper{

    private $db;

    public function __construct($servername, $username, $password, $dbname, $port){
        $this->db = new mysqli($servername, $username, $password, $dbname, $port);
        if ($this->db->connect_error) {
            die("Connection failed: " . $db->connect_error);
        }        
    }

    public function getInsieme($n){
        $stmt = $this->db->prepare("SELECT id, valore, insieme FROM insiemi WHERE insieme = ?");
        $stmt->bind_param('i',$n);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

}

$A = $_GET["A"];
$B = $_GET["B"];
$O = $_GET["O"];

if(!isset($A) || !isset($B)) {
    die("ERRORE: variabili nulle");
} 

if($A < 0 || $B < 0) {
    die("ERRORE: variabili negative");
}

if(count(getInsieme($A)) == 0 && count(getInsieme($B)) == 0) {
    die("ERRORE: le variabili non appartengono all'insieme");
}

if(!isset($O) || $O != "i" && $O != "u") {
    die("ERRORE: variabile O nulla o diversa da 'i' o 'u'");
}

$valoriA = array();
for(int i = 0; i < count(getInsieme($A)); i++) {
    $elem = getInsieme($A)[i];
    $valoriA[i] = $elem["valore"];
}

$valoriB = array();
for(int i = 0; i < count(getInsieme($B)); i++) {
    $elem = getInsieme($B)[i];
    $valoriB[i] = $elem["valore"];
}

var_dump($valoriA);
var_dump($valoriB);

?>