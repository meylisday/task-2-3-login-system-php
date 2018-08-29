<?php 
require_once("dbconfig.php"); 
require_once("function.php");

    $errors = array();
    if(isset($_POST['login']))
    {
        $username = preg_replace('/[^A-Za-z-0-9]/', '', $_POST['login']);
        $email = htmlspecialchars($_POST['email']);
        $password = createPass(htmlspecialchars($_POST['password']));
        $password2 = createPass(htmlspecialchars($_POST['password2']));
        $status = 0;

        $res = $dbh->prepare("SELECT COUNT(email) FROM auth.users WHERE email = :email"); 
        $res->bindParam(':email', $email);
        $res->execute();
        $num_row = ($res->fetchColumn() > 0) ? true : false;

        $stmt = $dbh->prepare("SELECT COUNT(username) FROM auth.users WHERE username = :username"); 
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $num_username= ($stmt->fetchColumn() > 0) ? true : false;
    }
    if($username == '')
    {
        $errors[] = 'The login field is blank';
    }
    if($email == '')
    {
        $errors[] = 'The email field is blank';
    }
    if($password == '' || $password2 == '')
    {
        $errors[] = 'The password field is blank';
    }
    if($password != $password2)
    {
        $errors[] = 'Passwords do not match';
    }
    if ($num_row){
        $errors[] = 'Email already exists';
    }
    if ($num_username){
        $errors[] = 'Username already exists';
    }

    if(count($errors) == 0)
    {  
        $query = $dbh->prepare("INSERT INTO auth.users (username, email, password, status) VALUES (:username, :email, :password, :status)");
        $query->bindParam(':username', $username);
        $query->bindParam(':email', $email);
        $query->bindParam(':password', $password);
        $query->bindParam(':status', $status);
        $query->execute();
             
    }
    echo json_encode($errors);

?>