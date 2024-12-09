-- Running a query to see the values for Director in movies.
SELECT  Director
FROM dbs_project.movies;

-- Getting the count of the values.
SELECT COUNT(Director)
FROM dbs_project.movies;

-- Inserting all the names and movies into the table
INSERT INTO dbs_project.director_movie (MovieID_d, DirectorID)
SELECT m.MovieID, d.iddirector
FROM movies m
JOIN director d ON m.Director = d.`name`;