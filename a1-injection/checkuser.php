<?php
//sqlmap: sqlmap -u "http://127.0.0.1/szem/a1-injection/checkuser.php?name=1" --flush-session --level=5 --risk=4 --dump-all

$pdo = new PDO('mysql:host=127.0.0.1;dbname=szem_db', 'root', '');
if(isset($_GET['name'])){

	$stmt = $pdo->prepare("SELECT * FROM user WHERE name = '".$_GET['name']."'");
	$stmt->execute();

	if($stmt->rowCount() == 0){
		echo "True";
	}else{
		echo "False";
	}

}else{
	echo "False";
}
?>