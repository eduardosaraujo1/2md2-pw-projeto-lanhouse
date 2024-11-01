import InputUtils from './common/input-utils.js';
import CadastroUtils from './common/cadastro.js';

async function cadastrarFuncionario(event) {
    // Dados form
    const form = event.target;
    const formdata = new FormData(form);

    // cancelar envio em caso de invalidez
    if (formValidate(form)) {
        return;
    }

    // sanitização - remover caracteres decorativos do campo "salario"
    const salario = formdata.get('salario');
    const salarioSanitized = salario.replace(/[^\d,.]/g, '');
    formdata.set('salario', salarioSanitized);

    // submit
    CadastroUtils.setSubmitButtonState(form, false);
    const result = await CadastroUtils.cadastrar(
        '../php/database/insert/funcionario.php',
        formdata
    );

    // exibir resposta para o usuário
    const cadastroResult = document.querySelector('.cadastro__result');
    CadastroUtils.displayResponseResult(
        cadastroResult,
        result['status'] === 'success'
    );
    // limpar form quando subject sucesso
    if (result['status'] === 'success') {
        form.reset();
    }
    CadastroUtils.setSubmitButtonState(form, true);
}

/**
 *
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
    // Filtros de entrada de texto
    const form = document.querySelector('form.cadastro__form');
    const salario = form.querySelector('#salario');
    salario.addEventListener('input', InputUtils.currency.hook);

    // Conectar funções ao evento "form submit"
    const formSubject = CadastroUtils.createFormSubmitSubject(form);
    formSubject.subscribe(cadastrarFuncionario);
}

load();
