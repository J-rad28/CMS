<?php
    //Retreive user data
    if(isset($_GET['source'])){
        global $connection;
        $user_edit_id = $_GET['edit_user_id'];
        
        $query = "SELECT * FROM users WHERE user_id = {$user_edit_id} ";
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
        }
    }
?>
<?php
    //send user data
   if(isset($_POST['update_user'])){
        global $connection;
        global $u_id;
        $username = $_POST['username'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $user_email= $_POST['user_email'];
        $password = $_POST['password'];
        $user_role = $_POST['user_role'];

        $user_image = $_FILES['user_image']['name'];
        $user_image_temp = $_FILES['user_image']['tmp_name'];

        move_uploaded_file($user_image_temp,"../images/$user_image");
        
        if(empty($user_image)){
            $query = "SELECT * FROM users WHERE user_id = $user_id ";
            $select_image = mysqli_query($connection, $query);
            
            while($row = mysqli_fetch_array($select_image)){
                $user_image = $row['user_image'];
            }
        }

        $username = mysqli_real_escape_string($connection, $username);
        $firstname = mysqli_real_escape_string($connection, $firstname);
        $lastname = mysqli_real_escape_string($connection, $lastname);
        $user_email = mysqli_real_escape_string($connection, $user_email);
        $password = mysqli_real_escape_string($connection, $password);

        $hash = '$6$rounds=5000$';
        $hash_salt = $hash . $rand_salt;
        $password = crypt($password, $hash_salt);

        $query = "UPDATE users SET ";
        $query .= "username = '{$username}', ";
        $query .= "firstname = '{$firstname}', ";
        $query .= "lastname = '{$lastname}', ";
        $query .= "user_email = '{$user_email}', ";
        $query .= "user_role = '{$user_role}', ";
        $query .= "password = '{$password}', ";
        $query .= "rand_salt = '{$rand_salt}', ";
        $query .= "user_image = '{$user_image}' ";
        $query .= "WHERE user_id = {$user_id}";

        mysqli_query($connection, $query);

        header("Location: users.php?user_id={$u_id}");
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
        <lable for="user_role">Role</lable></br>
        <select class="" name="user_role" id="">
            <?php
            $query = "SELECT * FROM user_role";
            $role_select = mysqli_query($connection, $query);
            while($row = mysqli_fetch_assoc($role_select)){
                $role_id = $row['role_id'];
                $user_role = $row['user_role'];
                
                echo "<option value='{$role_id}'>{$user_role}</option>";
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <lable for="password">Password</lable>
        <input type="password" class="form-control" name="password" placeholder="Enter your secret passwrod here">
    </div> 
    <div class="form-group">
        <lable for="user_image">Profile Picture</lable>
        <img width = 100px src="../images/<?php echo $user_image; ?>" alt="">
        <input type="file" name="user_image">
    </div>
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="update_user" value="Update User Details">
    </div>
</form>