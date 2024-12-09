-- Running a query to see the unique values for Genre in movies.
SELECT DISTINCT Genre
FROM dbs_project.movies;
/*
Distinct values are:
-Horror
-Documentary
-Drama
-Romance
-Fantasy
-Sci-Fi
-Thriller
-Comedy
-Action
-Adventure
*/
-- Getting the count of the distinct values, so I know how many ID counts.
SELECT COUNT(DISTINCT(Genre))
FROM dbs_project.movies;

-- Inerting these values into the genre table
INSERT INTO dbs_project.genre
VALUES
(1,"Horror"),
(2,"Documentary"),
(3,"Drama"),
(4,"Romance"),
(5,"Fantasy"),
(6,"Sci-Fi"),
(7,"Thriller"),
(8,"Comedy"),
(9,"Action"),
(10,"Adventure");





