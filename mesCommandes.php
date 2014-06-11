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

if ( isset($_POST['duAn'] ) ) {
  $tri[0] = $_POST['client'];
  $tri[1] = $_POST['duAn'].'-'.$_POST['duMois'].'-'.$_POST['duJour'];
  $tri[2] = $_POST['auAn'].'-'.$_POST['auMois'].'-'.$_POST['auJour'];
  $tri[3] = $_POST['sauf'];
  $tri[4] = $_POST['etat'];
} else {
  $tri[0] = (date("Y")-5).'-1-0';
  $tri[1] = date("Y").'-12-31';
  $tri[2] = '';
  $tri[3] = '9';
}

require "./ClassPHP/cone.class.php";
$con = new con();

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" >
<link rel="stylesheet" type="text/css" href="./CSS/style.css" >
<script src="./Admin/panneau.js" ></script>
<title>Panneau</title>
</head>
<body>
<h1>HISTORIQUE</h1>
<div class="tri">
<p>CRITÈRES DE TRI</p>
<form id="tri" method="post" action="" >
  du : 
  <select name="duJour">
  <?php for ($i=0; $i<=31; $i++) {
          if ( $i === $_POST['duJour'] ) echo "<option selected>$i</option>";
          else echo "<option>$i</option>";
        }?>
  </select>/
  <select name="duMois">
  <?php for ($i=1; $i<=12; $i++) {
          if ( $i == $_POST['duMois'] ) echo "<option selected>$i</option>";
          else echo "<option>$i</option>";
        }?>
  </select>/
  <select name="duAn">
  <?php for ($i=date("Y")-5; $i<date("Y"); $i++) {
          if ( $i == $_POST['duAn'] ) echo "<option selected>$i</option>";
          else echo "<option>$i</option>";
        }?>
  </select>
  au : 
  <select name="auJour">
  <?php for ($i=31; $i>=0; $i--) {
          if ( $i === $_POST['auJour'] ) echo "<option selected>$i</option>";
          else echo "<option>$i</option>";
        }?>
  </select>/
  <select name="auMois">
  <?php for ($i=12; $i>=1; $i--) {
          if ( $i == $_POST['auMois'] ) echo "<option selected>$i</option>";
          else echo "<option>$i</option>";
        }?>
  </select>/
  <select name="auAn">
  <?php for ($i=date("Y"); $i>date("Y")-5; $i--) {
          if ( $i == $_POST['auAn'] ) echo "<option selected>$i</option>";
          else echo "<option>$i</option>";
        }?>
  </select>
<br />
  État ( sauf <input type="checkbox" name="sauf"
<?php if ($tri[3] == 'on') echo 'checked="checked" '; ?> /> )
  <select name="etat" >
    <option value="9" >Tout</option>
    <option value="1" <?php if($tri[4]==1) echo 'selected="selected" ';?>
      >Validée</option>
    <option value="0" <?php if($tri[4]===0) echo 'selected="selected" ';?>
      >Rejetée</option>
    <option value="-1" <?php if($tri[4]==-1) echo 'selected="selected" ';?>
      >À traiter</option>
  </select>
<br />
  <input class="bigbutton" type="submit" name="trier" value="Trier" />
</form>
</div>
<br />

<div class="largeblock" >
<table>
  <tr>
    <th>Réf</th>
    <th>Date</th>
    <th>Montant</th>
    <th>Etat</th>
    <th>Actions</th>
  </tr>
<?php
//$resultat = $pan->_getEntetesCom();

$req  = 'SELECT Commandes.refCom ref, nomClient client, ';
$req .= 'date_format(dateCom, "%d %m %Y") date, ';
$req .= 'sum(quantite*puRemise) montant, Commandes.valide ';
$req .= 'FROM Commandes, Clients, Lignesco ';
$req .= 'WHERE ';
$req .= 'Commandes.refCom = Lignesco.refCom AND ';
$req .= 'Commandes.refClient = Clients.refClient AND ';
$req .= 'Clients.refClient = :rc ';
//$req .= 'dateCom between "'.$tri[1].'" AND "'.$tri[2].'"';
//if ( $tri[1] != '') 
  //$req .= 'AND dateCom between "'.$tri[1].'" and "'.$tri[2].'" ';
$req .= 'AND dateCom between :du and :au ';
if ($tri[3] === '') {
  $req .= '';
} else if ( ($tri[3] == 1) || (intval($tri[3]) === 0) ) {
  if ( $tri[2] == 'on' ) {
    $req .= 'AND Commandes.valide != '.$tri[3].' ';
  } else {
    $req .= 'AND Commandes.valide = '.$tri[3].' ';
  }
} else  if ( $tri[3] == -1 ) { 
  if ( $tri[2] == 'on' ) {
    $req .= 'AND Commandes.valide is not null ';
  } else {
    $req .= 'AND Commandes.valide is null ';
  }
}
$req .= 'GROUP BY Commandes.refCom ';
$req .= 'ORDER BY Commandes.refCom DESC';
$arg  = array('du' => $tri[0], 
              'au' => $tri[1], 
              'rc' => $_SESSION['refClient']
             );
//con::_demander("set @@lc_time_names='fr_FR'", array());
$resultat  = $con->_demander($req, $arg);

foreach ($resultat as $donnees) {
//while ( $donnees = $resultat->fetch() ) {
  $d = $donnees['ref'];
  echo '<tr>';
  echo '<td>'.$donnees['ref'].'</td>';
  echo '<td>'.$donnees['date'].'</td>';
  echo '<td>'.($donnees['montant']/100.0).'</td>';
  echo '<td>';
  switch($donnees['valide']) {
  case null: echo 'À Traitée' ; break;
  case 0: echo 'Rejetée'; break;
  case 1: echo 'Validée'; break;
  }
    echo '</td>';
  echo '<form method="post" action="consulterCommandes.php" >';
  echo '<td>';
  echo '<input type="hidden" name="consulter" value="'.$d.'" />';
  echo '<input class="consult smallbutton" type="submit" 
    name="submit" value="consulter"';
  /*
  echo '<button class="consulter" type="button" name="consulter" value="'.$d;
  echo '" >Consulter</button>';
   */
  echo '</td>';
  echo '</form>';
  echo '</tr>';
}
?>

</table>
</form>
</div>


</body>
</html>
