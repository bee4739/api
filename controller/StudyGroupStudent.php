<?php

namespace Controller;

use \Psr\Http\Message\ResponseInterface as Response;
use \Psr\Http\Message\ServerRequestInterface as Request;

class StudyGroupStudent
{
  public function insertStudyGroupStudent(Request $request, Response $response, $args)
  {
    $db = new \Tools\Database();
    $rawData = json_decode(file_get_contents('php://input'), true);

      $query = $db->query("INSERT INTO tb_student
      (
      `Std_ID`,
      `Class_ID`
      )
      VALUES
      (
      '" . $rawData['User_ID'] . "',
      '" . $rawData['Study_Group'] . "'
      );");

    $response->getBody()->write(\json_encode($query));
    return $response;
 
}

  public function getStudyGroupStudent(Request $request, Response $response, $args)
  {
    $db = new \Tools\Database();
    $query = $db->query(
      "SELECT  `Class_ID`, `Subject_ID`, `Subject_NameTH`, `Group_Study`, `Pass_Group`
      FROM `tb_class`
      LEFT JOIN `tb_subject`
      ON `tb_class`.`Subject_PK` = `tb_subject`.`Subject_PK`;"
    );

    $response->getBody()->write(\json_encode($query));
    return $response;
  }

  public function getStudent(Request $request, Response $response, $args)
  {
    $db = new \Tools\Database();
    $rawData = json_decode(file_get_contents('php://input'), true);
    $query = $db->query(
      "SELECT  `Subject_ID`, `Subject_NameTH`, `Group_Study` 
      FROM `tb_student` 
      LEFT JOIN `tb_class`
      ON `tb_student`.`Class_ID` = `tb_class`.`Class_ID`
      LEFT JOIN `tb_subject`
      ON `tb_class`.`Subject_PK` = `tb_subject`.`Subject_PK`
      WHERE `tb_student`.`Std_ID` = '" . $rawData['User_ID'] . "';"
    );

    $response->getBody()->write(\json_encode($query));
    return $response;
  }
}
