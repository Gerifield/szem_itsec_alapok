<?php

if(isset($_POST['user'])){
	echo "Params:<pre>";
	print_r($_POST);
	echo "</pre>";

	
	mysql_connect("127.0.0.1", "root", "");
	mysql_select_db("szem_db");
	$res = mysql_query("SELECT * FROM user WHERE name = '".$_POST['user']."' AND password = '".md5($_POST['password'])."'");

	if(mysql_num_rows($res) > 0){
		echo "<font color='green'>OK!</font>";
		echo "<pre>";
		print_r(mysql_fetch_array($res, MYSQL_ASSOC));
		echo "</pre>";
	}else{
		echo "<font color='red'>Error!</font>";
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>A1 - Injection</title>
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