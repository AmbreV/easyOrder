<?php
	
	require "cone.class.php";
	
	class donner extends con
	{
		
		function _select()
		{
			try
			{
				$req =  ("select * from Produits");
				$arg =  array();
				
				$res = con::_demander($req, $arg);
			    
			    return (json_encode($res));

			}
			catch (Exception $error)
			{
				echo 'Echec de la connexion à la base de données';
		    }
		}

	}

?>

