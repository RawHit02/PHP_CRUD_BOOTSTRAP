<?php
include_once 'db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delete User - CRUD Example with Bootstrap</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container">
        <h1>Delete User</h1>
        <a href="index.php" class="btn btn-primary">Back to Index</a>
        <hr>
        <?php
        $name = '';
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $sql = "DELETE FROM users WHERE id=$id";
            if (mysqli_query($conn, $sql)) {
                echo "<div class='alert alert-success'>User deleted successfully</div>";
            } else {
                echo "<div class='alert alert-danger'>Error deleting user: " . mysqli_error($conn) . "</div>";
            }
        } else if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $id = $_GET['id'];
            $sql = "SELECT * FROM users WHERE id=$id";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) == 1) {
                $row = mysqli_fetch_assoc($result);
                $name = $row['name'];
                $email = $row['email'];
            } else {
                echo "<div class='alert alert-danger'>Error retrieving user</div>";
                exit;
            }
        }
        ?>
        <p>Are you sure you want to delete the user "<?php echo $name; ?>"?</p>
        <form method="post">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <button type="submit" class="btn btn-danger">Delete User</button>
        </form>
    </div>
</body>
</html>
