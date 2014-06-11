<?php 
session_start();
if ((!isset($_SESSION['categ']) || ( $_SESSION['categ'] != 'client' )) && 
  ($_SESSION['valide'] == 1 )) {
    header('Location: index.html');
  }


?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<title>EasyOrder - Admin</title>
<link rel="stylesheet" type="text/css" href="../CSS/style.css" />
<script type="text/javascript" >
window.onload = function() {
  var but = document.getElementsByTagName('button');
  var main = document.getElementById('main');

  function eteindre() {
    for (var i=0; i<but.length; i++) {
      but[i].style.color = "black";
    }
  }
  
  for (var i = 0 ; i<but.length; i++) {
    but[i].onclick = function(b) { 
      main.src = this.value;
      eteindre();
      this.style.color = "#D26A00";
    }
  }
}
</script>
<style>
	
body   {background-image: url(../img/MOTIFS.jpg);width: 100%; height: 100%}
#haut  {position: fixed; width: 99%; top: 0; height: 5%}
#corps {width: 100%; position: fixed; bottom: 0; top: 28%}
#main  {width: 100%; height: 100%}
</style>
</head>
<body>
<div id="haut" > <!-- panneau de commandes horrizontal -->
<div id="header"></div>
  <a href="../index.html">
    <img alt="logo EasyOrder - Déconnexion" id="logo" title="déconnexion" 
src="../img/logo.jpg" />
  </a>
<div class="menu" >
  <button type="button" id="produits" value="bonCommande.php" 
    >BON DE COMMANDE</button>
  <button type="button" id="utilisateurs" value="../mesCommandes.php" 
    >HISTORIQUE</button>
  <button type="button" id="commandes" value="./Catalogue/catalogue.php" 
    >CATALOGUE</button>
</div>
</div>

<div id="corps"> <!-- iframe d'action -->
  <iframe id="main" src="#" ></iframe>
</div>

</body>
</html>
