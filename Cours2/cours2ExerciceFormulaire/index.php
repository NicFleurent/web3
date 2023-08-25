<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <?php
    $username = $password = $passwordConfirmation = $email = $srcImg = $sexe = $dateNaissance = $auto = $autobus = $marche = $velo = "";
    $usernameErreur = $passwordErreur = $passwordConfirmationErreur = $emailErreur = $srcImgErreur = $sexeErreur = $dateNaissanceErreur = $transportErreur = "";
    $erreur = $validationtransport = false;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if (empty($_POST['username'])) {
            $usernameErreur = "Le nom d'utilisateur est requis<br>";
            $erreur = true;
        } else if($_POST['username'] == "SLAY"){
            $usernameErreur = "Le nom d'utilisateur est déjà pris<br>";
            $erreur = true;
        } 
        $username = test_input($_POST["username"]);

        if (empty($_POST['password'])) {
            $passwordErreur = "Le mot de passe est requis<br>";
            $erreur = true;
        }
        $password = test_input($_POST["password"]);

        if (empty($_POST['passwordConfirmation'])) {
            $passwordConfirmationErreur = "La confirmation de votre mot de passe est requise<br>";
            $erreur = true;
        } 
        elseif($_POST['passwordConfirmation'] != $_POST['password']){
            $passwordConfirmationErreur = "Les deux mot de passe ne sont pas identique<br>";
            $erreur = true;
        } 
        $passwordConfirmation = test_input($_POST["passwordConfirmation"]);

        $email = test_input($_POST["email"]);
        if(empty($_POST['email'])){
            $emailErreur = "L'adresse courriel est requise";
            $erreur = true;
        }
        else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErreur = "L'adresse courriel n'est pas valide";
            $erreur = true;
        }

        $srcImg = test_input($_POST["srcImg"]);
        if(empty($_POST['srcImg'])){
            $srcImgErreur = "L'URL est requise";
            $erreur = true;
        }
        else if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$srcImg)) {
            $srcImgErreur = "L'URL n'est pas valide";
            $erreur = true;
        }

        if(empty($_POST['sexe'])){
            $sexeErreur = "Vous devez choisir une option";
            $erreur = true;
        }
        else{
            $sexe = test_input($_POST["sexe"]);
        }

        if(empty($_POST['dateNaissance'])){
            $dateNaissanceErreur = "La date de naissance est requise";
            $erreur = true;
        }
        $dateNaissance = test_input($_POST["dateNaissance"]);
        
        if(!(empty($_POST['auto']))){
            $auto = test_input($_POST["auto"]);
            $validationtransport = true;
        }
        if(!(empty($_POST['autobus']))){
            $autobus = test_input($_POST["autobus"]);
            $validationtransport = true;
        }
        if(!(empty($_POST['marche']))){
            $marche = test_input($_POST["marche"]);
            $validationtransport = true;
        }
        if(!(empty($_POST['velo']))){
            $velo = test_input($_POST["velo"]);
            $validationtransport = true;
        }

        if(!$validationtransport){
            $transportErreur = "Vous devez choisir au moins une option une option";
            $erreur = true;
        }


        // Inserer dans la base de données
        //SI erreurs, on réaffiche le formulaire 
    }
    if ($_SERVER["REQUEST_METHOD"] != "POST" || $erreur == true) {
    ?>
        <div class="container">
            <form class="row g-3 needs-validation" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" novalidate>
                <div class="row mb-3 mt-5">
                    <label for="username" class="col-sm-2 col-form-label">Nom d'usager</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="username" name="username" value="<?php echo $username; ?>" required>
                        <?php 
                            if($erreur == true){
                        ?>
                                <div class="text-danger">
                                    <?php echo $usernameErreur; ?>
                                </div>
                        <?php 
                            }
                            else{
                        ?>
                            <div class="invalid-feedback" id="invalidUsername">
                                Le nom d'utilisateur est requis
                            </div>
                        <?php 
                            }
                        ?>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="password" class="col-sm-2 col-form-label">Mot de passe</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="password" name="password" value="<?php echo $password; ?>" required>
                        <?php 
                            if($erreur == true){
                        ?>
                                <div class="text-danger">
                                    <?php echo $passwordErreur; ?>
                                </div>
                        <?php 
                            }
                            else{
                        ?>
                            <div class="invalid-feedback">
                                Le mot de passe est requis
                            </div>
                        <?php 
                            }
                        ?>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="passwordConfirmation" class="col-sm-2 col-form-label">Confirmation du mot de passe</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="passwordConfirmation" name="passwordConfirmation" value="<?php echo $passwordConfirmation; ?>" required>
                        <?php 
                            if($erreur == true){
                        ?>
                                <div class="text-danger">
                                    <?php echo $passwordConfirmationErreur; ?>
                                </div>
                        <?php 
                            }
                            else{
                        ?>
                            <div class="invalid-feedback">
                                La confirmation de votre mot de passe est requise
                            </div>
                        <?php 
                            }
                        ?>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="email" class="col-sm-2 col-form-label">Adresse courriel</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>" required>
                        <?php 
                            if($erreur == true){
                        ?>
                                <div class="text-danger">
                                    <?php echo $emailErreur; ?>
                                </div>
                        <?php 
                            }
                            else{
                        ?>
                            <div class="invalid-feedback">
                                L'adresse courriel est requise
                            </div>
                        <?php 
                            }
                        ?>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="srcImg" class="col-sm-2 col-form-label">URL photo de profil</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="srcImg" name="srcImg" value="<?php echo $srcImg; ?>" required>
                        <?php 
                            if($erreur == true){
                        ?>
                                <div class="text-danger">
                                    <?php echo $srcImgErreur; ?>
                                </div>
                        <?php 
                            }
                            else{
                        ?>
                            <div class="invalid-feedback">
                                L'URL d'image est requise
                            </div>
                        <?php 
                            }
                        ?>
                    </div>
                </div>
                <fieldset class="row mb-3">
                    <legend class="col-form-label col-sm-2 pt-0">Sexe</legend>
                    <div class="col-sm-10">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="sexe" id="sexe1" value="masculin" <?php echo($sexe == "masculin") ? "checked" : "" ?> required>
                            <label class="form-check-label" for="sexe1">
                                Masculin
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="sexe" id="sexe2" value="feminin" <?php echo($sexe == "feminin") ? "checked" : "" ?> required>
                            <label class="form-check-label" for="sexe2">
                                Féminin
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="sexe" id="sexe3" value="non_genre" <?php echo($sexe == "non_genre") ? "checked" : "" ?> required>
                            <label class="form-check-label" for="sexe3">
                                Non genré
                            </label>
                            <?php 
                                if($erreur == true){
                            ?>
                                    <div class="text-danger">
                                        <?php echo $sexeErreur; ?>
                                    </div>
                            <?php 
                                }
                                else{
                            ?>
                                <div class="invalid-feedback">
                                    Vous devez choisir une option
                                </div>
                            <?php 
                                }
                            ?>
                        </div>
                    </div>
                </fieldset>
                <div class="row mb-3">
                    <label for="dateNaissance" class="col-sm-2 col-form-label">Date de naissance</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control" id="dateNaissance" name="dateNaissance" value="<?php echo $dateNaissance; ?>" required>
                        <?php 
                                if($erreur == true){
                            ?>
                                    <div class="text-danger">
                                        <?php echo $dateNaissanceErreur; ?>
                                    </div>
                            <?php 
                                }
                                else{
                            ?>
                                <div class="invalid-feedback">
                                    La date de naissance est requise
                                </div>
                            <?php 
                                }
                            ?>
                    </div>
                </div>
                <fieldset class="row mb-3">
                    <legend class="col-form-label col-sm-2 pt-0">Moyen de transport</legend>
                    <div class="col-sm-10">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="auto" name="auto" <?php echo($auto == "on") ? "checked" : "" ?>>
                            <label class="form-check-label" for="auto">
                                Auto
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="autobus" name="autobus" <?php echo($autobus == "on") ? "checked" : "" ?>>
                            <label class="form-check-label" for="autobus">
                                Autobus
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="marche" name="marche" <?php echo($marche == "on") ? "checked" : "" ?>>
                            <label class="form-check-label" for="marche">
                                Marche
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="velo" name="velo" <?php echo($velo == "on") ? "checked" : "" ?>>
                            <label class="form-check-label" for="velo">
                                Vélo
                            </label>
                        </div>
                        <?php 
                            if($erreur == true){
                        ?>
                                <div class="text-danger">
                                    <?php echo $transportErreur; ?>
                                </div>
                        <?php 
                            }
                        ?>
                    </div>
                </fieldset>
                <button type="submit" class="btn btn-primary">S'incrire</button>
            </form>
        </div>
    <?php
    }
    else{
    ?>
        <div class="container mt-3">
            <div class="row justify-content-center text-center">
                <div class="card p-0" style="width: 25rem;">
                    <img src="<?php echo $srcImg; ?>" class="card-img-top" alt="profilPicture">
                    <div class="card-body">
                        <h1 class="card-title"><?php echo $username; ?></h5>
                        <h5 class="card-title">Email : <?php echo $email; ?></h5>
                        <h5 class="card-title">Date de naissance : <?php echo $dateNaissance; ?></h5>
                        <h5 class="card-title">Sexe : <?php echo $sexe; ?></h5>
                        <h5 class="card-title">Moyen de transport :</h5>
                        <h5 class="card-title"><?php echo($auto == "on") ? "Auto" : "" ?></h6>
                        <h5 class="card-title"><?php echo($autobus == "on") ? "Autobus" : "" ?></h5>
                        <h5 class="card-title"><?php echo($marche == "on") ? "Marche" : "" ?></h5>
                        <h5 class="card-title"><?php echo($velo == "on") ? "Velo" : "" ?></h5>
                        <a href="http://localhost/web3/Cours2/cours2ExerciceFormulaire" class="btn btn-primary">Créer un autre compte</a>
                    </div>
                </div>
            </div>
        </div>
        
    <?php
    }

    function test_input($data)
    {
        $data = trim($data);
        $data = addslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    ?>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function() {
            'use strict'

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.querySelectorAll('.needs-validation')

            // Loop over them and prevent submission
            Array.prototype.slice.call(forms)
                .forEach(function(form) {
                    form.addEventListener('submit', function(event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }

                        form.classList.add('was-validated')
                    }, false)
                })
        })()
    </script>
    <script src="./js/script.js"></script>
</body>

</html>