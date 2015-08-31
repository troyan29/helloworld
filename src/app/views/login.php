<!DOCTYPE html>
<html>
<head>
	<title><?=$title?></title>
	<link rel="stylesheet" type="text/css" href="<?=$baseUrl?>assets/css/main.css" />
</head>
<body>
<h4><?=$title?></h4>
<form action="" method="POST" >
	<input type="text" placeholder="Inserisci username" name="username" />
	<input type="password" placeholder="Inserisci password" name="password" />
	<input type="submit" name="submit" value="Login" />
</form>
<?php if (isset($_SESSION['login_error'])) {
    echo $_SESSION['login_error'];
} ?>
</body>
</html>
