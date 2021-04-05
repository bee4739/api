<?php

namespace Controller;

use \Psr\Http\Message\ResponseInterface as Response;
use \Psr\Http\Message\ServerRequestInterface as Request;

class EditSubject
{
  public function editSubject(Request $request, Response $response, $args)
  {
    $db = new \Tools\Database();
    $rawData = json_decode(file_get_contents('php://input'), true);
    $query = $db->query("UPDATE `tb_subject` SET 
      Subject_ID = '" . $rawData['Subject_IDE'] . "',
      Subject_NameTH = '" . $rawData['Subject_NameTHE'] . "',
      Subject_NameEN = '" . $rawData['Subject_NameENE'] . "',
      Subject_Theory = '" . $rawData['Subject_TheoryE'] . "',
      Subject_Practice = '" . $rawData['Subject_PracticeE'] . "'
      WHERE `tb_subject`.`Subject_PK` = '" . $rawData['Subject_PK'] . "'");
    $response->getBody()->write(\json_encode($query));
    return $response;
  }
}
