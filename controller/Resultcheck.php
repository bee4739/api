<?php

namespace Controller;

use \Psr\Http\Message\ResponseInterface as Response;
use \Psr\Http\Message\ServerRequestInterface as Request;

class Resultcheck
{
  public function resultcheck(Request $request, Response $response, $args)
  {
    $db = new \Tools\Database();
    $rawData = json_decode(file_get_contents('php://input'), true);
    $query = $db->query(
      "SELECT * FROM tb_year"
    );

    $response->getBody()->write(\json_encode($query));
    return $response;
  }

  public function resultchecksubject(Request $request, Response $response, $args)
  {
    $db = new \Tools\Database();
    $rawData = json_decode(file_get_contents('php://input'), true);
    $query = $db->query(
      "SELECT * FROM `tb_class`

      LEFT JOIN `tb_subject`
      ON `tb_class`.`Subject_PK` = `tb_subject`.`Subject_PK`
      
      LEFT JOIN `tb_year`
      ON `tb_year`.`Year_ID` = `tb_class`.`Year_ID`
      
      WHERE `tb_class`.`User_ID` =   '" . $rawData['User_ID'] . "'
      "
    );

    $response->getBody()->write(\json_encode($query));
    return $response;
  }

  public function showresultcheck(Request $request, Response $response, $args)
  {
    $db = new \Tools\Database();
    $rawData = json_decode(file_get_contents('php://input'), true);
    $query = $db->query(
      "SELECT DISTINCT `tb_student`.`Std_No`,
      `tb_student`.`Std_ID`, 
      `tb_student`.`Std_Title`,
      `tb_student`.`Std_FirstName`, 
      `tb_student`.`Std_LastName`,
      `tb_checked`.`Schedule_ID`,
      `tb_checked`.`Class_ID`
      FROM `tb_checked` 
      
      LEFT JOIN `tb_student`
      ON `tb_checked`.`Std_No` = `tb_student`.`Std_No`
      
      WHERE `tb_checked`.`Class_ID` = '" . $rawData['dds'] . "'
      ORDER BY `tb_student`.`Std_ID`
      "
    );

    $response->getBody()->write(\json_encode($query));
    return $response;
  }

  public function rsDate(Request $request, Response $response, $args)
  {
    $db = new \Tools\Database();
    $rawData = json_decode(file_get_contents('php://input'), true);
    $query = $db->query(
      "SELECT DISTINCT `Date` 
      FROM `tb_checked` 
      WHERE `Class_ID` = '" . $rawData['dds'] . "'"
    );

    $response->getBody()->write(\json_encode($query));
    return $response;
  }

  public function rsStatus(Request $request, Response $response, $args)
  {
    $db = new \Tools\Database();
    $rawData = json_decode(file_get_contents('php://input'), true);
    $query = $db->query(
      "SELECT `tb_checked`.`Status`, `tb_checked`.`Std_No`
      FROM `tb_checked` 
      
      WHERE `tb_checked`.`Class_ID` = '" . $rawData['dds'] . "'"
    );

    $response->getBody()->write(\json_encode($query));
    return $response;
  }

  public function showEdit(Request $request, Response $response, $args)
  {
    $db = new \Tools\Database();
    $rawData = json_decode(file_get_contents('php://input'), true);
    $query = $db->query(
      "SELECT * FROM `tb_checked`
      WHERE `tb_checked`.`Std_No` = '" . $rawData['Std_No'] . "'
      AND `tb_checked`.`Schedule_ID` = '" . $rawData['Schedule_ID'] . "'
      AND `tb_checked`.`Class_ID` = '" . $rawData['Class_ID'] . "'
      "
    );

    $response->getBody()->write(\json_encode($query));
    return $response;
  }

  public function updateCheck(Request $request, Response $response, $args)
  {
    $db = new \Tools\Database();
    $rawData = json_decode(file_get_contents('php://input'), true);
    $query = $db->query("UPDATE `tb_checked` SET 
      Status = '" . $rawData['Status'] . "'
      WHERE `tb_checked`.`Std_No` = '" . $rawData['Std_No'] . "'
      AND `tb_checked`.`Time` = '" . $rawData['Time'] . "'");

    $response->getBody()->write(\json_encode($query));
    return $response;
  }
}
