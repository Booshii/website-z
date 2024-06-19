document.getElementById("loginForm").addEventListener("submit", authentification(event)); 

function authentification(event){
    event.preventDefault(); 
    const email = document.getElementById("email").value;
    const password = document.getElementById("password").value; 
    
    fetch('api/login.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ email: email, password: password})
    })
    .then(response => response.json())
    .then(data => {
        const message = document.getElementById("message");
        if (data.status === 'success') {
            message.innerText = 'Login erfolgreich! Weiterleitung...';
            window.location.href = 'dashboard.php'; // Weiterleitung nach erfolgreichem Login
        } else {
            message.innerText = 'Login fehlgeschlagen! Bitte überprüfen Sie Ihre Anmeldedaten.';
        }
    })
    .catch(error => {
        console.error('Error:', error);
        document.getElementById("message").innerText = 'Ein Fehler ist aufgetreten. Bitte versuchen Sie es später erneut.';
    });
};


// für test