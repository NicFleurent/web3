let username = document.getElementById("username");
let password = document.getElementById("password");
let passwordConfirmation = document.getElementById("passwordConfirmation");
let email = document.getElementById("email");
let srcImg = document.getElementById("srcImg");
let form = document.getElementById("form");
let moyenTransport = document.getElementById("moyenTransport");
let auto = document.getElementById("auto");
let autobus = document.getElementById("autobus");
let marche = document.getElementById("marche");
let velo = document.getElementById("velo");

let invalidUsername = document.getElementById("invalidUsername");
let invalidPassword = document.getElementById("invalidPassword");
let invalidPasswordConfirmation = document.getElementById("invalidPasswordConfirmation");
let invalidEmail = document.getElementById("invalidEmail");
let invalidURL = document.getElementById("invalidURL");

let inputUsername;
let inputPassword;
let inputPasswordConfirmation;
let inputEmail;
let inputSrcImg;

let transportValider = false;

const regexURL = /\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i;
const regexEmail = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;

username.addEventListener("input", function(event){
    inputUsername = username.value;

    if(inputUsername === "" || inputUsername === null){
        invalidUsername.style.display = "block";
    }
});

password.addEventListener("input", function(event){
    inputPassword = password.value;

    if(inputPassword === "" || inputPassword === null){
        invalidPassword.style.display = "block";
    }
});

passwordConfirmation.addEventListener("input", function(event){
    inputPasswordConfirmation = passwordConfirmation.value;

    if(inputPasswordConfirmation === "" || inputPasswordConfirmation === null){
        invalidPasswordConfirmation.style.display = "block";
        invalidPasswordConfirmation.innerHTML = "La confirmation de votre mot de passe est requise";
    }
    else if(inputPasswordConfirmation != inputPassword){
        invalidPasswordConfirmation.style.display = "block";
        invalidPasswordConfirmation.innerHTML = "Le mot de passe ne correspond pas";
    }
    else{
        invalidPasswordConfirmation.style.display = "none";
    }
});

email.addEventListener("input", function(event){
    inputEmail = email.value;

    if(inputEmail === "" || inputEmail === null){
        invalidEmail.style.display = "block";
        invalidEmail.innerHTML = "L'adresse courriel est requise";
    }
    else if(!(regexEmail.test(inputEmail))){
        invalidEmail.style.display = "block";
        invalidEmail.innerHTML = "L'adresse courriel n'est pas valide";
    }
    else{
        invalidEmail.style.display = "none";
    }
});

srcImg.addEventListener("input", function(event){
    inputSrcImg = srcImg.value;

    if(inputSrcImg === "" || inputSrcImg === null){
        invalidURL.style.display = "block";
        invalidURL.innerHTML = "L'URL d'image est requise";
    }
    else if(!(regexURL.test(inputSrcImg))){
        invalidURL.style.display = "block";
        invalidURL.innerHTML = "L'URL n'est pas valide";
    }
    else{
        invalidURL.style.display = "none";
    }
});

auto.addEventListener("change", valideTransport);
autobus.addEventListener("change", valideTransport);
marche.addEventListener("change", valideTransport);
velo.addEventListener("change", valideTransport);

let transportErreur = document.createElement("div");
transportErreur.setAttribute("class", "invalid-feedback");
transportErreur.innerHTML = "Veuillez choisir au moins une des options";
transportErreur.style.display = "none";
moyenTransport.appendChild(transportErreur);

function valideTransport(){
    if(form.auto.checked){
        transportValider = true;
    }
    else if(form.autobus.checked){
        transportValider = true;
    }
    else if(form.marche.checked){
        transportValider = true;
    }
    else if(form.velo.checked){
        transportValider = true;
    }
    else{
        transportValider = false;
    }

    if(!transportValider){
        transportErreur.style.display = "block";
    }
    else{
        transportErreur.style.display = "none";
    }
}