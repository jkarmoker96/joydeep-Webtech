<?php
include "includes/dashboardheader.php";
$current_account_data = $dashboard->currentaccountdata();
?>
<div class="container">
    <form method="post" name="editaccount">
        <div class="row">
            <div class="col-sm-6 m-auto mt-4 card">
                <h1 class="text-dark text-center display-6 m-3">Edit Account</h1>
                <input type="text" class="form-control mt-3" name="name" placeholder="Name" value="<?php echo $current_account_data->name ?>">
                <input type="text" class="form-control mt-3" name="username" placeholder="UserName" value="<?php echo $current_account_data->username ?>">
                <input type="email" class="form-control mt-3" name="email" placeholder="Email Address" value="<?php echo $current_account_data->email ?>">
                <input type="date" class="form-control mt-3" name="dob" placeholder="Date of Birth" value="<?php echo $current_account_data->dob ?>">
                <?php
                include "includes/error.php";
                ?>
                <button type="submit" name="editaccount" class="btn btn-primary btn-lg btn-block m-3" id="password-checker-form">Update Account</button>
            </div>
        </div>
    </form>
</div>

<?php
include "includes/footer.php";
?>