# Guia de inicialização

## Execute os seguintes comandos

git clone https://github.com/orlandocoelhoo/multi-adquirencia-laravel.git

cd multi-adquirencia-laravel

composer install

cp .env.example .env

php artisan key:generate

Edite os dados de conexão com o banco de dados no arquivo .env com o editor de sua escolha!
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=multi_adquirencia_laravel
DB_USERNAME=root
DB_PASSWORD=

npm install
npm run build

php artisan app:setup-test

php artisan serve

Acessando http://locahost:8000 no navegador você tera acesso a pagina para simulação de pagamento com multi-adquirentes!

## Breve explicação do projeto

Tem o arquivo multi-adquirencia-laravel.postman_collection.json onde contem todas as rotas de api criadas para o postman.

Todas estrutura de regras de negocios esta na pasta src/core.
Controllers da api estão na pasta app/Http/Controllers/Api.
As rotas estão em routes/api.php.
Arquivos de conexão com Api de terceiros fica em app/Rest

A ideia do projeto foi demonstrar meu conhecimento na estruturação e criação de uma processo simples de checkout com multi-adquirencia!
Não foi utilizado APIs reais, apenas demonstração da ideia de como seria desenvolvido.
