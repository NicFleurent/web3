let nom = document.getElementById("nom");
let prime = document.getElementById("prime");
let image = document.getElementById("image");
let equipage = document.getElementById("equipage");

let invalidNom = document.getElementById("invalidNom");
let invalidPrime = document.getElementById("invalidPrime");
let invalidImage = document.getElementById("invalidImage");
let invalidEquipage = document.getElementById("invalidEquipage");

let inputNom;
let inputPrime;
let inputImage;
let inputEquipage;

const regexURL = /\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i;

nom.addEventListener("input", function(event){
    inputNom = nom.value;
    
    if(inputNom === "" || inputNom === null){
        invalidNom.style.display = "block";
    }
    else{
        invalidNom.style.display = "none";
    }
});

prime.addEventListener("input", function(event){
    inputPrime = prime.value;

    if(inputPrime === "" || inputPrime === null){
        invalidPrime.style.display = "block";
    }
    else{
        invalidPrime.style.display = "none";
    }
});

equipage.addEventListener("input", function(event){
    inputEquipage = equipage.value;

    if(inputEquipage === "" || inputEquipage === null){
        invalidEquipage.style.display = "block";
    }
    else{
        invalidEquipage.style.display = "none";
    }
});

image.addEventListener("input", function(event){
    inputImage = image.value;

    if(inputImage === "" || inputImage === null){
        invalidImage.style.display = "block";
        invalidImage.innerHTML = "L'URL d'image est requise";
    }
    else if(!(regexURL.test(inputImage))){
        invalidImage.style.display = "block";
        invalidImage.innerHTML = "L'URL n'est pas valide";
    }
    else{
        invalidImage.style.display = "none";
    }
});