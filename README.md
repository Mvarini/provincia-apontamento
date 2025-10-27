## Requisitos

* PHP 8.2 ou superior - Conferir a versão: php -v
* Composer - Conferir a instalação: composer -v
* Node. js 22 ou superior - Conferir a versão: node -v
* GIT - Conferir se está instalado: git -v

## Como rodar o projeto baixado
- Duplicar o arquivo .env.example para .env
* Instalar as dependências do PHP.
```
composer install
```
Instalar as dependências do Node.js
```
npm install
```
Gerar a chave no arquivo .env
```
php artisan key:generate
```
Alterar a conexão para o mysql
* De
```
DB_CONNECTION=sqlite
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=laravel
# DB_USERNAME=root
# DB_PASSWORD=
```
* Para
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=provincia_apontamento
DB_USERNAME=root
DB_PASSWORD=
```
Iniciar o projeto criado com laravel
```
php artisan serve
```
Executar as bibliotecas do Node.js modo desenvolvimento
```
npm run dev
```
Executar as bibliotecas do Node.js modo produção
```
npm run build
```
Acessar a página criada pelo laravel
```
http://127.0.0.1:8000
```
Exceutar as migration inicias do projeto para gerar o banco de dados
```
php artisan migrate
```
Instalar o bootstrap com Vite
```
Instalar o vite, mas instalamos anteriormente com o comando npm install
```
```
npm i --save bootstrap @popperjs/core
```
```
npm i --save-dev sass
```
## Renomear pastas e arquivos css
* Dentro da pasta resources

```
Renomear a pasta css para scss
```
```
Renomear  o arquivo app.css para app.scss
```
## Importar o bootstrap
* Adicione em resources->js->app.js
```
import 'bootstrap';
````
* Adicione em resources->scss->app.scss
```
@import 'bootstrap';
```
