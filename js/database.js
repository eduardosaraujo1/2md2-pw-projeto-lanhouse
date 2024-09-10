/**
 *
 * @param {FormData} formdata FormData object composing the post request.
 */
async function dbInsertRequest(formdata, phpFile) {
    try {
        const response = await fetch(`./database/${phpFile}`, {
            method: 'POST',
            body: formdata,
        });

        // Parse the JSON if no errors
        const data = await response.json();
        return data;
    } catch (err) {
        // Catch both network and HTTP errors
        console.error('Fetch request failed:', err.message);
        return {
            success: false,
            message: err.message,
        };
    }
}

/**
 *
 * @param {HTMLFormElement} form form element
 * @param {string} tableName table name for the insert
 */
// async function submitInsertForm(form, phpFile) {
//     const formData = new FormData(form);
//     const insertStatus = await dbInsertRequest(formData, phpFile);
//     return insertStatus;
// }
