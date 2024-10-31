<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Cadastrar Lançamento - Sistema Lanhouse</title>
    <link rel="stylesheet" href="../css/cadastro/lancamento.css" />
    <script>
        0
    </script>
</head>

<body>
    <?php include '../components/navbar.php' ?>
    <div class="cadastro">
        <h1 class="cadastro__title">Registrar Lançamento</h1>
        <span class="cadastro__result"></span>
        <form class="cadastro__form">
            <div class="cadastro__inputs">
                <div class="input">
                    <label class="input__label" for="tipoLanc">Tipo de lançamento</label>
                    <div class="radio">
                        <div>
                            <input
                                type="radio"
                                class="radio__button"
                                name="tipoLanc"
                                id="lucro"
                                value="lucro"
                                checked />
                            <label for="lucro" class="radio__label"> Lucro </label>
                        </div>
                        <div>
                            <input
                                type="radio"
                                class="radio__button"
                                name="tipoLanc"
                                id="despeza"
                                value="despeza" />
                            <label for="despeza" class="input__label"> Despeza </label>
                        </div>
                    </div>
                </div>
                <div class="input-group">
                    <label for="categoria" class="input__label">Categoria</label>
                    <select
                        name="categoria"
                        id="categoria"
                        class="input__box">
                        <option value="selecione">Selecione</option>
                    </select>
                </div>
                <div class="input-group">
                    <label class="input__label" for="valor">Valor</label>
                    <input
                        class="input__box"
                        type="text"
                        id="valor"
                        name="valor"
                        placeholder="R$ 999999,99"
                        data-currency-limit="6" />
                </div>
                <div class="input-group">
                    <label class="input__label" for="nome">Descrição</label>
                    <textarea
                        maxlength="300"
                        rows="8"
                        class="input__box"
                        name="descricao"
                        id="descricao"></textarea>
                </div>
            </div>
            <button
                type="button"
                class="btn btn--primary"
                id="cadastro__button"
                onclick="location.href = './home.php'">
                Cadastrar
            </button>
        </form>
    </div>
    <script type="module" src="../js/lancamento.js"></script>
</body>

</html>