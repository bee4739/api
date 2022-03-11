<?php

namespace Controller;

use \Psr\Http\Message\ResponseInterface as Response;
use \Psr\Http\Message\ServerRequestInterface as Request;

class Register
{
  public function registerStudent(Request $request, Response $response, $args)
  {
    $db = new \Tools\Database();
    $rawData = json_decode(file_get_contents('php://input'), true);

    $strSd = explode("/", $rawData['Title']);

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
            '" . strtolower($rawData['Username']) . "',
            '" . $rawData['Std_ID'] . "',
            '$strSd[0]',
            '" . $rawData['FirstName'] . "',
            '" . $rawData['LastName'] . "',
            '$strSd[1]',
            '" . ucwords($rawData['FirstName_Eng']) . "',
            '" . ucwords($rawData['LastName_Eng']) . "',
            '2',
            '" . $rawData['User_Password'] . "'
            );"
    );

    $response->getBody()->write(\json_encode($query));
    return $response;
  }

  public function registerTeacher(Request $request, Response $response, $args)
  {
    $db = new \Tools\Database();
    $rawData = json_decode(file_get_contents('php://input'), true);

    $strSd = explode("/", $rawData['Title']);

    $query = $db->query(
      "INSERT INTO tb_user
            (
              Username,
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
            '" . strtolower($rawData['Username']) . "',
            '$strSd[0]',
            '" . $rawData['FirstName'] . "',
            '" . $rawData['LastName'] . "',
            '$strSd[1]',
            '" . ucwords($rawData['FirstName_Eng']) . "',
            '" . ucwords($rawData['LastName_Eng']) . "',
            '1',
            '" . $rawData['User_Password'] . "'
            );"
    );

    $response->getBody()->write(\json_encode($query));
    return $response;
  }
}
