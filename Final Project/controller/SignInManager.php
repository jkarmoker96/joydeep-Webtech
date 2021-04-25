<?php

namespace Service {

    use DB\DBcontext;
    use Model\UserModel;
    use Route;

    class SignInManager
    {
        private DBContext $db;

        function __construct()
        {
            $this->db = new DBContext();
        }

        static function Logout()
        {
            if (isset($_POST["logout"])) {
                $past = time() - 86400 * 30 * 30;
                foreach ($_COOKIE as $key => $value) {
                    setcookie($key, $value, $past, '/');
                }
                $helper = array_keys($_SESSION);
                foreach ($helper as $key) {
                    unset($_SESSION[$key]);
                }
                session_destroy();
                header("Location:" . Route::pages_array["login"]["slug"]);
            }
        }

        function Login($email, $password, $remember_me)
        {
            if (empty($password) || empty($email)) {
                array_push($GLOBALS["ERR_INVALIDS"], "email and password required");
                return false;
            }

            $password = md5($password);
            $query = "SELECT `token` from `users` WHERE `email`='$email' AND `password`='$password'";
            $user = $this->db->query($query)->fetchAll();
            $user = $user[0];
            if (!$user) return false;

            $_SESSION["ackqwtoken"] = $user["token"];
            if ($remember_me) setcookie("ackqwtoken", $user["token"], time() + (86400 * 30 * 30), "/");
            return true;
        }

        function CurrentUser()
        {
            $current_user_token = $_COOKIE["ackqwtoken"] ?? $_SESSION["ackqwtoken"] ?? null;
            if (!$current_user_token) return false;

            $query = "SELECT * from `users` INNER JOIN `role` ON users.role_role_id=role.role_id 
                    WHERE `token` = '$current_user_token'";
            $current_user = $this->db->query($query)->fetchAll();
            if (!$current_user) return false;

            return UserModel::UserModelOrm($current_user)[0];
        }
        function ChangePassword($oldpassword, $newpassword)
        {
            $sign = new SignInManager();
            $user_id = $sign->CurrentUser()->user_id;

            if (strlen($newpassword) > 8) {
                $newpassword = md5($newpassword);
                $oldpassword = md5($oldpassword);

                $query = "SELECT * FROM `users` WHERE `user_id` = '$user_id' AND `password` = '$oldpassword'";
                $userExist = $this->db->query($query)->fetchAll();
                if ($userExist) {
                    $query = "UPDATE `users` SET `password` = '$newpassword' WHERE `user_id` = '$user_id'";
                    if ($this->db->query($query)) return true;
                } else {
                    array_push($GLOBALS["ERR_INVALIDS"], "password mismatched");
                }
            }
        }
        function Resetpassword($token, $newpassword)
        {
            if (strlen($newpassword) > 8) {
                $newpassword = md5($newpassword);
                $query = "SELECT * FROM `users` WHERE `token` = '$token'";
                $userExist = $this->db->query($query)->fetchAll();
                if ($userExist) {
                    $query = "UPDATE `users` SET `password` = '$newpassword' WHERE `token` = '$token'";
                    if ($this->db->query($query)) return true;
                } else {
                    array_push($GLOBALS["ERR_INVALIDS"], "invalid token");
                }
            }
        }
    }
}
