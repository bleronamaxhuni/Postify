import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

const openModalButtons = document.querySelectorAll('.open-modal')
const closeModalButtons = document.querySelectorAll('.close-modal')
const modalContainers = document.querySelectorAll('.modal-container')

openModalButtons.forEach((button, index) => {
    button.addEventListener('click', () => {
        modalContainers[index].classList.remove('hidden')
    })
})

closeModalButtons.forEach((button, index) => {
    button.addEventListener('click', () => {
        modalContainers[index].classList.add('hidden')
    })
})
