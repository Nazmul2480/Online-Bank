<?php


include 'head.php';
?>

<br><br><br>
<?php



$error = "";
if (isset($_POST['saveAccount'])) {


    if (user_exists($_POST['phone']) > 0) {

        $error = "<div class='alert alert-danger text-center'>Account Already  Exist</div>";
    } else {

        if (!$con->query("insert into customers (name,phone,password,address,branch) values ('$_POST[name]','$_POST[phone]','$_POST[password]','$_POST[address]','$_POST[branch]')")) {


            $error = "<div class='alert alert-success'>Failed. Error is:" . $con->error . "</div>";
        } else {
            $last_id = $con->insert_id;

            $con->query("insert into balance (userid,taka)
             values ($last_id,'$_POST[taka]')");

            $error = "<div class='alert alert-info text-center'>Account added Successfully</div>";
        }
    }
}
if (isset($_GET['del']) && !empty($_GET['del'])) {
    $con->query("delete from login where id ='$_GET[del]'");
}


?>

<div class="container">
    <div class="row content">

        <div class="col-sm-12">
            <div id="accordion" role="tablist" class="shadowBlack" style="margin-right: 0px">
                <br>
                <h4 class="text-center text-white">Add New Customer</h4>
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
                            <input type="text" value="<?= $_POST['name'] ?? '' ?>" name="name" class="form-control" required placeholder="Enter Customer Name">

                            <br>
                            <label for="">Accout No / Phone Number</label>
                            <input type="phone" value="<?= $_POST['phone'] ?? '' ?>" name="phone" class="form-control" required placeholder="Enter Phone Numer">

                            <br>
                            <label for="">Password</label>
                            <input type="password" name="password" value="<?= $_POST['password'] ?? '' ?>" class="form-control" required placeholder="Enter  Password">
                            <br>
                            <label for="">Diposit Balance</label>
                            <input type="number" value="<?= $_POST['taka'] ?? '' ?>" name="taka" class="form-control" required placeholder="Enter Diposit Amount">
                            <br>
                            <label for="">Address</label>
                            <div class="form-group">

                                <textarea class="form-control" name="address" rows="2" placeholder="Enter Address" required><?= $_POST['address'] ?? '' ?></textarea>
                            </div>

                            <label for="">Branch</label>
                            <select class="form-control" name="branch" required>
                                <option value="">Select Branch Name</option>

                                <?php foreach (getAllBranchList() as $row) {
                                    echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
                                } ?>



                            </select>
                            <br>
                            <button type="submit" name="saveAccount" class="btn btn-primary btn-block">Save Account</button>

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