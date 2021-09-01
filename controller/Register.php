<?php

namespace Controller;

use \Psr\Http\Message\ResponseInterface as Response;
use \Psr\Http\Message\ServerRequestInterface as Request;

class Register
{
  public function insertregister(Request $request, Response $response, $args)
  {
    $db = new \Tools\Database();
    $rawData = json_decode(file_get_contents('php://input'), true);
    $query = $db->query(
      "INSERT INTO tb_user
            (
              Username,
              Std_ID,
              Title,
              FirstName,
              LastName,
              Title_Eng,
              FirstName_Eng,
              LastName_Eng,
              Role,
              User_Password
            )
            VALUES
            (
            '" . $rawData['Username'] . "',
            '" . $rawData['Std_ID'] . "',
            '" . $rawData['Title'] . "',
            '" . $rawData['FirstName'] . "',
            '" . $rawData['LastName'] . "',
            '" . $rawData['Title_Eng'] . "',
            '" . $rawData['FirstName_Eng'] . "',
            '" . $rawData['LastName_Eng'] . "',
            '2',
            '" . $rawData['User_Password'] . "'
            );"
    );

    $response->getBody()->write(\json_encode($query));
    return $response;
  }
}
