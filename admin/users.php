<?php include './admin-header.php';
include('../functions/authenticate.php');
isLoggedIn();
isAdmin();
include('../functions/db.php');
$conn = openDatabaseConnection();
include('../functions/orders.php');
include('../functions/users.php');
include('../functions/plates-functions.php');

$users = getUsers($conn);
?>

<main class="row dashboard">
    <div class="col-md-3">
        <?php include './sidebar.php'; ?>
    </div>
    <div class="col-md-9">
        <div class="container">

            <h1 class="fw-bold display-4 mt-4 text-dark">Users</h1>
            <div class="mt-5 dashboard-table-container ">
                <table class="table table-striped table-hover ">
                    <tr>
                        <td>Id</td>
                        <td>Name</td>
                        <td>Email</td>
                        <td>is admin</td>

                        <td>action</td>
                    </tr>

                    <?php foreach ($users as $user):?>
                        <tr class="cursor-pointer" id="user-<?php echo $user['id']?>">
                            <td><?php echo $user['id']; ?>
                            <td><?php echo $user['name']; ?>
                            <td><?php echo $user['email']; ?>
                            <td class="<?php echo $user['is_admin']? 'text-success' : 'text-danger'; ?>"><?php echo $user['is_admin']? 'Yes' : 'No'; ?>
                            <td>
                                <!--make admin or not admin -->
                                <a href="./update-user.php?id=<?php echo $user['id']?>" class="btn btn-primary">
                                    <i data-lucide="edit"></i>
                                </a>
                                <button class='btn btn-danger delete-js' data-id='<?php echo $user['id']?>' data-page='user'>
                                <i data-lucide="x"></i>
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