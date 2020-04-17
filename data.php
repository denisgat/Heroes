<?php

require "connection.php";

$hero1_id = $_GET['hero1_id'];
$hero2_id = $_GET['hero2_id'];
$method= $_GET['method'];



if($method == 'DelFriend'){
    echo 'entering DelFriend function';
    echo '<br></br>';
    DelFriend($hero1_id,$hero2_id);
}

if($method == 'BeFriend'){
    echo 'entering BeFriend function';
    BeFriend($hero1_id,$hero2_id);
}

function DelFriend($hero1_id,$hero2_id){
    echo 'in DelFriend';
    $DelFriend = "DELETE
              FROM relationships
              WHERE hero1_id = $hero1_id 
              AND hero2_id = $hero2_id
              AND type_id = '1'";
    $result = $GLOBALS['conn']->query($DelFriend);
}

function BeFriend($hero1_id,$hero2_id){
    echo 'in BeFriend';
    $BeFriend = "UPDATE relationships SET type_id = 1 WHERE hero1_id = $hero1_id AND hero2_id = $hero2_id AND type_id = 2";
    $result = $GLOBALS['conn']->query($BeFriend);
}

$conn->close();
header("Location: ./hero.php?id=" . $hero1_id);

?>