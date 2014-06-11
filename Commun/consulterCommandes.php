<?php
session_start();

$numCom = $_POST['consulter'];
/*
$numCom = 1;
 */


require "../ClassPHP/cone.class.php";
$con = new con();

//commande
$req  = 'SELECT Commandes.refCom, dateCom, Commandes.valide as coVal, note, ';
//clients
$req .= 'Clients.refClient, nomClient, adresse, codePost, ville, pays, ';
$req .= 'telClient, mailClient, tvaIntracom, correspondant, remise, seuil, ';
//lignes commande
$req .= 'refLico, quantite, puRemise, ';
//produits
$req .= 'Produits.clefProd, refProd, nature, specProd, pu, ';
$req .= 'unite, Produits.valide as prodVal ';

$req .= 'FROM Commandes, Clients, Lignesco, Produits ';
$req .= 'WHERE '; // tout correspond à la commande demandée
$req .= 'Commandes.refCom = Lignesco.refCom AND ';
$req .= 'Produits.clefProd  = Lignesco.clefProd AND ';
$req .= 'Clients.refClient = Commandes.refClient AND ';
$req .= 'Commandes.refCom = :n';
$arg  = array('n' => $numCom);
$resultat  = $con->_demander($req, $arg);

$json = json_encode($resultat);


?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<title>Commande</title>
<link rel="stylesheet" type="text/css" href="../CSS/style.css" />
<script type="text/javascript">
  //var commande = eval('('<?php print_r($json); ?>')') ;
  var vue = "<?php echo $_SESSION['categ']; ?>" ;
  var data = <?php print_r($json); ?>;

var refcom = data[0].refCom;
var datecom = data[0].dateCom;
var valide = data[0].coVal;
var note = data[0].note;
var client = data[0].nomClient;
var adresse = data[0].adresse;
var codepost = data[0].codePost;
var ville = data[0].ville;
var pays = data[0].pays;
var tel = data[0].telClient;
var mail = data[0].mailClient;
var intracom = data[0].tvaIntracom;
var corresp = data[0].correspondant;
var remise = data[0].remise / 100;
var seuil = data[0].seuil / 100;

var reflico = [] ;
var quantite = [] ;
var puremise = [] ;
var clefProd = [] ;
var refProd = [] ;
var nature = [] ;
var spec = [] ;
var pu = [] ;
var unite = [] ;
var prodVal = [] ;


for (var i=0; i<data.length; i++) {
  reflico.push(data[i].refLico);
  quantite.push(data[i].quantite);
  puremise.push(data[i].puRemise / 100);
  clefProd.push(data[i].clefProd);
  refProd.push(data[i].refProd);
  nature.push(data[i].nature);
  spec.push(data[i].specProd);
  pu.push(data[i].pu / 100);
  unite.push(data[i].unite);
  prodVal.push(data[i].prodVal);
}
 
</script>
<script type="text/javascript" src="consulterCom.js" ></script>
</head>
<body>

<h1></h1>
<div class="largeblock" >
<table id="entete" ></table>
</div>

<div class="tri" >
<h2></h2>
  <form id="etat" method="post" action="../Admin/trtPanCom.php" >
  <input type="hidden" name="commande" />
  <input type="hidden" name="dest" />
  <select name="action" style="padding: 5px 130px;font-size:1.3em">
  </select>
<br />
  <textarea name="raison" id="raison"  cols="50" rows="7" 
  style="font-size:1.1em" placeholder="raison du changement d’état" ></textarea>
<br />
  <input class="bigbutton" type="submit" name="submit" value="Envoi" />
  </form>
</div>

<br />
<div class="largeblock" >
<table id="lignes" >
  <tr>
    <th>reference</th>
    <th>nature</th>
    <th>specification</th>
    <th>P.U. Public</th>
    <th>P.U. Remisé</th>
    <th>quantité</th>
    <th>unité</th>
    <th>total HT</th>
    <th>dispo</th>
  </tr>
</table>
</div>

</body>
</html>

