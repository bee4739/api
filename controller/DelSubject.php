<?php

namespace Controller;

use \Psr\Http\Message\ResponseInterface as Response;
use \Psr\Http\Message\ServerRequestInterface as Request;

class DelSubject
{
  public function delSubject(Request $request, Response $response, $args)
  {
    $db = new \Tools\Database();
    $rawData = json_decode(file_get_contents('php://input'), true);
    $query = $db->query("DELETE FROM `tb_subject` WHERE `tb_subject`.`Subject_PK` = '" . $rawData['subject'] . "'");

    $response->getBody()->write(\json_encode($query));
    return $response;
  }
}
