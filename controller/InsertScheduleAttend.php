<?php

namespace Controller;

use \Psr\Http\Message\ResponseInterface as Response;
use \Psr\Http\Message\ServerRequestInterface as Request;

class InsertScheduleAttend
{
  public function dropdownSubSchedule(Request $request, Response $response, $args)
  {
    $db = new \Tools\Database();
    $rawData = json_decode(file_get_contents('php://input'), true);
    $query = $db->query(
      "SELECT  `tb_subject`.`Subject_PK`,
              `tb_subject`.`Subject_ID`,
              `tb_subject`.`Subject_NameTH`,  
              `tb_class`.`Class_ID`,
              `tb_class`.`Group_Study`
      FROM `tb_class`
      LEFT JOIN `tb_subject`
      ON `tb_class`.`Subject_PK` = `tb_subject`.`Subject_PK`
      WHERE `tb_class`.`User_ID` =   '" . $rawData['User_ID'] . "'"
    );
    $response->getBody()->write(\json_encode($query));
    return $response;
  }

  public function insertSchedule(Request $request, Response $response, $args)
  {
    $db = new \Tools\Database();
    $rawData = json_decode(file_get_contents('php://input'), true);

    $sl = $db->query("SELECT * 
    FROM `tb_schedule` 
    LEFT JOIN  `tb_class`
    ON `tb_schedule`.`Class_ID` = `tb_class`.`Class_ID`
    WHERE `tb_class`.`User_ID` = `2`");

    // for ($i = 0; $i < $sl['rowCount']; $i++) {
    //   // if ($sl['result'][$i]['User_ID'] == "'" . $rawData['User_ID'] . "'") {
    //   //   if ($sl['result'][$i]['Day'] == "'" . $rawData['Day'] . "'") {
    //   //     if ($sl['result'][$i]['Start_Time'] >= "'" . $rawData['Start_Time'] . "'" && $sl['result'][$i]['End_Time'] >= "'" . $rawData['End_Time'] . "'") {
    //   //       // if ($sl['result'][$i]['Start_Time'] <= "'" . $rawData['Start_Time'] . "'" || $sl['result'][$i]['End_Time'] <= "'" . $rawData['End_Time'] . "'") {
    //   //       $query = "error";
    //   //       //   $sls = "1"; //ค่าซ้ำ
    //   //       // }
    //   //     } else {
    //   //       // insert
    //   //       $query = $db->query("INSERT INTO `tb_schedule` (
    //   //       Class_ID,
    //   //       Day,
    //   //       Start_Time,
    //   //       End_Time,
    //   //       Subject_Type)
    //   //       VALUES (
    //   //       '" . $rawData['Class_ID'] . "',
    //   //       '" . $rawData['Day'] . "',
    //   //       '" . $rawData['Start_Time'] . "',
    //   //       '" . $rawData['End_Time'] . "',
    //   //       '" . $rawData['Subject_Type'] . "'
    //   //       );");
    //   //     }
    //   //   }
    //   // }
    // }

    $response->getBody()->write(\json_encode($sl));
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

  public function getSd(Request $request, Response $response, $args)
  {
    $db = new \Tools\Database();
    $rawData = json_decode(file_get_contents('php://input'), true);

    $query = $db->query(
      "INSERT INTO `tb_checked` (Std_No, Schedule_ID, Class_ID, Composite_ID, Status, Time)
      SELECT 	`tb_student`.`Std_No`,
          `tb_schedule`.`Schedule_ID`,
              `tb_student`.`Class_ID`,
              `tb_schedule_composate`.`Composite_ID`,
              'ขาด',
              CURRENT_TIMESTAMP
      FROM `tb_student`
      LEFT JOIN `tb_class`
      ON `tb_student`.`Class_ID` = `tb_class`.`Class_ID`
      LEFT JOIN `tb_schedule`
      ON `tb_class`.`Class_ID` = `tb_schedule`.`Class_ID`
      LEFT JOIN `tb_schedule_composate`
      ON `tb_schedule`.`Schedule_ID` = `tb_schedule_composate`.`Schedule_ID`
      WHERE `tb_student`.`Class_ID` = '" . $rawData['Class_ID'] . "'
      AND `tb_schedule`.`Schedule_ID` = '" . $rawData['Schedule_ID'] . "'"
    );

    $response->getBody()->write(\json_encode($query));
    return $response;
  }

  public function addSchedule(Request $request, Response $response, $args)
  {
    $db = new \Tools\Database();
    $rawData = json_decode(file_get_contents('php://input'), true);

    $sl = $db->query("SELECT * 
                      FROM `tb_schedule` 
                      LEFT JOIN  `tb_class`
                      ON `tb_schedule`.`Class_ID` = `tb_class`.`Class_ID`
                      WHERE `tb_class`.`User_ID` = '2'");

    for ($i = 0; $i < $sl['rowCount']; $i++) {
      if ($sl['result'][$i]['User_ID'] == 2) {
        if ($sl['result'][$i]['Day'] == 4) {
          if ($sl['result'][$i]['Start_Time'] >= "16:00" || $sl['result'][$i]['End_Time'] >= "19:00") {
            if ($sl['result'][$i]['Start_Time'] <= "16:00" || $sl['result'][$i]['End_Time'] <= "19:00") {
              // $sls[] = $sl['result'][$i];
              $sls = "1"; //ค่าซ้ำ

            }
          }
          // insert
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
        }
      }
      // $sl['result'][$i]['Day'];
      // $sl['result'][$i]['Start_Time'];
      // $sl['result'][$i]['End_Time'];
      // $sl['result'][$i]['User_ID'];
    }

    $response->getBody()->write(\json_encode($query));
    return $response;
  }

  // public function addScheduleA(Request $request, Response $response, $args)
  // {
  //   $db = new \Tools\Database();
  //   $rawData = json_decode(file_get_contents('php://input'), true);

  //   $sl = $db->query("SELECT * 
  //                     FROM `tb_schedule` 
  //                     LEFT JOIN  `tb_class`
  //                     ON `tb_schedule`.`Class_ID` = `tb_class`.`Class_ID`
  //                     WHERE `tb_class`.`User_ID` = '2'");

  //   $names = $request->getParam('name');
  //   $genders = $request->getParam('gender');
  //   $ages = $request->getParam('age');
  //   $persons = array();
  //   for($i=0;$i<count($names);$i++){
  //           $arr['name'] = $names[$i];
  //           $arr['gender'] = $genders[$i];
  //           $arr['age'] = $ages[$i];
  //           array_push($persons,$arr);
  //   }

  //   $response->getBody()->write(\json_encode($neededObject));
  //   return $response;
  // }

  public function addScheduleAB(Request $request, Response $response, $args)
  {
    $db = new \Tools\Database();
    $rawData = json_decode(file_get_contents('php://input'), true);

    // $sj = $db->query("SELECT  `tb_class`.`Class_ID`, 
    //                           `tb_subject`.`Subject_PK`, 
    //                           `tb_subject`.`Subject_ID`,
    //                           `tb_subject`.`Subject_NameTH`,
    //                           `tb_subject`.`Subject_NameEN`,
    //                           `tb_subject`.`Subject_Theory`,
    //                           `tb_subject`.`Subject_Practice`
    //                   FROM `tb_class` 
    //                   LEFT JOIN `tb_subject`
    //                   ON `tb_class`.`Subject_PK` = `tb_subject`.`Subject_PK`");

    $sl = $db->query("SELECT * 
                      FROM `tb_schedule` 
                      LEFT JOIN  `tb_class`
                      ON `tb_schedule`.`Class_ID` = `tb_class`.`Class_ID`
                      WHERE `tb_class`.`User_ID` = '" . $rawData['User_ID'] . "'");

    $sls = "false";
    // floatval($var);

    for ($i = 0; $i < $sl['rowCount']; $i++) {
      if (
        $sl['result'][$i]['User_ID'] == $rawData['User_ID'] &&
        $sl['result'][$i]['Day'] == $rawData['Day'] &&
        $sl['result'][$i]['Start_Time'] == $rawData['Start_Time'] &&
        $sl['result'][$i]['End_Time'] == $rawData['End_Time']
        || (floatval(str_replace(":", ".", $sl['result'][$i]['Start_Time']) >= $rawData['Start_Time'])
          && floatval(str_replace(":", ".", $sl['result'][$i]['End_Time']) <= $rawData['End_Time']))
        //&& (floatval(str_replace(":", ".", $sl['result'][$i]['Start_Time']) >= $rawData['Start_Time']) && floatval(str_replace(":", ".", $sl['result'][$i]['End_Time']) <= $rawData['End_Time']))
      ) {
        $sls = "true";
      }
    }

    if ($sls == "true") {
      return false;
    } else {
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

    // $response->getBody()->write(\json_encode($sls));
    // return $response;
  }
}
