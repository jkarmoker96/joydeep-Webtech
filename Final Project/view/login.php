<?php
include "includes/header.php";
$userController = new Controller\UserController();

?>


<div class="container">
    <form action="<?php $userController->login() ?>" method="post" name="login">
        <div class="row">
            <div class="col-sm-6 m-auto mt-4 card">
                <h1 class="text-dark text-center display-6 m-3">Enter Login Details</h1>
                <input type="email" class="form-control mt-3" name="email" placeholder="Email Address">
                <input type="password" class="form-control mt-3" name="password" placeholder="Password">
                <div class="form-check mt-3">
                    <input class="form-check-input" type="checkbox" name="remember_me" id="remember_me" checked>
                    <label class="form-check-label" for="remember_me">
                        Remember this device
                    </label>
                </div>
                <?php
                include "includes/error.php";
                ?>
                <a class="link-info text-start" href="<?php echo Route::pages_array["forgetpassword"]["slug"] ?>">Forget Password?</a>
                <button type="submit" name="login" class="btn btn-primary btn-lg btn-block m-3 ">Login</button>
            </div>
        </div>
    </form>
</div>

<?php
include "includes/footer.php";
?>