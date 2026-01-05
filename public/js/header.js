const menuModalButton = document.getElementById('menu-btn');
const menuModalElement = document.getElementById('menu-modal-element')
const linkToContact = document.getElementById('link-to-contact');

menuModalButton.addEventListener('click', openMenuModal);
linkToContact.addEventListener('click', (event) => {
	event.preventDefault();
	closeMenuModal();
	const target = document.querySelector(linkToContact.getAttribute('href'));
	if (target) {
		target.scrollIntoView({behavior: 'smooth'});
	}
});

function openMenuModal(event){
	event.stopPropagation();

	if (menuModalElement.open) {
		closeMenuModal()
	}

  menuModalElement.show();
	document.addEventListener('click', clickOutsideToClose)
}
function closeMenuModal() {
  menuModalElement.close();
	document.removeEventListener('click', clickOutsideToClose);
}

function clickOutsideToClose(event) {
	const clickInsideDialog = menuModalElement.contains(event.target);
	const clickMenuButton = menuModalButton.contains(event.rarget);

	if (!clickInsideDialog && !clickMenuButton) {
		closeMenuModal();
	}

}


