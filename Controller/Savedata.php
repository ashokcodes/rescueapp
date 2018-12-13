<?php

    global $dataBase;


    $uname = htmlspecialchars($_POST["uname"]);
    $location = htmlspecialchars($_POST["location"]);
    $phone = htmlspecialchars($_POST["phone"]);
    $lat = htmlspecialchars($_POST["latitude"]);
    $lng = htmlspecialchars($_POST["longitude"]);
    
    

    $add_status = $dataBase->addPosting($uname, $location, $phone, $lat, $lng);

    if($add_status) echo "<h1 class='display-4 text-center'>Thanks for your contribution!!</h1>";
    else echo "Error!! <a href='/'>Go back</a>";

?>