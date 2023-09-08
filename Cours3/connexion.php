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
    $user = $password = "";
    $erreurUser = $erreurPassword = $erreurSQL = "";
    $erreur = false;

    if(isset($_GET['succes'])){
        if($_GET['succes'] === "inscrit"){
            $_SESSION["connexion"] = true;
            header("Location: ./index.php?succes=inscription");
        }
    }

    if($_SERVER["REQUEST_METHOD"] == "POST"){

        if (empty($_POST['user'])) {
            $erreurUser = "Le username est requis";
            $erreur = true;
        }
        $user = test_input($_POST["user"]);
        
        if (empty($_POST['password'])) {
            $erreurPassword = "Le password est requis";
            $erreur = true;
        }
        $password = test_input($_POST["password"]);
        $password = sha1($password,false);

        $servername = "localhost";
        $usernameDB = "root";
        $passwordDB = "root";
        $dbname = "persosonepiece";

        $conn = new mysqli($servername,$usernameDB,$passwordDB,$dbname);
        if($conn->connect_error){
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM usagers WHERE user='$user' AND password='$password'";

        $result = $conn->query($sql);

        if($result->num_rows > 0){
            $row = $result->fetch_assoc();
            echo "<h1>Connecté</h1>";
            $_SESSION["connexion"] = true;
            header("Location: ./index.php");
        }
        else{
            $erreurSQL = "<p>Nom d'usager ou mot de passe invalide</p>";
            $erreur = true;
        }

        $conn->close();
    }

    if ($_SERVER["REQUEST_METHOD"] != "POST" || $erreur == true) {
    ?>
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="row">
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h4 class="card-title mb-4 text-center">Connexion</h4>
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
                        <div class="col d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary mb-3">Se connecter</button>
                            <a href='./inscription.php' class="btn btn-primary ms-3 mb-3">S'incrire</a>
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