# Integrantes

-   Eduardo Soares e Araújo
-   Gian Pablo Benvive Torres

# Como utilizar (XAMPP)

1.  Acesse a pasta onde seu website se encontra (Windows: `C:\xampp\htdocs`) através do terminal (Recomendado Git Bash)
2.  Clone o projeto na pasta utilizando `git clone https://github.com/eduardosaraujo1/2md2-pw-projeto-lanhouse`.
3.  Caso tenha [composer](https://getcomposer.org/) instalado, utilize o comando `composer build` para fazer o deploy do banco de dados
    -   Se preferir por um deploy manual, utilize o arquivo [script.sql](database/script.sql)
    -   No caso de um erro no comando build, tente o alternativo `composer build-global`.
    -   Para alterar os parametros do banco de dados, veja o arquivo [database.json](./config/database.json);
4.  Inicie o Apache Server pelo XAMPP Control
5.  O projeto deve estar disponivel em http://localhost:80/2md2-pw-projeto-lanhouse
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

-   [ ] (EDUARDO) OPCIONAL - Implementar nixpacks no projeto para deploy em Railway

# Documentação (dev)

ESTRUTURA DE ARQUIVOS

```
project-root/
  .git/            # Git config
  assets/          # CSS, JavaScript, imagens, fonts
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
