# Integrantes

-   Eduardo Soares e Araújo
-   Gian Pablo Benvive Torres

# Como utilizar (XAMPP)

1.  Crie o Schema descrito em [script.sql](project-data/banco-de-dados/script.sql) em seu banco MySQL. As credenciais de acesso do banco podem ser visualizadas e alteradas através do arquivo [database.json](database.json)
2.  Acesse a pasta onde seu website se encontra (Windows: `C:\xampp\htdocs`) através do terminal (Recomendado Git Bash)
3.  Clone o projeto na pasta utilizando `git clone https://github.com/eduardosaraujo1/2md2-pw-projeto-lanhouse`.
4.  Inicie o Apache Server pelo XAMPP Control
5.  O projeto deve estar disponivel em http://localhost:80/2md2-pw-projeto-lanhouse/www

# Sobre o Projeto

## Descrição

Trata-se de um sistema para uma Lan House fictícia onde é controlado os funcionarios, clientes, fornecedores e as receitas da loja.

## Especificações

-   [Design Figma do projeto](https://www.figma.com/design/PGKnYiHtQ5wEX7GWklSsVg/Projeto-LanHouse?node-id=0-1&t=JGkDWUHh2upO3IXY-1)

# Roadmap

-   [ ] (GIAN) #1 Fazer uma tela de home.php melhorada
-   [ ] (EDUARDO) #2 Refatorar JS utilizando [ES6 Modules](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Guide/Modules) para separar funcionalidades como validação de formulario. (50% progresso)
-   [ ] (EDUARDO) #3 Implementar sistema login utilizando $SESSION
-   [ ] (EDUARDO) #4 Fazer botão de visualizar senha
-   [ ] (N/A) #5 A tela lancamentos.php não foi conectada ao banco pois:
    -   [ ] #5.1 O endpoint não está estruturado para exibir as categorias que estão no banco de dados no banco e retornar ao usuário esse script. (prestes a resolver)
    -   [ ] #5.2 O campo fk_id_funcionário obtem o usuário que está atualmente logado. Como não temos um sistema de login ainda, não é possível preencher esse campo. (prestes a resolver)
-   [ ] (EDUARDO OPCIONAL) Repensar na estrutura do frontend para form submit depois de ver algumas tecnicas do Filipe Deschamps: SEPARATION OF CONCERNS

# Branch Roadmap

-   [x] Validação senha e confirmar senha funcionario
-   [x] Função para fazer requisição a API tomando como entrada
-   [x] Fazer função que da hook no form submit para pegar os dados do form, trata-los, envia-los
-   [x] Formatar resposta de forma normal
-   [x] Replicar nos outros forms, não apenas em funcionario.js
-   [x] BLOQUEAR BOTÃO "submit" quando o form estiver no processo de envio
-   [x] VALIDAÇÃO DE TELEFONE QUANDO ENVIAR EU ESQUECI!!!
