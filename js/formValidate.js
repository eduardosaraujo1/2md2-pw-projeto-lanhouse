function currencyFilter(event) {
    const inputField = event.target;
    let currentValue = inputField.value;

    // Ensure the value only contains valid characters (numbers, comma, or period)
    const cleanedValue = currentValue.replace(/[^0-9,.]/g, '');

    // Prevent more than 5 digits before the decimal point
    const parts = cleanedValue.split(/[,.]/).slice(0, 2);
    const wholePart = parts[0];

    if (wholePart.length > 5) {
        // Limit to 5 digits before the decimal/comma
        parts[0] = wholePart.slice(0, 5);
    }

    // If there are more than two decimal digits, truncate them
    if (parts.length > 1 && parts[1].length > 2) {
        parts[1] = parts[1].slice(0, 2);
    }

    // Join the parts back together with the original separator (if any)
    inputField.value = parts.join(cleanedValue.includes(',') ? ',' : '.');
}

function validCurrency(value) {
    // Check if it's a number with up to 7 digits and no decimal or comma
    const plainNumberRegex = /^\d{1,5}$/;

    // Check if it's a number with exactly 2 decimal places (period as separator)
    const decimalNumberRegex = /^\d{1,5}[,\.]\d{2}$/;

    // Return true if it matches either condition (plain number or decimal with 2 places)
    if (plainNumberRegex.test(value) || decimalNumberRegex.test(value)) {
        return true;
    }

    // Return false for all other cases (including commas)
    return false;
}
