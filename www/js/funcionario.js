import { InputUtils } from './common/input-utils.js';
import { FormSenderFactory, CadastroUtils } from './common/cadastro.js';

function getFormData(form) {
    // Dados form
    const formdata = new FormData(form);

    // Sanitizar salario
    const salario = formdata.get('salario');
    const salarioSanitized = salario.replace(/[^\d,.]/g, '');
    formdata.set('salario', salarioSanitized);

    // Retornar FormData
    return formdata;
}

/**
 * @param {HTMLFormElement} form
 */
function formValidate(form) {
    let valid = true;
    const senha = form.querySelector('#senha');
    const confirmSenha = form.querySelector('#confirmSenha');

    if (senha.value.length < 8) {
        valid = false;
        senha.setCustomValidity('Senha deve ter 8 ou mais caracteres');
    }

    if (senha.value !== confirmSenha.value) {
        valid = false;
        senha.setCustomValidity('Senhas não coincidem');
    }

    if (!form.checkValidity()) {
        valid = false;
    }

    // Exibir problema caso exista
    form.reportValidity();

    // Redefinir validity para permitir proximos envios
    senha.setCustomValidity('');

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
        const success = response?.['status'] === 'success';

        // Exibir resposta ao usuário
        CadastroUtils.displayResult(resultDisplay, success);

        // Reativar botão após finalização do envio
        CadastroUtils.submitButton.enable(submitButton);

        // Por fim, limpar formulário dos dados se bem sucedido
        if (success) {
            form.reset();
        }
    });

    // Filtros de entrada de texto
    const salario = form.querySelector('#salario');
    salario.addEventListener('input', InputUtils.currency.hook);
}

load();
