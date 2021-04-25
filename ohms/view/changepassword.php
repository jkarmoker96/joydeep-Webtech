<?php
include "includes/dashboardheader.php";

?>
<div class="container">
    <form action="<?php $dashboard->changepassword() ?>" method="post">
        <div class="row">
            <div class="col-sm-6 m-auto mt-4 card">
                <h1 class="text-dark text-center display-6 m-3">Change Password</h1>
                <input type="password" class="form-control mt-3" name="old_password" id="old_password" placeholder="Password" required>
                <input type="password" class="form-control mt-3" name="password" id="password" placeholder="Password" required>
                <input type="password" class="form-control mt-3" name="confirm_password" id="confirm_password" placeholder="Confirm Password" required>
                <?php
                include "includes/error.php";
                ?>
                <button type="submit" name="password_change" class="btn btn-primary btn-lg btn-block m-3" id="password-checker-form">Change Password</button>
            </div>
        </div>
    </form>
</div>

<?php
include "includes/footer.php";
?>