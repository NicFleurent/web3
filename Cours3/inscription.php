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
    $user = $password = $confirmPassword = $email = "";
    $erreurUser = $erreurPassword = $erreurConfirmPassword = $erreurEmail = $erreurSQL = "";
    $erreur = false;

    if($_SERVER["REQUEST_METHOD"] == "POST"){

        if (empty($_POST['user'])) {
            $erreurUser = "Le username est requis";
            $erreur = true;
        }
        $user = test_input($_POST["user"]);
        
        if (empty($_POST['password'])) {
            $erreurPassword = "Le passqord est requis";
            $erreur = true;
        }
        $password = test_input($_POST["password"]);

        if (empty($_POST['confirmPassword'])) {
            $erreurConfirmPassword = "La confirmation de votre mot de passe est requise";
            $erreur = true;
        } 
        elseif($_POST['confirmPassword'] != $_POST['password']){
            $erreurConfirmPassword = "Les deux mot de passe ne sont pas identique";
            $erreur = true;
        } 
        $password = sha1($password,false);
        
        $email = test_input($_POST["email"]);
        if(empty($_POST['email'])){
            $erreurEmail = "L'adresse courriel est requise";
            $erreur = true;
        }
        else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $erreurEmail = "L'adresse courriel n'est pas valide";
            $erreur = true;
        }

        $servername = "localhost";
        $usernameDB = "root";
        $passwordDB = "root";
        $dbname = "persosonepiece";

        $conn = new mysqli($servername,$usernameDB,$passwordDB,$dbname);
        if($conn->connect_error){
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM usagers WHERE user='$user'";

        $result = $conn->query($sql);

        if($result->num_rows != 0){
            $erreurUser = "Le username existe déjà";
            $erreur = true;
        }

        $sql = "SELECT * FROM usagers WHERE email='$email'";

        $result = $conn->query($sql);

        if($result->num_rows != 0){
            $erreurEmail = "L'adresse suivante est déjà associer à un compte'";
            $erreur = true;
        }

        if($erreur == false){
            $machine = gethostname();
            $sql = "INSERT INTO usagers (user, email, password, ip, machine) 
                VALUES ('" . $user . "', '" . $email . "', '" . $password . "', '". $_SERVER['REMOTE_ADDR'] . "', '". $_SERVER['REMOTE_HOST'] ."')";
            if (mysqli_query($conn, $sql)) {

                header("Location: ./connexion.php?succes=inscrit");
                die();
            } else {
                $erreurSQL = "Error: " . $sql . "<br>" . mysqli_error($conn);
                $erreur = true;
            }
        }

        $conn->close();
    }

    if ($_SERVER["REQUEST_METHOD"] != "POST" || $erreur == true) {
    ?>
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="row">
            <div class="card" style="width: 25rem;">
                <div class="card-body">
                    <h4 class="card-title mb-4 text-center">Inscription</h4>
                    <form id="form" class="row g-3 needs-validation" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="mb-3">
                            <label for="user" class="form-label">Username</label>
                            <input type="text" class="form-control" name="user" id="user" value="<?php echo $user; ?>">
                            <?php
                            if ($erreur == true) {
                            ?>
                                <div class="text-danger">
                                    <?php echo $erreurUser; ?>
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
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" id="password">
                            <?php
                            if ($erreur == true) {
                            ?>
                                <div class="text-danger">
                                    <?php echo $erreurPassword; ?>
                                </div>
                            <?php
                            }
                            else{
                            ?>
                                <div class="invalid-feedback" id="invalidPassword">
                                    Le password est requis
                                </div>
                            <?php 
                            }
                            ?>
                        </div>
                        <div class="mb-3">
                            <label for="confirmPassword" class="form-label">Confirmer le password</label>
                            <input type="password" class="form-control" name="confirmPassword" id="confirmPassword">
                            <?php
                            if ($erreur == true) {
                            ?>
                                <div class="text-danger">
                                    <?php echo $erreurConfirmPassword; ?>
                                </div>
                            <?php
                            }
                            else{
                            ?>
                                <div class="invalid-feedback" id="invalidPasswordConfirmation">
                                    La confirmation de votre password est requise
                                </div>
                            <?php 
                            }
                            ?>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" class="form-control" name="email" id="email" value="<?php echo $email; ?>"placeholder="name@example.com">
                            <?php
                            if ($erreur == true) {
                            ?>
                                <div class="text-danger">
                                    <?php echo $erreurEmail; ?>
                                </div>
                            <?php
                            }
                            else{
                            ?>
                                <div class="invalid-feedback"  id="invalidEmail">
                                    L'adresse courriel est requise
                                </div>
                            <?php 
                            }
                            ?>
                        </div>
                        <div class="col d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary mb-3">S'incrire</button>
                            <a href='./connexion.php' class="btn btn-primary ms-3 mb-3">Se connecter</a>
                        </div>
                        <?php
                        if ($erreur == true) {
                        ?>
                            <div class="text-danger">
                                <?php echo $erreurSQL; ?>
                            </div>
                        <?php
                        }
                        ?>
                    </form>
                    <div class="col d-flex justify-content-center">
                    </div>
                    
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
    <script src="./js/usagers.js"></script>
</body>
</html>