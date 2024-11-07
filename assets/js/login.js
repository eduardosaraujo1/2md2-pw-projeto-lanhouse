import Database from './common/database.js';

function disableSubmitButton(button) {
    return button.setAttribute('disabled', 'true');
}

function enableSubmitButton(button) {
    return button.removeAttribute('disabled');
}

/**
 *
 * @param {HTMLFormElement} form
 * @returns {Promise<EndpointResponse>}
 */
function requestLogin(form) {
    const formdata = new FormData(form);
    const endpoint = form.action;

    // If endpoint is missing, throw exception
    if (!form.getAttribute('action')) {
        throw new Error('Missing form action attribute');
    }

    // Return login result
    return Database.sendPost(endpoint, formdata);
}

function formValidate(form) {
    return form.reportValidity();
}

let timeout;
function displayError(code) {
    // Exibir mensagem
    let message = '';

    switch (code) {
        case 'USER_NOT_FOUND':
            message = 'Usuário não cadastrado.';
            break;
        case 'INCORRECT_PASSWORD':
            message = 'Senha incorreta.';
            break;
        default:
            console.error('Login Error: ' + code);
            message = 'Ocorreu um erro inesperado. Tente novamente mais tarde.';
            break;
    }

    const result = document.querySelector('.login__result');
    result.innerHTML = message;

    // Limpar depois de alguns segundos
    clearTimeout(timeout);
    timeout = setTimeout(() => {
        result.innerHTML = '';
    }, 30000);
}

function load() {
    const form = document.querySelector('form');
    const submitButton = form.querySelector('#btn-login');
    form.addEventListener('submit', async (event) => {
        event.preventDefault();

        if (!formValidate(form)) {
            return;
        }

        // Desativar botão submit para evitar spam
        disableSubmitButton(submitButton);

        // Attempt login
        const loginResponse = await requestLogin(form);

        // If successful then redirect else display error
        if (loginResponse.status === 'success') {
            location.href = './home.php';
        } else {
            displayError(loginResponse.content);
        }

        // Habilitar botão para submit
        enableSubmitButton(submitButton);
    });
}

load();

/* 
On form submit:
preventDefault
Validate
RequestLogin
*/

/**
 * @typedef {import('./common/cadastro.js').EndpointResponse} EndpointResponse
 */
