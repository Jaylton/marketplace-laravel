# Marketplace Laravel com PagSeguro
Este projeto é um marketplace desenvolvido com Laravel 6, integrado com o Transparent Checkout do PagSeguro para processamento de pagamentos de forma segura e eficiente.

## Funcionalidades
 - **Gerenciamento de Produtos**: Criação, edição e exclusão de produtos pelos vendedores.
 - **Carrinho de Compras**: Adicione produtos ao carrinho, veja o resumo e prossiga para o pagamento.
 - **Checkout Transparente com PagSeguro**: Integração com o PagSeguro para processar pagamentos sem redirecionar o usuário para fora do site.
 - **Administração de Usuários**: Sistema de cadastro, login e gerenciamento de vendedores e compradores.
 - **Painel de Controle**: Dashboard para administradores gerenciarem o marketplace (usuários, produtos e pedidos).

## Tecnologias Utilizadas
 - **Laravel 6**: Framework PHP para desenvolvimento do backend.
 - **MySQL**: Banco de dados relacional usado para armazenar dados de usuários, produtos e pedidos.
 - **PagSeguro Transparent Checkout**: Para processar pagamentos diretamente no site sem redirecionamento.
 - **HTML/CSS/JS**: Usado para criar o frontend do marketplace.

## Pré-requisitos
Antes de começar, certifique-se de ter as seguintes ferramentas instaladas:
- PHP >= 7.2
- Composer
- MySQL
- Node.js e NPM (para gerenciamento de dependências do frontend)

## Instalação
1. Clone o repositório:
    ```
    git clone https://github.com/Jaylton/marketplace-laravel.git
    cd marketplace-laravel
    ```

2. Instale as dependências do PHP:
    ```
    composer install
    ```

3. Instale as dependências do frontend:
    ```
    npm install
    ```

3. Configure o arquivo .env com suas credenciais de banco de dados e do PagSeguro:
    ```
    cp .env.example .env
    ```
    
4. Atualize as seguintes variáveis no arquivo .env com suas credenciais:
    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=seu_banco
    DB_USERNAME=seu_usuario
    DB_PASSWORD=sua_senha

    PAGSEGURO_EMAIL=seu-email@exemplo.com
    PAGSEGURO_TOKEN=seu-token-pagseguro
    PAGSEGURO_ENV=production # ou sandbox para ambiente de testes
    ```

5. Gere a chave da aplicação Laravel:
    ```
    php artisan key:generate
    ```
    
6. Execute as migrações e seeders do banco de dados:
    ```
    php artisan migrate --seed
    ```

7. Inicie o servidor de desenvolvimento:

    ```
    php artisan serve
    ```

## Integração com PagSeguro Transparent Checkout
Este projeto utiliza a integração do Transparent Checkout do PagSeguro, que permite processar pagamentos diretamente no seu site sem redirecionar os clientes. A integração é feita da seguinte forma:

1. **Tokenização do Cartão**: No frontend, o PagSeguro coleta os dados do cartão de crédito e gera um token, que é enviado ao backend.
2. **Envio do Pedido**: O token do cartão é enviado ao backend, onde a transação é finalizada através da API do PagSeguro.
3. **Status do Pagamento**: O backend recebe o status da transação e o atualiza no sistema.

## Configuração no PagSeguro
1. Acesse o painel do PagSeguro.
2. Ative o Transparent Checkout.
3. No ambiente sandbox, use as credenciais de teste para simular transações.

## Referência de Documentação
 - PagSeguro API Reference
 - Laravel PagSeguro Package (opcional, caso você use um pacote para facilitar a integração)

## Estrutura do Projeto
 - **app/**: Contém os controladores, modelos e lógica de negócios do Laravel.
 - **resources/views/**: Arquivos Blade para a interface do usuário.
 - **routes/web.php**: Arquivo de rotas da aplicação.
 - **public/js/**: Scripts JavaScript relacionados ao PagSeguro Transparent Checkout.
 - **database/**: Migrações e seeders do banco de dados.
 
 
