const navigationItem = document.getElementById('menu-btn');
const menuModalElement = document.getElementById('menu-modal-element')
const menuCloseButton = document.getElementById('menu-close-button');
const linkToContact = document.getElementById('link-to-contact');

menuCloseButton.addEventListener('click', closeMenuModal);
navigationItem.addEventListener('click', openMenuModal);
linkToContact.addEventListener('click', (event) => {
	event.preventDefault();
	closeMenuModal();
	const target = document.querySelector(linkToContact.getAttribute('href'));
	if (target) {
		target.scrollIntoView({behavior: 'smooth'});
	}
});

// menuModalElement.addEventListener('close', () => {
//     document.body.classList.remove('modal-open');
// });

function openMenuModal(){
  menuModalElement.showModal();
}
function closeMenuModal() {
  menuModalElement.close();
}


