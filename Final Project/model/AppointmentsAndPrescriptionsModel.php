<?php



namespace Model {

    use DB\DBcontext;

    class AppointmentsAndPrescriptionsModel
    {
        private DBcontext $db;

        public string $appointment_date, $prescription, $user_patient_name, $user_doctor_name;
        public int $appointment_id, $user_patient_id, $user_doctor_id;

        function __construct()
        {
            $this->db = new DBContext();
        }
        function __destruct()
        {
            $this->db->close();
        }
        function create_appointment_prescription(int $user_patient_id, int $user_doctor_id, string $appointment_date, string $prescription = null)
        {
            $appointment_date = date('d-m-Y (h:i A)', strtotime($appointment_date));

            $query = "SELECT * FROM `appointments_and_prescriptions` 
                    WHERE `appointment_date` = '$appointment_date'";
            if ($this->db->query($query)->numRows()) return false;
            $query = "INSERT INTO `appointments_and_prescriptions`(`user_patient_id`, 
                    `user_doctor_id`, `appointment_id`, `prescription`, `appointment_date`) 
                    VALUES ('$user_patient_id','$user_doctor_id',NULL,'$prescription', '$appointment_date')";
            if ($this->db->query($query)) {
                return true;
            } else {
                array_push($GLOBALS["ERR_INVALIDS"], "some error occured");
            }
        }

        function get_all_appointment_prescription()
        {
            $query = "SELECT doctor.name user_doctor_name, patient.name user_patient_name,
                appointments_and_prescriptions.*
                FROM appointments_and_prescriptions JOIN users doctor
                ON appointments_and_prescriptions.user_doctor_id = doctor.user_id 
                JOIN users patient ON appointments_and_prescriptions.user_patient_id = patient.user_id";
            $appointment_prescriptions = $this->db->query($query)->fetchAll();
            if (!$appointment_prescriptions) return false;
            return self::AppointmentsAndPrescriptionsModelOrm($appointment_prescriptions);
        }
        function get_appointment_prescription(int $id)
        {
            $query = "SELECT doctor.name user_doctor_name, patient.name user_patient_name,
        appointments_and_prescriptions.*
        FROM appointments_and_prescriptions JOIN users doctor
        ON appointments_and_prescriptions.user_doctor_id = doctor.user_id 
        JOIN users patient ON appointments_and_prescriptions.user_patient_id = patient.user_id 
        WHERE appointments_and_prescriptions.appointment_id = '$id'";
            $appointment_prescriptions = $this->db->query($query)->fetchAll();
            if (!$appointment_prescriptions) return false;
            return self::AppointmentsAndPrescriptionsModelOrm($appointment_prescriptions);
        }

        function get_all_appointment_prescription_for_specific_user(int $user_id)
        {
            $query = "SELECT doctor.name user_doctor_name, patient.name user_patient_name,
        appointments_and_prescriptions.*
        FROM appointments_and_prescriptions JOIN users doctor
        ON appointments_and_prescriptions.user_doctor_id = doctor.user_id 
        JOIN users patient ON appointments_and_prescriptions.user_patient_id = patient.user_id 
        WHERE appointments_and_prescriptions.user_patient_id = '$user_id'";
            $appointment_prescriptions = $this->db->query($query)->fetchAll();
            if (!$appointment_prescriptions) return false;
            return self::AppointmentsAndPrescriptionsModelOrm($appointment_prescriptions);
        }

        static function AppointmentsAndPrescriptionsModelOrm($objects)
        {
            $appointment_prescriptions = [];
            foreach ($objects as $object) {
                $appointment_prescription = new AppointmentsAndPrescriptionsModel();
                $appointment_prescription->appointment_date = $object["appointment_date"];
                $appointment_prescription->prescription = $object["prescription"];
                $appointment_prescription->appointment_id = $object["appointment_id"];
                $appointment_prescription->user_patient_id = $object["user_patient_id"];
                $appointment_prescription->user_doctor_id = $object["user_doctor_id"];
                $appointment_prescription->user_patient_name = $object["user_patient_name"];
                $appointment_prescription->user_doctor_name = $object["user_doctor_name"];
                array_push($appointment_prescriptions, $appointment_prescription);
            }
            return $appointment_prescriptions;
        }
    }
}
