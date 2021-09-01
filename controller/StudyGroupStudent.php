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
      `Std_No`,
      `Std_ID`,
      `Std_Title`,
      `Std_FirstName`,
      `Std_LastName`,
      `Class_ID`
      )
      VALUES
      (
      '" . $rawData['User_ID'] . "',
      '" . $rawData['Std_ID'] . "',
      '" . $rawData['Title'] . "',
      '" . $rawData['FirstName'] . "',
      '" . $rawData['LastName'] . "',
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
      ON `tb_class`.`Subject_PK` = `tb_subject`.`Subject_PK`"
    );

    $response->getBody()->write(\json_encode($query));
    return $response;
  }

  public function getStudent(Request $request, Response $response, $args)
  {
    $db = new \Tools\Database();
    $rawData = json_decode(file_get_contents('php://input'), true);
    $query = $db->query(
      "SELECT  `Subject_ID`, `Subject_NameTH`, `Group_Study`, `tb_class`.`Class_ID`
      FROM `tb_student` 
      LEFT JOIN `tb_class`
      ON `tb_student`.`Class_ID` = `tb_class`.`Class_ID`
      LEFT JOIN `tb_subject`
      ON `tb_class`.`Subject_PK` = `tb_subject`.`Subject_PK`
      WHERE `tb_student`.`Std_No` = '" . $rawData['User_ID'] . "';"
    );

    $response->getBody()->write(\json_encode($query));
    return $response;
  }

  public function getHistoryCheck(Request $request, Response $response, $args)
  {
    $db = new \Tools\Database();
    $rawData = json_decode(file_get_contents('php://input'), true);
    $query = $db->query(
      "SELECT `Time`, `Status` ,  `tb_student`.`Class_ID`, `tb_student`.`Std_No`
      FROM `tb_checked`
      LEFT JOIN `tb_student`
      ON `tb_checked`.`Class_ID` = `tb_student`.`Class_ID`
      AND `tb_checked`.`Std_No` = `tb_student`.`Std_No` 
      WHERE `tb_checked`.`Class_ID` = '" . $rawData['Class_ID'] . "'
      AND `tb_checked`.`Std_No` = '" . $rawData['User_ID'] . "'
      ORDER BY `Time` "
    );

    $response->getBody()->write(\json_encode($query));
    return $response;
  }
}
