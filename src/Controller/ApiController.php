<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\DBAL\Driver\Connection;
use Symfony\Component\VarDumper\VarDumper;

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

    public function csv()
    {
        $list = array(
            //these are the columns
            array('Firstname', 'Lastname',),
            //these are the rows
            array('Andrei', 'Boar'),
            array('John', 'Doe')
        );
        $fp = fopen('php://output', 'w');
        foreach ($list as $fields) {
            fputcsv($fp, $fields);
        }
        $response = new Response();
        $response->headers->set('Content-Type', 'text/csv');
        //it's gonna output in a testing.csv file
        $response->headers->set('Content-Disposition', 'attachment; filename="testing.csv"');
        return $response;
    }
}
