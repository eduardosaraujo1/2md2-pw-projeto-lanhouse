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
                            required
                            class="input__box"
                            type="text"
                            id="nome"
                            name="nome" />
                    </div>
                    <div class="input input--textarea">
                        <label class="input__label" for="nome">Descrição</label>
                        <textarea
                            required
                            class="input__box"
                            name="descricao"
                            id="descricao"
                            class="multilineTextbox"></textarea>
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
    <script>
        const form = document.querySelector('form');
        let validate = () => {};
        setupCadastroSubmit(form, 'insert_categoria.php', validate);
    </script>
</body>

</html>