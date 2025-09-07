<?php
require_once 'db_connect.php';

// Function to sanitize user input
function clean_input($data){
    return htmlspecialchars(stripslashes(trim($data)));
}

// Variables for user inputs and corresponding errors
$username = $password = "";
$username_err = $password_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Check if username/email is provided and sanitize
    if(empty(trim($_POST["email"]))){
        $username_err = "Bitte Benutzernamen angeben";
    } else {
        $username = clean_input($_POST["email"]);
    }

    // Check if password is provided and sanitize
    if(empty(trim($_POST["password"]))){
        $password_err = "Bitte Passwort eingeben";
    } else {
        $password = clean_input($_POST["password"]);
    }

    // Error checking
    if(empty($username_err) && empty($password_err)){
        // SQL query to check user
        $sql = "SELECT id, username, password FROM users WHERE username = ?";
        
        if($stmt = $conn->prepare($sql)){
            $stmt->bind_param("s", $username); 

            if($stmt->execute()){
                $stmt->store_result(); 

                // Check if user exists
                if($stmt->num_rows == 1) {
                    $stmt->bind_result($id, $username, $hashed_password);
                    if($stmt->fetch()){
                        if(password_verify($password, $hashed_password)){
                            // Password correct, start session
                            session_start();
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id; 
                            $_SESSION["username"] = $username;

                            // Redirect to dashboard
                            header("location: dashboard.php");
                            exit(); // Ensure no further code is executed after redirection
                        } else {
                            $password_err = "Das Passwort ist nicht korrekt";
                        }
                    }
                } else {
                    $username_err = "Kein Konto mit diesem Benutzernamen gefunden";
                }
            } else {
                echo "Es gab ein Problem, bitte später noch einmal versuchen";
            }
            $stmt->close(); 
        }
    }
    $conn->close(); 
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <style>
        .error { color: red; }
    </style>
</head>
<body>
    <h1>Login</h1>
    <form id="loginForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo $username; ?>" required>
        <span class="error"><?php echo $username_err; ?></span>
        <br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <span class="error"><?php echo $password_err; ?></span>
        <br>
        <button type="submit">Login</button>
    </form>
    <div id="message"></div>
    <script src="assets/js/auth.js"></script>
</body>
</html>
