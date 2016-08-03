<?php
// post count
$post_count = null;
$query = "SELECT * FROM posts";
$post_count_query = mysqli_query($connection, $query);

while($row = mysqli_fetch_assoc($post_count_query)){
    $post_id = $row['post_id'];
    
    if(isset($post_id)){
        $post_count = $post_count + 1;
    }
}
?>
<?php
// comment count
$comment_count = null;
$query = "SELECT * FROM comments";
$comment_count_query = mysqli_query($connection, $query);

while($row = mysqli_fetch_assoc($comment_count_query)){
    $comment_id = $row['comment_id'];
    
    if(isset($comment_id)){
        $comment_count = $comment_count + 1;
    }
}
?>
<?php
// user count
$user_count = null;
$query = "SELECT * FROM users";
$user_count_query = mysqli_query($connection, $query);

while($row = mysqli_fetch_assoc($user_count_query)){
    $user_id = $row['user_id'];
    
    if(isset($user_id)){
        $user_count = $user_count + 1;
    }
}
?>
<?php
// category count
$cat_count = null;
$query = "SELECT * FROM categories";
$cat_count_query = mysqli_query($connection, $query);

while($row = mysqli_fetch_assoc($cat_count_query)){
    $cat_id = $row['cat_id'];
    
    if(isset($cat_id)){
        $cat_count = $cat_count + 1;
    }
}
?>
                <!-- /.row -->              
<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-file-text fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class='huge'><?php echo $post_count; ?></div>
                        <div>Posts</div>
                    </div>
                </div>
            </div>
            <a href="posts.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-comments fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                     <div class='huge'><?php echo $comment_count; ?></div>
                      <div>Comments</div>
                    </div>
                </div>
            </div>
            <a href="comments.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-user fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                    <div class='huge'><?php echo $user_count; ?></div>
                        <div> Users</div>
                    </div>
                </div>
            </div>
            <a href="users.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-list fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class='huge'><?php echo $cat_count; ?></div>
                         <div>Categories</div>
                    </div>
                </div>
            </div>
            <a href="categories.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
</div>
                <!-- /.row -->