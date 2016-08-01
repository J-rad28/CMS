
    <?php
      if(isset($_GET['user_id'])){
          global $connection;
          $u_id = $_GET['user_id'];
          
          $query = "SELECT * FROM users WHERE user_id = {$u_id}";
          $user_details = mysqli_query($connection, $query);
          
          while($row = mysqli_fetch_assoc($user_details)){
              $firstname = $row['firstname'];
              $lastname = $row['lastname'];
              
              echo "<h1 class='page-header''>";
              echo "    Welcome to admin ";
              echo "    <small>";
              echo          $firstname . " " . $lastname;
              echo "    </small>";
              echo "</h1>";
          }
          return $u_id;
      }
    ?>