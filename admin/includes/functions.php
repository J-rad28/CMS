<?php

function confirm($result){
    global $connection;
    if(!$result){
        die(mysqli_error($connection));
    }
}

//Add Categories
function AddCategory(){
    global $connection;
     if(isset($_POST["submit"])){
         $cat_title = $_POST["cat_title"];
                         
         if($cat_title == "" || empty($cat_title)){
            echo "This field should not be empty";
        }else{
            $query = "INSERT INTO categories(cat_title) ";
            $query .= "VALUE('{$cat_title}')";
            $create_cat = mysqli_query($connection, $query);
                                
            if(!$create_cat){
                die("query failed" . mysqli_error($connection));                       
            }
        }
    }
    ?>
    <!-- form to add categories -->
    <form action="" method="post">
        <div class="form-group">
            <label for="cat_title">Add Category</label>
            <input class="form-control" type="text" name="cat_title">
        </div> 
        <div class="form-group">
            <input class="btn btn-primary" type="submit" name="submit" value="Add Category">
        </div> 
    </form>
    <?php
}


//Show all Categories
function ShowAllCat(){
    global $connection;
    $query = "SELECT * FROM categories";
    $select_categories = mysqli_query($connection, $query);
                    
    while($row = mysqli_fetch_assoc($select_categories)){
        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];

        echo "<tr>";
        echo "<td>{$cat_title}</td>";
        echo "<td><a href ='categories.php?update={$cat_id}'>Update</a></td>";
        echo "<td><a href ='categories.php?delete={$cat_id}'>Delete</a></td>";
        echo "</tr>";
    }
}


// Update Categories
function UpdateCat(){
    global $connection;
    //send Category title to update form
    if(isset($_GET['update'])){
        global $connection;
        $update_cat = $_GET['update'];
        $query = "SELECT * FROM categories WHERE cat_id = {$update_cat} ";
        $update_cat_query = mysqli_query($connection, $query);
        while($row = mysqli_fetch_assoc($update_cat_query)){
            $cat_id = $row['cat_id'];
            $cat_title = $row['cat_title'];
            ?>
            <form action="" method="post">
                <div class="form-group">
                    <label for="cat_title">Update Category</label>
                    <input value="<?php if(isset($cat_title)){echo $cat_title;} ?>" class="form-control" type="text" name="cat_title">
                </div> 
                <div class="form-group">
                    <input class="btn btn-primary" type="submit" name="update" value="Update Category">
                </div> 
            </form> 
    <?php   
        }
    }
    //update database
    if(isset($_POST['update'])){
        global $connection;
        $cat_update = $_POST['cat_title'];
        $query = "UPDATE categories SET cat_title = '{$cat_update}' WHERE cat_id = {$cat_id} ";
        $update_query = mysqli_query($connection, $query);
        if(!$update_query){
            die("Query Faied" . mysqli_error($connection));
        }else{
            header("Location: categories.php");
        }
    }
}


//Delete Categories
function DeleteCat(){
    global $connection;
    if(isset($_GET['delete'])){
        $cat_delete = $_GET['delete'];
        $query = "DELETE FROM categories WHERE cat_id = {$cat_delete} ";
        $delete_id = mysqli_query($connection, $query);
        header("Location: categories.php");
    }
}
?>