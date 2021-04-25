<?php

namespace Model {

    use DB\DBcontext;

    class UserModel
    {
        private DBcontext $db;

        public string $username, $email, $password,
            $token, $name, $gender, $dob, $role_name;
        public int $patient_role_id, $doctor_role_id,
            $user_id, $role_role_id;

        function __construct()
        {
            $this->db = new DBContext();
            $this->patient_role_id = 1;
            $this->doctor_role_id = 2;
        }

        function __destruct()
        {
            $this->db->close();
        }

        function create_user(string $username, string $email, string $name, string $gender, string $dob, string $password, string $token, int $role_role_id)
        {
            if (
                empty($username) || empty($email) || empty($name)
                || empty($gender) || empty($dob) || empty($password)
                || empty($token) || empty($role_role_id)
                || !filter_var($email, FILTER_VALIDATE_EMAIL)
                || strlen($password) < 8
            ) return false;
            $password = md5($password);
            $token = md5(base64_encode($token));

            $query = "SELECT `email` FROM users WHERE `username` = '$username' OR `email` = '$email'";
            $userExist = $this->db->query($query)->numRows();
            if (!$userExist) {
                $query = "INSERT INTO `users`(`user_id`, `username`, `email`, 
                `password`, `token`, `name`, `gender`, `dob`, `role_role_id`) 
                VALUES (NULL,'$username','$email','$password','$token','$name',
                '$gender','$dob','$role_role_id')";

                if ($this->db->query($query)) {
                    return true;
                } else {
                    array_push($GLOBALS["ERR_INVALIDS"], "some error occured");
                    return false;
                }
            } else {
                array_push($GLOBALS["ERR_INVALIDS"], "duplicate user found");
                return false;
            }
            return false;
        }
        function get_all_users(string $searhterm = null)
        {
            $query = "SELECT * FROM `users` INNER JOIN `role` ON users.role_role_id=role.role_id 
                    WHERE `name` LIKE '%" . $searhterm . "%' ";
            $users = $this->db->query($query)->fetchAll();
            if (!$users) return false;
            return self::UserModelOrm($users);
        }
        function get_user(int $id)
        {
            $query = "SELECT * FROM users INNER JOIN `role` ON users.role_role_id=role.role_id 
                    WHERE `user_id` = '$id'";
            $users = $this->db->query($query)->fetchAll();
            if (!$users) return false;
            return self::UserModelOrm($users)[0];
        }
        function get_user_token_by_email(string $email)
        {
            $query = "SELECT `token` FROM `users` WHERE `email` = '$email'";
            $users = $this->db->query($query)->fetchAll();
            if (!$users) return false;
            return $users[0]['token'];
        }
        function update_user(int $id, string $username, string $email, string $name, string $dob)
        {
            if (empty($username) || empty($email) || empty($name) || empty($email)) return false;

            $query = "SELECT * FROM `users` WHERE `username` = '$username' OR `email` = '$email' AND `user_id` = '$id'";
            if ($this->db->query($query)->numRows() <= 1) {
                $query = "UPDATE `users` SET `username` = '$username', `email` = '$email', 
                `name`='$name', `dob`='$dob' WHERE `user_id` = '$id'";
                if ($this->db->query($query)) return true;
            }
            return false;
        }
        function delete_user(int $id)
        {
            $query = "DELETE FROM `users` WHERE `user_id` = '$id'";
            if ($this->db->query($query)) return true;
        }

        function change_role(int $id, int $role_role_id)
        {
            $query = "UPDATE `users` SET `role_role_id`='$role_role_id' WHERE `user_id` = '$id'";
            if ($this->db->query($query)) return true;
        }

        static function UserModelOrm($objects)
        {
            $user_array = [];
            foreach ($objects as $object) {
                $user = new UserModel();
                $user->user_id = $object["user_id"];
                $user->username = $object["username"];
                $user->email = $object["email"];
                $user->name = $object["name"];
                $user->gender = $object["gender"];
                $user->dob = $object["dob"];
                $user->role_name = $object["role_name"];
                array_push($user_array, $user);
            }
            return $user_array;
        }
    }
}
