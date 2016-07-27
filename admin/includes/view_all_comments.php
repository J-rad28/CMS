<!-- view posts -->
<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th>Author</th>
            <th>Comment</th>
            <th>Email</th>
            <th>Status</th>
            <th>In response to</th>
            <th>Date</th>
            <th>Approve</th>
            <th>Reject</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
    <?php
     global $connection;
     $query = "SELECT * FROM comments";
     $select_comments = mysqli_query($connection, $query);

     while($row = mysqli_fetch_assoc($select_comments)){
        $com_id = $row['comment_id'];
        $com_author = $row['comment_author'];
        $com_content = $row['comment_content'];
        $com_email = $row['comment_email'];
        $com_status = $row['comment_status'];
        $com_post_id = $row['comment_post_id'];
        $com_date = $row['comment_date'];

        echo "<tr>";
        echo "<td>{$com_id}</td>";
        echo "<td>{$com_author}</td>";
        echo "<td>{$com_content}</td>";
        echo "<td>{$com_email}</td>";
         
        $query = "SELECT * FROM comment_status WHERE com_status_id = {$com_status}";
        $view_status = mysqli_query($connection, $query);
        while($row = mysqli_fetch_assoc($view_status)){
            $status_id = $row['com_status_id'];
            $status = $row['com_status'];
            
            if($status_id == 1){
                echo "<td style='color:orange'>{$status}</td>";
            }elseif($status_id == 2){
                echo "<td style='color:green'>{$status}</td>";
            }else{
                echo "<td style='color:red'>{$status}</td>";
            }
        } 
         
        $query = "SELECT * FROM posts WHERE post_id = {$com_post_id} ";
        $select_post = mysqli_query($connection, $query);
        while($row = mysqli_fetch_assoc($select_post)){
            $post_id = $row['post_id'];
            $post_title = $row['post_title'];
        
            echo "<td>'{$post_title}'</td>";
        }
         
        echo "<td>{$com_date}</td>";
        echo "<td><a href='comments.php?approve={$com_id}'>Approve</a></td>";
        echo "<td><a href='comments.php?reject={$com_id}'>Reject</a></td>";
        echo "<td><a href='comments.php?delete={$com_id}'>Delete</a></td>";
        echo "</tr>";
     }
    ?>
    </tbody>
 </table>
 
<?php
//delete comment
if(isset($_GET['delete'])){
    $delete_comment = $_GET['delete'];
    $query = "DELETE FROM comments WHERE comment_id = {$delete_comment} ";
    $delete_query = mysqli_query($connection, $query);
    
    confirm($delete_query);
    header("Location: posts.php");
}
?>

<?php
//approve comment
if(isset($_GET['approve'])){
    $com_id = $_GET['approve'];
    $approve_comment = 2;
    
    $query = "UPDATE comments SET ";
    $query .= "comment_status = {$approve_comment} ";
    $query .= "WHERE comment_id = {$com_id}";
    $approve_query = mysqli_query($connection, $query);
    
    confirm($approve_query);
    header("Location: comments.php");
}
?>

<?php
//reject comment
if(isset($_GET['reject'])){
    $com_id = $_GET['reject'];
    $approve_comment = 3;
    
    $query = "UPDATE comments SET ";
    $query .= "comment_status = {$approve_comment} ";
    $query .= "WHERE comment_id = {$com_id}";
    $reject_query = mysqli_query($connection, $query);
    
    confirm($reject_query);
    header("Location: comments.php");
}
?>