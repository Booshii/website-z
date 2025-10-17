const navigationItem = document.getElementById('menu-btn');
const menuModalElement = document.getElementById('menu-modal-element')
const menuCloseButton = document.getElementById('menu-close-button');

menuCloseButton.addEventListener('click', closeMenuModal);
navigationItem.addEventListener('click', openMenuModal)

// menuModalElement.addEventListener('close', () => {
//     document.body.classList.remove('modal-open');
// });

function openMenuModal(){
    menuModalElement.showModal();
}
function closeMenuModal() {
    menuModalElement.close();
}


