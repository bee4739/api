<?php

namespace Controller;

use \Psr\Http\Message\ResponseInterface as Response;
use \Psr\Http\Message\ServerRequestInterface as Request;

class InsertYear
{
  public function insertSchedule(Request $request, Response $response, $args)
  {
    $db = new \Tools\Database();
    $rawData = json_decode(file_get_contents('php://input'), true);
    $query = $db->query("INSERT INTO `tb_schedule`
        (
        Day,
        Start_Time,
        End_Time,
        Subject_PK,
        Class_ID,
        User_ID
        )
        VALUES
        (
        '" . $rawData['Day'] . "',
        '" . $rawData['Start_Time'] . "',
        '" . $rawData['End_Time'] . "',
        '" . $rawData['Subject_PK'] . "',
        '" . $rawData['Class_ID'] . "',
        '" . $rawData['User_ID'] . "'
        );");

    $response->getBody()->write(\json_encode($query));
    return $response;
  }
}
