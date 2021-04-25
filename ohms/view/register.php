<?php
include "includes/header.php";
$userController = new Controller\UserController();
?>
<div class="container">
    <form action="<?php $userController->register() ?>" method="post" name="registration">
        <div class="row">
            <div class="col-sm-6 m-auto mt-4 card">
                <h1 class="text-dark text-center display-6 m-3">Register</h1>
                <input type="text" class="form-control mt-3 " name="name" placeholder="Name">
                <div class="row">
                    <div class="col">
                        <input type="text" class="form-control mt-3 " name="username" placeholder="UserName">
                    </div>
                    <div class="col">
                        <input type="email" class="form-control mt-3 " name="email" placeholder="Email Address">
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <input type="password" class="form-control mt-3 " name="password" id="password" placeholder="Password">
                    </div>
                    <div class="col">
                        <input type="password" class="form-control mt-3" name="confirm_password" id="confirm_password" placeholder="Confirm Password">
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label class="mt-3 form-label">Choose Gender</label>
                        <div class="form-group">
                            <input class="form-check-input" type="radio" name="gender" id="Male" value="Male">
                            <label class="form-check-label" for="Male">Male</label>
                            <input class="form-check-input" type="radio" name="gender" id="Female" value="Female">
                            <label class="form-check-label" for="Female">Female</label>
                            <input class="form-check-input" type="radio" name="gender" id="Other" value="Other">
                            <label class="form-check-label" for="Other">Other</label>
                        </div>
                    </div>
                    <div class="col">
                        <p class="mt-3">Date of Birth</p>
                        <input type="date" class="form-control" name="dob" max="<?php echo date("Y-m-d", time()); ?>" placeholder="Date of Birth">
                    </div>
                </div>
                <?php
                include "includes/error.php";
                ?>
                <button type="submit" name="register" class="btn btn-primary btn-lg btn-block m-3" id="password-checker-form">Register</button>
            </div>
        </div>
    </form>
</div>

<?php
include "includes/footer.php";
?>