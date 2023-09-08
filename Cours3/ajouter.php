<?php
session_start();
?>
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
    if($_SESSION['connexion'] == true){
        $nom = $prime = $image = $equipage = "";
        $nomErreur = $primeErreur = $imageErreur = $equipageErreur = $erreurSQL = "";
        $erreur = false;

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            if (empty($_POST['nom'])) {
                $nomErreur = "Le nom est requis<br>";
                $erreur = true;
            }
            $nom = test_input($_POST["nom"]);

            if (empty($_POST['prime'])) {
                $primeErreur = "La prime est requise<br>";
                $erreur = true;
            }
            $prime = test_input($_POST["prime"]);

            if (empty($_POST['equipage'])) {
                $equipageErreur = "L'équipage est requise<br>";
                $erreur = true;
            }
            $equipage = test_input($_POST["equipage"]);

            $image = test_input($_POST["image"]);
            if (empty($_POST['image'])) {
                $imageErreur = "L'URL est requise";
                $erreur = true;
            } else if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i", $image)) {
                $imageErreur = "L'URL n'est pas valide";
                $erreur = true;
            }


            // Inserer dans la base de données
            $servername = "localhost";
            $username = "root";
            $password = "root";
            $dbname = "persosonepiece";

            // Create connection
            $conn = mysqli_connect($servername, $username, $password, $dbname);

            // Check connection
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }

            $sql = "INSERT INTO persosonepiece (nom, prime, image, equipage) 
            VALUES ('" . $nom . "', '" . $prime . "', '" . $image . "', '" . $equipage . "')";
            if (mysqli_query($conn, $sql)) {
                header("Location: ./index.php?succes=ajouter");
                die();
            } else {
                $erreurSQL = "Error: " . $sql . "<br>" . mysqli_error($conn);
                $erreur = true;
            }
            mysqli_close($conn);
        }
        if ($_SERVER["REQUEST_METHOD"] != "POST" || $erreur == true) {
    ?>
        <div class="container">
            <div class="row">
                <div class="col text-white bg-danger">
                    <?php echo $erreurSQL ?>
                </div>
            </div>
        </div>
        <div class="container mt-3">
            <h1 class="text-center">Ajouter un personnage</h1>
            <form id="form" class="row g-3 needs-validation" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" novalidate>
                <div class="row mb-3 mt-3">
                    <label for="nom" class="col-sm-2 col-form-label">Nom du personnage</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="nom" name="nom" value="<?php echo $nom; ?>" required>
                        <?php
                        if ($erreur == true) {
                        ?>
                            <div class="text-danger">
                                <?php echo $nomErreur; ?>
                            </div>
                        <?php
                        } else {
                        ?>
                            <div class="invalid-feedback" id="invalidNom">
                                Le nom est requis
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="prime" class="col-sm-2 col-form-label">Prime</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" id="prime" name="prime" value="<?php echo $prime; ?>" required>
                        <?php
                        if ($erreur == true) {
                        ?>
                            <div class="text-danger">
                                <?php echo $primeErreur; ?>
                            </div>
                        <?php
                        } else {
                        ?>
                            <div class="invalid-feedback" id="invalidPrime">
                                La prime est requise
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="image" class="col-sm-2 col-form-label">Image du personnage</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="image" name="image" value="<?php echo $image; ?>" required>
                        <?php
                        if ($erreur == true) {
                        ?>
                            <div class="text-danger">
                                <?php echo $imageErreur; ?>
                            </div>
                        <?php
                        } else {
                        ?>
                            <div class="invalid-feedback" id="invalidImage">
                                L'URL de l'image est requise
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="passwordConfirmation" class="col-sm-2 col-form-label">Équipage</label>
                    <div class="col-sm-10">
                        <input type="test" class="form-control" id="equipage" name="equipage" value="<?php echo $equipage; ?>" required>
                        <?php
                        if ($erreur == true) {
                        ?>
                            <div class="text-danger">
                                <?php echo $equipageErreur; ?>
                            </div>
                        <?php
                        } else {
                        ?>
                            <div class="invalid-feedback" id="invalidEquipage">
                                L'équipage est requise
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-success">Ajouter</button>
                </div>
            </form>
            <div class="text-center">
                <a class="btn btn-primary mt-2" href="./index.php" role="button">Retourner à la page d'accueil</a>
            </div>

        </div>
    <?php
        }
    }
    else{
        header("Location: ./connexion.php");
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