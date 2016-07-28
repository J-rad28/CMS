<?php include 'includes/header.php' ?>
<?php include 'includes/db.php' ?>
    <!-- Navigation -->
<?php include 'includes/navigation.php' ?>
    
<?php
//add comment to database
if(isset($_POST['submit'])){
    $com_content = $_POST['comment'];
    $com_author = "user";
    $com_email = "user@email.com";
    $com_post_id = $_POST['submit'];
    $post_date = date('d-m-y');

    $query = "INSERT INTO comments(comment_post_id, comment_date, comment_author, comment_email, comment_content) ";
    $query .= "VALUES({$com_post_id}, now(), '{$com_author}', '{$com_email}', '{$com_content}')";
    mysqli_query($connection, $query); 
    
    header("Location:post.php?p_id={$com_post_id}");
    
}
?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Post Content Column -->
            <div class="col-lg-8">

                <!-- Blog Post -->
                <?php
                if(isset($_GET['p_id'])){
                    $post_id = $_GET['p_id'];
                    
                }
                
                $query = "SELECT * FROM posts WHERE post_id = $post_id";
                $posts = mysqli_query($connection, $query);

                 while($row = mysqli_fetch_assoc($posts)){
                        $post_title = $row['post_title'];
                        $post_author = $row['post_author'];
                        $post_date = $row['post_date'];
                        $post_image = $row['post_image'];
                        $post_content = $row['post_content'];
                 ?>
                <!--Blog Post -->
                <h2>
                    <a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $post_author?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image;?>" alt="">
                <hr>
                <p><?php echo $post_content?></p>
                <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>
                <?php
                }
                ?>
                <hr>

                <!-- Blog Comments -->

                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form method="post" action="" enctype="multipart/form-data">
                        <div class="form-group">
                           <textarea name="comment" class="form-control" placeholder="Enter comment here" cols="30" rows="5"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" name="submit" value="<?php echo $post_id; ?>">Submit Comment</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->
                <?php
                if(isset($_GET['p_id'])){
                    $com_post_id = $_GET['p_id'];
                    
                    $query = "SELECT * FROM comments WHERE comment_post_id = {$com_post_id} ";
                    $view_com_query = mysqli_query($connection, $query);
                    
                    while($row = mysqli_fetch_assoc($view_com_query)){
                        $com_author = $row['comment_author'];
                        $com_content = $row['comment_content'];
                        $com_status = $row['comment_status'];
                        $com_date = $row['comment_date'];
                        
                        if($com_status == 2){
                            ?>
                            <!-- Comment -->
                            <div class="media">
                                <a class="pull-left" href="#">
                                    <img class="media-object" src="http://placehold.it/64x64" alt="">
                                </a>
                                <div class="media-body">
                                    <h4 class="media-heading"><?php echo $com_author; ?>
                                        <small><?php echo $com_date; ?></small>
                                    </h4>
                                    <?php echo $com_content; ?>
                                </div>
                            </div>
                            <?php
                        }
                    }
                }
                ?>
            </div>

            <!-- Blog Sidebar Widgets Column -->
<?php include 'includes/sidebar.php' ?>
        <!-- /.row -->

        <hr>

        <!-- Footer -->
<?php include 'includes/footer.php' ?>