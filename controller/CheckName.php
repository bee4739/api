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
      ON `tb_student`.`Std_No` = `tb_checked`.`Std_No` 
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
    $username = json_decode($rawData['username'], true);
    $query_user = array();
    $insertStatus = array();

    if (count($username) > 0) {
      foreach ($username as $list) {
        $query_user[] =  $db->query("SELECT * FROM `tb_user` WHERE `Username` = '" . $list . "' LIMIT 1");
      }
    }

    if (count($query_user) > 0) {
      foreach ($query_user as $list_result) {
        if (count($list_result['result']) > 0) {
          $insertStatus[] = $db->query("INSERT INTO `tb_checked`
          (
          `Std_No`,
          `Schedule_ID`,
          `Class_ID`,
          `Composite_ID`,
          `Status`
          )
          VALUES
          (
          '" . $list_result['result'][0]['User_ID'] . "',
          '" . $rawData['Schedule_ID'] . "',
          '" . $rawData['Class_ID'] . "',
          '" . @$rawData['Composite_ID'] . "',
          'ปกติ'
          );");
        }
      }
    }

    $query =  $db->query(
      "SELECT * FROM `tb_checked`
      LEFT JOIN `tb_user`
      ON `tb_checked`.`Std_No` = `tb_user`.`User_ID`
      WHERE `tb_checked`.`Schedule_ID` = '" . $rawData['Schedule_ID'] . "'
      AND `tb_checked`.`Class_ID` = '" . $rawData['Class_ID'] . "'
      AND `tb_checked`.`Date` = CURRENT_DATE()
      "
    );

    $response->getBody()->write(\json_encode($query));
    return $response;
  }
}
