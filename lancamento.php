<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Cadastrar Lançamento - Sistema Lanhouse</title>
    <link rel="stylesheet" href="css/base/base.css" />
    <link rel="stylesheet" href="css/module/modules.css" />
    <link rel="stylesheet" href="./css/layout/lancamento.css" />
</head>

<body>
    <?php include 'components/navbar.php' ?>
    <main>
        <div class="container">
            <h1 class="title">Registrar Lançamento</h1>
            <span class="submit-result"></span>
            <form class="cadastro-form">
                <div class="cadastro-form__inputs">
                    <div class="input">
                        <label class="input__label" for="tipoLanc">Tipo de lançamento</label>
                        <div class="radio">
                            <label for="lucro" class="input__label">
                                <input
                                    type="radio"
                                    name="tipoLanc"
                                    id="lucro"
                                    value="lucro"
                                    checked />
                                Lucro</label>
                            <label for="despeza" class="input__label">
                                <input
                                    type="radio"
                                    name="tipoLanc"
                                    id="despeza"
                                    value="despeza" />
                                Despeza</label>
                        </div>
                    </div>
                    <div class="input">
                        <label for="categoria" class="input__label">Categoria</label>
                        <select
                            name="categoria"
                            id="categoria"
                            class="input__box">
                            <option value="selecione">Selecione</option>
                        </select>
                    </div>
                    <div class="input">
                        <label class="input__label" for="valor">Valor (R$)</label>
                        <input
                            class="input__box"
                            type="text"
                            id="valor"
                            name="valor" />
                    </div>
                    <div class="input input--textarea">
                        <label class="input__label" for="nome">Descrição</label>
                        <textarea
                            maxlength="300"
                            class="input__box"
                            name="descricao"
                            id="descricao"></textarea>
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
</body>

</html>