// TODO: Transition to class model
class FormValidate {
    static currency(input) {
        // WIP
    }
}
const InputFilter = {
    /**
     * @param {HTMLInputElement} input Input for the filter
     */
    currency: function (input) {
        let value = input.value;

        // Character filter
        value = value.replace(',', '.');
        value = value.replace(/[^0-9.]/g, '');

        // Split price and decimals
        let price = value.split('.').slice(0, 2);

        // limit to 5 digits the wholePart
        price[0] = price[0].slice(0, 5);

        // limit to 2 digits the decimal part
        if (price.length > 1) {
            price[1] = price[1].slice(0, 2);
        }

        // join everything together
        value = price.join('.');

        // Blank decimal filter
        if (value === '.') {
            value = '';
        }

        // Assign
        input.value = value;
    },
    telefone: function (input) {
        let value = input.value;

        // Remove any character that is not a digit
        value = value.replace(/[^0-9]/g, '');

        // If third number is a '9' (implies cellphone), max length is 11, otherwise max length is 10
        if (value[2] === '9') {
            value = value.slice(0, 11);
        } else {
            value = value.slice(0, 10);
        }

        // Separate phone number components
        // sample: 11951490211 -> 11
        let ddd = value.slice(0, 2);
        let firsthalf, secondhalf;

        if (value[2] === '9') {
            // sample: 11951490211 -> 94149
            firsthalf = value.slice(2, 7);
            // sample: 11951490211 -> 0211
            secondhalf = value.slice(7);
        } else {
            // sample: 1121490211 -> 2149
            firsthalf = value.slice(2, 6);
            // sample: 1121490311 -> 0311
            secondhalf = value.slice(6);
        }

        value = ddd;
        if (firsthalf) {
            value += ' ' + firsthalf;
        }
        if (secondhalf !== '') {
            value += '-' + secondhalf;
        }

        // Update the input value with the formatted phone number
        input.value = value;
    },
};

function fullCurrency(currency) {
    const currencyRegex = /^\d{1,5}([,.]\d{2})?$/;
    const valid = currencyRegex.test(currency);
    return valid;
}

function fullTelefone(telefone) {
    const numOnly = telefone.replace(/[^0-9]/g, '');
    if (numOnly?.[2] === '9') {
        return numOnly.length >= 11;
    } else {
        return numOnly.length >= 10;
    }
}
