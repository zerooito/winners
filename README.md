<p align="center">
  <img src="http://www.ciawn.com.br/images/logo.png" width="200" alt="Front-end Brasil">
</p>
<br>

## Build Status

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/reginaldojunior/winners/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/reginaldojunior/winners/?branch=master) [![Build Status](https://scrutinizer-ci.com/g/reginaldojunior/winners/badges/build.png?b=master)](https://scrutinizer-ci.com/g/reginaldojunior/winners/build-status/master) 

## Dependências

 - Git
 - PHP 5.6
 - Mysql 5
 - Composer

`ou`

 - Git
 - Docker
 - Docker Composer

## Instalação Local

```
git clone https://github.com/ciawn/winners.git
cp app/Config/database.example.php app/Config/database.php
composer install
cd app/webroot && php -S localhost:8000
```

## Instalar utilizando o Docker

Para instalar o projeto utilizando o Docker. Utilize os seguintes comandos.

```
git clone https://github.com/ciawn/winners.git
docker-compose build
docker-compose up -d
docker-compose run --rm web cp app/Config/database.php.default app/Config/database.php
docker-compose run --rm web bash
mkdir app/webroot/uploads && mkdir app/tmp
chmod 777 -R app/webroot/uploads app/tmp
```

## Contribuindo


Basta abrir pull request com sua sugestão ou criar issue reportando bugs.

Para dúvidas acesse a Wiki.
