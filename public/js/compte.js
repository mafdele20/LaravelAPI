function searchValid() {

    var requete = new XMLHttpRequest();

    var url = "http://localhost/tpphpOMR/searchClient";

    var search = document.getElementById('idclient').value;

    var arg = "idclient="+search;

    requete.open("POST",url,true);

    requete.setRequestHeader("Content-type","application/x-www-form-urlencoded");

    requete.onreadystatechange = function(){

        if(requete.readyState == 4 && requete.status == 200){
          
            var donne = requete.responseText;
            console.log(donne);  
            ok = document.getElementById("trouve");
            ok.innerHTML = donne;
            const element = ok;
            for(var i = 0; i < element.length ; i++){
                if(search == element[i].value){
                            
                    document.getElementById('info').style.display = "block";

                }else{

                    document.getElementById('info').style.display = "none";
                }
             }
        }
    };
    requete.send(arg);
    document.getElementById("trouve").innerHTML = "processing..";

}


function alertDuree(champ){
    setTimeout(function(){ 
             champ.style.display = "none";
     }, 3000);
    
}

function mail(maile){
    if(maile.value.indexOf("@") == -1 &&  document.getElementById("nouveau").checked == true){
        document.getElementById("mail").style.display ="block"   
    }else{
        document.getElementById("mail").style.display ="none"   
        
    }
}

function addCompte(){
    if(document.getElementById("numCompte").value.trim()=="" && document.getElementById("idclient").value.trim()==""
    && document.getElementById("numAgence").value.trim()=="" && document.getElementById("solde").value.trim()==""
    && document.getElementById("dateO").value.trim()==""){
       afficheTout()
       event.preventDefault()
    }else if(document.getElementById("numCompte").value.trim()==""){

        document.getElementById("champs2").style.display= "block";
 
        document.getElementById("champs1").style.display= "none";
        document.getElementById("champs3").style.display= "none";
        document.getElementById("champs4").style.display= "none";
        document.getElementById("champs5").style.display= "none";
        
    }else if(document.getElementById("idclient").value.trim()==""){

        document.getElementById("champs1").style.display= "block";

        
        document.getElementById("champs2").style.display= "none";
        document.getElementById("champs3").style.display= "none";
        document.getElementById("champs4").style.display= "none";
        document.getElementById("champs5").style.display= "none";
        
    }else if(document.getElementById("numAgence").value.trim()==""){

        document.getElementById("champs3").style.display= "block";

        
        document.getElementById("champs1").style.display= "none";
        document.getElementById("champs2").style.display= "none";
        document.getElementById("champs4").style.display= "none";
        document.getElementById("champs5").style.display= "none";


    }else if(document.getElementById("solde").value.trim()==""){

    document.getElementById("champs4").style.display= "block";
    
    document.getElementById("champs1").style.display= "none";
    document.getElementById("champs3").style.display= "none";
    document.getElementById("champs2").style.display= "none";
    document.getElementById("champs5").style.display= "none";

   }else if(document.getElementById("dateO").value.trim()==""){

    document.getElementById("champs5").style.display= "block";

    
    document.getElementById("champs1").style.display= "none";
    document.getElementById("champs3").style.display= "none";
    document.getElementById("champs4").style.display= "none";
    document.getElementById("champs2").style.display= "none";

    }else if((document.getElementById("epargne").checked == false 
    && document.getElementById("courant").checked == false && document.getElementById("bloque").checked == false )){

        document.getElementById("champs6").style.display= "block";
    
        document.getElementById("champs1").style.display= "none";
        document.getElementById("champs3").style.display= "none";
        document.getElementById("champs4").style.display= "none";
        document.getElementById("champs5").style.display= "none";
        document.getElementById("champs2").style.display= "none";
     }else{
  /*    var xhttp = new XMLHttpRequest();
        var url = "../../controller/CompteClientController.php";

        var id = document.getElementById("idclient").value;
        var numero = document.getElementById("numCompte").value;
        var agenge = document.getElementById("numAgence").value;
       // var cleRib = document.getElementById("numCompte").value;
        var nom = document.getElementById("nom").value;
        var prenom = document.getElementById("prenom").value;
        var email = document.getElementById("email").value;
        var tel = document.getElementById("tel").value;
        var salaire = document.getElementById("salaire").value;
        var solde = document.getElementById("solde").value;
        var date = document.getElementById("dateO").value;
        var frais= document.getElementById("agio").value;
        var typeCompte = document.getElementById("epargne").value+""+document.getElementById("courant").value+""+document.getElementById("bloque").value;
        var typeClient = document.getElementById("salarie").value+""+document.getElementById("entrepriseC").value+""+document.getElementById("nonsalaire").value;
        var raison= document.getElementById("raison").value;
        var employeur= document.getElementById("emp").value;
        var cni = document.getElementById("cni").value;
        var nom_entreprise = document.getElementById("nomentreprise").value;
        var adresse = document.getElementById("adresse").value;
        var vars;

        if(document.getElementById("ancien").checked ===true){
           vars = "id="+id+"&numero="+numero+"&agenge="+agenge+"&solde="+solde+"&date="+date+"&typeCompte="+typeCompte+"&frais="+frais;
        }else{
            id = 0;
            vars = "id="+id+"&numero="+numero+"&agenge="+agenge+"&adresse="+adresse+"&nom="+nom+"&prenom="+prenom+"&email="+email+"&tel="+tel+"&salaire="+salaire+"&solde="+solde+"&date="+date+"&typeCompte="+typeCompte+"&frais="+frais+"&typeClient="+typeClient+"&raison="+raison+"&cni="+cni+"&nom_entreprise="+nom_entreprise+"&employeur="+employeur;
        }
    
    
        xhttp.open("POST", url, true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.onreadystatechange = function() {
            console.log(xhttp)
            console.log(vars)
            if (this.readyState == 4 && this.status == 200) {
                var return_data = xhttp.responseText;
                document.getElementById("status").innerHTML = return_data;
            }
        };
            xhttp.send(vars); 
            document.getElementById("status").innerHTML = "processing...";*/
        }
      
    }

