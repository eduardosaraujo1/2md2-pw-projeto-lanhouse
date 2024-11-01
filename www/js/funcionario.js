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

/**
 * Validar campos "Senha" e "Confirmar Senha"
 *
 * @param {SubmitEvent} event
 */
function passwordValidationHandler(event) {
    const password = form.querySelector('#senha');
    const result = validatePassword();

    if (result === 'SENHA_DIFERENTE') {
        password.setCustomValidity('Senhas não coincidem');
    } else if (result === 'SENHA_PEQUENA') {
        password.setCustomValidity('Senha deve ter 8 ou mais caracteres');
    }

    // Exibir problema caso exista
    form.reportValidity();

    // Redefinir validity para permitir proximos envios
    password.setCustomValidity('');
}

function validatePassword() {
    const password = form.querySelector('#senha');
    const confirmPassword = form.querySelector('#confirmSenha');

    // verifica se confirmação está correta
    if (password.value !== confirmPassword.value) {
        return 'SENHA_DIFERENTE';
    }
    // limite de tamanho
    else if (password.value.length < 8) {
        return 'SENHA_PEQUENA';
    }

    return 'SUCESSO';
}

async function cadastrarFuncionario(event) {
    const formdata = new FormData(form);

    // cancelar envio em caso de invalidez
    if (!form.checkValidity() || validatePassword() != 'SUCESSO') {
        return;
    }

    // sanitização - remover caracteres decorativos do campo "salario"
    const salario = formdata.get('salario');
    const salarioSanitized = salario.replace(/[^\d,.]/g, '');
    formdata.set('salario', salarioSanitized);

    // submit
    console.log(formdata);
    const result = await CadastroUtils.cadastrar(
        '../php/database/insert/funcionario.php',
        formdata
    );

    cadastroResult.innerHTML = JSON.stringify(result);
}

// subscribes
formSubject.subscribe(passwordValidationHandler);
formSubject.subscribe(cadastrarFuncionario);
