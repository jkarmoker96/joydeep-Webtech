<li class="nav-item">
    <a class="nav-link  <?php echo ($NAV_ACTIVE == Route::pages_array["dashboard"]["slug"]) ? 'active' : '' ?>" href="<?php echo Route::pages_array["dashboard"]["slug"] ?>"><?php echo $logged_in->CurrentUser()->username ?></a>
</li>