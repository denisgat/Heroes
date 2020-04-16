
<?php

require "connection.php";
require "header.php";

$id = $_GET["id"];

$sql = "SELECT * FROM heroes";
$sql2 = "SELECT * FROM relationships WHERE hero1_id = " . $id;

//WHERE id = " . $id
// WHERE hero1_id = " . $id

$result = $conn->query($sql);
$result2 = $conn->query($sql2);

$bio ='';
$freinds='';

if ($result->num_rows > 0) {
    //loops through all heros
    while ($herorow = $result->fetch_assoc()) {
        //enter if when the looping hero matches the hero on the page
        if($herorow['id'] == $id){
            $bio = 
            "<div class ='row'>
                <div class = 'col-12'>
                    <a class='btn btn-primary mt-3' href='index.php'> Back </a>
                    <br></br>
                    <img src='$herorow[image_url]' class='card-image' alt='profile pic' style='height: 12rem; width: 12rem;'>
                    <br></br>
                    <h3> $herorow[name] </h3>
                    <p> $herorow[biography] </p>
                    <br></br>
                </div>
            </div>";
        }
        //loops through the relationship table where the hero1_id matches the hero on the page
        while($relationrow = $result2->fetch_assoc()){
            //enters if when the looping hero matches the hero2_id in the relationtable
            // if($herorow['id'] == $relationrow['hero2_id'] && hero1_id = $id){
                $friends .= 
                    "<div class='row'>
                        <div class='col-12'>
                            <h3>Friend</h3>
                            <ul>
                                <li> Friend ID: $relationrow[hero2_id] </li>
                                <li> Friend Name: $herorow[name] </li>
                            </ul>
                        </div.
                    </div>";
            // }
        }
    }
} 

else {
    echo "0 results";
}



echo "<div class='container bg-dark text-white' style='height: 100%'>";
echo $bio;
echo $friends;
echo "</div>";

$sql = "SELECT * FROM relationships WHERE hero1_id = $id OR hero2_id = $id AND type_id = 1";
$result = $conn->query($sql);
// var_dump($result) ;

$conn->close();

require 'footer.php';

?>