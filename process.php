<?php

// adding session
session_start();
// connection to database

$mysqli = new mysqli('127.0.0.1', 'keeprich', 'keeprich', 'phpCrudApp') or die(mysqli_error($mysqli));

$id = 0;
$update = false;
$name = '';
$location = '';


if (isset($_POST['save'])){
$name = $_POST['name'];
$location = $_POST['location'];

$mysqli->query("INSERT INTO data(name, location) VALUES('$name', '$location')") or
    die($mysqli->error);

    $_SESSION['message'] = "Record has been saved";
    $_SESSION['msg_type'] = "success";

    header("location: index.php");

}

// deleting entries
if (isset($_GET['delete'])){
    $id = $_GET['delete'];
    $mysqli->query("DELETE FROM data WHERE id=$id") or die($mysqli->error());


    $_SESSION['message'] = "Record has been Deleted";
    $_SESSION['msg_type'] = "danger";


    // page redirect
    header("location: index.php");
}


// updating records

if(isset($_GET['edit'])){
    $id = $_GET['edit'];
    $update = true;
    $result = $mysqli->query("SELECT * FROM data WHERE id=$id") or die($mysqli->error());
    if (count(['$result']) == 1){
        $row = $result->fetch_array();
        $name = $row['name'];
        $location = $row['location'];
    }
}


// updating records

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $location = $_POST['location'];

    $mysqli->query("UPDATE data SET name='$name', location='$location' WHERE id=$id") or die($mysqli->error);

    $_SESSION['message'] = "Record has been Updated";
    $_SESSION['msg_type'] = "warning";


    // page redirect
    header("location: index.php");
}

?>