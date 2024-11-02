import Database from './common/database.mjs';

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

function displayError(code) {
    // TEMPORARIO: exibir resposta ao span
    document.querySelector('.title span').innerHTML = code;
}

function load() {
    const form = document.querySelector('form');
    form.addEventListener('submit', async (event) => {
        event.preventDefault();

        if (!formValidate(form)) {
            return;
        }

        const loginResponse = await requestLogin(form);

        if (loginResponse.status === 'success') {
            location.href = './home.php';
        } else {
            displayError(loginResponse.content);
        }
    });
}

load();

/* 
On form submit:
preventDefault
Validate
RequestLogin
If successful then redirect
else display error
*/

/**
 * @typedef {import('./common/cadastro.mjs').EndpointResponse} EndpointResponse
 */
