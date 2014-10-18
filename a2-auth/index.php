<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>A2 - Broken auth</title>
	<meta charset="utf-8">
</head>
<body>

<?php

if(isset($_GET['a']) && $_GET['a'] == "logout"){
	session_destroy();
	echo "Session destroyed!<br /><br />";
}

if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
?>

<b>Belépve!</b><br />
<a href="?a=logout">Kilépés</a><br />
<br />

<?php

if(isset($_COOKIE['rank']) && $_COOKIE['rank'] == "admin"){
	echo "Na ez itt az admin felület elérése, mostantól mindenhez hozzáférsz!<br />";
}


}else{

if(isset($_POST['user'])){
	echo "Params:<pre>";
	print_r($_POST);
	echo "</pre>";

	
	$pdo = new PDO('mysql:host=127.0.0.1;dbname=szem_db', 'root', '');
	$stmt = $pdo->prepare("SELECT * FROM user WHERE name = ? AND password = ?");
	$stmt->bindParam(1, $_POST['user'], PDO::PARAM_STR);
	$stmt->bindParam(2, md5($_POST['password']), PDO::PARAM_STR);
	$stmt->execute();

	if($stmt->rowCount() > 0){
		$userdata = $stmt->fetch(PDO::FETCH_ASSOC);

		echo "<font color='green'>OK!</font>";
		echo "<pre>";
		print_r($userdata);
		echo "</pre>";
		$_SESSION['loggedin'] = true;
		$_SESSION['user'] = $userdata['name'];
		setcookie("rank", "user", time()+3600);  
	}else{
		echo "<font color='red'>Error!</font>";
	}
}
?>
<table>
<form method="post" action="">
<tr><td>Felhasználó:</td> <td><input type="text" name="user" /></td></tr>
<tr><td>Jelszó:</td> <td><input type="password" name="password" /></td></tr>
<tr><td colspan="2"><input type="submit" value="Belépés" /></td></tr>
</form>
</table>

<?php
}
?>

</body>
</html>