<?php
//allow_url_include changed from 'Off' to 'On' :)
//in /Applications/XAMPP/etc/php.ini

if(!empty($_GET['page'])){
	include $_GET['page'].'.php';
}
?>

<ul>
	<li><a href="?page=page1">Page1</a></li>
	<li><a href="?page=page2">Page2</a></li>
</ul>