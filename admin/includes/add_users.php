<?php
//add user
if(isset($_POST['create_user'])){
    global $connection;
    global $u_id;
    $username = $_POST['username'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $user_email= $_POST['user_email'];
    $password = $_POST['password'];
    $user_role = 1;

    $user_image = $_FILES['user_image']['name'];
    $user_image_temp = $_FILES['user_image']['tmp_name'];

    move_uploaded_file($user_image_temp,"../images/$user_image");

    $username = mysqli_real_escape_string($connection, $username);
    $firstname = mysqli_real_escape_string($connection, $firstname);
    $lastname = mysqli_real_escape_string($connection, $lastname);
    $user_email = mysqli_real_escape_string($connection, $user_email);
    $password = mysqli_real_escape_string($connection, $password);
    
    $rand_salt = rand('0', '9');
    if(strlen($rand_salt) <= 16){
        while(strlen($rand_salt) < 16){
            $rand_salt = $rand_salt . rand('0', '9');
            if(strlen($rand_salt) == 16){
                $hash = '$6$rounds=5000$';
                $hash_salt = $hash . $rand_salt;
                $password = crypt($password, $hash_salt);

                $query = "INSERT INTO users(username, firstname, lastname, user_email, user_role, password, rand_salt, user_image) ";
                $query .= "VALUES ('$username', '$firstname', '$lastname', '$user_email', $user_role, '$password', '$rand_salt', '$user_image')";
                $add_user = mysqli_query($connection, $query);
            }
        }
    }
    header("Location: users.php?user_id={$u_id}");
}

?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <lable for="username">Username</lable>
        <input type="text" class="form-control" name="username" placeholder="Choose a username">
    </div>
    <div class="form-group">
        <lable for="firstname">First Name</lable></br>
        <input type="text" class="form-control" name="firstname" placeholder="Enter your first name here">
    </div> 
    <div class="form-group">
        <lable for="lastname">Lastname</lable>
        <input type="text" class="form-control" name="lastname" placeholder="Enter your lastname here">
    </div> 
    <div class="form-group">
        <lable for="user_email">Email</lable>
        <input type="email" class="form-control" name="user_email" placeholder="Enter your Eamil here">
    </div> 
    <div class="form-group">
        <lable for="password">Password</lable>
        <input type="password" class="form-control" name="password" placeholder="Enter your secret passwrod here">
    </div> 
    <div class="form-group">
        <lable for="user_image">Profile Picture</lable>
        <input type="file" name="user_image">
    </div>
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="create_user" value="Create New User">
    </div>
</form>