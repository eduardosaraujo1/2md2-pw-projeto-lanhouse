# Integrantes

-   Eduardo Soares e Araújo
-   Gian Pablo Benvive Torres

# Como utilizar (XAMPP)

1.  Acesse a pasta onde seu website se encontra (Windows: `C:\xampp\htdocs`) através do terminal (Recomendado Git Bash)
2.  Clone o projeto na pasta utilizando `git clone https://github.com/eduardosaraujo1/2md2-pw-projeto-lanhouse`.
3.  Utilize o comando `composer build` para fazer o deploy do banco de dados. **AVISO: O COMANDO VAI APAGAR O BANCO DE DADOS PRÉ-EXISTENTE CASO EXISTA**
    -   As credenciais de acesso do banco de dados podem ser alteradas em [database.json](config/database.json)
    -   Se [composer](https://getcomposer.org/) não estiver instalado, digite `bin/build.bat` para fazer o deploy
    -   Se preferir fazer o deploy manualmente, utilize [script.sql](database/script.sql)
4.  Inicie o Apache Server pelo XAMPP Control
5.  O projeto deve estar disponivel em http://localhost:80/2md2-pw-projeto-lanhouse/
6.  Para fazer login, o usuário administrador possui as seguintes credenciais:
    -   E-mail: admin@lanhouse.org
    -   Senha: admin01

# Sobre o Projeto

## Descrição

Trata-se de um sistema para uma Lan House fictícia onde é controlado os funcionarios, clientes, fornecedores e as receitas da loja.

## Referências

-   [Design Figma do projeto](https://www.figma.com/design/PGKnYiHtQ5wEX7GWklSsVg/Projeto-LanHouse?node-id=0-1&t=JGkDWUHh2upO3IXY-1)
-   [Canva da Logo](https://www.canva.com/design/DAGL5--3MWw/aEQKmSfDH_Kinom0rT7OPQ/edit)

# Roadmap

-   [ ] Optional: categoria.php deveria utilizar fetch para pegar lista de categorias. Mesmo que o fetch falhe, é o mesmo que não tivesse cadastrado nenhuma categoria
-   [ ] (EDUARDO) Por todo o projeto, utilizei caminhos relativos ('../../login.php') para encontrar arquivos do aplicativo. Entretanto, seria interessante um modulo que, conhecendo sua localização atual e a URL atual, leia dinamicamente onde está a raiz do projeto. Permitindo o uso de um prefixo (basepath) para a raiz do projeto.
-   [ ] (EDUARDO) Em session, logon.php faz um require diretamente em conexao.php e response.php. Entretanto, é ideal separar a interação com o banco de dados desse arquivo, criando uma API (ou um funcionarios.php requirable) que possa ler os funcionarios a partir de seu email. Então, src deveria conter uma pasta separada para interações com o banco de dados (contendo insert, get e response.php), e o session (contendo check.php, logon.php e sair.php)

# Documentação (dev)

ESTRUTURA DE ARQUIVOS

```
project-root/
  .git/            # Git config
  assets/          # CSS, JavaScript, imagens, fonts
  build/           # Arquivos para deploy
  config/          # App config
  database/        # Arquivos de banco de dados
      php/
          deploy.php # Deploy do banco de dados utilizando PHP e Composer
      script.sql
      model.sql
  public/          # Páginas front-end
      index.php
      ...
  src/             # API banco de dados
      insert/...
      get/...
      modules/
          conexao.php
          erros.php
          sanitizar.php
          utils.php # String utils & Array utils
      session/...
      response.php # Garante resposta consistente da API
  templates/       # Arquivos padrões para paginas (navbar.php)
  vendor/          # Pacotes PHP
  .gitignore       # Arquivos ignorados pelo versionamento git
  composer.json    # Configurações de composer
```
