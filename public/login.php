<?php
    session_start(); 
    
    require_once 'db_connect.php';

    // Benutzereingaben bereinigen 
    function clean_input($data){
        return htmlspecialchars(striplashes(trim($data)));
    }

    // Variablen für Usereingaben und zugehörigen error
    $username = $password = "";
    $username_err = $password_err = "";

    if($_SERVER["REQUEST_METHOD"] == "POST"){

        // prüfen ob Benutzername vorhanden ist und an cleanup Methode übergeben 
        if(empty(trim($_POST["username"]))){
            $username_err = "Bitte Benutzernamen angeben";
        } else {
            $username = clean_input($POST["username"]);
        }

        // Passwort überprüfen ob vorhanden und an cleanup Mehtode übergeben 
        if(empty(trim($_POST["password"]))){
            $password_err = "Bitte Passwort eingeben";
        } else {
            $password = clean_input($_POST["password"]);
        }

        //Fehlerprüfung 
        if(empty($username_err) && empty($password_err)){
            // SQL Abfrage zu ÜBerprüfung des Benutzers 
            $sql = "SELECT id, username, password FROM users WHERE username = ?"
            // prepare bereitet eine sql anweisung vor und liefert ein Anweisungsobjekt 
            if($stmt = $conn -> prepare($sql)){
                
                // Parameter setzen 
                $param_username = $username;
                // bind_param ist eine Methode des mysqli_stmt-Objekts, die verwendet wird um die Parameter
                //an das Prepared Statement zu binden 
                $stmt->bind_param("s", $param_username); 

                // Abfrage ausführen 
                if($stmt->execute()){
                    $stmt->store_result(); 

                    //Benutzer überprüfen 
                    // prüft ob nur ein Benutzer zurückgegeben wurde 
                    if($stmt->num_rows == 1) {
                        // Ergebnisse binden 
                        $stmt->bind_result($id, $username, $hashed_password);

                        if($stmt->fetch()){
                            if(password_verify($password, $hashed_password)){
                                //Password korrekt, Sitzung starten 
                                session_start(); 

                                // Benutzerdaten in Session-Variablen speichern 
                                $_SESSION["loggedin"] = true;
                                $_SESSION["id"] = $id; 
                                $_SESSION["username"] = $username;

                                // Umleitung
                                header("location: dashboard.php");
                            } else {
                                $password_err = "Das Password ist nicht korrekt";
                            }
                        }
                    } else {
                        $username_err = "Kein Konto mit diesem Benutzernamen gefunden";
                    }
                } else {
                    echo "Es gab ein Problem bitte später noch einmal versuchen"
                }

                // Statement schließen 
                $stmt->close(); 
            }
        }
        //Verbindung schließen 
        $conn->close(); 
    }

    // Benutzereingaben escapen 
?> 

<h1>Login</h1>
<form id="loginForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <label for="email">Email</label>
    <input type="email" id="email" name="email" value="<?php echo $username; ?>" required>
    <span><?php echo $username_err; ?></span>
    <br>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required>
    <span><?php echo $password_err; ?></span>
    <br>
    <button type="submit">Login</button>
</form>
<div id="message"></div>
<script src="assets/js/auth.js"></script>