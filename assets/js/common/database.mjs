/**
 * Faz uma request POST para o banco de dados
 * @param {string} url Caminho para o endpoint
 * @param {formdata} formdata Dados para enviar no corpo
 * @returns {object} Retorna o objeto JSON da resposta ou um objeto de erro com o conteúdo da resposta em caso de falha na conversão para JSON
 */
async function sendPost(url, formdata) {
    try {
        const response = await fetch(url, {
            method: 'POST',
            body: formdata,
            credentials: 'same-origin',
        });

        // Read the response as text first
        const text = await response.text();

        // Attempt to parse the text as JSON
        try {
            const data = JSON.parse(text);
            return data;
        } catch (jsonError) {
            // If parsing fails, return the raw text content
            return {
                status: 'error',
                content: text,
            };
        }
    } catch (networkError) {
        // If there's a network error
        return {
            status: 'error',
            content: `Network error: ${networkError.message}`,
        };
    }
}

async function sendGet(url) {
    try {
        const response = await fetch(url, {
            method: 'GET',
            credentials: 'same-origin',
        });

        // Attempt to parse as JSON, catching any errors
        try {
            const data = await response.json();
            return {
                status: 'success',
                content: data,
            };
        } catch (jsonError) {
            // Fall back to plain text if JSON parsing fails
            const content = await response.text();
            return {
                status: 'error',
                content: content,
            };
        }
    } catch (networkError) {
        // Handle network error
        return {
            status: 'error',
            content: `Network error: ${networkError.message}`,
        };
    }
}

const Database = {
    sendPost,
    sendGet,
};

export default Database;
