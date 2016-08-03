<?php include "db.php"; ?>
<?php session_start(); ?>
<?php
if(isset($_POST['login'])){
    global $connection;
    $log_username = $_POST['username'];
    $log_password = $_POST['password'];
    
    $log_username = mysqli_real_escape_string($connection, $log_username);
    $log_password = mysqli_real_escape_string($connection, $log_password);
    
    $query = "SELECT * FROM users WHERE username = '{$log_username}'";
    $user_val = mysqli_query($connection, $query);
    while($row = mysqli_fetch_assoc($user_val)){
        $user_id = $row['user_id'];
        $username = $row['username'];
        $password = $row['password'];
        $firstname = $row['firstname'];
        $lastname = $row['lastname'];
        $user_role = $row['user_role'];
        $user_email = $row['user_email'];
        $rand_salt = $row['rand_salt'];
        
    }
   /* $hash = '$6$rounds=5000$';
    $hash_salt = $hash . $rand_salt;
    $log_password = crypt($log_password, $hash_salt);*/
    if($log_username === $username && $log_password === $password){
        if($user_role == 1){
            $_SESSION['user_id'] = $user_id;
            $_SESSION['username'] = $username;
            $_SESSION['firstname'] = $firstname;
            $_SESSION['lastname'] = $lastname;
            $_SESSION['user_email'] = $user_email;
            $_SESSION['user_role'] = $user_role;
            
            header("Location: ../");
            
        }elseif($user_role == 2){ 
            $_SESSION['user_id'] = $user_id;
            $_SESSION['username'] = $username;
            $_SESSION['firstname'] = $firstname;
            $_SESSION['lastname'] = $lastname;
            $_SESSION['user_email'] = $user_email;
            $_SESSION['user_role'] = $user_role;
            
            header("Location: ../admin");
        }
    }else{
        header("Location: ../?failed=true");
    }
}