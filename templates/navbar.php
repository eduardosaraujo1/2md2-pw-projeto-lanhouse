<?php
$username = "Convidado";
if (isset($_SESSION, $_SESSION['current_user'], $_SESSION['current_user']['name'])) {
    $username = $_SESSION['current_user']['name'];
}
?>

<nav class="navbar">
    <a class="navbar__brand" href="home.php">
        <img src="../assets/images/simplified.png" alt="" />
    </a>
    <ul class="navbar__navs">
        <li class="navbar__nav-item">
            <a class="navbar__nav-link" href="home.php">Home</a>
        </li>
        <li class="navbar__nav-item navbar__nav-item-dropdown">
            <a class="navbar__nav-link" href="#">Cadastros</a>
            <ul class="navbar__dropdown-container dropdown">
                <li class="dropdown-item">
                    <a href="funcionario.php" class="dropdown-link">Funcionario</a>
                </li>
                <li class="dropdown-item">
                    <a href="fornecedor.php" class="dropdown-link">Fornecedor</a>
                </li>
                <li class="dropdown-item">
                    <a href="cliente.php" class="dropdown-link">Cliente</a>
                </li>
                <li class="dropdown-item">
                    <a href="categoria.php" class="dropdown-link">Categoria</a>
                </li>
                <li class="dropdown-item">
                    <a href="lancamento.php" class="dropdown-link">Lançamento</a>
                </li>
            </ul>
        </li>
    </ul>
    <div class="currentuser">
        <button class="currentuser__profile" aria-controls="currentuser__menu">
            <img class="currentuser__avatar" src="../assets/images/user.png" alt="" />
        </button>
        <div class="currentuser__menu" id="currentuser__menu" tabindex="-1">
            <div class="currentuser__info">
                <img class="currentuser__avatar" src="../assets/images/user.png" alt="" />
                <span class="currentuser_name"><?php echo $username ?></span>
            </div>
            <ul class="currentuser__actions dropdown">
                <li class="dropdown-item">
                    <button class="currentuser__action dropdown-link" id="action__sair" onclick="location.href = '../src/session/sair.php'">
                        <img src="../assets/icons/sair.svg" alt="" class="currentuser__action-icon" />
                        <span class="currentuser__action-text">Sair</span>
                    </button>
                </li>
            </ul>
        </div>
    </div>
</nav>