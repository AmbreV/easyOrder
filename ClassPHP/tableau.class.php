<?php
 require "cone.class.php";
	
	class tableau extends con
	{
		
		function _chenePoutre()
		{
			$requete =  ("select * from Produits where nature='Chene' and specProd like 'Poutre%'");
			$args =  array();
			$res = con::_demander($requete, $args);
		    return (json_encode($res));
		}

		function _chenePlaque()
		{
			$requete =  ("select * from Produits where nature='Chene' and specProd like 'Plaque%'");
			$args =  array();
			$res = con::_demander($requete, $args);
		    return (json_encode($res));
		}

		function _mediumPoutre()
		{
			$requete =  ("select * from Produits where nature='Medium' and specProd like 'Poutre%'");
			$args =  array();
			$res = con::_demander($requete, $args);
			return (json_encode($res));
		}


		function _mediumPlaque()
		{
			$requete =  ("select * from Produits where nature='Medium' and specProd like 'Plaque%'");
			$args =  array();
			$res = con::_demander($requete, $args);
			return (json_encode($res));
		}

		function _exotiquePoutre()
		{
			$requete =  ("select * from Produits where nature='Exotique' and specProd like 'Poutre%'");
			$args =  array();
			$res = con::_demander($requete, $args);
		    return (json_encode($res));
		}

		function _exotiquePlaque()
		{
			$requete =  ("select * from Produits where nature='Exotique' and specProd like 'Plaque%'");
			$args =  array();
			$res = con::_demander($requete, $args);
		    return (json_encode($res));
		}
	}
?>


