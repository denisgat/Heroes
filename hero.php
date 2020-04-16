
<?php

require "connection.php";
require "header.php";

$id = $_GET["id"];

$sql = "SELECT * FROM heroes WHERE id = " . $id;
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // $hero = "hero.php?id=" . $row["id"];
        $profile = 
        "<div class='container bg-dark text-white' style='height: 100vh'>
            <div class ='row'>
                <div class = 'col-12'>
                    <a class='btn btn-primary mt-3' href='index.php'> Back </a>
                    <br></br>
                    <h3> $row[name] </h3>
                    <p> $row[biography] </p>
                    <br></br>
                </div>
            </div>
            <div class='row p-3'>
                <br></br>
                <h3> Friends </h3>
            </div>
        </div>";
        echo $profile;
    }
} else {
    echo "0 results";
}

$sql = "SELECT * FROM relationships WHERE hero1_id = $id OR hero2_id = $id AND type_id = 1";
$result = $conn->query($sql);
// var_dump($result) ;

$conn->close();

require 'footer.php';

?>