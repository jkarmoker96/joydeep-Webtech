<?php

namespace Controller {

    use Model\UserModel;
    use Service\SignInManager;
    use Route;

    class UserController
    {
        private SignInManager $sign;
        private UserModel $user;
        function __construct()
        {
            $this->sign = new SignInManager();
            $this->user = new UserModel();

            if ($this->sign->CurrentUser()) {
                header('Location: ' . Route::pages_array["dashboard"]["slug"]);
            }
        }

        function login()
        {
            if ($_POST) {
                $email = $_POST["email"];
                $pass = $_POST["password"];
                $remember_me = $_POST["remember_me"];
                if ($this->sign->Login($email, $pass, $remember_me)) {
                    header("Location:" . Route::pages_array["dashboard"]["slug"]);
                } else {
                    array_push($GLOBALS["ERR_INVALIDS"], "email or password required");
                }
            }
        }
        function register()
        {
            if ($_POST) {
                $username = $_POST["username"];
                $email = $_POST["email"];
                $password = $_POST["password"];
                $name = $_POST["name"];
                $gender = $_POST["gender"];
                $dob = $_POST["dob"];

                if ($this->user->create_user($username, $email, $name, $gender, $dob, $password, $email, $this->user->patient_role_id)) {
                    header("Location:" . Route::pages_array["login"]["slug"]);
                } else {
                    array_push($GLOBALS["ERR_INVALIDS"], "all fields are required");
                }
            }
        }
        function forgetPassword()
        {
            if ($_POST) {
                $email = $_POST["email"];
                $token = $this->user->get_user_token_by_email($email);
                if ($token) {
                    header("Location:" . Route::pages_array["resetpassword"]["slug"] . "?reset_token=" . $token);
                } else {
                    array_push($GLOBALS["ERR_INVALIDS"], "email doesn't exist in our database");
                }
            }
        }
        function resetpassword()
        {
            if ($_POST) {
                $token = $_POST["reset_token"];
                $password = $_POST["password"];
                $confirm_password = $_POST["confirm_password"];
                if ($password == $confirm_password) {
                    if ($this->sign->Resetpassword($token, $password)) {
                        header("Location:" . Route::pages_array["login"]["slug"]);
                    } else {
                        array_push($GLOBALS["ERR_INVALIDS"], "error occured");
                    }
                } else {
                    array_push($GLOBALS["ERR_INVALIDS"], "passsword not matched");
                }
            }
        }
    }
}
