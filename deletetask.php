<?php
require_once "config.php";

$id = $_GET['id'];

//deleting the row from table
// $sql = mysqli_query($mysqli, 'DELETE FROM tasks WHERE id = ?');
$SQL = $mysqli->prepare("DELETE FROM tasks WHERE id =?");
$SQL->bind_param('s', $id);
$SQL->execute();
//redirecting to the display page (index.php in our case)
header("Location:index.php");

$mysqli->close();

?>