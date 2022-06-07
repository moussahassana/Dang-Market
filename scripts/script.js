function tmp() {
    var gdiv=document.createElement("div").setAttribute("class","banner");
    gdiv.innerHTML="<div class=\"loading-content\"><div class=\"animPoint\"><div></div><div></div><div></div><div></div></div><h1>Chargement ...</h1></div>";
}
function preview(){
    var target_img=document.getElementById('target_import');
    var import_file=document.getElementById('images').files[0];
    var addButton=document.getElementById('id_img_ajout');
    addButton.classList.add("img_select");
    var file=new FileReader();
    file.onload=function(e){
        target_img.src=e.target.result;
    }
    file.readAsDataURL(import_file);
}
function chargementTerminer(){
    var banner=document.getElementsByClassName("banner")[0];
    var gb=document.getElementsByClassName("globalContainer")[0];
    setTimeout(() => {
        gb.style.display="block";
        banner.remove();
    }, 500);
    //alert("Chargement Terminer"); 
}

function revalSignUp() {    
    var logIn=document.getElementById('idLoginUser');
    var sign=document.getElementById('idSignUpUser');
    logIn.style.display="none";
    sign.style.display="block";
}

function revalLogin() {
    var logIn=document.getElementById('idLoginUser');
    var sign=document.getElementById('idSignUpUser');
    logIn.style.display="block";
    sign.style.display="none";
}
function chercher(e) {
    var listNomProd=document.getElementsByClassName('nom_prod');
    for (let i = 0; i < listNomProd.length; i++) {
        val=listNomProd[i].innerHTML;
        val=val.toLowerCase();
        if(val.indexOf(e.value.toLowerCase())>-1){
            listNomProd[i].parentNode.style.display='';
        }else{
            listNomProd[i].parentNode.style.display='none';
        }
    }
}