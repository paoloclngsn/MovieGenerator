-- Running a query to see the values for Rating in movies.
SELECT Rating
FROM dbs_project.movies;

-- Getting the count of the values.
SELECT COUNT(Rating)
FROM dbs_project.movies;
/*
-- The distinct values are too much to copy and paste individually, so I need to create a query to do so.
-- According to the query above there are '91' unique values.
*/

/*
-- Have to create a calculated field/column to insert star ratings.
-- Number has to be divided by two
-- Inserting all the ratings into the table
-- Calculating and Inserting all stars into the table
*/
-- Inserting all the distinct ratings into the table
DELETE FROM dbs_project.ratings
WHERE idratings >= 0;

INSERT INTO dbs_project.ratings (MovieID, rating, stars)
SELECT 
MovieID,
Rating,
 (rating DIV 2.0)*1.0 -- Tried to get rid of 0 star entries, but couldn't.  
FROM dbs_project.movies;
