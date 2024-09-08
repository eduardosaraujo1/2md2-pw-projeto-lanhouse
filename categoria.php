<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Cadastrar Categoriqa - Sistema Lanhouse</title>
    <link rel="stylesheet" href="css/base/base.css" />
    <link rel="stylesheet" href="css/module/modules.css" />
    <link rel="stylesheet" href="./css/layout/categoria.css" />
</head>

<body>
    <?php include 'navbar.php' ?>
    <main>
        <div class="container">
            <h1 class="title">Cadastro de Categoria</h1>
            <form class="cadastro-form">
                <div class="cadastro-form__inputs">
                    <div class="input">
                        <label class="input__label" for="nome">Nome</label>
                        <input
                            class="input__box"
                            type="text"
                            id="nome"
                            name="nome" />
                    </div>
                    <div class="input input--textarea">
                        <label class="input__label" for="nome">Descrição</label>
                        <textarea
                            class="input__box"
                            name="descricao"
                            id="descricao"
                            class="multilineTextbox"></textarea>
                    </div>
                </div>
                <button
                    type="button"
                    class="btn btn--primary"
                    onclick="location.href = './home.php'">
                    Cadastrar
                </button>
            </form>
        </div>
    </main>
    <script>
        function allowOnlyCurrency(e) {
            const key = e.key;
            const inputField = e.target;
            const currentValue = inputField.value;

            // Permitir botões Tab e Apagar
            if (key === 'Backspace' || key === 'Tab') {
                return;
            }

            // BLOQUEAR digitar se já estiver completo o formato de salário
            // REGEX: essa expressão verifica se o valor digitado termina com uma virgula (ou ponto) e duas casas decimais
            // Se quiser entender mais, pergunte ao ChatGPT "Me explique o REGEX /[,.]\d{2}$/g"
            if (/[,.]\d{2}$/g.test(currentValue)) {
                e.preventDefault();
                return;
            }

            // Permitir uma virgula ou ponto se não já estiver presente
            if (key === ',' || key === '.') {
                const temPonto = currentValue.includes('.');
                const temVirgula = currentValue.includes(',');
                if (!temPonto && !temVirgula) {
                    return;
                }
            }

            // Permitir números
            if (!isNaN(key)) {
                return;
            }

            e.preventDefault();
        }
        document
            .getElementById('salario')
            .addEventListener('keypress', allowOnlyCurrency);
    </script>
</body>

</html>