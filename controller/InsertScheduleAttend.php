<?php

namespace Controller;

use \Psr\Http\Message\ResponseInterface as Response;
use \Psr\Http\Message\ServerRequestInterface as Request;

class InsertScheduleAttend
{
  public function dropdownSubSchedule(Request $request, Response $response, $args)
  {
    $db = new \Tools\Database();
    $query = $db->query(
      "SELECT  `tb_subject`.`Subject_PK`,
              `tb_subject`.`Subject_ID`,
              `tb_subject`.`Subject_NameTH`,  
              `tb_class`.`Class_ID`,
              `tb_class`.`Group_Study`
      FROM `tb_class`
      LEFT JOIN `tb_subject`
      ON `tb_class`.`Subject_PK` = `tb_subject`.`Subject_PK`"
    );
    $response->getBody()->write(\json_encode($query));
    return $response;
  }

  public function insertSchedule(Request $request, Response $response, $args)
  {
    $db = new \Tools\Database();
    $rawData = json_decode(file_get_contents('php://input'), true);
    $query = $db->query("INSERT INTO `tb_schedule` (
        Class_ID,
        Day,
        Start_Time,
        End_Time,
        Subject_Type)
        VALUES (
        '" . $rawData['Class_ID'] . "',
        '" . $rawData['Day'] . "',
        '" . $rawData['Start_Time'] . "',
        '" . $rawData['End_Time'] . "',
        '" . $rawData['Subject_Type'] . "'
        );");

    $response->getBody()->write(\json_encode($query));
    return $response;
  }
}
