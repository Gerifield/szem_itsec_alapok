<?php

if(isset($_POST['user'])){
	echo "Params:<pre>";
	print_r($_POST);
	echo "</pre>";

	
	$pdo = new PDO('mysql:host=127.0.0.1;dbname=szem_db', 'root', '');
	$stmt = $pdo->prepare("SELECT * FROM user WHERE name = ? AND password = ?");
	$stmt->bindParam(1, $_POST['user'], PDO::PARAM_STR);
	$stmt->bindParam(2, md5($_POST['password']), PDO::PARAM_STR);
	//$stmt->execute(array($_POST['user'], md5($_POST['password'])));
	$stmt->execute();

	if($stmt->rowCount() > 0){
		echo "<font color='green'>OK!</font>";
		echo "<pre>";
		print_r($stmt->fetch(PDO::FETCH_ASSOC));
		echo "</pre>";
	}else{
		echo "<font color='red'>Error!</font>";
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>A3 - XSS</title>
	<meta charset="utf-8">
</head>
<body>

<table>
<form method="post" action="">
<tr><td>Felhasználó:</td> <td><input type="text" name="user" /></td></tr>
<tr><td>Jelszó:</td> <td><input type="password" name="password" /></td></tr>
<tr><td colspan="2"><input type="submit" value="Belépés" /></td></tr>
</form>
</table>

</body>
</html>