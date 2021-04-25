<?php
include "includes/header.php";
$userController = new Controller\UserController();
?>
<div class="container">
    <form action="<?php $userController->forgetPassword() ?>" method="post">
        <div class="row">
            <div class="col-sm-6 m-auto mt-4 card">
                <h1 class="text-dark text-center display-6 m-3">Enter Email</h1>
                <input type="email" class="form-control mt-3" name="email" placeholder="Email Address" required>
                <?php
                include "includes/error.php";
                ?>
                <button type="submit" name="forgetpassword" class="btn btn-primary btn-lg btn-block m-3 ">Reset Password</button>
            </div>
        </div>
    </form>
</div>
<?php
include "includes/footer.php";
?>