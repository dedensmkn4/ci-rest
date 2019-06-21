# OTA Simple with CI + Redis + RabbitMq + Mysql + Docker Compose

Rest API OTA Simple.

## Installation

1. With Docker

```bash
docker-compose up -d
```
```bash
docker ps
```
```bash
docker-compose exec {mysql container name} bash
```
```bash
mysql -u root -p
```
```bash
root
```

Import db from [database/db_ota.sql](https://github.com/dedensmkn4/ci-rest/database)

2. With Manual

```bash
composer install
```

3. Download requirement
4. [Open RabbitMq](http://localhost:15672/#/queues) 
```bash
username:password = guest:guest
```
```
Create queue data_inquiry 
```
5. Running consume queue for send [email](http://localhost/ci-rest/api/consume)
## Requirement
1. download RabbitMq
2. download Redis 

## Configuration
 1. Config db
```bash
application/config/database.php
```
 2. Config redist
```bash
application/modules/api/config/codeigniter-predis.php
```
 3. Rabbit mq
```bash
application/modules/api/config/rabbitmq.php
```

## License
[Deden Farhan](mailto:deden@swamedia.co.id)