# Meu CEP

Projeto PHP para consulta de CEP.

## Estrutura do Projeto

.htaccess
app/
  ├─ controller/
  │   ├─ BuscaController.php
  │   └─ HomeController.php
  ├─ model/
  │   └─ CepModel.php
  └─ view/
      └─ home.php
composer.json
config/
  └─ config.php
core/
  └─ router.php
package.json
public/
  ├─ assets/
  │   ├─ css/
  │   │   ├─ output.css
  │   │   ├─ style.css
  │   │   └─ tailwindcss.css
  │   └─ js/
  │       ├─ cep.js
  │       └─ script.js
  └─ index.php

## Deploy

- **GitHub**: O projeto será versionado no GitHub em [https://github.com/brunoleocam/meu_cep.git](https://github.com/brunoleocam/meu_cep.git).  
- **GitHub Pages**: Caso pretenda servir conteúdos estáticos (por exemplo, a pasta `public/`), poderá utilizar o GitHub Pages. Configure a branch `gh-pages` (ou a pasta desejada) nas configurações do repositório.
- **Vercel**: Você pode criar um projeto na Vercel e fazer o deploy do seu projeto, inclusive configurando as rotas e os arquivos de build conforme necessário.

## Instruções para iniciar

1. Clone o repositório:

   ```sh
   git clone https://github.com/brunoleocam/meu_cep.git
   ```

2. Instale as dependências (via Composer e NPM se necessário):

    ```sh
    composer install
    npm install
    ```

3. Execute o projeto localmente (configurar o servidor PHP para apontar para a pasta public/).

