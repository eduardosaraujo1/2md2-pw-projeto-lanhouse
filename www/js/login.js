import { InputUtils } from './common/inpututils.js';
const form = document.querySelector('form');

form.addEventListener('submit', (event) => {
    event.preventDefault();

    const valid = form.reportValidity();
    if (valid) {
        // login data submit here
    }

    // temporario até lógica de login ser implementada
    location.href = './home.php';
});
