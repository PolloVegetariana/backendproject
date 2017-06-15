<!DOCTYPE html>
<html>
<head>
	<title>Twitter backend challenge</title>
</head>
<body>
		<form action="process.php" method="POST">
			<h2>Registration</h2>
			<input type="text" name="name" placeholder="name">
			<input type="email" name="email" placeholder="Email">
			<input type="password" name="password" placeholder="Password">
			<input type="hidden" name="form_source" value="registration">
			<input type="submit" value="Create User">
		</form>

		<form action="process.php" method="POST">
			<h2>Login</h2>
			<input type="text" name="email" placeholder="Email">
			<input type="password" name="password" placeholder="Password">
			<input type="hidden" name="form_source" value="login">
			<input type="submit" value="login">
		</form>
</body>
</html>