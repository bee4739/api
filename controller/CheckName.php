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
      "SELECT `tb_student`.*, `tb_user`.*,
      CONCAT(`tb_checked`.`Time`) as `isCheck`
      FROM `tb_student`

      LEFT JOIN `tb_user`
      ON `tb_student`.`Std_No` = `tb_user`.`User_ID`

      LEFT JOIN `tb_checked`
      ON `tb_student`.`Std_No` = `tb_checked`.`Student_ID` 
      AND `tb_checked`.`Schedule_ID` = '" . $rawData['Schedule_ID'] . "'
      AND `tb_checked`.`Date` = '" . date("Y-m-d") . "'
      
      WHERE `tb_student`.`Class_ID` = '" . $rawData['Class_ID'] . "'"
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
    //                         LEFT JOIN `Username`
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
      '" . $rawData['name'] . "'
      );");




    // WHERE '" . $stdNo . "' = '" . $student . "'

    $response->getBody()->write(\json_encode($query));
    return $response;
  }
}
