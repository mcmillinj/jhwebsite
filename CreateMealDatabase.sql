/Applications/MAMP/Library/bin/mysql --host=localhost -uroot -proot

DROP DATABASE cookguide;

CREATE DATABASE cookguide;

USE cookguide;

CREATE TABLE meal (
	 MEAL_KEY    INT
	,MEAL_NAME   VARCHAR(255)
	,PORTIONS    INT
);

CREATE TABLE ingredient (
	 INGREDIENT_KEY   INT
	,INGREDIENT_NAME  VARCHAR(255)
	,PRICE            INT
	,KCAL             INT
	,FAT              INT
	,SATFAT           INT
	,CARB             INT
	,SUGAR            INT
	,FIBRE            INT
	,PROTEIN          INT
);

CREATE TABLE meal_ingredient_bridge (
	 MEAL_KEY         INT
	,INGREDIENT_KEY   INT
);

INSERT INTO meal VALUES (1, 'Chilli Con Carne', 4);
INSERT INTO meal VALUES (2, 'Spaghetti Bolognese', 4);
INSERT INTO meal VALUES (3, 'Pasta Verde', 4);
INSERT INTO meal VALUES (4, 'Spanish Stew', 4);
INSERT INTO meal VALUES (5, 'Chilli Risotto', 4);
INSERT INTO meal VALUES (6, 'Salmon, Kale and Mash', 2);
INSERT INTO meal VALUES (7, 'Bibimbap', 2);
INSERT INTO meal VALUES (8, 'Pad Thai', 4);

INSERT INTO ingredient VALUES (1, 'Lean Minced Beef 500g', 400, 620, 22, 10, 0, 0, 0, 104);
INSERT INTO ingredient VALUES (2, 'Onion', 15, 80, 0, 0, 16, 13, 3, 2);
INSERT INTO ingredient VALUES (3, 'Garlic (half)', 15, 15, 0, 0, 5, 0, 0, 1);
INSERT INTO ingredient VALUES (4, 'Chopped Tomatoes 400g', 50, 100, 1, 0, 16, 16, 4, 6);
INSERT INTO ingredient VALUES (5, 'Beef Stock (goo pot)', 35, 60, 2, 1, 6, 1, 0, 1);
INSERT INTO ingredient VALUES (6, 'Jalapenos 100g', 65, 16, 1, 0, 1, 1, 0, 0);
INSERT INTO ingredient VALUES (7, 'Kidney Beans 400g', 50, 280, 1, 0, 43, 9, 15, 17);
INSERT INTO ingredient VALUES (8, 'Carrots x2', 10, 42, 0, 0, 8, 7, 2, 1);
INSERT INTO ingredient VALUES (9, 'Parmesan 100g', 135, 402, 30, 20, 0, 0, 0, 32);
INSERT INTO ingredient VALUES (10, 'Red Wine (glass)', 100, 125, 0, 0, 4, 1, 0, 0);
INSERT INTO ingredient VALUES (11, 'Spaghetti 500g', 100, 790, 5, 1, 155, 3, 10, 30);
INSERT INTO ingredient VALUES (12, 'Broccoli', 40, 127, 3, 1, 6, 5, 9, 15);
INSERT INTO ingredient VALUES (13, 'Chestnut Mushrooms 250g', 100, 40, 1, 0, 1, 0, 2, 4);
INSERT INTO ingredient VALUES (14, 'Double Cream 300ml', 90, 1400, 150, 95, 5, 5, 0, 5);
INSERT INTO ingredient VALUES (15, 'White Wine (glass)', 100, 125, 0, 0, 4, 1, 0, 0);
INSERT INTO ingredient VALUES (16, 'Pasta 500g', 100, 790, 5, 1, 155, 3, 10, 30);
INSERT INTO ingredient VALUES (17, 'Green Olives 340g', 75, 228, 21, 4, 6, 0, 4, 1);
INSERT INTO ingredient VALUES (18, 'Chicken Breast 300g', 250, 318, 3, 1, 0, 0, 0, 72);
INSERT INTO ingredient VALUES (19, 'Chorizo Ring 225g', 250, 1035, 88, 34, 5, 2, 1, 55);
INSERT INTO ingredient VALUES (20, 'Butter Beans 400g', 50, 210, 1, 0, 31, 3, 11, 14);
INSERT INTO ingredient VALUES (21, 'Risotto 350g', 80, 1222, 1, 0, 274, 1, 3, 26);
INSERT INTO ingredient VALUES (22, 'Tomato puree squeeze', 5, 15, 0, 0, 3, 3, 0, 1);
INSERT INTO ingredient VALUES (23, 'Salmon Fillets 270g', 300, 600, 38, 5, 0, 0, 0, 64);
INSERT INTO ingredient VALUES (24, 'Maris Piper Potatoes 800g', 65, 1744, 54, 1, 273, 7, 27, 29);
INSERT INTO ingredient VALUES (25, 'Butter 25g', 15, 180, 20, 13, 0, 0, 0, 0);
INSERT INTO ingredient VALUES (26, 'Kale 200g', 100, 100, 2, 0, 20, 0, 4, 6);
INSERT INTO ingredient VALUES (27, 'Blue Dragon Sauce', 65, 195, 1, 0, 46, 40, 0, 0);
INSERT INTO ingredient VALUES (28, 'Sushi Rice 1.5 cup', 40, 1028, 1, 0, 226, 0, 8, 20);
INSERT INTO ingredient VALUES (29, 'Stir-fry veg 320g', 100, 128, 4, 0, 13, 9, 5, 7);
INSERT INTO ingredient VALUES (30, 'Gochujang 2 scoops', 25, 80, 0, 0, 18, 18, 2, 2);
INSERT INTO ingredient VALUES (31, 'Sesame oil 4 tbsp', 25, 540, 60, 9, 0, 0, 0, 0);
INSERT INTO ingredient VALUES (32, 'Soy sauce 2 tbsp', 10, 10, 0, 0, 2, 2, 0, 0);
INSERT INTO ingredient VALUES (33, 'Glass Noodles 500g', 200, 1750, 0, 0, 430, 0, 3, 1);
INSERT INTO ingredient VALUES (34, 'Beansprouts 300g', 50, 130, 8, 0, 6, 6, 5, 7);
INSERT INTO ingredient VALUES (35, 'Salted Peanuts 100g', 24, 596, 48, 6, 10, 7, 10, 26);
INSERT INTO ingredient VALUES (36, 'Spring Onion 50g', 25, 16, 0, 0, 4, 1, 1, 1);
INSERT INTO ingredient VALUES (37, 'Lime', 35, 20, 0, 0, 7, 1, 2, 1);
INSERT INTO ingredient VALUES (38, 'Fish Sauce 120ml', 25, 64, 0, 0, 2, 2, 0, 11);


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
INSERT INTO meal_ingredient_bridge VALUES (8, 33);
INSERT INTO meal_ingredient_bridge VALUES (8, 34);
INSERT INTO meal_ingredient_bridge VALUES (8, 35);
INSERT INTO meal_ingredient_bridge VALUES (8, 36);
INSERT INTO meal_ingredient_bridge VALUES (8, 37);
INSERT INTO meal_ingredient_bridge VALUES (8, 37);
INSERT INTO meal_ingredient_bridge VALUES (8, 38);


COMMIT;