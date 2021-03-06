<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\DBAL\Driver\Connection;

class ApiController extends AbstractController
{
    /**
     * @param Connection $connection
     * @param                                  $id
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function api(Connection $connection, $id)
    {
        $data = [];

        $id = intval($id);
        $latLangQuery = 'SELECT latitude, longitude FROM postcodes WHERE id=?';
        $stm = $connection->prepare($latLangQuery);
        $stm->bindValue('1', $id);
        $stm->execute();

        $result = $stm->fetch();

        if ($result) {
          $latitude = $result['latitude'];
          $longitude = $result['longitude'];

            $bussStopsQuery = '
        SELECT name FROM busstops ORDER BY ABS(ABS(lat-:lat) + ABS(lon-:long)) ASC LIMIT 5
        ';
            $stm = $connection->prepare($bussStopsQuery);
            $stm->bindValue('lat', $latitude);
            $stm->bindValue('long', $longitude);
            $stm->execute();
            $results = $stm->fetchAll();
            $bussStops = '';

            foreach ($results as $result) {
                $bussStops = $bussStops.$result['name'].',';
            }

            $data['bussStops'] = $bussStops?$bussStops:'/';

            $schoolsQuery = '
            SELECT
              name, (
                3959 * acos (
                    cos ( radians(:lat) )
                    * cos( radians( latitude ) )
                    * cos( radians( longitude ) - radians(:long) )
                    + sin ( radians(57.1896) )
                    * sin( radians( :lat ) )
                )
            ) AS distance
            FROM schools INNER JOIN postcodes ON schools.postcode_id = postcodes.id
            HAVING distance < 10
            ORDER BY distance
        ';
            $stm = $connection->prepare($schoolsQuery);
            $stm->bindValue('lat', $latitude);
            $stm->bindValue('long', $longitude);
            $stm->execute();
            $results = $stm->fetchAll();
            $schools = '';

            foreach ($results as $result) {
                $schools = $schools.$result['name'].',';
            }

            $data['schools'] = $schools?$schools:'/';


            $addressQuery = '
        SELECT street, site_number FROM addresses WHERE postcode_id=?
        ';
            $stm = $connection->prepare($addressQuery);
            $stm->bindValue('1', $id);
            $stm->execute();
            $results = $stm->fetchAll();
            $addresses = '';

            foreach ($results as $result) {
                $addresses = $addresses.$result['street'].' '.$result['site_number'].', ';
            }

            $data['addresses'] = $addresses? $addresses: "/";
            $data['status'] = 200;
        } else {
            return new JsonResponse(array('status'=> '404'));
        }

        return new JsonResponse($data);
    }

    public function csv(Connection $connection)
    {

        $list = array(
            //these are the columns
            'id, fullName, property_type,full_address, num_like_given, num_like_received, like_ids, num_of_people, num_of_old_man',
//            //these are the rows
        );
        $query = 'SELECT u.id, CONCAT(u.name," ", u.surname) as fullName, 
    CASE h.propertytype
    WHEN 1      THEN "FLAT"
    WHEN 2        THEN "small house"
    WHEN 3        THEN "big house"
    WHEN 4        THEN "Villa"
     ELSE "-"  END AS property_type,
    CONCAT (p.postcode, "-" ,a.district, " ", a.locality, " ", a.street, " ",a.site, " ",a.site_number, " ",a.site_description, " ", a.site_subdescription) AS full_address,
    u.num_lgiven as num_like_given,
    u.num_lreceived as num_like_received,
    u.like_ids,
    h.num_of_people as num_of_people,
    h.num_of_old_man as num_of_old_man
FROM users u INNER JOIN houses h ON h.user_id = u.id 
INNER JOIN addresses a ON h.address_id = a.id
INNER JOIN postcodes p ON a.postcode_id = p.id
INNER JOIN people on people.user_id = u.id
';

        $results = $connection->fetchAll($query);

        foreach ($results as $result) {

            $data = array($result['id'], $result['fullName'], $result['property_type'], $result['full_address'], $result['num_like_given'], $result['num_like_received'], '"'.$result['like_ids'].'"',
                $result['num_of_people'], $result['num_of_old_man']);
            $list[] = implode(',', $data);
        }

        $content = implode("\n", $list);
        $response = new Response($content);
        $response->headers->set('Content-Type', 'text/csv');
        //it's gonna output in a testing.csv file
        $response->headers->set('Content-Disposition', 'attachment; filename="testing.csv"');
        return $response;
    }
}
