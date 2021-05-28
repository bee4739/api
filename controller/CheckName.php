<?php

namespace Controller;

use \Psr\Http\Message\ResponseInterface as Response;
use \Psr\Http\Message\ServerRequestInterface as Request;

class CheckName
{

  public function getNameStudent(Request $request, Response $response, $args)
  {
    $db = new \Tools\Database();
    $rawData = json_decode(file_get_contents('php://input'), true);

    $query = $db->query(
      "SELECT `Std_No`, `Std_ID`, `Std_FirstName`, `Std_LastName`, `Class_ID` FROM `tb_student`
       WHERE `Class_ID` = '" . $rawData['Class_ID'] . "'"
    );

    $response->getBody()->write(\json_encode($query));
    return $response;
  }

  public function checkName(Request $request, Response $response, $args)
  {
    $db = new \Tools\Database();
    $rawData = json_decode(file_get_contents('php://input'), true);

    // $stdNo = $db->query("SELECT 
    //                               `Std_No`
    //                         FROM `tb_student`");

    // $useStd =  $db->query("SELECT 
    //                               `Username`
    //                       FROM `tb_user`");


    // $student = $db->query("SELECT 
    //                               `Std_No`
    //                         FROM `tb_student` 
    //                         LEFT JOIN `tb_user`
    //                         ON `tb_student`.`Std_ID` = `tb_user`.`Std_ID`
    //                         WHERE `tb_user`.`Username` = '" . $rawData['name'] . "'");

    $query = $db->query("INSERT INTO `tb_check`
      (
      `Status_ID`,
      `Date`,
      `Schedule_ID`,
      `Std_No`
      )
      VALUES
      (
      '1',
      '2021-05-28',
      '" . $rawData['Schedule_ID'] . "',
      '3')");

    // WHERE '" . $stdNo . "' = '" . $student . "'

    $response->getBody()->write(\json_encode($query));
    return $response;
  }
}
