const galleryItems = document.querySelectorAll('.gallery-item');
const modalElement = document.getElementById('modal-element')
const modalImage = document.getElementById('modal-image');

const closeButton = document.getElementById('close-button');
const prevButton = document.getElementById('prev-button');
const nextButton = document.getElementById('next-button');
let currentIndex;



/***********************************/
/************ Kalender *************/
/***********************************/
const calendarBody = document.getElementById('calendar-body'); 
const currentDate = new Date(); 
const month = currentDate.getMonth(); 
const year = currentDate.getFullYear(); 

//Funktion um die Anzahl der Tage des Monats zu erhalten 
function monthInDays(events) {
    // jahr , Monat mit Januar = 0 , Tage mit 0 gleich letzter Tag vom Monat davor 
    return new Date(year, month + 1, 0).getDate(); 
}
function firstDayOfMonth(month, year){
    return new Date(year, month, 1).getDay(); 
}

// beim Aufruf der Seite Kalender richtg laden 
function loadCalendar(current_date){
   
    // vom Datum die Anzahl der Tage des Monats
    const days = monthInDays(month, year); 
    // von dem Datum den ersten Tag des Monats
    const firstDay= firstDayOfMonth(month, year);
    

    // elemente einfügen mit for-Schleife
    let date = 1; 

    for (let i = 0; i < 6; i++){
        const row = document.createElement('tr');
        for (let j = 0; i < 7; i++){
            const cell = document.createElement('td');
            // Tage vor dem ersten im Monat
            if( i === 0 && j < firstDay){
                cell.innerHTML = ''; 
            } else if (date > days){
                break; 
            } else{


                const dateStr = `${year}-${String(month + 1).padStart(2, '0')}-${String(date).padStart(2, '0')}`;
                cell.innerHTML = `<strong>${date}</strong>`;
                
                events.forEach(event => {
                    if (event.date === dateStr){
                        const eventElement = document.createElement('span'); 
                        eventElement.className = 'event'; 
                        eventElement.textContent = event.description; 
                        cell.appendChild(eventElement); 
                    }
                });
                date++;
            }
            row.appendChild(cell);
        }
        calendarBody.appendChild(row);
    }
    
    // Abrufen der Events aus der Datenbank 
    fetch 
 
    

}

/***********************************/
/********** Modal Fenster **********/
/***********************************/

// open modal function
function openModal(index){
    currentIndex = index; 
    loadImage(galleryItems[currentIndex].dataset.full);
    modalElement.showModal();
    document.body.classList.add('modal-open'); // deactivate scrollilng on page
}
// load clicked image in image modal
// an extra image is created to ensure that the image is fully loaded 
function loadImage(src){
    const img = new Image(); 
    img.onload = () => {
        modalImage.src = src; 
    }
    img.src = src;
}

function closeModal() {
    modalElement.close();
}
function showNextImage(){
    currentIndex = (currentIndex < galleryItems.length - 1) ? currentIndex + 1 : 0; 
    loadImage(galleryItems[currentIndex].dataset.full);
}
function showPrevImage(){
    currentIndex = (currentIndex > 0) ? currentIndex - 1 : galleryItems.length - 1;
    loadImage(galleryItems[currentIndex].dataset.full);
}

// Event listeners 
galleryItems.forEach((item, index) => {
    item.addEventListener('click', () => openModal(index)); 
});
closeButton.addEventListener('click', closeModal);
prevButton.addEventListener('click', showPrevImage);
nextButton.addEventListener('click', showNextImage);

modalElement.addEventListener('close', () => {
    document.body.classList.remove('modal-open');
});
// Keyboard navigation with debouncing


