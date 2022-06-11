<?php

namespace Richardkrikler\Artlocator;
require_once 'vendor/autoload.php';

use Doctrine\DBAL\DriverManager;
use SimpleXMLElement;


header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: *');
header('Access-Control-Allow-Headers: Content-Type');

$connectionParams = [
    'url' => 'sqlite:///db.sqlite'
];

$conn = DriverManager::getConnection($connectionParams);
$queryBuilder = $conn->createQueryBuilder();

$post = json_decode(file_get_contents("php://input"), true);
$output = [];


if (isset($_GET['get'])) {
    if ($_GET['get'] === 'museums') {
        $output = $queryBuilder->select('museumId as id', 'name', 'description', 'url', 'country', 'city')
            ->from('museums')
            ->executeQuery()
            ->fetchAllAssociative();
    } else if ($_GET['get'] === 'portraits') {
        $output = $queryBuilder->select('portraitId as id', 'p.name', 'p.description', 'year', 'm.museumId')
            ->from('portraits', 'p')
            ->innerJoin('p', 'museums', 'm', 'p.museumId = m.museumId')
            ->executeQuery()
            ->fetchAllAssociative();
    } else if ($_GET['get'] === 'image' && isset($_GET['id']) && isset($_GET['from'])) {
        $table = null;
        if ($_GET['from'] === 'museum') {
            $table = 'museums';
        } else if ($_GET['from'] === 'portrait') {
            $table = 'portraits';
        }
        if (!isset($table)) {
            return;
        }

        $data = $queryBuilder->select('image')
            ->from($table)
            ->where($_GET['from'] . 'Id = ?')
            ->setParameter(0, $_GET['id'])
            ->executeQuery()
            ->fetchAllAssociative();
        if ($data[0]['image'] === null) {
            return;
        }

        $dataAr = explode(';', $data[0]['image']);
        header('Content-type: ' . explode(':', $dataAr[0])[0]);
        echo file_get_contents($dataAr[0] . ';' . $dataAr[1]);
        return;
    }
} else if (isset($post)) {
    if ($post['post'] === 'museum') {
        if (isset($post['name']) && $post['name'] !== '' && isset($post['description']) && isset($post['country']) && $post['country'] !== '' && isset($post['city']) && $post['city'] !== '' && isset($post['url']) && $post['url'] !== '') {
            $queryBuilder->insert('museums')
                ->values([
                    'name' => '?',
                    'description' => '?',
                    'country' => '?',
                    'city' => '?',
                    'url' => '?',
                    'image' => '?'
                ])
                ->setParameter(0, $post['name'])
                ->setParameter(1, $post['description'])
                ->setParameter(2, $post['country'])
                ->setParameter(3, $post['city'])
                ->setParameter(4, $post['url'])
                ->setParameter(5, !isset($post['image']) ? null : $post['image'])
                ->executeQuery();
            $output = ['msg' => 'Successfully added a new Museum!'];
        } else {
            $output = ['error' => 'Please fill in all input fields.'];
        }
    } else if ($post['post'] === 'portrait') {

    }
}


// --- JSON / XML ---

$outputType = 'json';

if (isset($_GET['type'])) {
    if ($_GET['type'] === 'xml') {
        $outputType = 'xml';
    }
}

if ($outputType === 'json') {
    header('Content-Type: application/json');
    print_r(json_encode($output));
} else {
    header('Content-Type: application/xml');

    function array2xml($array, $xml = false)
    {
        if ($xml === false) {
            $xml = new SimpleXMLElement(<<<XML
<?xml version="1.0" encoding="UTF-8" ?>
<result/>
XML
            );
        }

        foreach ($array as $key => $value) {
            if (is_array($value)) {
                array2xml($value, $xml->addChild($key));
            } else {
                $xml->addChild($key, $value);
            }
        }

        return $xml->asXML();
    }

    $jSON = json_decode(json_encode($output), true);
    $xml = array2xml($jSON, false);

    print_r($xml);
}
