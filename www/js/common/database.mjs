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
        });

        // Tenta converter para JSON
        try {
            const data = await response.json();
            return data;
        } catch (jsonError) {
            // Em caso de erro ao converter para JSON, retorne o conteúdo como texto
            const content = await response.text();
            return {
                status: 'error',
                content: content,
            };
        }
    } catch (networkError) {
        // Caso ocorra um erro na própria requisição
        return {
            status: 'error',
            content: `Network error: ${networkError.message}`,
        };
    }
}

const Database = {
    sendPost,
};

export default Database;
