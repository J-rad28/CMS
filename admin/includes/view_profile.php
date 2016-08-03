<?php
if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];

    $query = "SELECT * FROM users WHERE user_id = {$user_id}";
    $profile_details = mysqli_query($connection, $query);

    while($row = mysqli_fetch_assoc($profile_details)){
        $username = $row['username'];
        $firstname = $row['firstname'];
        $lastname = $row['lastname'];
        $user_email = $row['user_email'];
        $user_image = $row['user_image'];
        $user_role = $row['user_role'];
        ?>
        <table style="width:600px;" class="table table-hover">
            <tr>
                <td colspan="2" style="text-align:center;">
                <img width="300px" class="img-resposive" src="images/<?php echo $user_image; ?>" alt="">
                </td>
            </tr>
            <tr>
                <td colspan="1" style="text-align:right; width:300px;">Username:</td>
                <td colspan="1"><?php echo $username; ?></td>
            </tr>
            <tr>
                <td colspan="1" style="text-align:right; width:300px;">Firstname:</td>
                <td colspan="1"><?php echo $firstname; ?></td>
            </tr>
            <tr>
                <td colspan="1" style="text-align:right; width:300px;">Lastname:</td>
                <td colspan="1"><?php echo $lastname; ?></td>
            </tr>
            <tr>
                <td colspan="1" style="text-align:right; width:300px;">Email Address:</td>
                <td colspan="1"><?php echo $user_email; ?></td>
            </tr>
            <tr>
                <td colspan="1" style="text-align:right; width:300px;">Role:</td>
                <?php  
                $query = "SELECT * FROM user_role WHERE role_id = {$user_role } ";
                $role_select = mysqli_query($connection, $query);
                while($row = mysqli_fetch_assoc($role_select)){
                    $role_id = $row['role_id'];
                    $user_role = $row['user_role'];

                    if($role_id == 1){
                        echo "<td colspan='1' style='color:green'>{$user_role}</td>";
                    }else{
                        echo "<td colspan='1' style='color:red'>{$user_role}</td>";
                    }

                }
                ?>
            </tr>
            <tr>
                <td colspan="2" style="text-align:center;">
                    <form action="profile.php" method="post">
                        <button class="btn btn-primary" name="source" value="edit_profile" type="submit">Edit Profile</button>
                    </form>
                </td>
            </tr>
            <tr>
                <td colspan="2" style="text-align:center;">
                    <form action="profile.php" method="post">
                        <button class="btn btn-primary" name="source" value="delete_profile" type="submit">Delete Profile</button>
                    </form>
                </td>
            </tr>
        </table>
        <?php
    }
}
?>  