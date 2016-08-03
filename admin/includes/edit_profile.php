<?php
    //Retreive user data
    if(isset($_POST['source'])){
        global $connection;
        $user_id = $_SESSION['user_id'];
        
        $query = "SELECT * FROM users WHERE user_id = {$user_id} ";
        $update_query = mysqli_query($connection, $query);
        confirm($update_query);
        
        while($row = mysqli_fetch_assoc($update_query)){
            $user_id = $row['user_id'];
            $username = $row['username'];
            $firstname = $row['firstname'];
            $lastname = $row['lastname'];
            $user_email = $row['user_email'];
            $user_image = $row['user_image'];
            $user_role = $row['user_role'];
            $rand_salt = $row['rand_salt'];
            $password = $row['password'];
        }
    }
?>
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <lable for="username">Username</lable>
        <input type="text" class="form-control" name="username" placeholder="Choose a username" value="<?php echo $username; ?>">
    </div>
    <div class="form-group">
        <lable for="firstname">First Name</lable></br>
        <input type="text" class="form-control" name="firstname" placeholder="Enter your first name here" value="<?php echo $firstname; ?>">
    </div> 
    <div class="form-group">
        <lable for="lastname">Lastname</lable>
        <input type="text" class="form-control" name="lastname" placeholder="Enter your lastname here" value="<?php echo $lastname; ?>">
    </div> 
    <div class="form-group">
        <lable for="user_email">Email</lable>
        <input type="email" class="form-control" name="user_email" placeholder="Enter your Eamil here" value="<?php echo $user_email; ?>">
    </div> 
    <div class="form-group">
        <lable for="password">Password</lable>
        <input type="password" class="form-control" name="password" placeholder="Enter your secret passwrod here" value="<?php echo $password; ?>">
    </div> 
    <div class="form-group">
        <lable for="user_image">Profile Picture</lable>
        <img width = 100px src="images/<?php echo $user_image; ?>" alt="">
        <input type="file" name="user_image">
    </div>
    <div class="form-group">
       <input class="btn btn-primary" type="submit" name="update_profile" value="Update Profile">
    </div>
</form>