<?php 
session_start();
require "../ClassPHP/cone.class.php";
$con = new con();

//print_r($_POST);

for ($i=1; $i<=count($_POST['clefProd']); $i++ ) {
  $arg = array(
    'cp' => $_POST['clefProd'][$i],
    'rp' => $_POST['refProd'][$i],
    'n'  => $_POST['nature'][$i],
    's'  => $_POST['specProd'][$i],
    'p'  => intval($_POST['pu'][$i]*100),
    'u'  => $_POST['unite'][$i],
    'v'  => $_POST['valide'][$i]
  );


  if (is_numeric($arg['cp'])) { 
    //si 'cp' est numérique, c'est une clef, donc une update
    $req = "update Produits set refProd=:rp, nature=:n, specProd=:s, pu=:p,
      unite=:u, valide=:v where clefProd=:cp ";

  } else if ($arg['cp'] == 'nouveau') {
    //si 'cp' est 'nouveau', c'est pour une insertion
    $req = "insert into Produits values(clefProd, 
      '$arg[rp]', '$arg[n]', '$arg[s]', $arg[p], '$arg[u]', $arg[v])";
  } else {
    //sinon c'est une erreur, autant ne rien en faire et passer au suivant
    continue;
  }


  $con->_demander($req, $arg);
}

header('Location: panneauProduits.php');

?>


