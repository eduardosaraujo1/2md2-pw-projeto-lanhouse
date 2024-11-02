import { FormSenderFactory, CadastroUtils } from './common/cadastro.js';
import { InputUtils } from './common/inpututils.js';

function getFormData(form) {
    // Declare FormData
    const formdata = new FormData(form);

    // Sanitizar Telefone
    const telefone = formdata.get('telefone');
    const telefoneFiltrado = telefone.replace(/\D/g, '');
    formdata.set('telefone', telefoneFiltrado);

    // Retornar FormData
    return formdata;
}

function formValidate(form) {
    let valid = true;
    const telefone = form.querySelector('#telefone');

    if (!form.checkValidity()) {
        valid = false;
    }

    if (!InputUtils.phone.isvalid(telefone.value)) {
        telefone.setCustomValidity('Telefone incompleto.');
        valid = false;
    }

    // Exibir problema caso exista
    form.reportValidity();

    // Remover customvalidity para permitir proximos submits
    telefone.setCustomValidity('');

    // Retornar se é valido ou não
    return valid;
}

function load() {
    // Cadastro elements
    const cadastro = document.querySelector('.cadastro');
    const form = cadastro.querySelector('form.cadastro__form');
    const submitButton = form.querySelector('#cadastro__button');
    const resultDisplay = cadastro.querySelector('.cadastro__result');

    // Form sender object
    const formSender = FormSenderFactory(form, formValidate, getFormData);

    form.addEventListener('submit', async (event) => {
        // Prevent form submit default redirection behaviour
        event.preventDefault();

        // Desativar botão enquanto envio não houver finalizado
        CadastroUtils.submitButton.disable(submitButton);

        // Enviar formulario utilizando endpoint especificado em 'action'
        const response = await formSender.submit();

        if (response) {
            // Verificar se requisição obteve êxito em seu proposito
            const success = response['status'] === 'success';

            // Exibir resposta ao usuário
            CadastroUtils.displayResult(resultDisplay, success);

            // Por fim, limpar formulário dos dados se bem sucedido
            if (success) {
                form.reset();
            }
        }

        // Reativar botão após finalização do envio
        CadastroUtils.submitButton.enable(submitButton);
    });

    // Filtros de input
    const telefone = form.querySelector('#telefone');
    telefone.addEventListener('input', InputUtils.phone.hook);
}

load();
