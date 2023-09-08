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
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
    <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
    </symbol>
    <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
        <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
    </symbol>
    <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
    </symbol>
    </svg>
    <?php
    if($_SESSION['connexion'] == true){
        if(isset($_GET['succes'])){
            if($_GET['succes'] === "ajouter"){
                ?>
                    <div class="alert alert-success alert-dismissible fade show m-5 mt-2" role="alert">
                        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>    
                        <strong>Yay!</strong> L'ajout du personnage à fonctionné!
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php
            }
            else if($_GET['succes'] === "modifier"){
                ?>
                    <div class="alert alert-success alert-dismissible fade show m-5 mt-2" role="alert">
                        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>    
                        <strong>Yay!</strong> La modification du personnage à fonctionné!
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php
            }
            else if($_GET['succes'] === "supprimer"){
                ?>
                    <div class="alert alert-success alert-dismissible fade show m-5 mt-2" role="alert">
                        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>    
                        <strong>Yay!</strong> La suppression du personnage à fonctionné!
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php
            }
            else if($_GET['succes'] === "inscription"){
                ?>
                    <div class="alert alert-success alert-dismissible fade show m-5 mt-2" role="alert">
                        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>    
                        <strong>Yay!</strong> Votre compte a été créé!
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php
            }
        }
        $serveurname = "localhost";
        $username = "root";
        $password =  "root";
        $db = "persosonepiece";
        //Create connection
        $conn = new mysqli($serveurname, $username, $password, $db);
        //Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        //Ça ne fais rien, c'est jsute la requête
        $sql = "SELECT * FROM persosonepiece";

        $conn->query('SET NAMES utf8');
        //Effectue la requête
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
        
    ?>
    <div class="container mt-5 text-center">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Prime</th>
                    <th scope="col">Photo</th>
                    <th scope="col">Equipage</th>
                </tr>
            </thead>
            <tbody>
    <?php
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<th scope='row'><a href='./modifier.php?id=". $row["id"] ."'>" . $row["id"] . "</a></th>";
            echo "<td><a href='./modifier.php?id=". $row["id"] ."'>" . $row["nom"] . "</a></td>";
            echo "<td><a href='./modifier.php?id=". $row["id"] ."'>" . number_format($row["prime"], 0, ",", ".") . " berry</a></td>";
            echo "<td><a href='./modifier.php?id=". $row["id"] ."'><img src='" . $row["image"] . "' alt='photo' width='100px'/></a></td>";
            echo "<td><a href='./modifier.php?id=". $row["id"] ."'>" . $row["equipage"] . "</a></td>";
            echo "</tr>";
        }
    } else {
        echo "0 results";
    }
    $conn->close();
    ?>
            </tbody>
        </table>
    <div class="text-center mt-3 mb-3">
        <a class="btn btn-success" href="./ajouter.php" role="button">Ajouter un personnage</a>
    </div>
    <div class="text-center mt-3 mb-3">
        <a class="btn btn-danger" href="./deconnexion.php" role="button">Se déconnecter</a>
    </div>
    <?php
    }
    else{
        header("Location: ./connexion.php");
    }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>