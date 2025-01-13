const textViewErrorContrasenya = document.getElementById("textViewErrorContrasenya");

const editTextPassword1 = document.getElementById("editTextPassword1");
const editTextPassword2 = document.getElementById("editTextPassword2");

editTextPassword1.addEventListener("keyup", function() {
 
    comprobarContrasenyas();

}, false);

editTextPassword1.addEventListener("keyin", function() {

    textViewErrorContrasenya.style.visibility = "hidden";

}, false);

editTextPassword2.addEventListener("keyup", function() {

    comprobarContrasenyas();

}, false);

editTextPassword2.addEventListener("keyin", function() {

    textViewErrorContrasenya.style.visibility = "hidden";

}, false);

function comprobarContrasenyas() {
    if (editTextPassword1.value != editTextPassword2.value){
        textViewErrorContrasenya.style.visibility = "visible";
        textViewErrorContrasenya.innerHTML = "Las contraseñas no son iguales";
        textViewErrorContrasenya.style.color = "red";
    } else {
        textViewErrorContrasenya.style.visibility = "hidden";
    }
}