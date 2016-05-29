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
INSERT INTO meal VALUES (4, 'Spanish Stew', 5, 4, 4);
INSERT INTO meal VALUES (5, 'Chilli Risotto', 5, 3, 4);
INSERT INTO meal VALUES (6, 'Salmon, Kale and Mash', 5, 5, 2);
INSERT INTO meal VALUES (7, 'Bibimbap', 2, 3, 2);

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
INSERT INTO ingredient VALUES (17, 'Green Olives 340g', 75);
INSERT INTO ingredient VALUES (18, 'Chicken Breast 300g', 250);
INSERT INTO ingredient VALUES (19, 'Chorizo Ring 225g', 250);
INSERT INTO ingredient VALUES (20, 'Butter Beans 400g', 50);
INSERT INTO ingredient VALUES (21, 'Risotto 350g', 80);
INSERT INTO ingredient VALUES (22, 'Tomato puree squeeze', 5);
INSERT INTO ingredient VALUES (23, 'Salmon Fillets 270g', 300);
INSERT INTO ingredient VALUES (24, 'Maris Piper Potatoes 800g', 65);
INSERT INTO ingredient VALUES (25, 'Butter 25g', 15);
INSERT INTO ingredient VALUES (26, 'Kale 200g', 100);
INSERT INTO ingredient VALUES (27, 'Blue Dragon Sauce', 65);
INSERT INTO ingredient VALUES (28, 'Rice 1.5 cup', 40);
INSERT INTO ingredient VALUES (29, 'Stir-fry veg 320g', 100);
INSERT INTO ingredient VALUES (30, 'Gochujang 2 scoops', 25);
INSERT INTO ingredient VALUES (31, 'Sesame oil 4 tbsp', 25);
INSERT INTO ingredient VALUES (32, 'Soy sauce 2 tbsp', 10);

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
INSERT INTO meal_ingredient_bridge VALUES (4, 2);
INSERT INTO meal_ingredient_bridge VALUES (4, 3);
INSERT INTO meal_ingredient_bridge VALUES (4, 4);
INSERT INTO meal_ingredient_bridge VALUES (4, 4);
INSERT INTO meal_ingredient_bridge VALUES (4, 17);
INSERT INTO meal_ingredient_bridge VALUES (4, 18);
INSERT INTO meal_ingredient_bridge VALUES (4, 19);
INSERT INTO meal_ingredient_bridge VALUES (4, 20);
INSERT INTO meal_ingredient_bridge VALUES (5, 2);
INSERT INTO meal_ingredient_bridge VALUES (5, 3);
INSERT INTO meal_ingredient_bridge VALUES (5, 4);
INSERT INTO meal_ingredient_bridge VALUES (5, 5);
INSERT INTO meal_ingredient_bridge VALUES (5, 13);
INSERT INTO meal_ingredient_bridge VALUES (5, 21);
INSERT INTO meal_ingredient_bridge VALUES (5, 22);
INSERT INTO meal_ingredient_bridge VALUES (6, 3);
INSERT INTO meal_ingredient_bridge VALUES (6, 23);
INSERT INTO meal_ingredient_bridge VALUES (6, 24);
INSERT INTO meal_ingredient_bridge VALUES (6, 25);
INSERT INTO meal_ingredient_bridge VALUES (6, 26);
INSERT INTO meal_ingredient_bridge VALUES (6, 27);
INSERT INTO meal_ingredient_bridge VALUES (7, 28);
INSERT INTO meal_ingredient_bridge VALUES (7, 29);
INSERT INTO meal_ingredient_bridge VALUES (7, 30);
INSERT INTO meal_ingredient_bridge VALUES (7, 31);
INSERT INTO meal_ingredient_bridge VALUES (7, 32);

COMMIT;