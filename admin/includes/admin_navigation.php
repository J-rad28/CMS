<?php
if(isset($_GET['user_id'])){
    $u_id = $_GET['user_id'];
    global $u_id;
?>
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="../admin?user_id=<?php echo $u_id; ?>">CMS Admin</a>
            </div>
           
             <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
               <li><a href="../?user_id=<?php global $u_id; echo $u_id; ?>">Home</a></li>
          
                
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> 
                    <?php 
                       //display username
                        if(isset($_GET['user_id'])){
                            global $connection;
                            $user_id = $_GET['user_id'];
                            
                            $query = "SELECT * FROM users WHERE user_id = '{$user_id}'";
                            $display_name = mysqli_query($connection, $query);
                            
                            while($row = mysqli_fetch_assoc($display_name)){
                                $firstname = $row['firstname'];
                                $lastname = $row['lastname'];
                                
                                echo $firstname . " " . $lastname;
                            }
                        }
                    ?> 
                    <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="#"><i class="fa fa-fw fa-user"></i> Profile</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>
            
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li>
                        <a href="../admin/?user_id=<?php global $u_id; echo $u_id; ?>"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#posts_dropdown"><i class="fa fa-fw fa-arrows-v"></i> Posts <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="posts_dropdown" class="collapse">
                            <li>
                                <a href="posts.php?user_id=<?php global $u_id; echo $u_id; ?>">View All Posts</a>
                            </li>
                            <li>
                                <a href="posts.php?source=add_posts&user_id=<?php global $u_id; echo $u_id; ?>}">Add Posts</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="categories.php?user_id=<?php global $u_id; echo $u_id; ?>"><i class="fa fa-fw fa-wrench"></i> Categories</a>
                    </li>
                    <li>
                        <a href="comments.php?user_id=<?php global $u_id; echo $u_id; ?>"><i class="fa fa-fw fa-file"></i> Comments</a>
                    </li>
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#users_dropdown"><i class="fa fa-fw fa-arrows-v"></i> Users <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="users_dropdown" class="collapse">
                            <li>
                                <a href="users.php?user_id=<?php global $u_id; echo $u_id; ?>">View Users</a>
                            </li>
                            <li>
                                <a href="users.php?source=add_user&user_id=<?php global $u_id; echo $u_id; ?>">Create Users</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="index-rtl.html?user_id=<?php global $u_id; echo $u_id; ?>"><i class="fa fa-fw fa-user"></i> Profile</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
            
        </nav>
<?php
}
?>