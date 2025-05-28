<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include './admin-header.php';
include('../functions/authenticate.php');
isLoggedIn();

isAdmin();
include('../functions/db.php');
$conn = openDatabaseConnection();
include('../functions/orders.php');

$orders = getOrders($conn);  


?>

<main class="row dashboard">
    <div class="col-md-3">
        <?php include './sidebar.php'; ?>
    </div>
    <div class="col-md-9">
        <div class="container">

            <h1 class="fw-bold display-4 mt-4 text-dark">Orders</h1>
            <div class="mt-5 dashboard-table-container">
                <table class=" table table-striped table-hover">
                    <thead>
                        <tr class="text-nowrap">
                            <th>Order ID 
                                <i  class="sort-icon" data-lucide="arrow-up-down"></i>
                            </th>
                            <th>User ID
                            <i  class="sort-icon" data-lucide="arrow-up-down"></i>

                            </th>
                            <th>Products
                            <i  class="sort-icon" data-lucide="arrow-up-down"></i>

                            </th>
                            <th>Total
                            <i  class="sort-icon" data-lucide="arrow-up-down"></i>

                            </th>
                            <th>User Name
                            <i  class="sort-icon" data-lucide="arrow-up-down"></i>

                            </th>
                            <th>Address
                            <i  class="sort-icon" data-lucide="arrow-up-down"></i>

                            </th>
    
                            <!-- <th>Created At</th> -->
                            <th>Is Complete</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <?php foreach ($orders as $order): ?>
                        <tr class="cursor-pointer" id="order-<?php echo $order['order_id']?>">
                            <td><?php echo $order['order_id']; ?></td>
                            <td><?php echo $order['user_id']; ?></td>
                            <td><?php echo formatProducts($order['products']); ?></td>
                            <td><?php echo $order['total']; ?></td>
                            <td><?php echo $order['name']?? 'Guest'; ?></td>
                            <td><?php echo $order['address']??"N/A" ?></td>
                            <!-- <td><?php echo $order['created_at']; ?></td> -->
                            <td class="complete-status-<?php echo $order['order_id']; ?>"><?php echo $order['is_complete'] ? 'Yes' : 'No'; ?></td>
                            <td>
                                <button title="Delete" class='btn btn-danger delete-js' data-id='<?php echo $order['order_id']?>' data-page='order'>
                                    <i data-lucide="x"></i>
                                </button>

                                <button title="Complete" class='btn btn-success completed-js' data-id='<?php echo $order['order_id']?>' data-page='order'>
                                    <i data-lucide="check"></i>
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
    </div>
</main>
<?php include './admin-footer.php'; ?>
