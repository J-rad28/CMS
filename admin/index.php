<?php include "includes/admin_header.php"; ?>
<?php
if($_SESSION['user_role'] == 1){
    header("Location: profile.php");
}
?>

<div id="wrapper">
   
    <!-- Navigation -->
    <?php include "includes/admin_navigation.php";?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <?php include "includes/page_heading.php"; ?>   
                </div>
            </div>
            <!-- /.row -->
            
        </div>
        <!-- /.container-fluid -->
    
    </div>
    <!-- /#page-wrapper -->
    
</div>
<!-- /#wrapper -->


<?php include "includes/admin_footer.php";?>