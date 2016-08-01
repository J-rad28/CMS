<?php include "db.php"; ?>
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
        
    }
    if($log_username == $username && $log_password == $password){
        if($user_role == 1){
            header("Location: ../?user_id={$user_id}");
        }elseif($user_role == 2){
            header("Location: ../admin/?user_id={$user_id}");
        }
    }else{
        header("Location: ../?failed=true");
    }
}