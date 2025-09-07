const cButton = document.getElementById("createForm");


function createEvent(){
    date = document.getElementById("date").value; 

    description = document.getElementById("description").value; 
    // umschreiben und was bedeutet URLSearchParams
    const data = new URLSearchParams();
    data.append('date', date);
    data.append('description', description);
    fetch('../includes-SRC/functions.php', {
        method: 'POST',
        body: data,
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        }
    })
    .then(response => response.json())
    .then(data => {
        console.log('Result:', data.result);
    })
    .catch(error => console.error('Error:', error));
};


