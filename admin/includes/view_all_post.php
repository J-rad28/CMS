<!-- view posts -->
<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Title</th>
            <th>Author</th>
            <th>Category</th>
            <th>Status</th>
            <th>Image</th>
            <th>Tags</th>
            <th>Comments</th>
            <th>Date</th>
            <th>Publish/ Draft</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
    <?php
     global $connection;
     $query = "SELECT * FROM posts";
     $select_posts = mysqli_query($connection, $query);

     while($row = mysqli_fetch_assoc($select_posts)){
        $post_id = $row['post_id'];
        $post_author = $row['post_author'];
        $post_title = $row['post_title'];
        $post_category = $row['post_category_id'];
        $post_status = $row['post_status'];
        $post_image = $row['post_image'];
        $post_tags = $row['post_tags'];
        $post_comments = $row['post_comment_count'];
        $post_date = $row['post_date'];

        echo "<tr>";
        echo "<td>{$post_title}</td>";
        echo "<td>{$post_author}</td>";
         
        $query = "SELECT * FROM categories WHERE cat_id = {$post_category} ";
        $select_cat = mysqli_query($connection, $query);
        while($row = mysqli_fetch_assoc($select_cat)){
            $cat_id = $row['cat_id'];
            $cat_title = $row['cat_title'];
        
            echo "<td>{$cat_title}</td>";
        }
         
        $query = "SELECT * FROM status WHERE status_id = {$post_status}";
        $view_status = mysqli_query($connection, $query);
        while($row = mysqli_fetch_assoc($view_status)){
            $status_id = $row['status_id'];
            $status = $row['value'];
            
            if($status_id == 2){
                echo "<td style='color:green'>{$status}</td>";
            }else{
                echo "<td style='color:red'>{$status}</td>";
            }
            
        } 
        echo "<td><img width = '100px' class = 'img-responsive' src = '../images/{$post_image}'></td>";
        echo "<td>{$post_tags}</td>";
        echo "<td>{$post_comments}</td>";
        echo "<td>{$post_date}</td>";
         
        if(isset($_GET['user_id'])){
            $u_id = $_GET['user_id'];
            
            //  publish/draft selction
            if($post_status == 1){
                echo "<td><a href='posts.php?status=2&p_id={$post_id}&user_id={$u_id}'>Publish</a></td>";
            }else{
                echo "<td><a href='posts.php?status=1&p_id={$post_id}&user_id={$u_id}'>Draft</a></td>";
            }
           
            echo "<td><a href='posts.php?source=edit_posts&p_id={$post_id}&user_id={$u_id}'>Edit</a></td>";
            echo "<td><a href='posts.php?delete={$post_id}&user_id={$u_id}'>Delete</a></td>";
        }
        echo "</tr>";
     }
    ?>
    </tbody>
 </table>
 
<?php
//delete posts
if(isset($_GET['delete'])){
    $delete_post = $_GET['delete'];
    $query = "DELETE FROM posts WHERE post_id = {$delete_post} ";
    $delete_query = mysqli_query($connection, $query);
    
    confirm($delete_query);
    header("Location: posts.php?user_id={$u_id}");
}
?>

<?php
//change status
if(isset($_GET['status'])){
    $status = $_GET['status'];
    $post_id = $_GET['p_id'];
    
    $query = "UPDATE posts SET ";
    $query .= "post_status = {$status} ";
    $query .= "WHERE post_id = {$post_id}";
    mysqli_query($connection, $query);
    
    header("Location: posts.php?user_id={$u_id}");
}
?>
