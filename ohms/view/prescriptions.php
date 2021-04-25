<?php
include "includes/dashboardheader.php";
?>

<div class="container mt-3 table-responsive">
    <table class="table table-striped table-hover table-bordered border-primary">
        <thead class="bg-dark text-white text-center">
            <tr>
                <th scope="col">#ID</th>
                <th scope="col">Doctor</th>
                <th scope="col">Prescription</th>
                <th scope="col">Appointment</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($dashboard->prescriptions() as $prescription) {
                echo " <tr class='text-center'>
                        <th scope='row'>$prescription->appointment_id</th>
                        <td>$prescription->user_doctor_name</td>
                        <td class='show-read-more'>$prescription->prescription</td>
                        <td>$prescription->appointment_date</td>
                    </tr>";
            }
            ?>
        </tbody>
    </table>
</div>
<?php
include "includes/footer.php";
?>