function afficheTout() {
    
    document.getElementById("champs5").style.display= "block"; 
    document.getElementById("champs1").style.display= "block";
    document.getElementById("champs3").style.display= "block";
    document.getElementById("champs4").style.display= "block";
    document.getElementById("champs2").style.display= "block";

}
function annulTout() {
    
    document.getElementById("champs5").style.display= "none"; 
    document.getElementById("champs1").style.display= "none";
    document.getElementById("champs3").style.display= "none";
    document.getElementById("champs4").style.display= "none";
    document.getElementById("champs2").style.display= "none";
    document.getElementById("champs6").style.display= "none";

}


function requiere(params) {
    if( params.value.trim() == ""){
        document.getElementById("champs").style.display = "block"
    }
 
}

function readForm(){
    var formdata = {};
    formdata ['idclient'] = document.getElementById("idclient").value;
    formdata ['numCompte'] = document.getElementById("numCompte").value;idclient
    formdata ['numAgence'] = document.getElementById("numAgence").value;
    //formdata ['cleRib'] = document.getElementById("numCompte").value;
    formdata ['nom'] = document.getElementById("nom").value;
    formdata ['prenom'] = document.getElementById("prenom").value;
 //   formdata ['typeclient'] = document.getElementById("typeclient").value;
    formdata ['email'] = document.getElementById("email").value;
    formdata ['tel'] = document.getElementById("tel").value;
    formdata ['salaire'] = document.getElementById("salaire").value;
    formdata ['solde'] = document.getElementById("solde").value;
    formdata ['dateO'] = document.getElementById("dateO").value;
    formdata ['agio'] = document.getElementById("agio").value;
    formdata ['epargne'] = document.getElementById("epargne").value;
    formdata ['courant'] = document.getElementById("courant").value;
    formdata ['bloque'] = document.getElementById("bloque").value;

    return formdata;
}
function insertCompte(data){
    
    var tab   = document.getElementById("listecompte").getElementsByTagName("tbody")[0];
    var newCompte = tab.insertRow(tab.length);
    cell1 = newCompte.insertCell(0); 
    cell1.innerHTML = data.numCompte;
    cell2 = newCompte.insertCell(1); 
    cell2.innerHTML = data.numAgence;
    cell3 = newCompte.insertCell(2); 
    cell3.innerHTML = data.cleRib;
    cell4 = newCompte.insertCell(3); 
    cell4.innerHTML = data.dateO;
    cell5 = newCompte.insertCell(4); 
    cell5.innerHTML = data.solde;
    cell6 = newCompte.insertCell(5); 
    cell6.innerHTML = data.epargne +""+ data.courant+""+data.bloque ;
    cell7 = newCompte.insertCell(6) ; 
    cell7.innerHTML = data.agio;
    cell8 = newCompte.insertCell(7); 
    cell8.innerHTML = data.nom+" "+data.prenom+""+data.idclient

}
//Pour masquer les infos client  s'il existe:
function masquerClient(){
        
        document.getElementById("masquer").style.display = "none";
        document.getElementById("identifiant").style.display="block";
        document.getElementById("nouveau").checked = false;
}
//Pour afficher les infos client s'il est nouveau :

