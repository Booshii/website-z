<?php
/** 
 * required variables
 * @var array<string> $errors  
 * */


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>

  <link rel="stylesheet" href="/css/login.css">
</head>
<body>
  <div class="login-container">
		<h1>Login</h1>
<!-- Login-Formular -->
		<form id="login-form" action="/login" method="POST">
			<label for="email">Email</label>
			<input type="email" id="email" name="email" placeholder="Email" required>

			<br>
			<label for="password">Password:</label>
			<input type="password" id="password" name="password" placeholder="Password" required>

			<br>
			<button type="submit" name="submit_button" value="user_login">Login</button>
		</form>

<!-- Anzeige von Fehlermeldungen, falls vorhanden -->
		<?php if (isset($errors) && !empty($errors)): ?>
			<ul class="error-list">
				<h1>Fehler</h1>
					<?php foreach ($errors as $error): ?>
						
							<li><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></li>
							
					<?php endforeach; ?>
			</ul>
		<?php endif; ?>
  </div>

</body>
</html>