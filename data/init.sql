INSERT INTO `brands` (`name`)
VALUES ('BMW'),
       ('Toyota'),
       ('Mercedes-Benz');

INSERT INTO `models` (`name`)
VALUES ('X5'),
       ('732'),
       ('Land Cruiser Comfort'),
       ('C-Class');

INSERT INTO `credit_programs` (`title`, `interest_rate`)
VALUES ('Alfa Energy', 12.3),
       ('Sber Prime', 10.5),
       ('VTB Drive', 11.2);

-- BMW X5
-- BMW 732
-- Toyota Land Cruiser Comfort
-- Mercedes-Benz C-Class
INSERT INTO `cars` (`brand_id`, `model_id`, `photo`, `price`)
VALUES (1, 1, 'path/to/bmw_x5.jpg', 5500000),
       (1, 2, 'path/to/bmw_732.jpg', 7500000),
       (2, 3, 'path/to/toyota_land_cruiser.jpg', 5131000),
       (3, 4, 'path/to/mercedes_c_class.jpg', 4200000);