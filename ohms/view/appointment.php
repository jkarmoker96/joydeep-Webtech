<?php
include "includes/dashboardheader.php";
if (!isset($_GET['id'])) exit("<p class='text-center'>invalid id</p>");
$id = $_GET['id'];
$doctor = $dashboard->appointment($id);
?>
<div class="container mt-3">
    <h1 class="text-center">Appointment Booking (<?php echo $doctor->name ?>)</h1>
    <form method="post" action="<?php $dashboard->getappointment() ?>">
        <input type="hidden" class="visually-hidden" name="doctor-id" value="<?php echo $doctor->user_id ?>" readonly required>
        <input type="datetime-local" id="datetime_local" class="form-control mt-3" name="appointment-date" required>
        <?php
        include "includes/error.php";
        ?>
        <button type="submit" name="appointment" class="btn btn-primary btn-lg btn-block m-3 ">Take Appointment</button>
    </form>
</div>
<?php
include "includes/footer.php";
?>