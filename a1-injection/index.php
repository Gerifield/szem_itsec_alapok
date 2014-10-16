<?php

if(isset($_POST['user'])){
	var_dump($_POST);

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