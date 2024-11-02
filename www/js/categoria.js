import { FormSenderFactory, CadastroUtils } from './common/cadastro.js';

function load() {
    // Form data
    const form = document.querySelector('form.cadastro__form');
    const submitButton = form.querySelector('#cadastro__button');
    const resultDisplay = document.querySelector('.cadastro__result');

    // Instanciação form sender
    const formSender = FormSenderFactory(form);

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
}
load();
