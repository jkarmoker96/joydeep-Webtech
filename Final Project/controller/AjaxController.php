<?php
require_once '../config.inc.php';

$user = new Model\UserModel();
$sign = new Service\SignInManager();
if (isset($_GET["search__doctor"])) {
    $searched = $_GET["search__doctor"];
    $users = $user->get_all_users($searched);
    if ($users) {
        foreach ($users as $doctor) {
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
    }
}
if (isset($_POST["edit__account"])) {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $name = $_POST["name"];
    $dob = $_POST["dob"];
    $user->update_user($sign->CurrentUser()->user_id, $username, $email, $name, $dob);
}
