let user = document.getElementById("user");
let password = document.getElementById("password");
let confirmPassword = document.getElementById("confirmPassword");
let email = document.getElementById("email");

let invalidUsername = document.getElementById("invalidUsername");
let invalidPassword = document.getElementById("invalidPassword");
let invalidPasswordConfirmation = document.getElementById("invalidPasswordConfirmation");
let invalidEmail = document.getElementById("invalidEmail");

let inputUsername;
let inputPassword;
let inputPasswordConfirmation;
let inputEmail;

const regexEmail = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;

user.addEventListener("input", function(event){
    inputUsername = user.value;

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

confirmPassword.addEventListener("input", function(event){
    inputPasswordConfirmation = confirmPassword.value;

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