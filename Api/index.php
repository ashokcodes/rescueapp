<?php

require "../db/db.php";

if(isset($_POST)){
        $req = file_get_contents('php://input');
        $req = json_decode($req);

        global $dataBase;

        switch($req->action){
            case "markFinished": $flag = $dataBase->markFinished($req->id);
                                 if($flag){
                                    $msg = array("state"=>"success");
                                } else {
                                    $msg = array("state"=>"failed");
                                }
                                respond($msg);
                                break;
            case "markIncomplete": $flag = $dataBase->markIncomplete($req->id);
                                        if($flag){
                                        $msg = array("state"=>"success");
                                    } else {
                                        $msg = array("state"=>"failed");
                                    }
                                    respond($msg);
                                    break;
            default: notFound();
        }
    } else {
        notFound();
    }



    function respond($resp){
        header("Content-Type: application/json");
        echo json_encode($resp);
        die();
    }