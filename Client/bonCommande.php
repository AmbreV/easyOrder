<?php
session_start();

require "../ClassPHP/donner.class.php"; 
$don = new donner();
$json = $don ->_select();
//require "con.class.php";
$con = new con();
$remise = $con->_demander("select remise from Clients where refClient = 
  $_SESSION[refClient]", array())[0][0];
?>
<!DOCTYPE HTML>
<html>
<head>
<title>Commnande</title>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="../CSS/style.css" />
<script type="text/javascript">
var remiseClient = <?php echo $remise ; ?>;
var pdt = <?php print_r($json); ?>;
</script>
<script type="text/javascript" src="bonC.js" >
</script>
</head>
<body>
<h1>BON DE COMMANDE</h1>

<div id="commande"> 
  <form id="bon" action="passerCommande.php" method="post" >
<div class="largeblock" >
    <table id="lignesForm">
<tr>
<th>Ref</th><th>Nature</th><th>Specification</th><th>P.Unit</th>
<th>Prix Remisé</th><th>Qté</th><th>Total HT</th>
</tr>
</table>
  <button class="bigbutton" type="button" id="lignePlus" >Ajouter une ligne</button>
</div>
<div class="tri">
<br />
<br />
  <textarea name="note" cols="50" rows="7"
  placeholder="Précisions à apporter (facultatif)" ></textarea>
<br />
  <input class="bigbutton" type="submit" value="submit" name="submit" />
  </form>
</div>
</div>

</body>
</html>
