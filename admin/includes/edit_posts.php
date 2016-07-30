<?php
    //Retreive post data
    if(isset($_GET['source'])){
        global $connection;
        $post_edit_id = $_GET['p_id'];
        
        $query = "SELECT * FROM posts WHERE post_id = {$post_edit_id} ";
        $update_query = mysqli_query($connection, $query);
        confirm($update_query);
        
        while($row = mysqli_fetch_assoc($update_query)){
            $post_id = $row['post_id'];
            $post_author = $row['post_author'];
            $post_title = $row['post_title'];
            $post_category = $row['post_category_id'];
            $post_status = $row['post_status'];
            $post_image = $row['post_image'];
            $post_tags = $row['post_tags'];
            $post_content = $row['post_content'];
            $post_date = $row['post_date'];
        }
    }
?>
<?php
    //send post data
    if(isset($_POST['update_post'])){
        $post_title = $_POST['post_title'];
        $post_author = $_POST['post_author'];
        $post_status = $_POST['post_status'];
        $post_category_id = $_POST['post_category'];
        
        $post_image = $_FILES['post_image']['name'];
        $post_image_temp = $_FILES['post_image']['tmp_name'];
        
        $post_tags = $_POST['post_tags'];
        $post_content = $_POST['post_content'];
        $post_date = date('d-m-y');
        
        move_uploaded_file($post_image_temp,"../images/$post_image");
        
        if(empty($post_image)){
            $query = "SELECT * FROM posts WHERE post_id = $post_id ";
            $select_image = mysqli_query($connection, $query);
            
            while($row = mysqli_fetch_array($select_image)){
                $post_image = $row['post_image'];
            }
        }
    
        $query = "UPDATE posts SET ";
        $query .= "post_title = '{$post_title}', ";
        $query .= "post_author = '{$post_author}', ";
        $query .= "post_category_id = '{$post_category_id}', ";
        $query .= "post_image = '{$post_image}', ";
        $query .= "post_content = '{$post_content}', ";
        $query .= "post_tags = '{$post_tags}', ";
        $query .= "post_date = now(), ";
        $query .= "post_status = '{$post_status}' ";
        $query .= "WHERE post_id = {$post_id}";
    
        $update_post = mysqli_query($connection, $query);
    
        confirm($update_post);
        header("Location: posts.php");
    }
?>
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <lable for="title">Post Title</lable>
        <input type="text" class="form-control" name="post_title" value="<?php if(isset($post_title)){echo $post_title;} ?>">
    </div>
    <div class="form-group">
        <lable for="post_category">Post Category</lable></br>
        <select class="form-control" name="post_category" id="">
           <?php
            $query = "SELECT * FROM categories";
            $select_cat = mysqli_query($connection, $query);
            confirm($select_cat);
           
            while($row = mysqli_fetch_assoc($select_cat)){
                $cat_id = $row['cat_id'];
                $cat_title = $row['cat_title'];
                
                echo "<option class='form-control' value='$cat_id'>{$cat_title}</option>";
            }
           ?>
        </select>
    </div> 
    <div class="form-group">
        <lable for="post_author">Author</lable>
        <input type="text" class="form-control" name="post_author" value="<?php if(isset($post_author)){echo $post_author;} ?>">
    </div> 
    <div class="form-group">
        <lable for="post_image">Image</lable></br>
        <img width = 100px src="../images/<?php echo $post_image; ?>" alt="">
        <input type="file" name="post_image">
    </div>
    <div class="form-group">
        <lable for="post_tags">Tags</lable>
        <input type="text" class="form-control" name="post_tags" value="<?php if(isset($post_tags)){echo $post_tags;} ?>">
    </div>
    <div class="form-group">
        <lable for="post_content">Content</lable>
        <input type="text" class="form-control" name="post_content" id="" value="<?php if(isset($post_content)){echo $post_content;} ?>">
    </div>
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="update_post" value="Update">
    </div>
</form>