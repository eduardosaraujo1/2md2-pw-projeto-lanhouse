import Database from './database.js';

/**
 * Handles the form submittion process when submit is called
 * @param {HTMLFormElement} form Form used for submittion
 * @param {function(HTMLFormElement): bool} [validate] Validate the current form state, refuse submittion if returns 'false'
 * @param {function(HTMLFormElement): FormData} [getFormData] Gets the form data for submittion.
 * @returns {FormSender} Object to call form submit event
 */
export function FormSenderFactory(form, validate, getFormData) {
    /**
     * @returns {Promise<EndpointResponse|null>} Result from the form call or null
     */
    async function submit() {
        // validate
        if (!formValidate()) {
            return null;
        }

        // get endpoint and data
        const endpoint = form.action;
        const formdata = readForm();

        // send data to endpoint
        const response = await sendRequest(endpoint, formdata);

        // return response
        return response;
    }

    /**
     * @param {string} endpoint Path to endpoint
     * @param {FormData} data Data to send to endpoint
     * @returns {Promise<EndpointResponse>} Form response
     */
    async function sendRequest(endpoint, data) {
        const result = await Database.sendPost(endpoint, data);

        // exibir resultado no console
        const resultString = JSON.stringify(result);
        const now = new Date().toLocaleString();
        const message = `=== RESULTADO DO ENVIO '${now}' === \n` + `${resultString}`;

        if (result['status'] === 'success') {
            console.info(message);
        } else {
            console.error(message);
        }

        // retornar resultado normalmente
        return result;
    }

    function formValidate() {
        // require 'action' attribute
        if (!form.getAttribute('action')) {
            console.warn("Missing 'action' attribute from form. Submit cannot continue without a specified endpoint.");
            return false;
        }

        // If the custom method is provided, run it, otherwise run a basic validity check
        return validate ? validate(form) : form.reportValidity();
    }

    function readForm() {
        return getFormData ? getFormData(form) : new FormData(form);
    }

    // Return the 'FormSender' object
    return {
        submit,
    };
}

let timeout;
/**
 * @param {HTMLElement} display
 * @param {boolean} success
 */
function displayResult(display, success) {
    const ON_SUCCESS = {
        text: 'Cadastro concluido com sucesso!',
        color: 'var(--color-success)',
        timeout_duration: 7500,
    };
    const ON_ERROR = {
        text: 'Ocorreu um erro, tente novamente mais tarde',
        color: 'var(--color-error)',
        timeout_duration: 30000,
    };

    // Determinar cores a partir do estado de sucesso ou falha
    const state = success ? ON_SUCCESS : ON_ERROR;

    // Exibir resposta no span
    display.innerHTML = state.text;
    display.style.color = state.color;

    // Redefinir timeout anterior
    clearTimeout(timeout);

    // Definir timeout para a mensagem desaparecer
    timeout = setTimeout(() => {
        display.innerHTML = '';
        display.style.color = '';
    }, state.timeout_duration);
}

function disableSubmitButton(button) {
    return button.setAttribute('disabled', 'true');
}

function enableSubmitButton(button) {
    return button.removeAttribute('disabled');
}

export const CadastroUtils = {
    displayResult,
    submitButton: {
        disable: disableSubmitButton,
        enable: enableSubmitButton,
    },
};

/**
 * @typedef {Object} FormSender
 * @property {function(): Promise<EndpointResponse|null>} submit
 */

/**
 * @typedef {Object} EndpointResponse
 * @property {string} status
 * @property {string} content
 */
