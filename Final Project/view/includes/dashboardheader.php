<?php
include "header.php";

$dashboard = new Controller\DashboardController();
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <form action="<?php Service\SignInManager::Logout() ?>" method="POST" class="d-flex navbar-brand">
            <input type="submit" name="logout" class="btn btn-danger" value="Logout">
        </form>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#dashboardheader" aria-controls="dashboardheader" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="dashboardheader">
            <div class="navbar-nav ms-auto">
                <a class="nav-link <?php echo ($NAV_ACTIVE == Route::pages_array["prescriptions"]["slug"]) ? 'active' : '' ?>" href="<?php echo Route::pages_array["prescriptions"]["slug"] ?>">Prescriptions</a>
                <a class="nav-link <?php echo ($NAV_ACTIVE == Route::pages_array["editaccount"]["slug"]) ? 'active' : '' ?>" href="<?php echo Route::pages_array["editaccount"]["slug"] ?>">Edit Account</a>
                <a class="nav-link <?php echo ($NAV_ACTIVE == Route::pages_array["changepassword"]["slug"]) ? 'active' : '' ?>" href="<?php echo Route::pages_array["changepassword"]["slug"] ?>">Change Password</a>
            </div>
        </div>
    </div>
</nav>