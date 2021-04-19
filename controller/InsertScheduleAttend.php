<?php

namespace Controller;

use \Psr\Http\Message\ResponseInterface as Response;
use \Psr\Http\Message\ServerRequestInterface as Request;

class InsertScheduleAttend
{
  public function insertScheduleAttend(Request $request, Response $response, $args)
  {
    $db = new \Tools\Database();
    $query = $db->query(
      "SELECT `Schedule_ID`, 
              `tb_subject`.`Subject_PK`,
              `tb_subject`.`Subject_ID`,
              `tb_subject`.`Subject_NameTH`,  
              `tb_class`.`Class_ID`,
              `tb_class`.`Group_Study`
      FROM `tb_schedule` 
      LEFT JOIN `tb_class` 
      ON `tb_schedule`.`Class_ID` = `tb_class`.`Class_ID`
      LEFT JOIN `tb_subject`
      ON `tb_schedule`.`Subject_PK` = `tb_subject`.`Subject_PK`"
    );
    $response->getBody()->write(\json_encode($query));
    return $response;
  }
}
