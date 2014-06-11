<?php

session_start();

require "./ClassPHP/cone.class.php";
$con = new con();


$inscriptionOK = false;
$error = FALSE;

if(isset($_POST["inscription"])){
  if($_POST["email"] == NULL OR $_POST["pass"] == NULL or $_POST["passcheck"] 
    == null or $_POST["country"] == null or $_POST["city"] == null or 
    $_POST["postcode"] == null or $_POST["adress"] == null or $_POST["phone"] 
    == null or $_POST["client"] == null or $_POST["corres"] == null)
  {
    $error = TRUE;
    $errorMSG = "Veuillez remplir tout les champs";	

  } else {
    $req = "SELECT mailClient FROM Clients WHERE mailClient = '$_POST[email]' ";
    $mail= $con->_demander($req, array() );
    $req = "SELECT nomClient FROM Clients WHERE nomClient ='$_POST[client]' ";
    $nom = $con->_demander($req, array() );

    if (isset($nom[0][0])) { 
      $error=true; $errorMSG ="Cette entreprise possède déjà un compte";
    } else 	{
      if (isset($mail[0][0])) { 
        $error=true; $errorMSG ="L'adresse Email que vous avez entrée est déjà utilisée";
      
      } else {	
      if ( $_post["pass"]==$_post["passcheck"])
      {	
        $req = "INSERT INTO Clients VALUES (refClient, 
          '$_POST[client]','client','$_POST[pass]','$_POST[adress]',
          '$_POST[postcode]','$_POST[city]','$_POST[country]','$_POST[phone]',
          '$_POST[email]',' ','$_POST[corres]',0,0,FALSE)";
        $con->_demander($req, array());
        $inscriptionOK = true;
      } else {	$error = TRUE;	$errorMSG = "Erreur a la confirmation du mot de passe";
      }
      }
    }
  }
}


if($error == TRUE){ echo "<p align='center' style='color:red'><strong>".$errorMSG."</strong></p>"; } 

if($inscriptionOK == TRUE){ echo "<p align='center' style='color:red'><strong>Inscription réussie</strong></p>";}
?>

