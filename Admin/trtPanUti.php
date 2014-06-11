<?php 
session_start();
require "../ClassPHP/cone.class.php";
$con = new con();

//print_r($_POST);

for ($i=1; $i<=count($_POST['refClient']); $i++ ) {
  $arg = array('ref' => $_POST['refClient'][$i], 
               'nom' => $_POST['nomClient'][$i],
               'cat' => $_POST['categ'][$i],
               'adr' => $_POST['adresse'][$i],
               'cp'  => $_POST['codePost'][$i],
               'vil' => $_POST['ville'][$i],
               'pay' => $_POST['pays'][$i],
               'tel' => $_POST['telClient'][$i],
               'mcl' => $_POST['mailClient'][$i],
               'pss' => $_POST['passClient'][$i],
               'tva' => $_POST['tvaIntracom'][$i],
               'cor' => $_POST['correspondant'][$i],
               'rem' => $_POST['remise'][$i],
               'seu' => $_POST['seuil'][$i],
               'val' => $_POST['valide'][$i],
             );

  if (is_numeric($arg['ref'])) { 
    $req = "update Clients set nomClient=:nom, categ=:cat, adresse=:adr, 
      codePost=:cp, ville=:vil, pays=:pay, telClient=:tel, mailClient=:mcl,
      passClient=:pss, tvaIntracom=:tva, correspondant=:cor, remise=:rem, 
      seuil=:seu, valide=:val where refClient=:ref ";
  } else if ($arg['ref'] == 'nouveau' ) { 
    $req = "insert into Clients values (refClient, '$arg[nom]', '$arg[cat]', 
      '$arg[pss]', '$arg[adr]', '$arg[cp]', '$arg[vil]', '$arg[pay]', 
      '$arg[tel]', '$arg[mcl]', '$arg[tva]', '$arg[cor]', $arg[rem], 
      $arg[seu], $arg[val])";
  } else {
    continue;
  }

  $con->_demander($req, $arg);

}

header('Location: panneauUtilisateurs.php');


?>


