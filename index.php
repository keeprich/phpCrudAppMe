<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>

<div class="container">
   <h1>PHP CRUD App</h1>

<?php require_once 'process.php'; ?>


<!-- setting msgs -->
<?php if (isset($_SESSION['message'])): ?>

<div class="alert alert-<?=$_SESSION['msg_type']?>">

<?php
    echo $_SESSION['message'];
    unset($_SESSION['message']);

?>

</div>
<?php endif ?>
<!-- getting data fron the database -->

<?php
$mysqli = new mysqli('127.0.0.1', 'keeprich', 'keeprich', 'phpCrudApp') or die(mysqli_error($mysqli));

$result = $mysqli->query("SELECT * FROM data") or die($mysqli->error);

// pre_r($result->fetch_assoc());
// pre_r($result->fetch_assoc());
?>


<table>
<thead>
<tr>
<th>Nmae</th>
<th>Location</th>
<th>Action</th>
</tr>
</thead>

<?php while($row = $result->fetch_assoc()): ?>

<tr>
<td><?php echo $row['name']; ?></td>
<td><?php echo $row['location']; ?></td>
<td>
<a class="btn btn-primary" href="index.php?edit=<?php echo $row['id']; ?>">Edit</a>
<a class="btn btn-danger" href="process.php?delete=<?php echo $row['id']; ?>">Delete</a>

</td>
</tr>
<?php endwhile; ?>
</table>


<?php
function pre_r($array) {
    echo '<pre>';
    print_r($array);
    echo '</pre>';

}

?>

<form action="process.php" method="POST">
<input type="hidden" name="id" value="<?php echo $id; ?>" >
<div class="form-group"> 
<label for="">Name</label>
<input class="form-control" type="text" name="name" value="<?php echo $name ?>" placeholder="Enter your name" id="">
</div>

<div class="form-group">
<label for="">Location</label>
<input class="form-control" type="text" name="location" value="<?php echo $location ?>" placeholder="Enter your location" id="">
</div>
<div class="form-group">

<?php
if ($update == true):
?>

    <button class="btn btn-info" type="submit" name="update">Update</button>

<?php else: ?>

    <button class="btn btn-primary" type="submit" name="save">Save</button>
<?php endif; ?>

</div>
</form>

</div>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</body>
</html>