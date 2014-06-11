<html>
		<head>
			<title>Tableau Medium Plaque</title>
			<meta charset="UTF-8">
			<link rel="stylesheet" type="text/css" href="../../CSS/styleCat.css">
			<script type="text/javascript">
			   	
			   	//function qui appelle du json dans un tableau fait par du js 
			   	window.onload = function()
			   	{
				   <?php 
				    require "../../ClassPHP/tableau.class.php";
				   	$tab = new tableau();
				   	$json = $tab->_mediumPlaque();
				   ?>

					var pdt = <?php print_r($json); ?>;

					var tableau = document.getElementById('tab');
					

					var refProd  = "refProd";
					var specProd = "specProd";
					var nature   = "nature";
					var pu       = "pu";
					var unite    = "unite";

					var rOpt = [];
					var nOpt = [];
					var sOpt = [];
					var pOpt = [];
					var uOpt = [];

					for (var i = 0; i < pdt.length; i++)
					{
						rOpt.push(pdt[i].refProd);
						nOpt.push(pdt[i].nature);
						sOpt.push(pdt[i].specProd);
						pOpt.push((pdt[i].pu/100)+'€');
						uOpt.push(pdt[i].unite);
					}
					
					/*alert(rOpt.length);
					alert(nOpt.length);
					alert(sOpt.length);
					alert(pOpt.length);
					alert(uOpt.length);*/

					for (var i = 0; i < rOpt.length; i++)
					{
						var ligne = tableau.insertRow(-1);
						var colonne1 = ligne.insertCell(0);
						colonne1.innerHTML  += rOpt[i];
						var colonne2 = ligne.insertCell(1);
						colonne2.innerHTML  += nOpt[i];
						var colonne3 = ligne.insertCell(2);
						colonne3.innerHTML  += sOpt[i];
						var colonne4 = ligne.insertCell(3);
						colonne4.innerHTML  += pOpt[i];
						var colonne5 = ligne.insertCell(4);
						colonne5.innerHTML  += uOpt[i];
					}
				}
    		</script>
			
		</head>
				<body>
						<table id="tab" >
							<thead>
								<tr>
									<th class="up">Ref</th>
									<th class="up">Nature</th>
									<th class="up">Specification</th>
									<th class="up">P.U.</th>
									<th class="up">Unité</th>
								</tr>
							</thead>
						</table>
				</body>
</html>
