<?php

require "connection.php";
require "header.php";



$sql = "SELECT * FROM heroes";
$result = $conn->query($sql);

$navbar = 
    '<nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="index.php">HeroBooK</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Settings</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Info</a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </nav>';

echo $navbar;

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
