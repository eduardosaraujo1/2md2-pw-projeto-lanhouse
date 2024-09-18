// TODO: Transition to class model
class Validate {
    /**
     * Filters the specified input value so it is in the correct track to become a propper element
     * @param {HTMLInputElement} input Input element to be filtered
     */
    static inputFilter(input) {
        throw new Error('Not Implemented Exception');
    }
    /**
     *
     * @param {string} text Text to validate in the function
     */
    static validate(text) {
        throw new Error('Not Implemented Exception');
    }
}

class TelefoneValidate extends Validate {
    static validate(text) {
        const numOnly = text.replace(/[^0-9]/g, '');
        if (numOnly?.[2] === '9') {
            return numOnly.length >= 11;
        } else {
            return numOnly.length >= 10;
        }
    }

    static inputFilter(input) {
        // Uses a length attribute instead of endPos
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
    }
}

class CurrencyValidate extends Validate {
    static inputFilter(input) {
        let value = input.value;

        // Character filter
        value = value.replace('.', ',');
        value = value.replace(/[^0-9.]/g, '');

        // Split price and decimals
        let price = value.split(',').slice(0, 2);

        // limit to 5 digits the wholePart
        price[0] = price[0].slice(0, 5);

        // limit to 2 digits the decimal part
        if (price.length > 1) {
            price[1] = price[1].slice(0, 2);
        }

        // join everything together
        value = price.join(',');

        // Blank decimal filter
        if (value === ',') {
            value = '';
        }

        // Assign
        input.value = value;
    }
    static validate(text) {
        const currencyRegex = /^\d{1,5}([,.]\d{2})?$/;
        const valid = currencyRegex.test(text);
        return valid;
    }
}
