-- Running a query to see the values for Director in movies.
SELECT  Genre
FROM dbs_project.movies;

-- Getting the count of the values.
SELECT COUNT(Genre)
FROM dbs_project.movies;

-- Inserting all the names and movies into the table
INSERT INTO dbs_project.genre_movie (GenreID, MovieID_g)
SELECT m.MovieID, g.idgenre
FROM movies m
JOIN genre g ON m.Genre = g.genre;