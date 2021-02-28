<?php
include "includes/header.php";
$authController = new AuthController();
$homeController = new HomeController();
//debug mode -> echo var_dump
?>


<div class="container mt-3">

    <form action="<?php $authController->logout() ?>" method="POST" class="d-flex">
        <p class="me-1">Successfully logged in. </p>
        <input type="submit" name="logout" class="link-danger bg-transparent" value="Logout">
    </form>
    <?php
    //var_dump($homeController->fetchUser());
    ?>
</div>


<?php
include "includes/footer.php";
?>