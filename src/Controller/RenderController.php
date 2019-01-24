<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Doctrine\DBAL\Driver\Connection;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\VarDumper\VarDumper;

class RenderController extends AbstractController
{
    public function renderAction(Connection $connection)
    {
        $postCodes = $connection->fetchAll('SELECT id, postcode, latitude, longitude FROM postcodes WHERE postcode IS NOT NULL ORDER BY postcode');
        return $this->render('base.html.twig', array('postCodes'=> $postCodes));
    }
}
