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
docker compose up -d --build

# Container
docker exec -it tradedealer_php-fpm /bin/bash
```

## Composer
```bash  
docker exec -it tradedealer_php-fpm composer install
```