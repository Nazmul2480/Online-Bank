<?php

include 'includes/config.php';
include 'includes/bank.php';


$error = "";

if (isset($_POST['LOGINAS'])) {


    //Customer

    if ($_POST['LOGINAS'] == 1) {
        $error = "";
        $phone = escape($_POST['phone']);
        $pass = escape($_POST['password']);

        $result = $con->query("select * from customers where phone='$phone' AND password='$pass'");
        if ($result->num_rows > 0) {

            $data = $result->fetch_assoc();
            $_SESSION['customerID'] = $data['id'];

            header('location:customer/index.php');
        } else {
            $error = "<div class='alert alert-danger text-center rounded-0'>Customer Username or password is wrong!</div>";
        }
    }
    //Manager
    if ($_POST['LOGINAS'] == 2) {
        $error = "";
        $phone = escape($_POST['phone']);
        $pass = escape($_POST['password']);


        $result = $con->query("select * from admin  where phone='$phone' AND password='$pass' AND role='manager'");
        if ($result->num_rows > 0) {
            session_start();
            $data = $result->fetch_assoc();
            $_SESSION['managerUserId'] = $data['id'];

            header('location:manager/index.php');
        } else {
            $error = "<div class='alert alert-danger text-center rounded-0'>Manager Username or password is wrong!</div>";
        }
    }
    //Agent
    if ($_POST['LOGINAS'] == 3) {
        $error = "";
        $phone = escape($_POST['phone']);
        $pass = escape($_POST['password']);


        $result = $con->query("select * from admin  where phone='$phone' AND password='$pass' AND role='agent'");

        if ($result->num_rows > 0) {
            session_start();
            $data = $result->fetch_assoc();
            $_SESSION['agentUserID'] = $data['id'];

            header('location:agent/index.php');
        } else {
            $error = "<div class='alert alert-danger text-center rounded-0'>Agent Username or password is wrong!</div>";
        }
    }
}

?>
<!DOCTYPE html>
<html>

<head>
    <title>Islamic Bank Ltd.</title>
    <?php require 'includes/files.php'; ?>
</head>

<body style="background: url(<?php echo SITEURL; ?>/assets/images/bg.jpg);">



    <nav class="navbar navbar-expand-lg navbar-dark bg-success">


        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">

            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="<?php echo SITEURL; ?>">

            <i class="d-inline-block  fa fa-building fa-fw"></i><?= BANKNAME; ?>
        </a>


        <br><br>

    </nav>

    <br><br><br>




    <div class="container-fluid">
        <div class="row content">
            <div class="col-sm-2">

            </div>
            <div class="col-sm-8">
                <div id="accordion" role="tablist" class="shadowBlack" style="margin-right: 0px">
                    <br>
                    <h4 class="text-center text-white">WELCOME TO OUR BANK</h4>
                    <?php echo $error ?>

                    <div class="card rounded-0">
                        <div class="card-header" role="tab" id="headingOne">
                            <h5 class="mb-0">

                            </h5>
                        </div>

                        <div class="card-body">
                            <form method="POST">
                                <input type="phone" value="01775878369" name="phone" class="form-control" required placeholder="Enter Your Phone Numer">

                                <br> <input type="password" name="password" value="123456" class="form-control" required placeholder="Enter Your Password">
                                <br>
                                <div class="form-check arman-login-radio-pad">
                                    <input class="form-check-input" type="radio" name="LOGINAS" value="1" required>
                                    <label class="form-check-label">
                                        Customer
                                    </label>
                                </div>

                                <div class="form-check arman-login-radio-pad">
                                    <input class="form-check-input" type="radio" name="LOGINAS" value="2" required>
                                    <label class="form-check-label">
                                        Manager
                                    </label>
                                </div>

                                <div class="form-check arman-login-radio-pad">
                                    <input class="form-check-input" type="radio" name="LOGINAS" value="3" required>
                                    <label class="form-check-label">
                                        Agent
                                    </label>
                                </div>


                                <br> <button type="submit" class="btn btn-success btn-block">LOGIN NOW </button>
                            </form>
                        </div>
                    </div>

                </div>
                <div class="col-sm-2 sidenav">

                </div>
            </div>
        </div>


</body>

</html>