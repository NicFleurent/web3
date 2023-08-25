let username = document.getElementById("username");
let invalidUsername = document.getElementById("invalidUsername");

username.addEventListener("input", function(event){
    inputUsername = username.value;

    if(inputUsername === "" || inputUsername === null){
        invalidUsername.style.display = "block";
    }
})