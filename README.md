# Como utilizar

1.  Execute [script.sql](project-data/banco-de-dados/script.sql) em um servidor MySQL
    -   O usuário do servidor deve ser 'root' e a senha deve ser 'root', para alterar, modifique [init.php](www/database/init.php)
2.  Com o banco de dados criado, copie o conteúdo da pasta www para a raiz de seu servidor Apache
    -   Caso esteja utlizando XAMPP, essa raiz se encontra em `C:\\xampp\\htdocs`
    -   Altenativamente, clone o repotisótio utilizando `git clone https://github.com/eduardosaraujo1/2md2-pw-projeto-lanhouse`.

Para a solução utilizando `git clone`, recomendo definir a raiz do seu projeto para a pasta [www](./www).

Caso esteja utilizando Apache como servidor (XAMPP), essa alteração pode ser feita do arquivo `C:\xampp\apache\conf\httpd.conf`, baseando-se no exemplo abaixo:

```
# ARQUIVO C:\xampp\apache\conf\httpd.conf
DocumentRoot "C:/xampp/htdocs/2md2-pw-projeto-api/www"
<Directory "C:/xampp/htdocs/2md2-pw-projeto-api/www">
    ...
</Directory>
```

# Sobre o Projeto

Sistema para uma Lan House onde é controlado os funcionarios, clientes, fornecedores e as receitas da loja.

# Integrantes

-   Eduardo Soares e Araújo
-   Gian Pablo Benvive Torres

# Especificações

-   Para o Figma, o tamanho das fontes é sempre o dobro das utilizadas
-   Tamanhos de fontes;
    -   Label: 0.75em -> 12px -> 24 figma pt
    -   Regular: 1em -> 16px -> 32 figma pt
    -   Heading: 2em -> 32px -> 64 figma pt
    -   Display: 3em -> 48px -> 96 figma pt
-   Estrutura CSS:

(Quando tiver tempo, arrume as linhas para conectarem nos arquivos também)

```
css
├───categoria.css
├───cliente.css
├───fornecedor.css
├───funcionario.css
├───lancamento.css
└───common
    ├───components.css -- Navbar, botões, inputs, etc
    ├───layout.css -- Estrutura genérica para cada página
    ├───reset.css
    └───themes.css -- Classes e variáveis para cores, fontes e afins
```

# Roadmap

-   [ ] (GIAN) Fazer uma tela de home.php melhorada
-   [ ] (GIAN) Refazer conexão ao banco de dados funcionario.php
-   [ ] (EDUARDO) Enquanto altere a estrutura do projeto (abaixo), aplique as alterações do figma (fontes, cores, telas de cadastro) no projeto
-   [ ] (EDUARDO) Tirar a estrutura SMACSS do projeto, ficou muito complexa.
-   [ ] (EDUARDO) Navbar menu dropdown para cadastros PRONTO NO FIGMA
-   [x] (EDUARDO) Pense mais sobre o tamanho de fontes que o projeto vai ter
    -   (Copiado de Material You 3)
    -   Display (3rem)
    -   Header (2rem)
    -   Normal (1rem)
    -   Label (.75rem)
-   [ ] (EDUARDO) Utilizar [ES6 Modules](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Guide/Modules) e ver ES-Lint no projeto
-   [ ] (ESPERANDO FEEDBACK DO PROFESSOR) Fazer a tela de lancamento.php não foi possível pois requer os seguintes parametros:

    -   [ ] Exibir as categorias que estão no banco de dados no campo "categoria"
    -   [ ] Validação de funcionário atual que está cadastrando para preencher o campo fk_id_funcionário

-   [ ] ~~Tentar aplicar MVC (Model View Controller) ao projeto~~ (Fica dificil entender MVC, mas é legal para aprendizado futuro)
