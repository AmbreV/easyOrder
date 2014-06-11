<?php
session_start();
require "../ClassPHP/cone.class.php";
$con = new con();

$rc = $_SESSION['refClient'];
$c = $_POST['clefProd'];
$q = $_POST['quantite'];

echo $rc;

print_r($_SESSION);

$entete = array(
		'client'  => $rc,
		'datecom' => date("Y-m-d"),
		'note'    => $_POST['note']
		);

$j=0;

foreach ($_POST['clefProd'] as $i => $cp ) {
  /*
    $p[$i]=1;
  */
  //echo "$cp -- ";

  $pu = $con->_demander("select pu from Produits where clefProd = :cp ",
    array('cp' => $cp ) )[0][0];

  //echo $pu.'-';
  
  $rem = $con->_demander("select remise from Clients where refClient = :rc",
    array('rc' => $rc ) )[0][0];

  //echo $rem.'-';
  $pur = $pu*(1-$rem/10000);
  //$p[$i] = $client->_getPu($ra);
  //$t = $p*$q[$i];
  //echo $pur.'-';
  
  $lignes[$j] = array(
		      'clefProd'   => $cp,
		      'quantite'   => $q[$i],
		      'pur'        => $pur
		      );
  
  $j++;

}

$refcomA = $con->_demander('select refCom from Commandes order by 
  refCom desc limit 1', array())[0][0];

// enregistrer l'entete de la commande
$reqE = "insert into Commandes values
  (refcom, $entete[client], '$entete[datecom]', null, '$entete[note]')";
$con->_demander($reqE, array());

echo $reqE;
//récupéré la référence SQL de la commande pour indexer les lignes
$refcom = $con->_demander('select refCom from Commandes order by 
  refCom desc limit 1', array())[0][0];

echo 'refcom == '.$refcom.' -- refcomA == '.(1+$refcomA);
if ( $refcom == (1+$refcomA))  {
  //enregistrer chaque ligne une à une
  // $req = "insert into Lignesco values (refLico, :rc, :cp, :q, :pur)";
  foreach ( $lignes as $cle => $ligne ) {
    $req = "insert into Lignesco values 
      (refLico, $refcom, $ligne[clefProd], $ligne[quantite], $ligne[pur])";
    echo $req;
    $con->_demander($req, array());
  }
}

header('Location: ../mesCommandes.php');

?>
