-- Running a query to see the values for Director in movies.
SELECT  Director
FROM dbs_project.movies;

-- Getting the count of the values.
SELECT COUNT(Director)
FROM dbs_project.movies;
/*
--
--
*/

-- Inserting all the distinct names into the table
INSERT INTO dbs_project.director 
SELECT  d.iddirector, m.MovieID
FROM dbs_project.movies m
JOIN dbs_project.director d ON m.Director =d.name;