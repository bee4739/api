<?php

namespace Controller;

use \Psr\Http\Message\ResponseInterface as Response;
use \Psr\Http\Message\ServerRequestInterface as Request;

class CreateFolder
{
  public function createFolder(Request $request, Response $response, $args)
  {
    $flgCreate = mkdir("Test");
    if ($flgCreate) {
      echo "Folder Created.";
    } else {
      echo "Folder Not Create.";
    }

    // $db = new \Tools\Database();
    // $rawData = json_decode(file_get_contents('php://input'), true);
    // $query = $db->query("");

    // $response->getBody()->write(\json_encode($query));
    // return $response;


  }
}
