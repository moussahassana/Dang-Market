var popUp=document.getElementsByClassName("ctn_user_popPup")[0];
var userInfo=document.getElementsByClassName("user_info container")[0];
$(document).ready(function (){
    $('#userPopUp').click(function()
    {
        $('.user_info').load("php/popUpContainer.html");
        popUp.style.display="block";
    });
    
});
function closePopup(){
    popUp.style.display="none";
}
