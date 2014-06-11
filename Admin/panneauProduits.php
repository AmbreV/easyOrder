<?php 
session_start();


if ((!isset($_SESSION['categ'])) || ($_SESSION['categ'] != 'admin')) 
  header('Location: index.php');

require "../ClassPHP/cone.class.php";
$con = new con();

$titre = array('Ref',
               'Nature',
               'Specification',
               'Unite',
               'Prix Unitaire',
               'Valide',
               'Action'
               );
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" >
<link rel="stylesheet" href="../CSS/style.css" >
<script src="panneau.js" ></script>
<title>Panneau</title>
</head>
<body>
<div class="largeblock">
<form action="trtPanProd.php" method="post" />
<table >
    <tr>
<?php for ($j=0; $j<count($titre); $j++) echo '<th>'.$titre[$j].'</th>'; ?>
    </tr>
<?php
//$resultat = $pan->getDonnees('produits');
$req  = "SELECT clefProd, refProd, nature, specProd, unite, pu, ";
$req .= "valide FROM Produits ";
$arg  = array('s' => $string);
$resultat = $con->_demander($req, $arg);

foreach ($resultat as $donnees) {
  echo '<tr>';
    $d = $donnees[0];
  echo '<input type="hidden" name="clefProd['.$d.']" value="'.$d.'" />';
  echo '<td><input type="text" name="refProd['.$d.']';
  echo '" value="'.$donnees[1].'" /></td>';
  echo '<td><input type="text" name="nature['.$d.']';
  echo '" value="'.$donnees[2].'" /></td>';
  echo '<td><input type="text" name="specProd['.$d.']';
  echo '" value="'.$donnees[3].'" /></td>';
  echo '<td><input type="text" name="unite['.$d.']';
  echo '" value="'.$donnees[4].'" /></td>';

  echo '<td><input type="text" name="pu['.$d.']';
  echo '" value="'.($donnees[5]/100.0).'" /></td>';

  echo '<td><select name="valide['.$d.']" >';
  if ($donnees[6] == 1) {
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
  /*
    if ($donnees['valide'] == false ) {
    echo '<button class="valider" type="button" value="true"';
    echo '" >Valider</button>';
    } else {
    echo '<button class="valider" type="button" value="false"';
    echo '" >Invalider</button>';
    }
  */
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
