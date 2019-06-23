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

Import db from [database/db_ota.sql](https://github.com/dedensmkn4/ci-rest/tree/master/database)

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
## Documentation API
1. List Ticket
&nbsp;[http://localhost:9090/ci-rest/api/tiket](http:9090//localhost/ci-rest/api/tiket) | GET
2. Booking Ticket
[http://localhost:9090/ci-rest/api/booking](http://localhost:9090/ci-rest/api/booking) | POST

## Flow & Technology
1. Show data ticket with stock available [http://localhost:9090/ci-rest](http:9090//localhost/ci-rest) with rest service and secure id token change with code_ticket random string and save code_ticket in redis. Code ticket is a unique every reload and can be used once and will expired in 1 hour 
2. Booking ticket with code ticket selected. Required field name, the birth of date and email. validation in front and backend email, format date and code ticket must available. Process in backend save code ticket, code booking, id booking, id ticket, code ticket, name, email, the birth of date to Redis. Save id booking, id ticket, email to MySql. If code ticket is available in the ticket will be processed. Decrement stock. Send email to the user will be processed with the asynchronous method. In backend will be sent queue to rabbitmq with message code booking.
3. service [http:9090//localhost/ci-rest/api/consume](http:9090//localhost/ci-rest/api/consume) will consume message queue rabbitmq. Use message(code booking) to select data in Redis to get detail information and service will be sent email to user email

## License
[Deden Farhan](mailto:deden@swamedia.co.id)