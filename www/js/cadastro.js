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

function displaySubmitResult(submitResponse, resultContainer) {
    if (submitResponse.success) {
        resultContainer.innerHTML = 'Cadastro concluido com sucesso!';
    } else {
        resultContainer.innerHTML =
            'Ocorreu um erro! tente novamente mais tarde';
        console.error(submitResponse?.content);
        resultContainer.classList.add('submit-result--error');
    }
    setTimeout(() => {
        resultContainer.classList.remove('submit-result--error');
        resultContainer.innerHTML = '';
    }, 30000);
}

function bootstrapFormSubmit(form, resultSpan, endpointName) {
    const button = form.querySelector('button');
    form.addEventListener('submit', async (event) => {
        event.preventDefault();

        if (!form.reportValidity()) {
            return;
        }

        button.disabled = true;
        const formdata = new FormData(form);
        const responseObject = await postFormData(
            `../database/insert/${endpointName}`,
            formdata
        );
        button.disabled = false;
        displaySubmitResult(responseObject, resultSpan);
        // TODO: Trazer lógica do displaySubmitResult para ca, para que o código abaixo não precise verificar o success duas vezes
        if (responseObject.success) {
            form.reset();
        }
    });
}
