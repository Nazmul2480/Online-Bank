<?php


include 'head.php';
?>

<br><br><br>
<?php

$id = $_GET['id'];


$error = "";
if (isset($_POST['updateAccount'])) {




    $sql = "UPDATE  customers SET name = '$_POST[name]' ,phone = '$_POST[phone]',address = '$_POST[address]' ,branch = $_POST[branch] WHERE id = $id";

   

    if ($con->query($sql) === TRUE) {

        $con->query("UPDATE  balance SET taka = $_POST[taka] where userid =$id");
      


        $error = "<div class='alert alert-success'>Update Successfully  </div>";
    } else {
        $error = "<div class='alert alert-danger'>Failed. Error is:" . $con->error . "</div>";
    }
}
// $error =  "<div class='alert alert-danger'>Failed. Error is:" . $con->error . "</div>";
$data = getCustomerByID($id);
if (isset($_GET['del']) && !empty($_GET['del'])) {
    $con->query("delete from login where id ='$_GET[del]'");
}


?>

<div class="container">
    <div class="row content">

        <div class="col-sm-12">
            <div id="accordion" role="tablist" class="shadowBlack" style="margin-right: 0px">
                <br>
                <h4 class="text-center text-white">Edit New Customer</h4>
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
                            <input type="text" value="<?= $data['name'] ?? '' ?>" name="name" class="form-control" required placeholder="Enter Customer Name">

                            <br>
                            <label for="">Accout No / Phone Number</label>
                            <input type="phone" value="<?= $data['phone'] ?? '' ?>" name="phone" class="form-control" required placeholder="Enter Phone Numer">

                            <!-- <br>
                            <label for="">Password</label>
                            <input type="password" name="password" value="<?= $data['password'] ?? '' ?>" class="form-control" required placeholder="Enter  Password">
                            -->
                            <br>
                            <label for="">Diposit Balance</label>
                            <input type="number" value="<?= $data['taka'] ?? '' ?>" name="taka" class="form-control" required placeholder="Enter Diposit Amount">
                            <br>
                            <label for="">Address</label>
                            <div class="form-group">

                                <textarea class="form-control" name="address" rows="2" placeholder="Enter Address" required><?= $data['address'] ?? '' ?></textarea>
                            </div>

                            <label for="">Branch</label>
                            <select class="form-control" name="branch" required>
                                <option value="">Select Branch Name</option>

                                <?php foreach (getAllBranchList() as $row) { ?>

                                    <option value="<?= $row['id']  ?>" <?= $row['id'] == $data['branch'] ?    'selected' : '' ?>> <?= $row['name']  ?></option>

                                <?php   } ?>
                            </select>
                            <br>
                            <button type="submit" name="updateAccount" class="btn btn-primary btn-block">Save Account</button>

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