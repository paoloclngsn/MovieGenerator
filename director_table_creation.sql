-- Running a query to see the unique values for Director in movies.
SELECT DISTINCT Director
FROM dbs_project.movies;

-- Getting the count of the distinct values.
SELECT COUNT(DISTINCT(Director))
FROM dbs_project.movies;
/*
-- The distinct values are too much to copy and paste individually, so I need to create a query to do so.
-- According to the query above there are '25844' unique values.
*/

-- Inserting all the distinct names into the table
INSERT INTO dbs_project.director (name)
SELECT DISTINCT Director
FROM dbs_project.movies;