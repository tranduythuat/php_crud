<?php 

require_once "classes/user.php";

$objUser = new User();

if (isset($_GET['delete_id'])) {
    $id = $_GET['delete_id'];

    try {
        if($id != null){
            if ($objUser->delete($id)) {
                $objUser->redirect('index.php?deleted');
            }
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    
}
?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php require_once 'includes/head.php'; ?>
</head>
<body>
    <!-- Header banner -->
    <?php require_once 'includes/header.php'; ?>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar menu -->
            <?php require_once 'includes/sidebar.php'; ?>
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
                <h1 style="margin-top: 10px">DataTable</h1>
                <?php 
                    if (isset($_GET['updated'])) {
                       echo '<div class="alert alert-info alert-dismissable fade show" role="alert">
                                <strong>User!</strong> Updated with success.
                                <button type="button" class="close" data-dismiss="alert" aria-label="close">
                                    <span aria-hidden="true"> &times; </span>
                                </button>   
                            </div>';
                    }else if(isset($_GET['deleted'])){
                        echo    '<div class="alert alert-info alert-dismissable fade show" role="alert">
                                    <strong>User!<trong> Deleted with success.
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true"> &times; </span>
                                    </button>
                                </div>';
                    }elseif(isset($_GET['inserted'])){
                        echo    '<div class="alert alert-info alert-dismissable fade show" role="alert">
                                    <strong>User!<trong> Inserted with success.
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true"> &times; </span>
                                    </button>
                                </div>';
                    }elseif(isset($_GET['error'])){
                        echo    '<div class="alert alert-info alert-dismissable fade show" role="alert">
                                    <strong>DB Error!<trong> Something went wrong with your action. Try again!
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true"> &times; </span>
                                    </button>
                                </div>';
                    }
                ?>
                

                <div class="table-responsive">
                    <table class="table table-striped table-sm">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Full Name</th>
                                <th>Email</th>
                                <th></th>
                            </tr>
                        </thead>
                        <?php 

                            $query = "SELECT id, name, email FROM users";
                            $stmt = $objUser->runQuery($query);
                            $stmt->execute();
    
                        ?>
                        <tbody>
                            <?php if($stmt->rowCount() > 0){
                                while($rowUser = $stmt->fetch(PDO::FETCH_ASSOC)){
                            ?>
                            <tr>
                                <td><?php print($rowUser["id"]); ?></td>

                                <td>
                                    <a href="form.php?edit_id=<?php print($rowUser['id']); ?>" title="Edit">
                                    <?php print($rowUser['name']); ?>
                                    </a>
                                </td>

                                <td><?php print($rowUser['email']); ?></td>

                                <td>
                                    <a class="confirmation" href="index.php?delete_id=<?php print($rowUser['id']); ?>" title="Delete">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php } } ?>
                        </tbody>
                        
                    </table>
                </div>
            </main>
        </div>
    </div>
    <!-- Footer scripts, and functions -->
    <?php require_once 'includes/footer.php'; ?>

    <!-- Custom scripts -->
    <script>
        // JQuery confirmation
        $('.confirmation').on('click', function () {
            return confirm('Are you sure you want do delete this user?');
        });
    </script>
</body>
</html>