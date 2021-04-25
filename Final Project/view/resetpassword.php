<?php
include "includes/header.php";
if (!isset($_GET["reset_token"])) exit("<p class='text-center'>invalid token</p>");
$reset_token = $_GET["reset_token"];
$userController = new Controller\UserController();
?>
<div class="container">
    <form action="<?php $userController->resetpassword() ?>" method="post" name="resetpassword">
        <div class="row">
            <div class="col-sm-6 m-auto mt-4 card">
                <h1 class="text-dark text-center display-6 m-3">Reset Password</h1>
                <input type="hidden" class="visually-hidden" name="reset_token" value="<?php echo $reset_token ?>">
                <input type="password" class="form-control mt-3" name="password" id="password" placeholder="New Password">
                <input type="password" class="form-control mt-3" name="confirm_password" id="confirm_password" placeholder="Confirm Password">
                <?php
                include "includes/error.php";
                ?>
                <button type="submit" name="reset_password" class="btn btn-primary btn-lg btn-block m-3" id="password-checker-form">Change Password</button>
            </div>
        </div>
    </form>
</div>

<?php
include "includes/footer.php";
?>