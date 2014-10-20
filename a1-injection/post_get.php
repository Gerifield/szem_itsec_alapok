<?php

if(empty($_GET['id'])){
	die('Missing id!');
}

$db = new mysqli('127.0.0.1', 'root', '', 'szem_db');

if($db->connect_errno > 0){
    die('Unable to connect to database [' . $db->connect_error . ']');
}

$sql = "SELECT * FROM post INNER JOIN user ON user.id = post.user_id WHERE post.id = '".$_GET['id']."'";

if(!$result = $db->query($sql)){
    die('There was an error running the query [' . $db->error . ']');
}

$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Post page</title>
	<meta charset="utf-8">
</head>
<body>

<h1><?php echo $row['title']; ?></h1>

<p><?php echo $row['body']; ?></p>
<small><?php echo $row['creation_date']; ?> - <?php echo $row['name']; ?></small>

<br /><br />
<a href="javascript:history.back()">Vissza</a>
</body>
</html>