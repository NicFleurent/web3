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
            echo '<tr>';
            echo "<th scope='row'>" . $row["id"] . "</th>";
            echo "<td>" . $row["nom"] . "</td>";
            echo "<td>" . number_format($row["prime"], 0, ",", ".") . " berry</td>";
            echo "<td><img src='" . $row["image"] . "' alt='photo' width='100px'/></td>";
            echo "<td>" . $row["equipage"] . "</td>";
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
        <a class="btn btn-success" href="./ajouter.php" role="button">Ajouter</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>