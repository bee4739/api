<?php

namespace Controller;

use \Psr\Http\Message\ResponseInterface as Response;
use \Psr\Http\Message\ServerRequestInterface as Request;

class InsertYear
{
  public function insertYear(Request $request, Response $response, $args)
  {
    $db = new \Tools\Database();
    $rawData = json_decode(file_get_contents('php://input'), true);
    $query = $db->query("INSERT INTO `tb_year`
        (
        Year,
        Term,
        Start_SchYear,
        End_SchYear,
        Start_Midterm,
        End_Midterm,
        Start_Final,
        End_Final
        )
        VALUES
        (
        '" . $rawData['Year'] . "',
        '" . $rawData['Term'] . "',
        '" . $rawData['Start_SchYear'] . "',
        '" . $rawData['End_SchYear'] . "',
        '" . $rawData['Start_Midterm'] . "',
        '" . $rawData['End_Midterm'] . "',
        '" . $rawData['Start_Final'] . "',
        '" . $rawData['End_Final'] . "'
        );");

    $response->getBody()->write(\json_encode($query));
    return $response;
  }
}
