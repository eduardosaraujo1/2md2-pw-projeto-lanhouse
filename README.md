# Integrantes

-   Eduardo Soares e Araújo
-   Gian Pablo Benvive Torres

# Como utilizar
[//]: # (TODO: Remover a dica de alterar a raiz do projeto. É mais facil só falar pra pessoa seguir até o caminho http://localhost:80/2md2-pw-projeto-lanhouse/www)
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

## Resumo
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

-   [ ] (GIAN) Fazer uma tela de home.php melhorada
-   [ ] (EDUARDO) Refatore o CSS do projeto seguindo a documentação atual
-   [ ] (EDUARDO) Adicione no CSS refatorado as fontes e cores do projeto
-   [ ] (EDUARDO) Implemente as melhorias de navbar (dropdown e user control)
-   [ ] (EDUARDO) No arquivo Figma, altere os frames para 1200x675 com containers de 1140px (Tela XL do bootstrap)
-   [ ] (EDUARDO) Utilizar [ES6 Modules](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Guide/Modules) para separar funcionalidades como validação de formulario
-   [ ] (EDUARDO) Em uma aplicação real, o banco de dados não estaria no mesmo diretorio que o website (www), então talvez seja ideal tirar a pasta `database` de dentro da `www`? Não tenho certeza pois nunca desenvolvi um back-end que faz delivery do front-end. Aprendendo o uso de Node.js para ambientes de desenvolvimento front-end tem sido legal
-   [ ] (N/A) A tela lancamentos.php não foi conectada ao banco pois:

    -   [ ] O banco não está estruturado para exibir as categorias que estão no banco de dados no banco e retornar ao usuário esse script.
    -   [ ] O campo fk_id_funcionário obtem o usuário que está atualmente logado. Como não temos um sistema de login ainda, não é possível preencher esse campo.
