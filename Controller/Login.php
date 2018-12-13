<?php

    if(isset($_POST["submit"])){
        if(isset($_POST["username"])){
            if(isset($_POST["password"])){
                global $dataBase;
                $username = htmlspecialchars($_POST["username"]);
                $password = htmlspecialchars($_POST["password"]);
                if($dataBase->login($username, $password)){
                    header("Location: /posts");
                } else {
                    echo "<h5 class='text-danger'>Wrong Credentials!</h5>";
                }
            }
        }
    }


?>


<div class="container">
    <form class="mt-3" action="" method="POST">
        <div class="form-group">
            <label for="username">*Username:</label>
            <input type="text" name="username" class="form-control" placeholder="Enter Username" id="username" required>
        </div>
        <div class="form-group">
            <label for="password">*Password:</label>
            <input type="password" name="password" class="form-control" placeholder="Enter Password" id="password" required>
        </div>

        
        <button name="submit" type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>