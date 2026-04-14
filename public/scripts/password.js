
function TogglePassword(){
    let a=document.getElementById("password");
    a.getAttribute("type") == "text" ? a.setAttribute("type","password") : a.setAttribute("type","text");
}