<?php
    if(isset($_POST['create_post'])){
        $post_title = $_POST['post_title'];
        $post_category = $_POST['post_category_id'];
        $post_author = $_POST['post_author'];
        $post_status = 1;
        
        $post_image = $_FILES['post_image']['name'];
        $post_image_temp = $_FILES['post_image']['tmp_name'];
        
        $post_tags = $_POST['post_tags'];
        $post_content = $_POST['post_content'];
        $post_date = date('d-m-y');
        $post_comment_count = 4;
        
        move_uploaded_file($post_image_temp,"../images/$post_image");
  
    
        $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_comment_count, post_status) ";
        $query .= "Values('{$post_category}', '{$post_title}', '{$post_author}', now(), '{$post_image}', '{$post_content}', '{$post_tags}', '{$post_comment_count}', '{$post_status}' )";
    
        $add_post = mysqli_query($connection, $query);
    
        confirm($add_post);
        header("Location: posts.php");
    }
    
?>
   

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <lable for="title">Post Title</lable>
        <input type="text" class="form-control" name="post_title">
    </div>
    <div class="form-group">
        <lable for="post_category">Post Category</lable></br>
        <select name="post_category_id" id="">
            <?php
            $query = "SELECT * FROM categories";
            $select_cat = mysqli_query($connection, $query);
            confirm($select_cat);
           
            while($row = mysqli_fetch_assoc($select_cat)){
                $cat_id = $row['cat_id'];
                $cat_title = $row['cat_title'];
                
                echo "<option value='$cat_id'>{$cat_title}</option>";
            }
           ?>
        </select>
    </div> 
    <div class="form-group">
        <lable for="post_author">Author</lable>
        <input type="text" class="form-control" name="post_author">
    </div> 
    <div class="form-group">
        <lable for="post_image">Image</lable>
        <input type="file" name="post_image">
    </div>
    <div class="form-group">
        <lable for="post_tags">Tags</lable>
        <input type="text" class="form-control" name="post_tags">
    </div>
    <div class="form-group">
        <lable for="post_content">Content</lable>
        <input type="text" class="form-control" name="post_content" id="" cols="30" rows="10">
    </div>
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="create_post" value="Publish">
    </div>
</form>