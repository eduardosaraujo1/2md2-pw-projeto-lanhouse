// Validar telefone
function phoneInputHook(event) {
    const input = event.currentTarget;
    const str = input.value;

    // Remove todos os caracteres que não sejam dígitos
    const value = str.replace(/\D/g, '');

    // Condição de formatação inicial: "(XX"
    if (value.length === 0) {
        input.value = '';
        return;
    } else if (value.length <= 2) {
        input.value = `(${value}`;
        return;
    }

    // Formatação inicial até "(XX) "
    let resultado = `(${value.slice(0, 2)}) `;

    // Define o terceiro dígito após o DDD
    const terceiroDigito = value[2];

    // Verifica a necessidade do hífen com base no terceiro dígito
    if (terceiroDigito === '9') {
        // Formato para números com terceiro dígito "9": (XX) 99999-9999
        if (value.length > 7) {
            resultado += `${value.slice(2, 7)}-${value.slice(7, 11)}`;
        } else {
            resultado += value.slice(2, 7);
        }
    } else {
        // Formato para números com terceiro dígito diferente de "9": (XX) 8888-8888
        if (value.length > 6) {
            resultado += `${value.slice(2, 6)}-${value.slice(6, 10)}`;
        } else {
            resultado += value.slice(2, 6);
        }
    }

    input.value = resultado;
}
function phoneValidateString(str) {
    const numOnly = str.replace(/[^0-9]/g, '');
    if (numOnly?.[2] === '9') {
        return numOnly.length >= 11;
    } else {
        return numOnly.length >= 10;
    }
}

// Validar moeda
function currencyInputHook(event) {
    const input = event.currentTarget;
    const str = input.value;

    // Parametro: tamanho máximo do valor
    const PARAM_CURRENCY_LIMIT = input.getAttribute('data-currency-limit');

    if (!parseInt(PARAM_CURRENCY_LIMIT)) {
        throw Error(
            `Attributo 'data-currency-limit' não encontrado: esperado número, encontrado ${PARAM_CURRENCY_LIMIT}`
        );
    }

    // Simplificar
    const value = str.replace('.', ',').replace(/[^\d,]/g, '');

    // Caso o valor comece com uma vírgula, retorna uma string vazia
    if (value == '' || value.startsWith(',')) {
        input.value = '';
        return;
    }

    // Divide a parte inteira e a decimal usando a vírgula
    let [inteira, decimal] = value.split(',');

    // Trunca a parte inteira para o limite de 5 dígitos
    if (inteira.length > PARAM_CURRENCY_LIMIT) {
        decimal = decimal ?? '' + inteira.slice(PARAM_CURRENCY_LIMIT); // Junta a parte cortada do numero ao decimal
        inteira = inteira.slice(0, PARAM_CURRENCY_LIMIT);
    }

    // Verifica se tem parte decimal, mesmo que vazia ("") e inclui a virgula
    if (decimal != undefined) {
        decimal = decimal.slice(0, 2);
        input.value = `R$ ${inteira},${decimal}`;
        return;
    }

    input.value = `R$ ${inteira}`;
}

function currencyValidate(str) {
    const regex = /^\d{1,5}([,.]\d{2})?$/;
    return regex.test(str);
}

/**
 * Utilidades para inputs de formulários. Funcionalidade para formatar e validar telefone e moeda
 * @param hook - Utilizado para conectar no evento "input" da caixa de texto para validar a entrada do usuário
 * @param isvalid - Valida se a entrada pode ser enviada ou não
 */
const InputUtils = {
    phone: {
        hook: phoneInputHook,
        isvalid: phoneValidateString,
    },
    currency: {
        hook: currencyInputHook,
        isvalid: currencyValidate,
    },
};

export default InputUtils;
