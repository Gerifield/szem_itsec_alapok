<?php
session_start();

$pdo = new PDO('mysql:host=127.0.0.1;dbname=szem_db', 'root', '');
?>

<!DOCTYPE html>
<html>
<head>
	<title>A3 - XSS</title>
	<meta charset="utf-8">
</head>
<body>


<?php
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){

	//Actions
	if(isset($_GET['a'])){
		switch ($_GET['a']) {
			case 'logout':
				session_destroy();
				header('location: index.php');
				break;
			
			case 'post':
				if(!empty($_POST['title']) && !empty($_POST['body'])){
					$stmt = $pdo->prepare("INSERT INTO post (user_id, title, body) VALUES (?, ?, ?)");
					$stmt->execute(array($_SESSION['user_id'], $_POST['title'], $_POST['body']));
					header('location: index.php');
				}else{
					$errorMsg = "Hiányzó paraméter!";
				}
				break;
		}
	}
?>

<a href="?a=logout">Kilépés</a>

<?php if(isset($errorMsg)): ?>
	<br /><font color="red"><b><?php echo $errorMsg; ?></b></font><br /><br />
<?php endif; ?>

<table>
<form method="post" action="?a=post">
	<tr><td>Cím</td> <td><input type="text" name="title"></td></tr>
	<tr><td>Tartalom</td><td><textarea name="body" rows="5" cols="40"></textarea></td></tr>
	<tr><td colspan="2"><input type="submit" value="Küldés"></td></tr>
</form>
</table>
<br />

<?php
	$stmt = $pdo->prepare("SELECT post.*, user.name FROM post INNER JOIN user ON user.id = post.user_id ORDER BY post.id DESC");
	$stmt->execute();
	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>

<hr />
Cím: <a href="http://127.0.0.1/szem/a1-injection/post_get.php?id=<?php echo $row['id']; ?>"><?php echo $row['title']; ?></a><br />
Tartalom: <?php echo $row['body']; ?><br />
Tulaj: <?php echo $row['name']; ?><br />
<?php endwhile; ?>


<?php
}else{

if(isset($_POST['user'])){
	//echo "Params:<pre>";
	//print_r($_POST);
	//echo "</pre>";

	
	$stmt = $pdo->prepare("SELECT * FROM user WHERE name = ? AND password = ?");
	$stmt->bindParam(1, $_POST['user'], PDO::PARAM_STR);
	$stmt->bindParam(2, md5($_POST['password']), PDO::PARAM_STR);
	//$stmt->execute(array($_POST['user'], md5($_POST['password'])));
	$stmt->execute();

	if($stmt->rowCount() > 0){
		$userData = $stmt->fetch(PDO::FETCH_ASSOC);
		//echo "<font color='green'>OK!</font>";
		//echo "<pre>";
		//print_r($userData);
		//echo "</pre>";
		$_SESSION['loggedin'] = true;
		$_SESSION['user'] = $userData['name'];
		$_SESSION['user_id'] = $userData['id'];
		header('location: index.php');
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