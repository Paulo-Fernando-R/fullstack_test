
## Como Rodar o Projeto

Este guia detalha os passos necessários para executar o projeto localmente. Certifique-se de ter o [Composer](https://getcomposer.org/) e o [Node.js](https://nodejs.org/) instalados em sua máquina.

### Configuração do Backend

1.  **Clonar o Repositório:**
    ```bash
    git clone [https://docs.github.com/en/repositories/archiving-a-github-repository/referencing-and-citing-content](https://docs.github.com/en/repositories/archiving-a-github-repository/referencing-and-citing-content)
    cd [nome do diretório do seu projeto]
    ```

2.  **Configurar o Arquivo de Ambiente:**
    * Duplique o arquivo `.env.example` localizado na raiz do projeto e renomeie a cópia para `.env`.
    * Abra o arquivo `.env` e substitua os valores padrão pelas credenciais do seu banco de dados MySQL:

        ```
        DB_CONNECTION=mysql
        DB_HOST=127.0.0.1
        DB_PORT=3306
        DB_DATABASE=laravel
        DB_USERNAME=root
        DB_PASSWORD=
        ```

        **Nota:** Se você não tiver uma senha para o seu banco de dados local, deixe `DB_PASSWORD` em branco.

3.  **Executar os Comandos do Backend:**
    Abra um terminal no diretório raiz do projeto e execute os seguintes comandos na ordem:

    ```bash
    composer install
    php artisan key:generate
    php artisan migrate
    php artisan products:import
    php artisan serve
    ```

    * `composer install`: Instala todas as dependências do backend definidas no arquivo `composer.json`.
    * `php artisan key:generate`: Gera uma chave de aplicação única.
    * `php artisan migrate`: Executa as migrations do banco de dados, criando as tabelas necessárias.
    * `php artisan products:import`: Importa registros de produtos utilizando a Fake Store API .
    * `php artisan serve`: Inicia o servidor de desenvolvimento do Laravel. Por padrão, a aplicação estará disponível em `http://127.0.0.1:8000`.

### Configuração do Frontend

1.  **Configurar o Arquivo de Ambiente do Frontend:**
    * Navegue até o diretório `frontend` dentro do seu projeto.
    * Duplique o arquivo `.env.example` e renomeie a cópia para `.env`.

2.  **Atualizar a URL do Backend:**
    * Abra o arquivo `.env` dentro do diretório `frontend`.
    * Localize a variável que define a URL do backend e substitua o valor padrão pelo endereço onde o seu backend está rodando. Geralmente, este valor é `http://127.0.0.1:8000`.

3.  **Executar os Comandos do Frontend:**
    Abra um novo terminal, navegue até o diretório `frontend` do seu projeto e execute os seguintes comandos:

    ```bash
    npm install
    npm run dev
    ```

    * `npm install`: Instala todas as dependências do frontend definidas no arquivo `package.json`.
    * `npm run dev`: Inicia o servidor de desenvolvimento do frontend. A URL onde a aplicação estará disponível será exibida no terminal (geralmente `http://localhost:3000` ou similar).

4.  **(Opcional) Gerar Arquivos Estáticos:**
    Para gerar os arquivos estáticos otimizados para produção, execute:

    ```bash
    npm run generate
    ```

