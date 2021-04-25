<?php
include "../config.inc.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?php echo $FAVICON ?>" rel="icon" type="image/x-icon" />

    <?php
    foreach ($CSS_FRAMEWORKS as $CSS) {
        echo "<link href='" . $CSS['url'] . "' rel='stylesheet' integrity='" . $CSS['integrity'] . "' crossorigin='" . $CSS['crossorigin'] . "'>";
    }
    foreach ($WWWROOT_CSS as $CSS) {
        echo "<link href='$CSS' rel='stylesheet'>";
    }
    ?>
    <title><?php echo $APP_NAME . " | " . $PAGE_TITLE ?></title>
</head>

<main>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <img src="<?php echo $IMG_PATH . "hospital.png" ?>" alt="logo" class="brand-logo me-2">
            <a class="navbar-brand fw-bold" href="<?php echo Route::pages_array["index"]["slug"] ?>"><?php echo $APP_NAME ?></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($NAV_ACTIVE == Route::pages_array["index"]["slug"]) ? 'active' : '' ?>" href="<?php echo Route::pages_array["index"]["slug"] ?>">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link  <?php echo ($NAV_ACTIVE == Route::pages_array["about"]["slug"]) ? 'active' : '' ?>" href="<?php echo Route::pages_array["about"]["slug"] ?>">About</a>
                    </li>
                    <?php
                    $logged_in = new Service\SignInManager();
                    if ($logged_in->CurrentUser()) {
                        include('authenticatednav.php');
                    } else {
                        include('anonymousnav.php');
                    }
                    ?>
                </ul>
            </div>
        </div>
    </nav>

    <body>