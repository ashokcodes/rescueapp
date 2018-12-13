<?php





    class DB{
        protected $pdo; 
        function __construct(){
            $config = parse_ini_file('.config.ini' , true);
            $mySql = $config["MySQL"];

            $dsn = $mySql["dsn"];
            $user = $mySql["user"];
            $pass = $mySql["pass"];
            
            try{
                $this->pdo = new PDO($dsn, $user, $pass);
            }   catch(PDOException $e){
                echo "Connection error! {$e->getMessage()}";
            }
        }

        function getFeed($req){
            $uid = $this->tokenToUid($req->token);
            $stmnt = $this->pdo->prepare("SELECT auth.username, post.body FROM post INNER JOIN auth ON post.uid = auth.uid WHERE post.uid <> :uid ORDER BY post.post_when DESC");
            $stmnt->bindParam(":uid",$uid, PDO::PARAM_INT);
            $stmnt->execute();
            $posts = $stmnt->fetchAll(PDO::FETCH_ASSOC);
            return $posts;
        }
        function addPosting($uname, $location, $phone, $lat, $lng){
            try{ 
                $stmnt = $this->pdo->prepare("INSERT INTO postings(uname, location, phone, lat, lng, status) VALUES(:uname, :location, :phone, :lat, :lng, 0)");
                $stmnt->bindParam(":uname",$uname, PDO::PARAM_STR);
                $stmnt->bindParam(":location",$location, PDO::PARAM_STR);
                $stmnt->bindParam(":phone",$phone, PDO::PARAM_STR);
                $stmnt->bindParam(":lat",$lat, PDO::PARAM_STR);
                $stmnt->bindParam(":lng",$lng, PDO::PARAM_STR);
                $stmnt->execute();
                return true;
            } catch (PDOException $e){
                return false;
            }

        }
        
        function login($username, $pass){
            $flag = false;
            $stmnt = $this->pdo->prepare("SELECT auth.pass FROM auth WHERE auth.user = :username");
            $stmnt->bindParam(":username", $username, PDO::PARAM_STR);
            $stmnt->execute();
            $password = $stmnt->fetch(PDO::FETCH_ASSOC);
            // $flag = password_verify($pass, $password["pass"]);
            // echo "Pass is {$pass} and password is {$password["pass"]}";
            // echo "pass is {$pass} and password is {$password["pass"]}";
            if((password_verify($pass, $password["pass"]))) {
                $tok = md5(uniqid("secret"));
                $stmnt = $this->pdo->prepare("UPDATE auth SET auth.token = :token WHERE auth.user = :username");
                $stmnt->bindParam(":username", $username, PDO::PARAM_STR);
                $stmnt->bindParam(":token", $tok, PDO::PARAM_STR);
                $stmnt->execute();
                session_start();
                $_SESSION["secret_tok"] = $tok;
                $_SESSION["user"] = $username;
                return true;
            }
            else return false;
        }
        function getPosts($token){

            $uid = $this->getUidFromToken($token);
            if(empty($uid)){
                session_destroy();
                header("Location: /");
            } else {
                $stmnt = $this->pdo->prepare("SELECT * FROM postings WHERE postings.status = 0 ORDER BY postings.post_when ASC");
                $stmnt->execute();
                $postings = $stmnt->fetchAll(PDO::FETCH_ASSOC);
                return $postings;
            }
        }
        function getFinished($token){

            $uid = $this->getUidFromToken($token);
            if(empty($uid)){
                session_destroy();
                header("Location: /");
            } else {
                $stmnt = $this->pdo->prepare("SELECT * FROM postings WHERE postings.status = 1 ORDER BY postings.post_when DESC");
                $stmnt->execute();
                $postings = $stmnt->fetchAll(PDO::FETCH_ASSOC);
                return $postings;
            }
        }
        function getUidFromToken($token){
            $stmnt = $this->pdo->prepare("SELECT auth.uid FROM auth WHERE auth.token = :token");
            $stmnt->bindParam(":token", $token, PDO::PARAM_STR);
            $stmnt->execute();
            $uid = $stmnt->fetch(PDO::FETCH_ASSOC);
            $uid = $uid["uid"];
            return $uid;
        }
        function markFinished($id){
            try{
                $stmnt = $this->pdo->prepare("UPDATE postings SET postings.status = 1 WHERE postings.id = :pid");
                $stmnt->bindParam(":pid", $id, PDO::PARAM_INT);
                $stmnt->execute();
                return true;
            } catch (PDOException $e){
                return false;
            }

        }
        function markIncomplete($id){
            try{
                $stmnt = $this->pdo->prepare("UPDATE postings SET postings.status = 0 WHERE postings.id = :pid");
                $stmnt->bindParam(":pid", $id, PDO::PARAM_INT);
                $stmnt->execute();
                return true;
            } catch (PDOException $e){
                return false;
            }

        }
    }
    $dataBase = new DB();


 