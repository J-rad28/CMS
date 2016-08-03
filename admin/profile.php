<?php include "includes/admin_header.php"; ?>

<div id="wrapper">
    
    <!-- Navigation -->
    <?php include "includes/admin_navigation.php";?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <?php include "includes/page_heading.php"; ?>
                    
                    <?php
                    // delete profile
                    if(isset($_POST['delete_account'])){
                        global $connection;
                        $delete_user = $_SESSION['user_id'];
                        $query = "DELETE FROM users WHERE user_id = {$delete_user} ";
                        mysqli_query($connection, $query);

                        header("Location: ../includes/logout.php");
                    }
                    ?>
                    <?php
                    //update profile
                    if(isset($_POST['update_profile'])){
                        global $connection;
                        $user_id = $_SESSION['user_id'];
                        $username = $_POST['username'];
                        $firstname = $_POST['firstname'];
                        $lastname = $_POST['lastname'];
                        $user_email= $_POST['user_email'];
                        $password = $_POST['password'];

                        $user_image = $_FILES['user_image']['name'];
                        $user_image_temp = $_FILES['user_image']['tmp_name'];

                        move_uploaded_file($user_image_temp,"images/$user_image");

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

                       /* $hash = '$6$rounds=5000$';
                        $hash_salt = $hash . $rand_salt;
                        $password = crypt($password, $hash_salt); */

                        $query = "UPDATE users SET ";
                        $query .= "username = '{$username}', ";
                        $query .= "firstname = '{$firstname}', ";
                        $query .= "lastname = '{$lastname}', ";
                        $query .= "user_email = '{$user_email}', ";
                        $query .= "password = '{$password}', ";
                        $query .= "rand_salt = '{$rand_salt}', ";
                        $query .= "user_image = '{$user_image}' ";
                        $query .= "WHERE user_id = {$user_id}";

                        $update_profile = mysqli_query($connection, $query);
                        confirm($update_profile);

                        $_SESSION['username'] = $username;
                        $_SESSION['firstname'] = $firstname;
                        $_SESSION['lastname'] = $lastname;
                        $_SESSION['user_email'] = $user_email;

                        header("Location: profile.php");
                    }
                    ?>
                    <?php 
                    //page element switch
                        if(isset($_POST['source'])){
                            $source = $_POST['source'];
                        }else{
                            $source = "";
                        }
                        switch($source){

                            case "edit_profile";
                            include "includes/edit_profile.php";
                            break;

                            case "delete_profile";
                            include "includes/delete_profile.php";
                            break;

                            default:
                            include "includes/view_profile.php";
                            break;
                        } 
                    ?>
                </div>
            </div>
            <!-- /.row -->
            
        </div>
        <!-- /.container-fluid -->
    
    </div>
    <!-- /#page-wrapper -->
    
</div>
<!-- /#wrapper -->


<?php include "includes/admin_footer.php";?>