import PHP from './database.js';
/**
 * Factory para um subject que chama funções para seremm executadas, em ordem, quando FORM receber o evento 'submit'
 * @param {HTMLFormElement} form Formulário que será escutado quando enviado
 */
function createFormSubmitSubject(form) {
    const observers = [];

    /**
     * @param {Function} callback Função para chamar quando o Subject pedir
     * @returns {observer} Objeto 'observer' com metodo de remover a si mesmo
     */
    function subscribe(callback) {
        observers.push(callback);
        return { remove: () => unsubscribe(callback) };
    }

    function unsubscribe(callback) {
        const index = observers.indexOf(callback);
        if (index !== -1) {
            observers.splice(index, 1);
        }
    }

    function notifyAll(event) {
        for (const cb of observers) {
            cb(event);
        }
    }

    /**
     * @param {SubmitEvent} event
     */
    function formSubmitHandler(event) {
        // Prevent submit
        event.preventDefault();

        // Notifica os observers que houve um submit
        notifyAll(event);
    }

    form.addEventListener('submit', formSubmitHandler);

    return {
        subscribe,
    };
}

/**
 * @param {string} endpointPath
 * @param {FormData} formdata
 */
async function cadastrar(endpointPath, formdata) {
    const result = await PHP.sendDatabaseRequest(endpointPath, formdata);

    // exibir resultado no console
    const resultString = JSON.stringify(result);
    const now = new Date().toLocaleString();
    const message = `=== RESULTADO DO ENVIO ${now} === 
    ${resultString}
    `;
    if (result['status'] === 'success') {
        console.info(message);
    } else {
        console.error(message);
    }

    return result;
}

/**
 * @param {HTMLSpanElement} cadastroResult
 * @param {boolean} success
 */
let timeout;
function displayResponseResult(cadastroResult, success) {
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
    const state = success ? ON_SUCCESS : ON_ERROR;

    // Exibir resposta no span
    cadastroResult.innerHTML = state.text;
    cadastroResult.style.color = state.color;

    // Redefinir timeout anterior
    clearTimeout(timeout);

    // Definir timeout até a mensagem desaparecer
    timeout = setTimeout(() => {
        cadastroResult.innerHTML = '';
        cadastroResult.style.color = '';
    }, state.timeout_duration);
}

function setSubmitButtonState(form, enabled) {
    const submitButton = form.querySelector('button#cadastro__button');
    if (enabled) {
        submitButton.removeAttribute('disabled');
    } else {
        submitButton.setAttribute('disabled', 'true');
    }
}

const CadastroUtils = {
    createFormSubmitSubject,
    cadastrar,
    displayResponseResult,
    setSubmitButtonState,
};

export default CadastroUtils;
