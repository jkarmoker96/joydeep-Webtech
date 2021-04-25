<?php
include "includes/header.php";
$homeController = new Controller\HomeController();
?>


<div class="container mt-3">
    <h1 class="text-center">Doctor List</h1>
    <input class="form-control mt-3" type="text" placeholder="Search Doctor" id="searchDoctor" aria-label="Search Doctor">
    <div class="row mt-3" id="initial-doctor-row">
        <?php
        foreach ($homeController->index() as $doctor) {
            if ($doctor->role_name == "doctor") {
                echo " <div class='card doctor-card text-center col-md-3 m-1'>
                        <a href='" . Route::pages_array['appointment']['slug'] . "?id=$doctor->user_id' class='card-link small-font link-dark text-decoration-none'>
                        <div class='card-body'>
                                <h5 class='card-title'>$doctor->name</h5>  
                                <a href='mailto:$doctor->email' class='card-link small-font'>$doctor->email</a>
                            </div>
                            </a>
                        </div> 
                    ";
            }
        }
        ?>
    </div>
</div>

<?php
include "includes/footer.php";
?>