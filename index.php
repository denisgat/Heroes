<?php

require "connection.php";
require "header.php";

echo "<h1 class='text-center my-4'>Hello Supers!</h1>";

$sql = "SELECT * FROM heroes";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $output = "";
    echo '<div class="container">';
    echo '<div class="row" style="">';
    while ($row = $result->fetch_assoc()) {
        $hero = "hero.php?id=" . $row["id"];
        $output .=
            '<div class="col-4 m-2">
                <div class="card m-2 bg-light" style="height: 26rem; width: 17rem;">
                    <div class="card-body">
                        <h5 class="card-title">' . $row["name"] . '</h5>
                        <img src=' . $row["image_url"] .' class="card-image" alt="profile pic" style="height: 12rem; width: 12rem;">
                        <p class="card-text my-3">' . $row["about_me"] . '</p>
                        <a href=' . $hero . ' class="btn btn-primary">About me</a>
                    </div>
                </div>
             </div>';
    }

    echo $output;
    echo '</div>';
   
} else {
    echo "0 results";
}

$conn->close();

require 'footer.php';

?>
