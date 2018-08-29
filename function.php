<?php
require_once("dbconfig.php"); 
    function createString($len)
    {
        $string = "35XRBVdevW7n2ZqbJmd7cqz2iXnYb39h";	
        return $string;
    }
    function createPass($mypass){
        $salt = createString(32);
        $value = md5($mypass.$salt);
        return $value;
    }

    class Form
    {
        public static function getAllUsers($dbh)
        {
            $stmt = $dbh->prepare("SELECT * FROM auth.users");
            $stmt->execute();
			$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $res;
        }

        public static function getAllRooms($dbh)
        {
            $stmt = $dbh->prepare("SELECT id_room, name_room, username  FROM users, rooms WHERE users.user_id = rooms.user_id;
            ");
            $stmt->execute();
			$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $res;
        }

        public static function deleteUser($dbh)
        {
            $checkbox = $_POST['checked'];
            for($i=0;$i<count($checkbox);$i++)
            {
                $del_id = $checkbox[$i]; 
                $stmt = $dbh->prepare("DELETE FROM auth.users WHERE user_id = :user_id");
                $stmt->bindParam(':user_id', $del_id, PDO::PARAM_INT);  
                $stmt->execute();
            }
        }
        
        public static function checkUnblockUser($dbh)
        {
            $checkbox = $_POST['checked'];
            for($i=0;$i<count($checkbox);$i++)
            {
                $block_id = $checkbox[$i];
                $stmt = $dbh->prepare("SELECT COUNT(*) FROM auth.users WHERE status = 0 AND user_id = :user_id");
                $stmt->bindParam(':user_id', $block_id , PDO::PARAM_INT);  
                $stmt->execute();
                return $num_row = ($stmt->fetchColumn() > 0) ? true : false;
            }
        }

        public static function blockUser($dbh)
        {
            $unblockuser = Form::checkUnblockUser($dbh);
            $checkbox = $_POST['checked'];
            for($i=0;$i<count($checkbox);$i++)
            {
                $block_id = $checkbox[$i];
                if ($unblockuser){
                    $stmt = $dbh->prepare("UPDATE auth.users SET status = 1 WHERE user_id = :user_id");
                
                }else{

                    $stmt = $dbh->prepare("UPDATE auth.users SET status = 0 WHERE user_id = :user_id");
                
                }
                $stmt->bindParam(':user_id', $block_id , PDO::PARAM_INT);  
                $stmt->execute();
            }
        }
    }
  
?>