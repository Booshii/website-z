<?php
/** 
 * required variables
 * @var array<string> $errors  
 * @var string $csrfToken
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
		<form id="login-form" action="/login" method="POST">
			<label for="email">Email</label>
			<input 
				type="email" 
				id="email" 
				name="email" 
				placeholder="Email" 
				required 
				value="<?= htmlspecialchars($oldEmail ?? '', ENT_QUOTES, 'UTF-8')?>"
			>

			<label for="password">Password:</label>
			<input type="password" id="password" name="password" placeholder="Password" required>

			<input type="hidden" name="csrf_token"
				value="<?= htmlspecialchars($csrfToken, ENT_QUOTES, 'UTF-8') ?>" 	
			>
			<button type="submit" name="submit_button" value="user_login">Login</button>
		</form>

		<?php if (!empty($errors)): ?>
			<h1>Fehler</h1>
			<ul class="error-list">
				<?php foreach ($errors as $error): ?>
						<li><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></li>
				<?php endforeach; ?>
			</ul>
		<?php endif; ?>
  </div>

</body>
</html>