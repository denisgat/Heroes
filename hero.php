
<?php

require "connection.php";
require "header.php";

$id = $_GET["id"];

$sql = "SELECT * FROM heroes WHERE id = " . $id;

$sql2 = "SELECT * 
FROM ability_hero
INNER JOIN abilities
ON ability_hero.ability_id=abilities.id
WHERE ability_hero.hero_id = " . $id;


$sql3 = "SELECT * 
FROM relationships  
INNER JOIN heroes 
ON relationships.hero2_id=heroes.id
WHERE relationships.hero1_id = $id
AND type_id = '1'";

$sql4 = "SELECT * 
FROM relationships  
INNER JOIN heroes 
ON relationships.hero2_id=heroes.id
WHERE relationships.hero1_id = $id
AND type_id = '2'";


$result = $conn->query($sql);
$result2 = $conn->query($sql2);
$result3 = $conn->query($sql3);
$result4 = $conn->query($sql4);




$bio ='';
$freinds='';
$enemies='';
$ability='';
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
                    <a class="nav-link" href="index.php/#Create">Create Hero</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Setting</a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </nav>';




if ($result->num_rows > 0) {
    //loops through all heros
    while ($herorow = $result->fetch_assoc()) {
        $bio = 
            "<div class = 'col-5 pl-4 pt-3'>
                <h2 class='text-center'> $herorow[name] </h2>
                <br></br>
                <img src='$herorow[image_url]' class='bg-white rounded-circle ml-3' alt='profile pic' style='height: 14rem; width: 14rem;'>
                <br></br>
                <p> $herorow[biography] </p>
                <br></br>
            </div>";
    }

    while($abilityrow = $result2->fetch_assoc()){
        $ability = 
            "<div class = 'col-5 ml-5 mt-3'>
                <h2 class='text-center'> Abilities </h2>
                <br></br>
                <h4> SuperPower: $abilityrow[ability] </h4>
            </div>";
    }

    while($relationrow = $result3->fetch_assoc()){
        $hero = "hero.php?id=" . $relationrow["id"];
        $friends .= 
            '<div class="col-3 text-dark">
                <div class="card m-2 bg-light" style="height: 27rem; width: 15rem;">
                    <div class="card-body">
                        <h5 class="card-title">' . $relationrow["name"] . '</h5>
                        <img src=' . $relationrow["image_url"] .' class="" alt="profile pic" style="height: 12rem; width: 12rem;">
                        <p class="card-text my-3">' . $relationrow["about_me"] . '</p>
                        <a href=' . $hero . ' class="btn btn-primary">About me</a>
                        <a href="data.php?method=DelFriend&hero2_id=' . $relationrow[id] . '&hero1_id=' .$id .'" class="btn btn-danger">Delete</a>
                    </div>
                 </div>
            </div>';
    }

    while($relationrow = $result4->fetch_assoc()){
        $hero = "hero.php?id=" . $relationrow["id"];
        $enemies .= 
            '<div class="col-3 text-dark">
                <div class="card m-2 bg-light" style="height: 27rem; width: 15rem;">
                    <div class="card-body">
                        <h5 class="card-title">' . $relationrow["name"] . '</h5>
                        <img src=' . $relationrow["image_url"] .' class="card-image" alt="profile pic" style="height: 12rem; width: 12rem;">
                        <p class="card-text my-3">' . $relationrow["about_me"] . '</p>
                        <a href=' . $hero . ' class="btn btn-primary">About me</a>
                        <a href="data.php?method=BeFriend&hero2_id=' . $relationrow[id] . '&hero1_id=' .$id .'" class="btn btn-success">BeFriend</a>
                    </div>
                 </div>
            </div>';
    }
} 


else {
    echo "0 results";
}
            // <a class='btn btn-primary' href='index.php'> Back </a>
$render = 
    "<div>
        $navbar
        <div class='container bg-dark text-white' style='height: 100%'>
            <div class='row p-3'>
                <h2 class='text-center'>PROFILE</h2>
            </div>
            <div class='row'>
                $bio
                $ability
            </div>
            <h3 class='text-center text-success'> Friends </h3>
            <br></br>
            <div class='row'>
                $friends
            </div>
            <h3 class='text-center text-danger'> Enemies </h3>
            <br></br>
            <div class='row'>
                $enemies
            </div>
        </div>
    </div>";

echo $render;

$conn->close();

require 'footer.php';

?>