function afficheElement(){
        
    document.getElementById("masquer").style.display = "block";
    document.getElementById("identifiant").style.display="none";
    document.getElementById("ancien").checked = false;


}

 function annulChamp(){
     document.getElementById("numCompte").value = "";
     document.getElementById("numAgence").value = "";
     document.getElementById("nom").value = "";
     document.getElementById("prenom").value = "";
     //document.getElementById("typeclient").value = "";
     document.getElementById("email").value = "";
     document.getElementById("tel").value = "";
     document.getElementById("salaire").value = "";
     document.getElementById("solde").value = "";
     document.getElementById("epargne").value ="";
     document.getElementById("courant").value = "";
     document.getElementById("bloque").value = "";
     document.getElementById("epargne").checked =false;
     document.getElementById("courant").checked = false;
     document.getElementById("bloque").checked = false;
     annulTout();

}

function salary(){
        document.getElementById("employeur").style.display ="block"  
        document.getElementById("pers").style.display ="block"  
        document.getElementById("ese").style.display ="none"
        document.getElementById("nonsalaire").checked = false    
        document.getElementById("entrepriseC").checked = false  
        document.getElementById("salarie").value ="salarie" 
        document.getElementById("entrepriseC").value ="" 
        document.getElementById("nonsalaire").value ="" 

}

function entreprisee(){
    document.getElementById("ese").style.display ="block"
    document.getElementById("pers").style.display ="none"  
    document.getElementById("employeur").style.display ="none"  
    document.getElementById("nonsalaire").checked = false 
    document.getElementById("salarie").checked = false 
    document.getElementById("entrepriseC").value ="entreprise" 
    document.getElementById("salarie").value ="" 
    document.getElementById("nonsalaire").value ="" 
    document.getElementById("courant").disabled = true


}

function non_salary(){
    document.getElementById("ese").style.display ="none"
    document.getElementById("pers").style.display ="block"  
    document.getElementById("employeur").style.display ="none"  
    document.getElementById("entrepriseC").checked = false    
    document.getElementById("salarie").checked = false       
    document.getElementById("nonsalaire").value ="non_salarie"
    document.getElementById("entrepriseC").value ="" 
    document.getElementById("salarie").value ="" 
    document.getElementById("courant").disabled = true

}
function epargnee(){
    document.getElementById("frais").style.display = "block"  
    document.getElementById("epargne").value ="epargne" 
    document.getElementById("courant").value =""
    document.getElementById("bloque").value = "" 

    document.getElementById("courant").checked = false   
    document.getElementById("bloque").checked = false      
}
function courante(){
    document.getElementById("frais").style.display = "none"   
    document.getElementById("courant").value ="courant" 
    document.getElementById("epargne").value =""   
    document.getElementById("bloque").value = "" 
    document.getElementById("bloque").checked = false   
    document.getElementById("epargne").checked = false  
}

function bloquee(){    
    document.getElementById("frais").style.display = "block"   
    document.getElementById("bloque").value = "bloque"   
    document.getElementById("courant").value ="" 
    document.getElementById("epargne").value ="" 
    document.getElementById("courant").checked = false   
    document.getElementById("epargne").checked = false        
}


function notNumber(champs){
    if( champs.value.trim() !== ""){
    
        if(isNaN(champs.value) === false ){
           champs.style.color = 'red'
           champs.value = ''
        }
        if(isNaN(champs.value) === true ){
            champs.style.color = 'black'
        }
    }
    
    }
    
    function isNumber(champs){
        if( champs.value.trim() !== ""){
        
            if(isNaN(champs.value) === false ){
               champs.style.color = 'black'
            }
            if(isNaN(champs.value) === true ){
                champs.style.color = 'red'
                champs.value = ''
            }
        }
        
        }
        
function deconnexion(){
    var conf = confirm("voulez vous quitter ?")
    if(conf == true){
      window.location.replace("/")
    }else{
      event.preventDefault();
    }
}