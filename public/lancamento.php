<?php require '../src/session/check.php' ?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Cadastrar Lançamento - Sistema Lanhouse</title>
    <link rel="stylesheet" href="../assets/css/lancamento.css" />
    <script>
        0;
    </script>
</head>

<body>
    <?php include '../templates/navbar.php' ?>
    <div class="cadastro">
        <h1 class="cadastro__title">Registrar lançamento</h1>
        <span class="cadastro__result"></span>
        <form class="cadastro__form" action="../src/insert/lancamento.php">
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
                            <label for="lucro" class="radio__label">
                                Lucro
                            </label>
                        </div>
                        <div>
                            <input
                                type="radio"
                                class="radio__button"
                                name="tipoLanc"
                                id="despeza"
                                value="despeza" />
                            <label for="despeza" class="input__label">
                                Despeza
                            </label>
                        </div>
                    </div>
                </div>
                <div class="input-group">
                    <label for="categoria" class="input__label">Categoria</label>
                    <select class="input__box" name="categoria" id="categoria">
                        <option value="" default>Selecione</option>
                        <?php
                        try {
                            include '../src/_view/categorias-as-options.php';
                            getCategorias();
                        } catch (Throwable $err) {
                            echo $err->getMessage();
                        }
                        ?>
                    </select>
                </div>
                <div class="input-group">
                    <label class="input__label" for="valor">Valor</label>
                    <input
                        type="text"
                        class="input__box"
                        id="valor"
                        name="valor"
                        placeholder="R$ 999999,99"
                        required
                        data-maxlength="8" />
                </div>
                <div class="input-group">
                    <label class="input__label" for="descricao">Descrição</label>
                    <textarea
                        class="input__box"
                        id="descricao"
                        name="descricao"
                        maxlength="300"
                        rows="8"></textarea>
                </div>
            </div>
            <button
                type="submit"
                class="btn btn--primary"
                id="cadastro__button">
                Cadastrar
            </button>
        </form>
    </div>
    <script type="module" src="../assets/js/lancamento.js"></script>
</body>

</html>