<?php

namespace Controller {

    use Model\UserModel;

    class HomeController
    {
        private UserModel $user;

        function __construct()
        {
            $this->user = new UserModel();
        }
        function index()
        {
            $doctors = $this->user->get_all_users();
            if ($doctors) {
                return $doctors;
            } else {
                exit("<p class='text-center'>no user in database</p>");
            }
        }
    }
}
