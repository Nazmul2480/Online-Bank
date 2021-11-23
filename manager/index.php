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



?>

<br><br><br>
<div class="container">
    <div class="card w-100 text-center ">
        <div class="card-header">
            <h3>All Customers</h3>
        </div>
        <?= $error ?? '' ?>
        <div class="card-body">
            <table class="table table-bordered table-sm">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Customer Name</th>
                        <th scope="col">Account No / Mobile No</th>
                        <th scope="col">Branch Name</th>
                        <th scope="col">Current Balance</th>

                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    // var_dump(getAllCustomerList());
                    foreach (getAllCustomerList() as  $i => $row) {


                    ?>
                        <tr>
                            <th scope="row"><?php echo $i + 1 ?></th>
                            <td><?php echo $row['name'] ?></td>
                            <td><?php echo $row['phone'] ?></td>

                            <td><?php echo $row['branch_name'] ?></td>
                            <td><?php echo $row['taka'] == null ? '00 Taka' : $row['taka'] . ' Taka'  ?></td>

                            <td>
                                <a href="editcustomer.php?id=<?php echo $row['id'] ?>" class='btn btn-success btn-sm' data-toggle='tooltip' title="Edit">Edit</a>

                                <!-- <a href="index.php?deleteCustomer=<?php echo $row['id'] ?>" class='btn btn-danger btn-sm' data-toggle='tooltip' title="Delete this account">Delete</a> -->
                            </td>

                        </tr>
                    <?php
                    }

                    ?>
                </tbody>
            </table>
            <div class="card-footer text-muted">

            </div>
        </div>
        </body>

        </html>