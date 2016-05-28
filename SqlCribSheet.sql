--SQL Crib Sheet

--How to connect

/Applications/MAMP/Library/bin/mysql --host=localhost -uroot -proot

--How to view databases

SHOW DATABASES;

--How to use a database

USE DATABASE_NAME;

--How to view a list of tables in the database

SHOW TABLES;

--How to describe the structure of a table

DESC test_table;

--How to delete a table

DROP TABLE test_table;

--How to create a table

CREATE TABLE test_table (column_1 INT, column_2 VARCHAR(255), column_3 INT);

--How to add a row to a table

INSERT INTO test_table VALUES (value_1, value_2, value_3);

--How to select data from a table

SELECT column_1, column_2 FROM test_table WHERE column_3 = 5;

--How to select all columns from a table

SELECT * FROM test_table;

--How to change values in a table - very important to use a WHERE here!

UPDATE test_table SET column_1 = 10 WHERE column_1 = 0;

--How to add a column to a table

ALTER TABLE test_table ADD column_4 INT;

--How to remove a column from a table

ALTER TABLE test_table DROP COLUMN column_4;


--Here's an example of how you can structure a query!
--SELECT SUM(i.price)
--FROM   meal m 
--JOIN   meal_ingredient_bridge mib 
--ON     m.meal_key = mib.meal_key 
--JOIN   ingredient i 
--ON     mib.ingredient_key = i.ingredient_key
--WHERE  m.meal_name = 'Chilli Con Carne';



--How to delete rows from a table - very important to use a WHERE here!

DELETE FROM test_table WHERE column_1 = 1;


