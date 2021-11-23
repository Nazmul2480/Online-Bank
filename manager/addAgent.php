<?php


include 'head.php';
?>

<br><br><br>
<?php
$error = "";
if (isset($_POST['saveAgent'])) {


    if (admin_exists($_POST['phone']) > 0) {

        $error = "<div class='alert alert-danger text-center'>Account Already  Exist</div>";
    } else {

        if (!$con->query("insert into admin (name,phone,password,role) values ('$_POST[name]','$_POST[phone]','$_POST[password]','$_POST[role]')")) {
            $error = "<div claass='alert alert-success'>Failed. Error is:" . $con->error . "</div>";
        } else {

            $error = "<div class='alert alert-info text-center'>Account added Successfully</div>";
        }
    }
}



?>

<div class="container">
    <div class="row content">

        <div class="col-sm-12">
            <div id="accordion" role="tablist" class="shadowBlack" style="margin-right: 0px">
                <br>
                <h4 class="text-center text-white">Add New Agent</h4>
                <br>
                <?php echo $error ?>

                <div class="card rounded-0">
                    <div class="card-header" role="tab" id="headingOne">
                        <h5 class="mb-0">

                        </h5>
                    </div>

                    <div class="card-body">
                        <form method="POST">
                            <label for="">Name</label>
                            <input type="text" value="<?= $_POST['name'] ?? '' ?>" name="name" class="form-control" required placeholder="Enter  Name">

                            <br>
                            <label for="">Accout No / Phone Number</label>
                            <input type="phone" value="<?= $_POST['phone'] ?? '' ?>" name="phone" class="form-control" required placeholder="Enter  Phone Numer">

                            <br>
                            <label for="">Password</label>
                            <input type="password" name="password" value="<?= $_POST['password'] ?? '' ?>" class="form-control" required placeholder="Enter  Password">
                            <br>


                            <label for="">User Role?</label>
                            <select class="form-control" name="role" required>
                                <option value="">Select Role </option>
                                <option value="agent">Agent</option>
                                <option value="manager">Manager</option>



                            </select>
                            <br>
                            <button type="submit" name="saveAgent" class="btn btn-primary btn-block">Create Agent</button>

                        </form>
                    </div>
                </div>

            </div>



        </div>

    </div>
    <div class="card-footer text-muted text-center" style="color:white">
        <?php echo BANKNAME; ?>
    </div>
</div>
</body>

</html>