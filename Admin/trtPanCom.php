<?php
session_start();

$refCom = $_POST['commande'];
$action = $_POST['action'];

require "../ClassPHP/cone.class.php";
$con = new con();

print_r($refCom);
echo ' -- -- ';
print_r($action);
if ( ($action != 1 ) && ( $action != 0 )) $action = NULL ;
else $action = intval($action);

$req = "update Commandes set valide = :v where refCom = :rc";
$arg = array('v' => $action, 'rc' => $refCom);
$rep = $con->_demander($req, $arg);


if (isset($rep) && ($rep == 0 ) ) {
  // une erreur s'est produite
}

$expe = $_SESSION['email'];
$dest = $_POST['dest'];

switch($action) {
  case 1: $sujet = "Validation de la commande ".$refCom;
          break;
  case 0: $sujet = "Anulation de la commande ".$refCom;
          break;
  default: $sujet = "Mise en attente de la commande ".$refCom;
}

$passage_ligne = "\n";

//=====Création du header de l'e-mail
$header = "From: $expe <$expe>".$passage_ligne;
$header.= "Reply-to: $expe <$expe>".$passage_ligne;
$header.= "MIME-Version: 1.0".$passage_ligne;
$header.= "Content-Type: text/plain;".$passage_ligne;

$message = $_POST['raison'];

mail($dest, $sujet, $message, $header);


header('Location:  panneauCommandes.php');

?>

