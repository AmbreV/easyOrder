window.onload = function () {
  var lignePlus = document.getElementById('lignePlus');
  var bon = document.getElementById('lignesForm');

  var xmlHttp = new XMLHttpRequest();
  xmlHttp.open("GET", "nouvelleLigne.html", false);
  xmlHttp.overrideMimeType('text/html');
  xmlHttp.send();
  var nouvelleLigne = xmlHttp.responseText;

  lignePlus.onclick = function() {
    var ligne = document.getElementsByTagName('tr');
    for(var i = 0; i<ligne.length; i++) ligne.id="ligne"+i;

    var nl = document.createElement('tr');
    nl.id="ligne"+i++;
    nl.innerHTML=nouvelleLigne;
    bon.appendChild(nl);

    var cetteLigne = document.getElementById(nl.id);
    var clefProd   = cetteLigne.getElementsByTagName('select')[0];
    var refProd    = cetteLigne.getElementsByTagName('select')[1];
    var nature     = cetteLigne.getElementsByTagName('select')[2];
    var specProd   = cetteLigne.getElementsByTagName('select')[3];
    var pu         = cetteLigne.getElementsByTagName('input')[0];
    var pur        = cetteLigne.getElementsByTagName('input')[1];
    var quantite   = cetteLigne.getElementsByTagName('input')[2];
    var totalHt    = cetteLigne.getElementsByTagName('input')[3];

    clefProd.name  = "clefProd["+nl.id+"]";
    refProd.name   = "refProd["+nl.id+"]";
    nature.name    = "nature["+nl.id+"]";
    specProd.name  = "specProd["+nl.id+"]";
    pu.name        = "pu["+nl.id+"]";
    pur.name        = "pur["+nl.id+"]";
    quantite.name  = "quantite["+nl.id+"]";
    totalHt.name   = "totalHt["+nl.id+"]";


    // remplir les selects de champs uniques 
    var cOpt  = [];
    var rOpt  = [];
    var nOpt  = [];
    var sOpt  = [];

    for(var j = 0; j < pdt.length; j++) {
      cOpt.push(pdt[j].clefProd);
      rOpt.push(pdt[j].refProd);
      nOpt.push(pdt[j].nature);
      sOpt.push(pdt[j].specProd);
    }

    cOpt.forEach(function(x,i,cOpt) {
      if (cOpt.indexOf(x) == i) {
        var option = document.createElement('option');
        option.innerHTML = cOpt[i];
        clefProd.appendChild(option);
      }
    });

    rOpt.forEach(function(x,i,rOpt) {
      if (rOpt.indexOf(x) == i) {
        var option = document.createElement('option');
        option.innerHTML = rOpt[i];
        refProd.appendChild(option);
      }
    });

    nOpt.forEach(function(x,i,nOpt) {
      if (nOpt.indexOf(x) == i) {
        var option = document.createElement('option');
        option.innerHTML = nOpt[i];
        nature.appendChild(option);
      }
    });

    sOpt.forEach(function(x,i,sOpt) {
      if (sOpt.indexOf(x) == i) {
        var option = document.createElement('option');
        option.innerHTML = sOpt[i];
        specProd.appendChild(option);
      }
    });



    function majTout() {
      var selection  = cOpt.indexOf(clefProd.value);
      var selRefProd = refProd.getElementsByTagName('option');
      var selNature  = nature.getElementsByTagName('option');
      var selSpec    = specProd.getElementsByTagName('option');

      for (var sel = 0; sel < selRefProd.length; sel++)
        if(sel == selection) selRefProd[sel].selected="selected";
        else selRefProd[sel].selected=false;

      for (var sel = 0; sel < selNature.length; sel++) {
        if ( selNature[sel].innerHTML == pdt[selection].nature ) {
          selNature[sel].selected = "selected" ;
        } else {
          selNature[sel].selected =false;
        }
      }

      for (var sel = 0; sel < selSpec.length; sel++) {
        if ( selSpec[sel].innerHTML == pdt[selection].specProd ) {
          selSpec[sel].selected = "selected";
        } else {
          selSpec[sel].selected = false;
        }
      }

      pu.value = pdt[selection].pu/100 +"€/" + pdt[selection].unite;

      pur.value = pdt[selection].pu/100*(1-remiseClient/10000) +
        "€/" + pdt[selection].unite;

      totalHt.value = pdt[selection].pu*
        quantite.value/100*(1-remiseClient/10000) + " €";
    }

    function maj() {
      for (var p = 0; p < pdt.length; p++) {
        if ( (nature.value == pdt[p].nature ) && 
            (specProd.value == pdt[p].specProd) ) {
              clefProd[p].selected = "selected";
              var trouver = true;
            } else clefProd[p].selected = false;

      }
      if ( !trouver )  { 
        for (var p = 0; p< pdt.length; p++) {
          if ( nature.value == pdt[p].nature ) {
            clefProd[p].selected = "selected";
            break;
          }
        }
      }
      majTout();
    }

    clefProd.onchange = function() {
      majTout();
    }

    refProd.onchange  = function() {
      for (var p = 0; p< pdt.length; p++) {
        if (refProd.value == pdt[p].refProd ) {
          clefProd[p].selected = "selected";
        } else {
          clefProd[p].selected = false;
        }
      }
      majTout();
    }

    nature.onchange   = function() {
      maj();
    }

    specProd.onchange = function() {
      maj();
    }

    quantite.onchange = function() {
      var selection = cOpt.indexOf(clefProd.value);

      //pu.value = pdt[selection].pu/100 + "€/" + pdt[selection].unite;
      totalHt.value = pdt[selection].pu*
        quantite.value/100*(1-remiseClient/10000) + " €";
    }

    clefProd.getElementsByTagName('option')[0].selected = "selected";
    majTout();

  }

  lignePlus.click();
}
