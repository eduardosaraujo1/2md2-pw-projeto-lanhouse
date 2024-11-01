import InputUtils from './common/input-utils.js';
import CadastroUtils from './common/cadastro.js';

// Filtro de input: moeda
const salario = document.querySelector('#salario');
salario.addEventListener('input', InputUtils.currency.hook);

// Elementos cadastro
const cadastroResult = document.querySelector('.cadastro__result');

// Criar form subject (observers)
const form = document.querySelector('form.cadastro__form');
const formSubject = CadastroUtils.createFormSubmitSubject(form);

async function cadastrarFuncionario(event) {
    const formdata = new FormData(form);

    // cancelar envio em caso de invalidez
    const senha = form.querySelector('#senha').value;
    const confirmSenha = form.querySelector('#confirmSenha').value;
    if (
        !form.checkValidity() ||
        !InputUtils.password.isvalid(senha, confirmSenha)
    ) {
        return;
    }

    // sanitização - remover caracteres decorativos do campo "salario"
    const salario = formdata.get('salario');
    const salarioSanitized = salario.replace(/[^\d,.]/g, '');
    formdata.set('salario', salarioSanitized);

    // submit
    const result = await CadastroUtils.cadastrar(
        '../php/database/insert/funcionario.php',
        formdata
    );

    // exibir resposta para o usuário
    CadastroUtils.displayResponseResult(
        cadastroResult,
        result['status'] === 'success'
    );
}

/**
 * @param {SubmitEvent} event
 */
function passwordSubmitHook(event) {
    const password = form.querySelector('#senha');
    const confirm = form.querySelector('#confirmSenha');
    const result = InputUtils.password.isvalid(password.value, confirm.value);

    if (!result) {
        if (password.value.length < 8) {
            password.setCustomValidity('Senha deve ter 8 ou mais caracteres');
        } else {
            password.setCustomValidity('Senhas não coincidem');
        }
    }

    // Exibir problema caso exista
    form.reportValidity();

    // Redefinir validity para permitir proximos envios
    password.setCustomValidity('');
}

// subscribes
formSubject.subscribe(passwordSubmitHook);
formSubject.subscribe(cadastrarFuncionario);
