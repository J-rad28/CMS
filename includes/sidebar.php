            <div class="col-md-4">
                
                <!-- Blog Search Well -->
                <div class="well">
                    <h4>Blog Search</h4>
                    <form action="search.php" method="post">
                    <div class="input-group">
                        <input name="search" type="text" class="form-control">
                        <span class="input-group-btn">
                            <button name="submit" class="btn btn-default" type="submit">
                                <span class="glyphicon glyphicon-search"></span>
                        </button>
                        </span>
                    </div>
                    </form> <!--search form -->
                    <!-- /.input-group -->
                </div>
                <?php
                if(isset($_SESSION['user_role'])){
                    if($_SESSION['user_role'] == null){
                        ?>
                        <!-- login -->
                        <div class="well">
                            <h4>Login</h4>
                            <?php
                            if(isset($_GET['failed'])){
                                echo "<h5 style='color:red'><strong>Incorrect Username and/or Password</strong></h5>";
                            }
                            ?>
                            <form action="includes/login.php" method="post">
                            <div class="form-group">
                                <lable for="username">Username</lable>
                                <input name="username" type="text" class="form-control" placeholder="Enter username">
                            </div>
                            <div class="form-group">
                                   <lable for="password">Password</lable>
                                <input name="password" type="password" class="form-control" placeholder="Enter password">
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary" name="login" type="submit">Login</button>
                            </div>
                            </form> <!--search form -->
                            <!-- /.input-group -->
                        </div>
                        <?php
                    }
                }else{
                    ?>
                    <!-- login -->
                    <div class="well">
                        <h4>Login</h4>
                        <?php
                        if(isset($_GET['failed'])){
                            echo "<h5 style='color:red'><strong>Incorrect Username and/or Password</strong></h5>";
                        }
                        ?>
                        <form action="includes/login.php" method="post">
                        <div class="form-group">
                            <lable for="username">Username</lable>
                            <input name="username" type="text" class="form-control" placeholder="Enter username">
                        </div>
                        <div class="form-group">
                               <lable for="password">Password</lable>
                            <input name="password" type="password" class="form-control" placeholder="Enter password">
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary" name="login" type="submit">Login</button>
                        </div>
                        </form> <!--search form -->
                        <!-- /.input-group -->
                    </div>
                    <?php
                }
                ?>
                <!-- Blog Categories Well -->
                <div class="well">
                  <?php
                    $query = "SELECT * FROM categories";
                    $select_sidebar = mysqli_query($connection, $query);
                    
                    ?>
                   
                    <h4>Blog Categories</h4>
                    <div class="row">
                        <div class="col-lg-12">
                            <ul class="list-unstyled">
                              <?php
                               
                                while($row = mysqli_fetch_assoc($select_sidebar)){
                            $cat_title = $row['cat_title'];
                            $cat_id = $row['cat_id'];
                            echo "<li><a href='category.php?category={$cat_id}'>{$cat_title}</a></li>";
                            }
                                ?>
                                
                            </ul>
                        </div>
                        <!-- /.col-lg-6 -->
                    </div>
                    <!-- /.row -->
                </div>

                <!-- Side Widget Well -->
                <?php include "widget.php"?>

            </div>