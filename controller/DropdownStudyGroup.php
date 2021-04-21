<?php

namespace Controller;

use \Psr\Http\Message\ResponseInterface as Response;
use \Psr\Http\Message\ServerRequestInterface as Request;

class DropdownStudyGroup
{

  public function dropdownSubject(Request $request, Response $response, $args)
  {
    $db = new \Tools\Database();
    $query = $db->query(
      "SELECT `Subject_PK`, `Subject_ID`, `Subject_NameTH` FROM `tb_subject`"
    );
    $response->getBody()->write(\json_encode($query));
    return $response;
  }

  public function dropdownYear(Request $request, Response $response, $args)
  {
    $db = new \Tools\Database();
    $query = $db->query(
      "SELECT `Year_ID`, `Year`, `Term` FROM `tb_year`"
    );
    $response->getBody()->write(\json_encode($query));
    return $response;
  }

  public function insertStudyGroup(Request $request, Response $response, $args)
  {
    $db = new \Tools\Database();
    $rawData = json_decode(file_get_contents('php://input'), true);
    // $s = explode("-", $rawData['Subject_ID']);
    // $y = explode("/", $rawData['Term']);

    // // $s = explode("-", '0000-aa');
    // // $y = explode("/", '2564/ภาคเรียนที่2');

    // $year = $db->query(
    //   "SELECT `Year_ID` FROM `tb_year`
    //   WHERE Year = '" . $y[0] . "' AND Term = '" . $y[1] . "'"
    // );

    // $subject = $db->query(
    //   "SELECT `Subject_PK` FROM `tb_subject`
    //   WHERE Subject_ID = '" . $s[1] . "' AND Subject_NameTH = '" . $s[1] . "'"
    // );

    $query = $db->query("INSERT INTO `tb_class`(
      `Subject_PK`, 
      `Group_Study`, 
      `Pass_Group`, 
      `Year_ID`,
      `User_ID`) 
  VALUES (
      '" . $rawData['Subject_ID'] . "',
      '" . $rawData['Group_Study'] . "',
      '" . $rawData['Pass_Group'] . "',
      '" . $rawData['Term'] . "',
      '" . $rawData['User_ID'] . "'
      );");

    $response->getBody()->write(\json_encode($query));
    // $response->getBody()->write(\json_encode($y));
    return $response;
  }

  public function getStudyGroup(Request $request, Response $response, $args)
  {
    $db = new \Tools\Database();
    $rawData = json_decode(file_get_contents('php://input'), true);
    $query = $db->query(
      "SELECT Class_ID,
      `tb_subject`.`Subject_ID`, 
      `tb_subject`.`Subject_NameTH`,  
      `Group_Study`,
      `tb_year`.`Year`,
      `tb_year`.`Term`,`tb_class`.`Subject_PK`, `tb_class`.`Year_ID`, Pass_Group
      FROM `tb_class`
      LEFT JOIN `tb_subject` 
      ON `tb_class`.`Subject_PK` = `tb_subject`.`Subject_PK` 
      LEFT JOIN `tb_year` 
      ON `tb_class`.`Year_ID` = `tb_year`.`Year_ID`
      WHERE User_ID = '" . $rawData['Username'] . "';"
    );

    $response->getBody()->write(\json_encode($query));
    return $response;
  }

  public function delStudyGroup(Request $request, Response $response, $args)
  {
    $db = new \Tools\Database();
    $rawData = json_decode(file_get_contents('php://input'), true);
    $query = $db->query("DELETE FROM `tb_class` WHERE `tb_class`.`Class_ID` = '" . $rawData['Class_ID'] . "'");
    $response->getBody()->write(\json_encode($query));
    return $response;
  }

  public function editStudyGroup(Request $request, Response $response, $args)
  {
    $db = new \Tools\Database();
    $rawData = json_decode(file_get_contents('php://input'), true);
    $query = $db->query("UPDATE `tb_class` SET 
      Subject_PK = '" . $rawData['Subject_IDE'] . "',
      Group_Study = '" . $rawData['Group_StudyE'] . "',
      Pass_Group = '" . $rawData['Pass_GroupE'] . "',
      Year_ID = '" . $rawData['TermE'] . "'
      WHERE `tb_class`.`Class_ID` = '" . $rawData['Class_ID'] . "'");

    $response->getBody()->write(\json_encode($query));
    return $response;
  }
}
