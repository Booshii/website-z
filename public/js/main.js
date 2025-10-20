const galleryItems = document.querySelectorAll('.gallery-item');
const showMoreButton = document.getElementById('show-more-button');
const modalElement = document.getElementById('modal-element');
const modalImage = document.getElementById('modal-image');

const closeButton = document.getElementById('close-button');
const prevButton = document.getElementById('prev-button');
const nextButton = document.getElementById('next-button');

const modalCounter = document.getElementById('counter');
let currentIndex;
const total = galleryItems.length;

/***********************************/
/********** Modal Fenster **********/
/***********************************/

// open modal function
function openModal(index){
    currentIndex = index; 
    loadImage(currentIndex);
    modalElement.showModal();
}
// load clicked image in image modal
// an extra image is created to ensure that the image is fully loaded 

function loadImage(id){

    const srcFullImage = galleryItems[id].dataset.full || galleryItems[id].src;



    //vorheriges und nachfolgendes soft vorladen 
// const nextIdx = (idx + 1) % thumbs.length;
//     const prevIdx = (idx - 1 + thumbs.length) % thumbs.length;
//     [nextIdx, prevIdx].forEach(n => {
//     const url = thumbs[n].dataset.full || thumbs[n].src;
//     const img = new Image(); img.decoding = 'async'; img.src = url;
//     });

    // lädt das Bild vor -> kein flackern 
    const img = new Image(); 
    img.onload = () => {
        modalImage.src = srcFullImage; 
        modalImage.alt = galleryItems[id].alt || '';
    }
    img.src = srcFullImage;
    updateCounter();
}

function closeModal() {
    modalElement.close();
}
function showNextImage(){
    currentIndex = (currentIndex < galleryItems.length - 1) ? currentIndex + 1 : 0; 
    loadImage(currentIndex);

}
function showPrevImage(){
    currentIndex = (currentIndex > 0) ? currentIndex - 1 : galleryItems.length - 1;
    loadImage(currentIndex);
}
function updateCounter(){
    modalCounter.textContent = `${currentIndex + 1} / ${total}`;
    modalElement.setAttribute('aria-label', `Bild ${currentIndex + 1} von ${total}`);
    
}

// Event listeners 
galleryItems.forEach((item, index) => {
    item.addEventListener('click', () => openModal(index)); 
});
showMoreButton.addEventListener('click', () => openModal(0));
closeButton.addEventListener('click', closeModal);
prevButton.addEventListener('click', showPrevImage);
nextButton.addEventListener('click', showNextImage);

// glaube das modal-open kann weg
modalElement.addEventListener('close', () => {
    document.body.classList.remove('modal-open');
});
// Keyboard navigation with debouncing


