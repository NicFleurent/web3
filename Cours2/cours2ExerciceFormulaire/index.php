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
    $username = $password = $passwordConfirmation = "";
    $usernameErreur = $passwordErreur = $passwordConfirmationErreur = "";
    $erreur = false;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        echo "POST";

        if (empty($_POST['username'])) {
            $usernameErreur = "Le nom d'utilisateur est requis<br>";
            $erreur = true;
        } else {
            $username = test_input($_POST["username"]);
        }

        if (empty($_POST['password'])) {
            $passwordErreur = "Le mot de passe est requis<br>";
            $erreur = true;
        } else {
            $password = test_input($_POST["password"]);
        }

        if (empty($_POST['passwordConfirmation'])) {
            $passwordConfirmationErreur = "La confirmation de votre mot de passe est requise<br>";
            $erreur = true;
        } 
        elseif($_POST['passwordConfirmation'] != $_POST['password']){
            $passwordConfirmationErreur = "Les deux mot de passe ne sont pas identique<br>";
            $erreur = true;
        } else {
            $passwordConfirmation = test_input($_POST["passwordConfirmation"]);
        }


        // Inserer dans la base de données
        //SI erreurs, on réaffiche le formulaire 
    }
    if ($_SERVER["REQUEST_METHOD"] != "POST" || $erreur == true) {
        echo "Erreur ou 1ere fois<br>";
        echo $usernameErreur;
        echo $passwordErreur;
        echo $passwordConfirmationErreur;

    ?>
        <div class="container">
            <form class="row g-3 needs-validation" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" novalidate>
                <div class="row mb-3 mt-5">
                    <label for="username" class="col-sm-2 col-form-label">Nom d'usager</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="username" name="username" required>
                        <div class="invalid-feedback">
                            Le nom d'utilisateur est requis
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="password" class="col-sm-2 col-form-label">Mot de passe</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="password" name="password" required>
                        <div class="invalid-feedback">
                            Le mot de passe est requis
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="passwordConfirmation" class="col-sm-2 col-form-label">Confirmation du mot de passe</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="passwordConfirmation" name="passwordConfirmation" required>
                        <div class="invalid-feedback">
                            La confirmation de votre mot de passe est requise
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="email" class="col-sm-2 col-form-label">Adresse courriel</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" id="email" name="email" required>
                        <div class="invalid-feedback">
                            L'adresse courriel est requise
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="srcImg" class="col-sm-2 col-form-label">URL photo de profil</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="srcImg" name="srcImg" required>
                        <div class="invalid-feedback">
                            L'URL d'image est requise
                        </div>
                    </div>
                </div>
                <fieldset class="row mb-3">
                    <legend class="col-form-label col-sm-2 pt-0">Sexe</legend>
                    <div class="col-sm-10">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="sexe" id="sexe1" value="masculin" required>
                            <label class="form-check-label" for="sexe1">
                                Masculin
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="sexe" id="sexe2" value="feminin" required>
                            <label class="form-check-label" for="sexe2">
                                Féminin
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="sexe" id="sexe3" value="non_genre" required>
                            <label class="form-check-label" for="sexe3">
                                Non genré
                            </label>
                            <div class="invalid-feedback">Vous devez choisir une option</div>
                        </div>
                    </div>
                </fieldset>
                <div class="row mb-3">
                    <label for="dateNaissance" class="col-sm-2 col-form-label">Date de naissance</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control" id="dateNaissance" name="dateNaissance" required>
                    </div>
                </div>
                <fieldset class="row mb-3">
                    <legend class="col-form-label col-sm-2 pt-0">Moyen de transport</legend>
                    <div class="col-sm-10">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="auto" name="auto">
                            <label class="form-check-label" for="auto">
                                Auto
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="autobus" name="autobus">
                            <label class="form-check-label" for="autobus">
                                Autobus
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="marche" name="marche">
                            <label class="form-check-label" for="marche">
                                Marche
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="velo" name="velo">
                            <label class="form-check-label" for="velo">
                                Vélo
                            </label>
                        </div>
                    </div>
                </fieldset>
                <button type="submit" class="btn btn-primary">S'incrire</button>
            </form>
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
</body>

</html>