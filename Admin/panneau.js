

window.onload = function() {
  var dupliquer = document.getElementsByClassName('dupliquer');
  // les boutons dupliquer

  function preparerDuplicata() {
    for (var i=0; i<dupliquer.length; i++) {
      // pour chaque bouton dupliquer, si on click dessus : 
      dupliquer[i].onclick = function() {
        var tr = document.getElementsByTagName('tr'); // chaque ligne
        var el = document.createElement('tr');  // prépare nouv ligne
        el.innerHTML = tr[this.value].innerHTML; // copier ligne cliquée
        var inputs = el.getElementsByTagName('input'); // chaque champs
          //inputs[0].disabled = "disabled"; // setting clef primaire 
          //inputs[0].innerHTML = "nouveau";
          //inputs[0].name = "clefProd["+tr.length+"]";
          inputs[0].value = "nouveau";

        for (var j=0; j<inputs.length; j++) {
          inputs[j].name = inputs[j].name.replace(this.value, tr.length);
	}
        // ajuster le numéro des names 
	  
	var selects = el.getElementsByTagName('select')[0];
	  selects.name = selects.name.replace(this.value, tr.length);

        document.getElementsByTagName('table')[0].appendChild(el);
        // ajouter la nouvelle ligne
        inputs[1].focus(); // mettre le focus sur nouv ligne

        preparerDuplicata(); // préparer duplicata sur le nouveau bouton
      } // fin onclick = function 
    } // fin boucle sur bouton dupliquer
  } // fin preparerDuplicata

    // au chargement de la page, executer la fonction 
    // si elle a un sens
  if ( dupliquer.length > 0 ) preparerDuplicata();



} // fin window.onload



