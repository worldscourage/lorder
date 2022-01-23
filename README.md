# lorder

##start up

```cp .env.example .env```

```
docker-compose build && docker-compose up -d
docker exec lorderphp bash composer install
docker exec lorderphp bash php artisan migrate:fresh --seed
```

### api example

POST localhost:7777/api/order/create
country:FI
products:[{"cnt":2,"id":1}]
invoiceFormat:json
sendEmail:1
email:corn@ma.is

### tests running

```
docker exec lorderphp php artisan test
```