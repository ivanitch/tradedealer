# TradeDealer

![Debian](https://img.shields.io/badge/Debian-12-A81D33?logo=debian&logoColor=white)
![Docker](https://img.shields.io/badge/Docker-28.1-2496ED?logo=docker&logoColor=white)
![Yii2](https://img.shields.io/badge/Yii2-2.0-83B81A?logo=yii&logoColor=white)
![Nginx](https://img.shields.io/badge/Nginx-1.29-009639?logo=nginx&logoColor=white)
![PHP-FPM](https://img.shields.io/badge/PHP_FPM-8.4-777BB4?logo=php&logoColor=white)
![MariaDB](https://img.shields.io/badge/MariaDB-11.8-003545)

## Установка
```bash
git clone git@github.com:ivanitch/tradedealer.git tradedealer
```

## Docker
```bash  
# Собрать и запустить контейнеры 
docker compose up -d --build

# Запустить контейнеры 
docker compose up -d

# Container
docker exec -it tradedealer_php-fpm /bin/bash
```

## Composer
```bash  
docker exec -it tradedealer_php-fpm composer install
```

## Миграции
```bash
docker exec -it tradedealer_php-fpm php yii migrate
```
> Можно взять первоначальные тестовые данные в файле `data/init.sql`

## API

Список автомобилей:
```bash
http://localhost/api/v1/cars
```
ANSWER:
```bash
[
  {
    "id": 1,
    "brand": {
        "id": 1,
        "name": "BMW"
    },
    "model": {
        "id": 1,
        "name": "X5"
    },
    "photo": "path/to/bmw_x5.jpg",
    "price": 5500000
  }
  # ...
]
```

Авто с детализированной информацией
```bash
http://localhost/api/v1/cars/3
```
ANSWER:
```bash
{
    "id": 2,
    "brand": {
        "id": 1,
        "name": "BMW"
    },
    "model": {
        "id": 2,
        "name": "732"
    },
    "photo": "path/to/bmw_732.jpg",
    "price": 7500000
}
```


```bash
{
    "programId": 1,
    "interestRate": 12.3,
    "monthlyPayment": 25682,
    "title": "Alfa Energy"
}
```



