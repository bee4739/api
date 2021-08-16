<?php

namespace Controller;

use \Psr\Http\Message\ResponseInterface as Response;
use \Psr\Http\Message\ServerRequestInterface as Request;

class InsertScheduleAttend
{
  public function dropdownSubSchedule(Request $request, Response $response, $args)
  {
    $db = new \Tools\Database();
    $query = $db->query(
      "SELECT  `tb_subject`.`Subject_PK`,
              `tb_subject`.`Subject_ID`,
              `tb_subject`.`Subject_NameTH`,  
              `tb_class`.`Class_ID`,
              `tb_class`.`Group_Study`
      FROM `tb_class`
      LEFT JOIN `tb_subject`
      ON `tb_class`.`Subject_PK` = `tb_subject`.`Subject_PK`"
    );
    $response->getBody()->write(\json_encode($query));
    return $response;
  }

  public function insertSchedule(Request $request, Response $response, $args)
  {
    $db = new \Tools\Database();
    $rawData = json_decode(file_get_contents('php://input'), true);
    $query = $db->query("INSERT INTO `tb_schedule` (
        Class_ID,
        Day,
        Start_Time,
        End_Time,
        Subject_Type)
        VALUES (
        '" . $rawData['Class_ID'] . "',
        '" . $rawData['Day'] . "',
        '" . $rawData['Start_Time'] . "',
        '" . $rawData['End_Time'] . "',
        '" . $rawData['Subject_Type'] . "'
        );");

    $response->getBody()->write(\json_encode($query));
    return $response;
  }

  public function delScheduleAttend(Request $request, Response $response, $args)
  {
    $db = new \Tools\Database();
    $rawData = json_decode(file_get_contents('php://input'), true);
    $query = $db->query("DELETE FROM `tb_schedule` WHERE `tb_schedule`.Schedule_ID = '" . $rawData['Schedule_ID'] . "'");

    $response->getBody()->write(\json_encode($query));
    return $response;
  }

  public function editScheduleAttend(Request $request, Response $response, $args)
  {
    $db = new \Tools\Database();
    $rawData = json_decode(file_get_contents('php://input'), true);
    $query = $db->query("UPDATE `tb_schedule` SET 
      Day = '" . $rawData['DayE'] . "',
      Start_Time = '" . $rawData['Start_TimeE'] . "',
      End_Time = '" . $rawData['End_TimeE'] . "',
      Class_ID = '" . $rawData['Class_IDE'] . "',
      Subject_Type = '" . $rawData['Subject_TypeE'] . "'
      WHERE `tb_schedule`.`Schedule_ID` = '" . $rawData['Schedule_ID'] . "'");

    $response->getBody()->write(\json_encode($query));
    return $response;
  }

  public function insertCompensate(Request $request, Response $response, $args)
  {
    $db = new \Tools\Database();
    $rawData = json_decode(file_get_contents('php://input'), true);
    $query = $db->query("INSERT INTO `tb_schedule_composate` (
        Date_Composate,
        Date_Normal,
        Day_Composate,
        Start_Time_Composate,
        End_Time_Composate,
        Schedule_ID
        )
        VALUES (
        '" . $rawData['Date_Composate'] . "',
        '" . $rawData['Date_Normal'] . "',
        '" . $rawData['Day_Composate'] . "',
        '" . $rawData['Start_Time_Composate'] . "',
        '" . $rawData['End_Time_Composate'] . "',
        '" . $rawData['Schedule_ID'] . "'
        );");

    $response->getBody()->write(\json_encode($query));
    return $response;
  }
}
