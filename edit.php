<?php
include_once 'db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit User - CRUD Example with Bootstrap</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container">
        <h1>Edit User</h1>
        <a href="index.php" class="btn btn-primary">Back to Index</a>
        <hr>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $email = $_POST['email'];
           
$sql = "UPDATE users SET name='$name', email='$email' WHERE id=$id";
if (mysqli_query($conn, $sql)) {
echo "<div class='alert alert-success'>User updated successfully</div>";
} else {
echo "<div class='alert alert-danger'>Error updating user: " . mysqli_error($conn) . "</div>";
}
} else {
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
<form method="post">
<input type="hidden" name="id" value="<?php echo $id; ?>">
<div class="form-group">
<label for="name">Name:</label>
<input type="text" class="form-control" id="name" name="name" value="<?php echo $name; ?>" required>
</div>
<div class="form-group">
<label for="email">Email:</label>
<input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>" required>
</div>
<button type="submit" class="btn btn-primary">Update User</button>
</form>
</div>

</body>
</html>