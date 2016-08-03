<!-- view posts -->
<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Username</th>
            <th>First Name</th>
            <th>Lastname</th>
            <th>Email</th>
            <th>Profile Picture</th>
            <th>Role</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
    <?php
     global $connection;
     $query = "SELECT * FROM users";
     $show_users = mysqli_query($connection, $query);

     while($row = mysqli_fetch_assoc($show_users)){
        $user_id = $row['user_id'];
        $username = $row['username'];
        $firstname = $row['firstname'];
        $lastname = $row['lastname'];
        $email = $row['user_email'];
        $user_image = $row['user_image'];
        $user_role = $row['user_role'];
 
        echo "<tr>";
        echo "<td>{$username}</td>";
        echo "<td>{$firstname}</td>";
        echo "<td>{$lastname}</td>";
        echo "<td>{$email}</td>";
        echo "<td><img width = '100px' class = 'img-responsive' src = 'images/{$user_image}'></td>";
         
        $query = "SELECT * FROM user_role WHERE role_id = {$user_role}";
        $view_role = mysqli_query($connection, $query);
        while($row = mysqli_fetch_assoc($view_role)){
            $role_id = $row['role_id'];
            $user_role = $row['user_role'];
            
            if($role_id == 1){
                echo "<td style='color:green'>{$user_role}</td>";
            }else{
                echo "<td style='color:red'>{$user_role}</td>";
            }
            
        } 

        echo "<td><a href='users.php?source=edit_user&edit_user_id={$user_id}'>Edit</a></td>";
        echo "<td><a href='users.php?delete={$user_id}'>Delete</a></td>";
        echo "</tr>";
     }
    ?>
    </tbody>
 </table>
 
<?php
//delete users
if(isset($_GET['delete'])){
    $delete_user = $_GET['delete'];
    $query = "DELETE FROM users WHERE user_id = {$delete_user} ";
    $delete_query = mysqli_query($connection, $query);
    
    confirm($delete_query);
    header("Location: users.php");
}
?>