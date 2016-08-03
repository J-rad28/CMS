<?php
//delete users
if(isset($_POST['source'])){
    ?>
    <table class="table table-hover" style="text-align:center; width:600px;">
        <tr>
            <td><h3>Are you sure you would like to delete your account?</h3></td>
        </tr>
        <tr>
            <td>
                <form action="profile.php" method="post">
                <button class="btn btn-primary" type="submit" name="delete_account">Delete</button>
                </form>
            </td>
        </tr>
    </table>
    <?php
}
?>