<?php

namespace Controller {

    use Model\UserModel;
    use Model\AppointmentsAndPrescriptionsModel;
    use Service\SignInManager;
    use Route;

    class DashboardController
    {
        private UserModel $user;
        private AppointmentsAndPrescriptionsModel $appointments;
        private SignInManager $sign;
        function __construct()
        {
            $this->user = new UserModel();
            $this->appointments = new AppointmentsAndPrescriptionsModel();
            $this->sign = new SignInManager();
            if (!$this->sign->CurrentUser()) {
                header('Location: ' . Route::pages_array["login"]["slug"]);
            }
        }
        function prescriptions()
        {
            $prescriptions = $this->appointments->get_all_appointment_prescription_for_specific_user($this->sign->CurrentUser()->user_id);
            if ($prescriptions) {
                return $prescriptions;
            } else {
                exit("<p class='text-center'>no appointment taken</p>");
            }
        }
        function getappointment()
        {
            if ($_POST) {
                $doctor_id = $_POST["doctor-id"];
                $appointment_date = $_POST["appointment-date"];
                if ($this->sign->CurrentUser()->user_id != $doctor_id) {
                    if ($this->appointments->create_appointment_prescription($this->sign->CurrentUser()->user_id, $doctor_id, $appointment_date)) {
                        header("Location:" . Route::pages_array["prescriptions"]["slug"]);
                    } else {
                        array_push($GLOBALS["ERR_INVALIDS"], "time already booked");
                    }
                } else {
                    array_push($GLOBALS["ERR_INVALIDS"], "user can't appoint thyself.");
                }
            }
        }
        function editaccount()
        {
            if ($_POST) {
                $username = $_POST["username"];
                $email = $_POST["email"];
                $name = $_POST["name"];
                $dob = $_POST["dob"];
                if ($this->user->update_user($this->sign->CurrentUser()->user_id, $username, $email, $name, $dob)) {
                    header("Location:" . Route::pages_array["dashboard"]["slug"]);
                } else {
                    array_push($GLOBALS["ERR_INVALIDS"], "something error happened");
                }
            }
        }
        function currentaccountdata()
        {
            return $this->sign->CurrentUser();
        }
        function changepassword()
        {
            if ($_POST) {
                $old_password = $_POST["old_password"];
                $password = $_POST["password"];
                $confirm_password = $_POST["confirm_password"];
                if ($password == $confirm_password) {
                    if ($this->sign->ChangePassword($old_password, $password)) header("Location:" . Route::pages_array["dashboard"]["slug"]);
                } else {
                    array_push($GLOBALS["ERR_INVALIDS"], "passsword not matched");
                }
            }
        }
        function appointment(int $id)
        {
            $doctor = $this->user->get_user($id);
            if ($doctor) {
                return $doctor;
            } else {
                exit("<p class='text-center'>doctor not exist in our database</p>");
            }
        }
    }
}
