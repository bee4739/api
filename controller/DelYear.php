<?php

namespace Controller;

use \Psr\Http\Message\ResponseInterface as Response;
use \Psr\Http\Message\ServerRequestInterface as Request;

class DelYear
{
  public function delYear(Request $request, Response $response, $args)
  {
    $db = new \Tools\Database();
    $rawData = json_decode(file_get_contents('php://input'), true);
    $query = $db->query("DELETE FROM `tb_year` WHERE `tb_year`.`Year_ID` = '" . $rawData['year'] . "'");

    $response->getBody()->write(\json_encode($query));
    return $response;
  }
}
