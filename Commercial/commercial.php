<?php 
session_start();
//if ( !isset($_SESSION['categ']) || ( $_SESSION['categ'] != 'commercial' ) ) 
  //header('Location: index.html');

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<title>EasyOrder - Commercial</title>
<link rel="stylesheet" type="text/css" href="../CSS/style.css" />
<script type="text/javascript" >
window.onload = function() {
  var but = document.getElementsByTagName('button');
  var main = document.getElementById('main');

  for (var i = 0 ; i<but.length; i++) {
    but[i].onclick = function(b) { 
      main.src = "../Admin/panneau"+this.value+".php";
    }
  }
}
</script>
<style>
body   {background-image: url(../img/MOTIFS.jpg);width: 100%; height: 100%}
#corps {width: 100%; position: fixed; bottom: 0; top: 28%}
#main  {width: 100%; height: 100%}
</style>
</head>
<body>
<div id="haut" > <!-- panneau de commandes horrizontal -->
<div id="header"></div>
  <a href="../index.html">
    <img title="déconnexion" alt="logo EasyOrder - Déconnexion" id="logo" 
src="../img/logo.jpg" />
  </a>
<div class="menu" >
  <button type="button" id="commandes" style="color:#D26A00" value="Commandes"
>COMMANDES</button>
</div>
</div>

<div id="corps"> <!-- iframe d'action -->
  <iframe id="main" src="../Admin/panneauCommandes.php" ></iframe>
</div>

</body>
</html>
