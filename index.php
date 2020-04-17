<?php

require "connection.php";
require "header.php";



$sql = "SELECT * FROM heroes";
$result = $conn->query($sql);

$navbar = 
    '<nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="index.php">HeroBook</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#Create">Create Hero</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Settings</a>
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
        $link = "hero.php?id=" . $row["id"];
        $output .=
            '<div class="col-4 m-2">
                <div class="card m-2 bg-light" style="height: 26rem; width: 17rem;">
                    <div class="card-body">
                        <h5 class="card-title">' . $row["name"] . '</h5>
                        <img src=' . $row["image_url"] .' class="card-image" alt="profile pic" style="height: 12rem; width: 12rem;">
                        <p class="card-text my-3">' . $row["about_me"] . '</p>
                        <a href=' . $link . ' class="btn btn-primary">About me</a>
                    </div>
                </div>
             </div>';
    }

    echo $output;
    echo '</div>';
   
} else {
    echo "0 results";
}

$form = 
    '<form>
        <div class="form-group">
            <label for="exampleFormControlInput1">Name</label>
            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="WONDER WALL">
        </div>
        <div class="form-group">
            <label for="exampleFormControlSelect1">SuperPower</label>
            <select class="form-control" id="exampleFormControlSelect1">
            <option>No Powers</option>
            <option>Super Strength</option>
            <option>Flying</option>
            <option>Telekinesis</option>
            <option>Telepathy</option>
            <option>Frost Breath</option>
            <option>Super Speed</option>
            <option>X-Ray Vision</option>
            <option>Laser Beams</option>
            <option>Invisibility</option>
            <option>Lava Breath</option>
            <option>Weather Control</option>
            </select>
        </div>
        <div class="form-group">
            <label for="exampleFormControlTextarea1">About_Me</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
        </div>
        <div class="form-group">
            <label for="exampleFormControlTextarea1">Bio</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
        </div>
        <div class="form-group">
            <label for="exampleFormControlFile1">Profile Pic</label>
            <input type="file" class="form-control-file" id="exampleFormControlFile1">
      </div>
      <button href="" type="submit" class="btn btn-primary">Create Hero</button>
    </form>';
    
$render = 
    "<div class='container'>
        <br></br>
        <h1 id='#Create' class='text-center'>Create Your Own Hero</h1>
        <br></br>
        $form
    </div>";

echo $render;

$conn->close();

require 'footer.php';

?>
