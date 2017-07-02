<DOCTYPE html>
<!DOCTYPE html>
<html>
<head>
	<title>MVC</title>
</head>
<body>
	<header>
		<a href='/php_mvc_blog'>Home</a>
		<a href="?controller=posts&action=index">Posts</a>>
	</header>

	<?php echo($controller . ' ' . $action); ?>
	<?php require_once('routes.php'); ?>

	<footer>
		Copyright
	</footer>
</body>
</html>