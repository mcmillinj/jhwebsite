/Applications/MAMP/Library/bin/mysql --host=localhost -uroot -proot

DROP DATABASE cookguide;

CREATE DATABASE cookguide;

USE cookguide;

CREATE TABLE meal (
	 MEAL_KEY    INT
	,MEAL_NAME   VARCHAR(255)
	,FREQUENCY   INT
	,HEALTH      INT
	,PORTIONS    INT
);

CREATE TABLE ingredient (
	 INGREDIENT_KEY   INT
	,INGREDIENT_NAME  VARCHAR(255)
	,PRICE            INT
);

CREATE TABLE meal_ingredient_bridge (
	 MEAL_KEY         INT
	,INGREDIENT_KEY   INT
);

INSERT INTO meal VALUES (1, 'Chilli Con Carne', 5, 3, 4);
INSERT INTO meal VALUES (2, 'Spaghetti Bolognese', 3, 3, 4);
INSERT INTO meal VALUES (3, 'Pasta Verde', 4, 3, 4);
INSERT INTO meal VALUES (5, 'Chilli Risotto', 5, 3, 4);

INSERT INTO ingredient VALUES (1, 'Minced Beef 500g', 400);
INSERT INTO ingredient VALUES (2, 'Onion', 20);
INSERT INTO ingredient VALUES (3, 'Garlic', 30);
INSERT INTO ingredient VALUES (4, 'Chopped Tomatoes 400g', 50);
INSERT INTO ingredient VALUES (5, 'Beef Stock (goo pot)', 35);
INSERT INTO ingredient VALUES (6, 'Jalapenos 100g', 65);
INSERT INTO ingredient VALUES (7, 'Kidney Beans 400g', 50);
INSERT INTO ingredient VALUES (8, 'Carrots x2', 10);
INSERT INTO ingredient VALUES (9, 'Parmesan 100g', 135);
INSERT INTO ingredient VALUES (10, 'Red Wine (glass)', 100);
INSERT INTO ingredient VALUES (11, 'Spaghetti 500g', 100);
INSERT INTO ingredient VALUES (12, 'Broccoli', 40);
INSERT INTO ingredient VALUES (13, 'Chestnut Mushrooms 250g', 100);
INSERT INTO ingredient VALUES (14, 'Double Cream 300ml', 90);
INSERT INTO ingredient VALUES (15, 'White Wine (glass)', 100);
INSERT INTO ingredient VALUES (16, 'Pasta 500g', 100);
INSERT INTO ingredient VALUES (21, 'Risotto 350g', 80);
INSERT INTO ingredient VALUES (22, 'Tomato puree squeeze', 5);





INSERT INTO meal_ingredient_bridge VALUES (1, 1);
INSERT INTO meal_ingredient_bridge VALUES (1, 2);
INSERT INTO meal_ingredient_bridge VALUES (1, 3);
INSERT INTO meal_ingredient_bridge VALUES (1, 4);
INSERT INTO meal_ingredient_bridge VALUES (1, 5);
INSERT INTO meal_ingredient_bridge VALUES (1, 6);
INSERT INTO meal_ingredient_bridge VALUES (1, 7);
INSERT INTO meal_ingredient_bridge VALUES (2, 1);
INSERT INTO meal_ingredient_bridge VALUES (2, 2);
INSERT INTO meal_ingredient_bridge VALUES (2, 3);
INSERT INTO meal_ingredient_bridge VALUES (2, 4);
INSERT INTO meal_ingredient_bridge VALUES (2, 5);
INSERT INTO meal_ingredient_bridge VALUES (2, 8);
INSERT INTO meal_ingredient_bridge VALUES (2, 9);
INSERT INTO meal_ingredient_bridge VALUES (2, 10);
INSERT INTO meal_ingredient_bridge VALUES (2, 11);
INSERT INTO meal_ingredient_bridge VALUES (3, 3);
INSERT INTO meal_ingredient_bridge VALUES (3, 12);
INSERT INTO meal_ingredient_bridge VALUES (3, 13);
INSERT INTO meal_ingredient_bridge VALUES (3, 14);
INSERT INTO meal_ingredient_bridge VALUES (3, 15);
INSERT INTO meal_ingredient_bridge VALUES (3, 16);
INSERT INTO meal_ingredient_bridge VALUES (5, 2);
INSERT INTO meal_ingredient_bridge VALUES (5, 3);
INSERT INTO meal_ingredient_bridge VALUES (5, 4);
INSERT INTO meal_ingredient_bridge VALUES (5, 5);
INSERT INTO meal_ingredient_bridge VALUES (5, 13);
INSERT INTO meal_ingredient_bridge VALUES (5, 21);
INSERT INTO meal_ingredient_bridge VALUES (5, 22);

COMMIT;