import { FormSenderFactory, CadastroUtils } from './common/cadastro.js';

function load() {
    // Form data
    const form = document.querySelector('form.cadastro__form');

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
