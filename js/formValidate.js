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
};
