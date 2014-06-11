
window.onload = function() {
  var ent = document.getElementById('entete');
  var titreA = document.getElementsByTagName('h1')[0];
  var titreB = document.getElementsByTagName('h2')[0];
  var tableClient = document.createElement('tr');
  var etat = document.getElementById('etat');
  var etatSel = etat.getElementsByTagName('select')[0];
  var optA = document.createElement('option');
  var optB = document.createElement('option');

  var com = document.getElementById('etat').getElementsByTagName('input')[0];
  com.value = refcom;
  var com = document.getElementById('etat').getElementsByTagName('input')[1];
  com.value = mail;

  var annee, mois, jour, nomMois;
  annee   = datecom.split('-')[0];
  mois    = datecom.split('-')[1];
  jour    = datecom.split('-')[2];
  nomMois = ['janvier', 'fervrier', 'mars', 'avril', 'mai', 'juin', 
          'juillet', 'aout', 'septembre', 'octobre', 'novembre', 
          'decembre' ];

  titreA.innerHTML = "Commande référence "+refcom+" — du "+
    jour+" "+nomMois[--mois]+" "+annee;

    tableClient.innerHTML = "<td id='adr' ><address>De : "+corresp+
      "<br />"+client+
      "<br />"+adresse+
      "<br />"+codepost+" "+ville+
      "<br />"+pays+
      "</address></td><td id='info' ><address>Tél : "+tel+
      "<br />Mail : "+mail+
      "<br />TVA Intracom : "+intracom+
      "<br />Remise : "+remise+' %'+
      "<br />Seuil : "+seuil+
      "</address></td>"+
      "<td colspan=3>"+note+
      "</td>";

  titreB.innerHTML = "Etat : ";
  if (valide == true) { 
    titreB.innerHTML += "VALIDÉE";
    optA.value = 0;
    optA.innerHTML = 'rejeter';
    optB.value = -1;
    optB.innerHTML = 'à traiter';
  } else if (valide == 0) {
    titreB.innerHTML += "REJETÉE";
    optA.value = 1;
    optA.innerHTML = 'valider';
    optB.value = -1;
    optB.innerHTML = 'à traiter';
  } else {
    titreB.innerHTML += "à traiter";
    optB.value = 1;
    optB.innerHTML = 'valider';
    optA.value = 0;
    optA.innerHTML = 'rejeter';
  }

  ent.appendChild(tableClient);
  if ( vue != 'admin' && vue != 'commercial' ) {
    document.getElementById('etat').style.display="none";
    document.getElementById('adr').style.display="none";
    document.getElementById('info').style.display="none";
  }
  etatSel.appendChild(optA);
  etatSel.appendChild(optB);

  var lignes = [];
  var li = document.getElementById('lignes');
  for (var j=0; j<i; j++) {
    var ligneSup = document.createElement('tr');
    ligneSup.innerHTML = ("<tr><td>"+reflico[j]+
        '</td><td>'+nature[j]+
        '</td><td>'+spec[j]+
        '</td><td>'+pu[j]+' €'+
        '</td><td>'+puremise[j]+' €'+
        '</td><td>'+quantite[j]+
        '</td><td>'+unite[j]+
        '</td><td>'+quantite[j]*puremise[j]+' €');
    if (prodVal[j] == true ) {
      ligneSup.innerHTML  += ("</td><td>oui</td></tr>");
    } else {
      ligneSup.innerHTML  += ("</td><td>non</td></tr>");
    }
    li.appendChild(ligneSup);
    lignes.push(ligneSup);
  }

  for (var k=0; k<i; k++) {
    // oli : objet ligne
    var oli = {
      num: k,
      ligne: lignes[k], 
      ref  : lignes[k].getElementsByTagName('td')[0],
      nat  : lignes[k].getElementsByTagName('td')[1],
      spec : lignes[k].getElementsByTagName('td')[2],
      pu   : lignes[k].getElementsByTagName('td')[3],
      pur  : lignes[k].getElementsByTagName('td')[4],
      qty  : lignes[k].getElementsByTagName('td')[5],
      unit : lignes[k].getElementsByTagName('td')[6],
      tot  : lignes[k].getElementsByTagName('td')[7],
      disp : lignes[k].getElementsByTagName('td')[8] 

    } //fin objet ligne (oli)
    if (oli.disp.innerHTML == 'non' ) oli.disp.style.color = 'red';

    if (oli.pur.innerHTML.split(' ')[0] == 
        oli.pu.innerHTML.split(' ')[0]*(100-remise)/100) 
      oli.pur.style.color = 'blue';
    else  oli.pur.style.color = 'red'; 


  } //fin for



} // fin window onload
