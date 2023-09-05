# recipe-app
 Desafio STW

# Instruções
1 - Ajustar as configurações da base de dados
        DB_CONNECTION=mysql
        DB_HOST=127.0.0.1
        DB_PORT=3306
        DB_DATABASE=INSERIR NOME
        DB_USERNAME=root
        DB_PASSWORD=INSERIR SENHA SE NECESSÁRIO

2 - Confirmar se as dependências vue-router e vue-axios estão instaladas, se não instalar elas com:
        npm install vue-router vue-axios --save
3 - Migrar a base de dados com o seguinte comando:
        php artisan migrate

4 - Rodar o comando para iniciar o servidor com o comando:
        php artisan serve


OBS:
    O computador tem que ter o Mysql server instalado para que seja possível criar a base de dados e inserir as tabelas nela.
    O computador tem que estar com os seguintes softwares instalados:
        PHP 8.0 ou maior
        Composer
        Laravel 10
        Node.js and npm
