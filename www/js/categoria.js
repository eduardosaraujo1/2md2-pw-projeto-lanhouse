import { FormSenderFactory, CadastroUtils } from './common/cadastro.mjs';

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

        // Default cadastro submit logic
        CadastroUtils.cadastroSubmitHandler(formSender);
    });
}

load();
