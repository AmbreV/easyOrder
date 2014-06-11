<?php 
// ce fichier contient la classe utilisée par les clients
//

class con {

  function _demander($requete, $args) {
    // retourne :
    // 		 - un array de tuples (un tuple par case)
    // 		 - 0 pour indiquer que la requête a échoué
    $n = "root"; // DOIT ETRE CHANGÉ
    $p = "nono/44+"; // DOIT ETRE CHANGÉ
    try {
      $bdd = new PDO('mysql:host=localhost;dbname=easyOrder', $n, $p);
      $resultat=$bdd->prepare($requete);
      $resultat->execute($args);
      $retour = array();
      while ($ligne=$resultat->fetch() ) {
	//print_r($ligne);
	array_push($retour, $ligne);
      }
      if (isset($retour)) return $retour;
    } catch (PDOException $e) { 
      echo "Erreur : ".$e->getMessage();
      return 0;       
    }
    return 0;
  }
  
  
}

?>
