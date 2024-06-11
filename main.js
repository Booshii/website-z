const galleryItems = document.querySelectorAll('.gallery-item');
const modalElement = document.getElementById('modal-element')
const modalImage = document.getElementById('modal-image');

const closeButton = document.getElementById('close-button');
const prevButton = document.getElementById('prev-button');
const nextButton = document.getElementById('next-button');
let currentIndex;

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
