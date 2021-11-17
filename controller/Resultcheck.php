<?php

namespace Controller;

use \Psr\Http\Message\ResponseInterface as Response;
use \Psr\Http\Message\ServerRequestInterface as Request;

class Resultcheck
{
  public function resultcheck(Request $request, Response $response, $args)
  {
    $db = new \Tools\Database();
    $rawData = json_decode(file_get_contents('php://input'), true);
    $query = $db->query(
      "SELECT * FROM tb_year"
    );

    $response->getBody()->write(\json_encode($query));
    return $response;
  }

  public function resultchecksubject(Request $request, Response $response, $args)
  {
    $db = new \Tools\Database();
    $rawData = json_decode(file_get_contents('php://input'), true);
    $query = $db->query(
      "SELECT * FROM `tb_class`

      LEFT JOIN `tb_subject`
      ON `tb_class`.`Subject_PK` = `tb_subject`.`Subject_PK`
      
      LEFT JOIN `tb_year`
      ON `tb_year`.`Year_ID` = `tb_class`.`Year_ID`
      
      WHERE `tb_year`.`Year_ID` = '1'"
    );

    $response->getBody()->write(\json_encode($query));
    return $response;
  }

  public function showresultcheck(Request $request, Response $response, $args)
  {
    $db = new \Tools\Database();
    $rawData = json_decode(file_get_contents('php://input'), true);
    $query = $db->query(
      "SELECT * FROM `tb_class`

      LEFT JOIN `tb_subject`
      ON `tb_class`.`Subject_PK` = `tb_subject`.`Subject_PK`
      
      LEFT JOIN `tb_year`
      ON `tb_year`.`Year_ID` = `tb_class`.`Year_ID`
      
      WHERE `tb_year`.`Year_ID` = '1'"
    );

    $response->getBody()->write(\json_encode($query));
    return $response;
  }
}
