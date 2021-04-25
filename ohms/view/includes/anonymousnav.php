<li class="nav-item">
    <a class="nav-link  <?php echo ($NAV_ACTIVE == Route::pages_array["login"]["slug"]) ? 'active' : '' ?>" href="<?php echo Route::pages_array["login"]["slug"] ?>">Login</a>
</li>
<li class="nav-item">
    <a class="nav-link  <?php echo ($NAV_ACTIVE == Route::pages_array["register"]["slug"]) ? 'active' : '' ?>" href="<?php echo Route::pages_array["register"]["slug"] ?>">Register</a>
</li>