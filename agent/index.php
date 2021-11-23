<?php

include 'head.php';

if (isset($_GET['deleteCustomer'])) {

    if ($con->query("delete from balance where userid = $_GET[deleteCustomer]")) {
        if ($con->query("delete from customers where id = $_GET[deleteCustomer]")) {
            header("location:index.php");
        }
    }

    $error =  "<div class='alert alert-danger'>Failed. Error is:" . $con->error . "</div>";
}


$row = getCustomerByID($_SESSION['agentUserID']);

if (isset($_POST['cashIn'])) {


    $acc = $_POST['accNo'];
    $accID =  $_POST['accID'];
    $amount = $_POST['taka'];

    //Add To Receiver
    setBalance($amount, 'add',  $accID, 0);


    $error = "<div class='alert alert-success text-center'>Cash in Successfully!</div>";
}


?>

<br><br><br>
<div class="container">
    <div class="card w-100 ">
        <div class=" card-header text-center">
        Deposit Balanace
        </div>
        <div class="card-body">
            <form method="POST">
                <div class=" w-75 mx-auto">
                    <?php echo $error ?? '' ?>
                    <h5>Enter User Info </h5>
                    <input type="phone" name="phone" class="form-control " placeholder="Enter Receiver phone number" required>
                    <button type="submit" name="accInfo" class="btn btn-primary btn-bloc btn-md my-1">Get Account Info</button>
                </div>
            </form>

            <br>
            <?php if (isset($_POST['accInfo'])) {


                $receiver_data = $con->query("select * from customers where phone = '$_POST[phone]'");

                if ($receiver_data->num_rows > 0) {
                    $data = $receiver_data->fetch_assoc(); ?>

                    <div class='w-75  mx-auto'>
                        <form method='POST'>
                            <input type='hidden' value='<?= $data['id'] ?>' name='accID' class='form-control ' readonly required>

                            Account No
                            <input type='text' value='<?= $data['phone'] ?>' name='accNo' class='form-control ' readonly required>
                            Account Name
                            <input type='text' class='form-control' value='<?= $data['name'] ?>' readonly required>

                            Enter Amount.
                            <input type='number' name='taka' class='form-control' required>
                            <button type='submit' name='cashIn' class='btn btn-primary btn-bloc btn-sm my-1'>Tranfer</button>
                        </form>
                    </div>


            <?php

                } else {
                    echo "<div class='w-75  mx-auto alert alert-info text-center'>No Account Found</div>";
                }
            }


            ?>
            <br>

        </div>
        <div class="card-footer text-muted">

        </div>
    </div>


    </body>

    </html>