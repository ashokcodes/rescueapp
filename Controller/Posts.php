<?php


    global $dataBase;

    session_start();

    $token = $_SESSION["secret_tok"];

    $posts = $dataBase->getPosts($token);

?>

    <div class="container mt-3">
    <ul class="nav nav-tabs mb-3">
        <li class="nav-item w-50">
            <a class="nav-link text-center active" href="/posts">Remaining</a>
        </li>
        <li class="nav-item w-50">
            <a class="nav-link text-center" href="/finished">Finished</a>
        </li>
    </ul>

<?php
    foreach($posts as $post){
        $map_link = "<a href='#' class='card-link' disabled>No Map</a>";
        if(!empty($post['lat']) && !empty($post['lng'])){
            $map_link = "<a href='https://maps.google.com/?q={$post['lat']},{$post['lng']}' class='card-link'>Open Map</a>";
        }
        echo "<div data-id='{$post['id']}'  class='card'>
                <div class='card-header'>{$post['uname']}</div>
                <div class='card-body'>
                <h4 class='card-title'>{$post['phone']}</h4>
                <p class='card-text'>{$post['location']}</p>
                {$map_link}
                <a href='tel:{$post['phone']}' class='card-link'>Call</a>
                </div>
                <div onclick='finishTask({$post['id']})' class='card-footer'>Click to Mark Finished</div>
            </div>";
        echo "<hr>";
    }

?>

    </div>