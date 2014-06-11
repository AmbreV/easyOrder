<?php
session_start();

// Connexion à la base de données.
$BDD = mysql_connect("localhost","root","nono/44+");  
// Sélection de la base de données utilisée.
mysql_select_db("easyOrder");       

require "./ClassPHP/cone.class.php";
$con = new con();

// On met les variables utilisés du script PHP à FALSE.
$connexionOK = FALSE;

// On regarde si l'utilisateur a bien utilisé le module de connexion 
// pour traiter les données.
if(isset($_POST["connexion"])){

  // On sélectionne toute les données de l'utilisateur dans la base de données.
  $sql = "SELECT * FROM Clients WHERE mailClient = :e "; 
  //'".$_POST["Email"]."' ";
  $arg = array('e' => $_POST['Email']);

  $donnees = $con->_demander($sql, $arg)[0];

  if ( ($_POST["Email"] == $donnees["mailClient"]) && 
    ( $_POST["pass"] == $donnees["passClient"])) {

      $connexionOK = TRUE;
      $connexionMSG = "Connexion au site réussie. Vous êtes désormais
		      connecté !";

      $_SESSION["categ"] = $donnees["categ"];
      $_SESSION["email"] = $donnees['mailClient'];
      $_SESSION["refClient"] = $donnees["refClient"];

    } else{
    $errorMSG = "Nom de compte ou mot de passe incorrect !";
  }

} else{
  $errorMSG = "Nom de compte ou mot de passe incorrect !";
}

?>

<?php

if ($connexionOK == true) {
  switch ($_SESSION['categ']) {
  case 'admin': header('Location: Admin/admin.php');
    break;
  case 'commercial': header('Location: Commercial/commercial.php');
    break;
  case 'client': 
    if($donnees['valide'] == 1) {
      $_SESSION['valide'] = 1;
      header('Location: Client/client.php');
      break;
    }
  default: header('Location: inscription.html');
  }

} else {
echo '<p align="center" style="color:red"><strong>'.$errorMSG.'</strong></p>';
}

?>
