<?php include './admin-header.php';
include('../functions/authenticate.php');
isLoggedIn();
isAdmin();
include('../functions/db.php');
$conn = openDatabaseConnection();
include('../functions/orders.php');
include('../functions/users.php');
include('../functions/plates-functions.php');

?>

<main class="row">
    <div class="col-md-3">
        <?php include './sidebar.php'; ?>
    </div>
    <div class="col-md-9">
        <div class="container">

            <h1 class="fw-bold display-4 mt-4 text-dark">Dashboard</h1>
            <div class="d-flex gap-4  pt-5">

                <a href="./orders.php">
                <div class="dashboard-card bg-info ">
                    <span class="display-5 fw-bolder ">
                        <?php echo getUnhandeledOrdersCount($conn); ?>
                    </span>
                    <span class="fs-6 fw-light text-center ">
                        Unhendeled Order
                    </span>
                </div>
                </a>

                <a href="./menu.php">
                    <div class="dashboard-card bg-danger ">
                        <span class="display-5 fw-bolder ">
                            <?php echo getPlatesCount($conn); ?>
                        </span>
                        <span class="fs-6 fw-light text-center ">
                            Meal in the menu
                        </span>
                    </div>
                </a>

                <a href="./users.php">
                <div class="dashboard-card bg-warning ">
                    <span class="display-5 fw-bolder ">
                        <?php echo getUsersCount($conn); ?>
                    </span>
                    <span class="fs-6 fw-light text-center ">
                        registered users
                    </span>
                </div>
                </a>
            </div>
        </div>
    </div>

</main>
<?php include './admin-footer.php'; ?>