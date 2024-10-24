# Integrantes

-   Eduardo Soares e Araújo
-   Gian Pablo Benvive Torres

# Como utilizar (XAMPP)

[//]: # "TODO: Remover a dica de alterar a raiz do projeto. É mais facil só falar pra pessoa seguir até o caminho http://localhost:80/2md2-pw-projeto-lanhouse/www"

1.  Crie o Schema descrito em [script.sql](project-data/banco-de-dados/script.sql) em seu DBMS. Certifique-se que o banco é acessado utilizando os seguintes parametros:
    -   `Host: localhost`
    -   `Port: 3306`
    -   `User: root`
    -   `Password: root`
    -   Note: Enquanto o Roadmap #8 não for resolvido, edite a query string que se encontra no arquivo [init.php](www/database/init.php)
2.  Acesse a pasta onde seu website se encontra (Windows: `C:\xampp\htdocs`) através do terminal (Recomendado Git Bash)
3.  Clone o projeto na pasta utilizando `git clone https://github.com/eduardosaraujo1/2md2-pw-projeto-lanhouse`.
4.  Inicie o Apache Server pelo XAMPP Control
5.  O projeto deve estar disponivel em http://localhost:80/2md2-pw-projeto-lanhouse/www

# Sobre o Projeto

## Descrição

Trata-se de um sistema para uma Lan House fictícia onde é controlado os funcionarios, clientes, fornecedores e as receitas da loja.

## Especificações

-   [Design Figma do projeto](https://www.figma.com/design/PGKnYiHtQ5wEX7GWklSsVg/Projeto-LanHouse?node-id=0-1&t=JGkDWUHh2upO3IXY-1)
-   ~~Para o Figma, o tamanho das fontes é sempre o dobro das utilizadas~~ (Quando o TODO #5, a escala será um pra um)
-   Fontes:
    -   Label: 0.75em -> 12px ~~-> 24 figma pt~~
    -   Regular: 1em -> 16px ~~-> 32 figma pt~~
    -   Heading: 2em -> 32px ~~-> 64 figma pt~~
    -   Display: 3em -> 48px ~~-> 96 figma pt~~
-   Arquitetura CSS:

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

-   [ ] (GIAN) #1 Fazer uma tela de home.php melhorada
-   [ ] (EDUARDO) #2 Refatore o CSS do projeto seguindo a arquitetura atual e o projeto Figma
-   [ ] (EDUARDO) #3 Implemente as melhorias de navbar (dropdown e user control)
-   [ ] (EDUARDO) #4 No arquivo Figma, altere os frames para 1200x675 com containers de 1140px (Tela XL do bootstrap)
-   [ ] (EDUARDO) #5 Fazer métodos de conexão do banco de dados utilizando menos "require" de arquivos inteiros e mais funções. Como função conectar() que retorna uma variavel de conexão ou até mesmo um objeto (Model com método de insert) que será utilizado pelo `cadastrar/fornecedor.php`. Nomear pasta 'database' para 'api' igual o Next.js faz. Lembre-se, qualquer erro que ocorrer no programa inteiro a API vai retornar um JSON com status 400.
-   [ ] (EDUARDO) #6 Adicionar mecanismo de login
-   [ ] (EDUARDO) #7 Refatorar lógica do front end (pasta js), separando a parte de interação com a api e o validador de textbox
-   [ ] (EDUARDO) #8 A string de conexão atualmente é hardcoded no sistema (em init.php), por isso o banco de dados precisa ser local estar na porta 3306 e possuir usuario e senha root. Faça um arquivo settings.json e deixe esses parametros mais facil de alterar
-   [ ] (N/A) #9 A tela lancamentos.php não foi conectada ao banco pois:

    -   #9.1 O banco não está estruturado para exibir as categorias que estão no banco de dados no banco e retornar ao usuário esse script.
    -   #9.2 O campo fk_id_funcionário obtem o usuário que está atualmente logado. Como não temos um sistema de login ainda, não é possível preencher esse campo.
