<?php
include "includes/dashboardheader.php";
?>
<div class="container">
    <h1 class="text-center">Hello, <?php echo $logged_in->CurrentUser()->name ?></h1>
</div>
<?php
include "includes/footer.php";
?>