<html>
<head>
	<title>Catalogue - EasyOrder</title>
	<meta charset="UTF-8"/>
	<link rel="stylesheet" type="text/css" href="../../CSS/styleCat.css"/>
	<script type="text/javascript">
		// function qui permet d'appeller les differente page du catalogue
		window.onload = function() 
		{
			// variables se referent au html
	  		var opt = document.getElementsByTagName('option');
	  		var main1 = document.getElementById('main1');
	  		var main2 = document.getElementById('main2');

        main1.src = "tableau"+opt[0].value +"Poutre.php";
        main2.src = "tableau"+opt[0].value +"Plaque.php";

            // boucle qui permet d'appeller les diferente page 
		  	for (var i = 0 ; i<opt.length; i++) 
		  	{
		    	opt[i].onclick = function(b) 
		    	{ 
		     		 main1.src = "tableau"+this.value+"Poutre"+".php";
		     		 main2.src = "tableau"+this.value+"Plaque"+".php";	     		 
		    	}
		    }
	  	}
	</script>
</head>
<body>
	<h1>CATALOGUE</h1>

	<div id="select">
		<p id="p">Rechercher par </p>
		<select class="select">
			<option value="Chêne">Chêne</option>
			<option value="Medium">Medium</option>
			<option value="Exotique">Exotique</option>
		</select>
	</div>	
		
		<p class="p">  POUTRE <span class="casse"> à l'unité</span></p>
		<iframe id="main1" src="#"></iframe>
		<p class="p">  PLAQUE <span class="casse"> à l'unité</span></p>
		<iframe id="main2" src="#"></iframe>
</body>
</html>
