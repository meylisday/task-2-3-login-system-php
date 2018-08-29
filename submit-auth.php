<?php 
require_once("dbconfig.php"); 
require_once("function.php");

$errors = array();

if(isset($_POST['email'])){
    $email = htmlspecialchars($_POST['email']);
    $password = createPass(htmlspecialchars($_POST['password']));

    $res = $dbh->prepare("SELECT COUNT(*) FROM auth.users WHERE email = :email"); 
    $res->bindParam(':email', $email);
    $res->execute();
    $num_row = ($res->fetchColumn() > 0) ? true : false;

    $query = $dbh->prepare("SELECT password FROM auth.users WHERE email = :email"); 
    $query->bindParam(':email', $email);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);

    $stmt = $dbh->prepare("SELECT COUNT(*) FROM auth.users WHERE status = 1 AND email = :email"); 
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $num_block = ($stmt->fetchColumn() > 0) ? true : false;

    $query1 = $dbh->prepare("SELECT username FROM auth.users WHERE email = :email"); 
    $query1->bindParam(':email', $email);
    $query1->execute();
    $username = $query1->fetch(PDO::FETCH_ASSOC);

    if ($password != $result['password']) {

        $errors[] = 'Password is wrong';
        $errors[] = $username['username'];
    }
    if (!$num_row){
        $errors[] = 'Users not found';
    }
    if ($email == ''){
        $errors[] = 'The login field is blank';
    }
    if ($password == ''){
        $errors[] = 'The password field is blank';
    }
    if ($num_block){
        $errors[] = 'Sorry. User is block';
    }
    if (count($errors) == 0){
        session_start();
        $_SESSION['username']= $username['username'];
            if ($num_row){
                header('Refresh: 5; url=./users-list.php');
        }
    }

    echo json_encode($errors);
}

?>