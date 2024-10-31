/**
 * Uses the fetch API to send a post request to the specified url
 * @param {string} url Url for request
 * @param {FormData} formdata FormData to submit to the server
 * @returns {object} JSON response from the server
 */
async function postFormData(url, formdata) {
    let responseObject;
    try {
        const response = await fetch(url, {
            method: 'POST',
            body: formdata,
        });
        const text = await response.text();
        try {
            responseObject = JSON.parse(text);
        } catch (error) {
            responseObject = {
                success: false,
                content: '[Invalid JSON] - ' + text,
            };
        }
    } catch (error) {
        responseObject = {
            success: false,
            content: `Network error: ${error}`,
        };
    }

    return responseObject;
}

function displaySubmitResult(form, success) {
    const message_success = 'Cadastro concluido com sucesso!';
    const message_fail = 'Ocorreu um erro! tente novamente mais tarde';
    const message_timeout = 30000;
    const resultSpan = document.querySelector('.submit-result');

    if (success) {
        resultSpan.innerHTML = message_success;
        form.reset();
    } else {
        resultSpan.innerHTML = message_fail;
        resultSpan.classList.add('submit-result--error');
        console.error(response?.content);
    }
    setTimeout(() => {
        resultSpan.classList.remove('submit-result--error');
        resultSpan.innerHTML = '';
    }, message_timeout);
}

/**
 * Envia os dados do form para o endpoint especificado
 * @param {HTMLFormElement} form Formulário que terá o envio
 * @param {string} endpointName Nome do endpoint que receberá os dados (e.g. fornecedor.php)
 * @returns
 */
async function cadastroFormSubmit(form, endpointName) {
    const button = form.querySelector('button');
    let response;

    button.disabled = true;
    response = await postFormData(
        `../database/insert/${endpointName}`,
        new FormData(form)
    );
    button.disabled = false;
    displaySubmitResult(form, response.success);

    return response;
}
