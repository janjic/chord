# chord
UPITI ZA STRUKTURU
mysql -uroot -proot test_chord < final_chord_test.sql
UPDATE schools SET postcode_id = NULL WHERE postcode_id = 0;
UPDATE schools SET postcode_id = NULL WHERE postcode_id NOT IN (SELECT id FROM postcodes);
UPDATE addresses SET postcode_id = NULL WHERE postcode_id NOT IN (SELECT id FROM postcodes)


UPDATE users INNER JOIN
(SELECT users.id as id, COUNT(likes.a) as num, GROUP_CONCAT(DISTINCT likes.b) as ids
FROM users INNER JOIN likes ON users.id = likes.a 
GROUP BY users.id) subQuery  ON users.id = subQuery.id
SET num_lgiven = subQuery.num, like_ids = CONCAT("",subQuery.ids, """);


UPDATE houses 
INNER JOIN (SELECT COUNT(DISTINCT people.id) as num_of_people,SUM(CASE WHEN people.age>45 AND people.sex LIKE 'M' THEN 1 ELSE 0 END) as num_of_old_man, houses.id as id FROM houses INNER JOIN users ON houses.user_id = users.id INNER JOIN people on people.user_id = users.id GROUP BY houses.id) as sub ON houses.id = sub.id SET houses.num_of_people = sub.num_of_people, houses.num_of_old_man = sub.num_of_old_man;

#Linkovi i upiti

/**
SELECT latitude, longitude, SQRT( POW(69.1 * (latitude - 57.2377), 2) + POW(69.1 * (-2.26581 - longitude) * COS(latitude / 57.3), 2)) AS distance FROM postcodes HAVING distance < 10 ORDER BY distance LIMIT 0,5

 */

//SELECT SUBSTRING_INDEX(postcode, ' ', 1) as first_part, postcode, latitude, longitude FROM postcodes

//https://gis.stackexchange.com/questions/31628/find-points-within-a-distance-using-mysql
//https://stackoverflow.com/questions/2234204/latitude-longitude-find-nearest-latitude-longitude-complex-sql-or-complex-calc
/**

 *
 * Here latitude = 37 & longitude = -122. So you just pass your own.

SELECT * FROM postcodes ORDER BY ABS(ABS(latitude-57.1766) + ABS(longitude-2.18435)) ASC LIMIT 5

 */


/**
 *
https://stackoverflow.com/questions/2234204/latitude-longitude-find-nearest-latitude-longitude-complex-sql-or-complex-calc

 set @my_lat=34.6087674878572;
 set @my_lng=58.3783670308302;
set @dist=10; #10 miles radius

SELECT dest.id, dest.lat, dest.lng,  3956 * 2 * ASIN(SQRT(POWER(SIN((@my_lat -abs(dest.lat)) * pi()/180 / 2),2) + COS(@my_lat * pi()/180 ) * COS(abs(dest.lat) *  pi()/180) * POWER(SIN((@my_lng - abs(dest.lng)) *  pi()/180 / 2), 2))
) as distance
FROM hotel as dest
having distance < @dist
ORDER BY distance limit 10;
 */
