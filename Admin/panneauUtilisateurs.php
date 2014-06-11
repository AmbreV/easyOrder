<?php 
session_start();

/*
if (!isset($_SESSION['categorie']) ) header('Location: index.php');

$categorie = $_SESSION['categorie'];

if ( $categorie == 'administrateur' ) {
  if (isset($_POST['genre']) ) {  
    $genre = $_POST['genre'];
  } else  {
    $genre = 'commandes';
  }
} else if ( $categorie == 'commercial' ) { 
  $genre = 'commandes';
} else {
  header('Location: index.php');
}

 */

require "../ClassPHP/cone.class.php";
$con = new con();


$titre = array(
	       'Nom',
	       'Catégorie',
	       'Adresse',
	       'Code Postal',
	       'Ville',
	       'Pays',
	       'Tel',
	       'Mail',
	       'Pass',
	       'Tva Intracom',
	       'Correspondant',
	       'Remise',
	       'Seuil',
	       'Valide',
	       'Action'
	       );

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" >
  <link rel="stylesheet" href="/CSS/style.css" >
  <script type="text/javascript" src="panneau.js" ></script>
  <title>Panneau</title>
</head>
<body>
<div class="largeblock lb">
  <form action="trtPanUti.php" method="post" >
  <table>
  <tr>
  <?php for ($j=0; $j<count($titre); $j++) echo '<th>'.$titre[$j].'</th>'; ?>
  </tr>
<?php
//  $resultat = $pan->getDonnees('utilisateurs');

$req  = "SELECT refClient, nomClient, categ, adresse, codePost, ";
$req .= "ville, pays, telClient, mailClient, passClient, tvaIntracom, ";
$req .= "correspondant, remise, seuil, valide FROM Clients ";
$arg  = array();
$resultat = $con->_demander($req, $arg);

foreach ($resultat as $donnees) {
  echo '<tr>';
  //for ($i=0; $i<$j-2; $i++) {
  $d= $donnees[0];
  echo '<td><input type="hidden" name="refClient['.$d.']';
  echo '" value="'.$donnees[0].'" />';

  echo '<input type="text" name="nomClient['.$d.']';
  echo '" value="'.$donnees[1].'" /></td>';

  echo '<td><input type="text" name="categ['.$d.']';
  echo '" value="'.$donnees[2].'" /></td>';

  echo '<td><input type="text" name="adresse['.$d.']';
  echo '" value="'.$donnees[3].'" /></td>';

  echo '<td><input type="text" name="codePost['.$d.']';
  echo '" value="'.$donnees[4].'" /></td>';

  echo '<td><input type="text" name="ville['.$d.']';
  echo '" value="'.$donnees[5].'" /></td>';

  echo '<td><input type="text" name="pays['.$d.']';
  echo '" value="'.$donnees[6].'" /></td>';

  echo '<td><input type="text" name="telClient['.$d.']';
  echo '" value="'.$donnees[7].'" /></td>';

  echo '<td><input type="text" name="mailClient['.$d.']';
  echo '" value="'.$donnees[8].'" /></td>';

  echo '<td><input type="text" name="passClient['.$d.']';
  echo '" value="'.$donnees[9].'" /></td>';

  echo '<td><input type="text" name="tvaIntracom['.$d.']';
  echo '" value="'.$donnees[10].'" /></td>';

  echo '<td><input type="text" name="correspondant['.$d.']';
  echo '" value="'.$donnees[11].'" /></td>';

  echo '<td><input type="text" name="remise['.$d.']';
  echo '" value="'.$donnees[12].'" /></td>';

  echo '<td><input type="text" name="seuil['.$d.']';
  echo '" value="'.$donnees[13].'" /></td>';

  //}

  echo '<td><select name="valide['.$d.']" >';
  if ($donnees[14] == 1) {
    echo '<option value="0">NON</option>';
    echo '<option value="1" selected="selected">OUI</option>';
  } else {
    echo '<option value="0" selected="selected">NON</option>';
    echo '<option value="1">OUI</option>';
  }
  echo '</select></td>';

  echo '<td>';

    /*
    echo 'Supprimer: <checkbox class="supprimer" name="supprimer'.$d.'" />';
     */

  echo '<button class="dupliquer smallbutton" type="button" value="'.$d.'" >';
  echo 'Dupliquer</button>';
  echo '</td>';
  echo '</tr>';
}
?>

</table>
<input type="submit" name="submit" value="Effectuer les mises à jours" />
</form>
</div>

</body>
</html>
