<?php
// https://stackoverflow.com/questions/7061802/php-function-for-get-all-mondays-within-date-range

namespace Controller;

use \Psr\Http\Message\ResponseInterface as Response;
use \Psr\Http\Message\ServerRequestInterface as Request;

class Day
{

  public function getDay(Request $request, Response $response, $args)
  {
    $db = new \Tools\Database();
    $rawData = json_decode(file_get_contents('php://input'), true);
    $query = $db->query("SELECT 
    `tb_schedule`.`Schedule_ID`, 
    `tb_schedule`.`Day`,
    `tb_schedule`.`Start_Time`,
    `tb_schedule`.`End_Time`,
    `tb_schedule`.`Subject_Type`,
    `tb_class`.`Class_ID`, 
    `tb_class`.`Group_Study`,
    `tb_year`.`Year`, 
    `tb_year`.`Term`, 
    `tb_year`.`Start_SchYear`, 
    `tb_year`.`End_SchYear`,
    `tb_subject`.`Subject_ID`,
    `tb_subject`.`Subject_NameTH`,
    `tb_subject`.`Subject_Theory`,
    `tb_subject`.`Subject_Practice`
  FROM `tb_schedule` 
  LEFT JOIN `tb_class` 
  ON `tb_schedule`.`Class_ID` = `tb_class`.`Class_ID` 
  LEFT JOIN `tb_year` 
  ON `tb_class`.`Year_ID` = `tb_year`.`Year_ID`
  LEFT JOIN `tb_subject` 
  ON `tb_class`.`Subject_PK` = `tb_subject`.`Subject_PK`
    WHERE `tb_class`.`User_ID` =  '" . $rawData['User_ID'] . "'
         ");

    $response->getBody()->write(\json_encode($query));
    return $response;
  }
}
