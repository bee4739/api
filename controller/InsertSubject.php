<?php

namespace Controller;

use \Psr\Http\Message\ResponseInterface as Response;
use \Psr\Http\Message\ServerRequestInterface as Request;

class InsertSubject
{
  public function insertSubject(Request $request, Response $response, $args)
  {
    $db = new \Tools\Database();
    $rawData = json_decode(file_get_contents('php://input'), true);
    $query = $db->query("INSERT INTO `tb_subject`
        (
        Subject_ID,
        Subject_NameTH,
        Subject_NameEN,
        Subject_Theory,
        Subject_Practice
        )
        VALUES
        (
        '" . $rawData['Subject_ID'] . "',
        '" . $rawData['Subject_NameTH'] . "',
        '" . $rawData['Subject_NameEN'] . "',
        '" . $rawData['Subject_Theory'] . "',
        '" . $rawData['Subject_Practice'] . "'
        );");

    $response->getBody()->write(\json_encode($query));
    return $response;
  }
}
