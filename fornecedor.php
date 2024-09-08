<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Cadastrar Fornecedor - Sistema Lanhouse</title>
    <link rel="stylesheet" href="css/base/base.css" />
    <link rel="stylesheet" href="css/module/modules.css" />
    <link rel="stylesheet" href="./css/layout/fornecedor.css" />
</head>

<body>
    <script>
        0
    </script>
    <?php include 'navbar.php' ?>
    <main>
        <div class="container">
            <h1 class="title">Cadastro de Fornecedor</h1>
            <form class="cadastro-form">
                <div class="cadastro-form__inputs">
                    <div class="input col-span-2">
                        <label class="input__label" for="nome">Nome</label>
                        <input
                            required
                            class="input__box"
                            type="text"
                            id="nome"
                            name="nome" />
                    </div>
                    <div class="input col-span-2">
                        <label for="email" class="input__label">E-mail</label>
                        <input
                            required
                            class="input__box"
                            type="email"
                            id="email"
                            name="email" />
                    </div>
                    <div class="input">
                        <label for="telefone" class="input__label">Telefone</label>
                        <input
                            required
                            class="input__box"
                            type="tel"
                            id="telefone"
                            name="telefone" />
                    </div>
                    <div class="input">
                        <label for="contato" class="input__label">Contato</label>
                        <input
                            required
                            class="input__box"
                            type="text"
                            id="contato"
                            name="contato" />
                    </div>
                    <div class="input col-span-2">
                        <label for="endereco" class="input__label">Endereco</label>
                        <input
                            required
                            class="input__box"
                            type="text"
                            id="endereco"
                            name="endereco" />
                    </div>
                </div>
                <button
                    type="submit"
                    class="btn btn--primary">
                    Cadastrar
                </button>
            </form>
        </div>
    </main>
    <script src="./js/database.js"></script>
    <script src="./js/formValidate.js"></script>
    <!-- TODO: FORM VALIDATE PHONE NUMBER -->
    <script>
        const form = document.querySelector('form');
        form.addEventListener("submit", (event) => {
            event.preventDefault();

            const res = submitInsertForm(form, 'insert_fornecedor.php');
            console.log(res)
        })
    </script>
</body>

</html>