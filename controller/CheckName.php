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
      "SELECT tb_student.*, tb_user.*,
      CONCAT(tb_checked.`Time`) as isCheck
      FROM tb_student

      LEFT JOIN tb_user
      ON tb_student.`Std_No` = tb_user.`User_ID`

      LEFT JOIN tb_checked
      ON tb_student.`Std_No` = tb_checked.`Std_No` 
      AND tb_checked.`Schedule_ID` = '" . $rawData['Schedule_ID'] . "'
      AND tb_checked.`Date` = '" . date("Y-m-d") . "'
      
      WHERE tb_student.`Class_ID` = '" . $rawData['Class_ID'] . "'
      ORDER BY `tb_user`.`Std_ID`"
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
        $query_user[] =  $db->query("SELECT * FROM tb_user WHERE Username = '" . $list . "' LIMIT 1");
      }
    }

    if (count($query_user) > 0) {
      foreach ($query_user as $list_result) {
        if (count($list_result['result']) > 0) {
          $insertStatus[] = $db->query("INSERT INTO tb_checked
          (
          Std_No,
          Schedule_ID,
          Class_ID,
          Composite_ID,
          Status
          )
          VALUES
          (
          '" . $list_result['result'][0]['User_ID'] . "',
          '" . $rawData['Schedule_ID'] . "',
          '" . $rawData['Class_ID'] . "',
          '" . @$rawData['Composite_ID'] . "',
          '" . $rawData['Status'] . "'
          );");
        }
      }
    }

    $query =  $db->query(
      "SELECT * FROM tb_checked
      LEFT JOIN tb_user
      ON tb_checked.`Std_No` = tb_user.`User_ID`
      LEFT JOIN tb_schedule
      ON tb_checked.`Schedule_ID` = tb_schedule.`Schedule_ID`
      WHERE tb_checked.`Schedule_ID` = '" . $rawData['Schedule_ID'] . "'
      AND tb_checked.`Class_ID` = '" . $rawData['Class_ID'] . "'
      AND tb_checked.`Date` = CURRENT_DATE()
      "
    );

    $response->getBody()->write(\json_encode($query));
    return $response;
  }


  public function gettime(Request $request, Response $response, $args)
  {
    $db = new \Tools\Database();
    $rawData = json_decode(file_get_contents('php://input'), true);

    $query = $db->query(
      "SELECT Start_Time, `End_Time`, `Schedule_ID`, `Class_ID`
        FROM tb_schedule
        WHERE Class_ID = '" . $rawData['Class_ID'] . "' 
        AND Schedule_ID = '" . $rawData['Schedule_ID'] . "'
      "
    );

    $response->getBody()->write(\json_encode($query));
    return $response;
  }

  public function getSummarySub(Request $request, Response $response, $args)
  {
    $db = new \Tools\Database();
    $rawData = json_decode(file_get_contents('php://input'), true);

    $query = $db->query(
      "SELECT
        tb_subject.`Subject_ID`,
        tb_subject.`Subject_NameTH`,
        tb_class.`Group_Study`,
        tb_schedule.`Subject_Type`
      FROM tb_schedule 
      LEFT JOIN tb_class 
      ON tb_schedule.`Class_ID` = tb_class.`Class_ID` 
      LEFT JOIN tb_subject 
      ON tb_class.`Subject_PK` = tb_subject.`Subject_PK`
      WHERE tb_schedule.`Class_ID` = '" . $rawData['Class_ID'] . "' 
      AND tb_schedule.`Schedule_ID` = '" . $rawData['Schedule_ID'] . "'
      "
    );

    $response->getBody()->write(\json_encode($query));
    return $response;
  }

  public function getSummary(Request $request, Response $response, $args)
  {
    $db = new \Tools\Database();
    $rawData = json_decode(file_get_contents('php://input'), true);
    // $a =  "IF(`tb_checked`.`Status` IS NULL, " - ", `tb_checked`.`Status`) AS 'Status',
    //       IF(`tb_checked`.`Time` IS NULL, " - ", `tb_checked`.`Time`) AS 'Time'";
    $query = $db->query(
      "SELECT 	`tb_student`.`Std_ID`, 
                `tb_student`.`Std_Title`,
                `tb_student`.`Std_FirstName`, 
                `tb_student`.`Std_LastName`,
                `tb_checked`.`Status`,
                `tb_checked`.`Time`
      FROM `tb_student` 
      LEFT JOIN `tb_checked`
      ON `tb_student`.`Std_No` = `tb_checked`.`Std_No`
      AND `tb_student`.`Class_ID` =  `tb_checked`.`Class_ID`
      WHERE `tb_checked`.`Status` IS NULL
      AND `tb_student`.`Class_ID` = '" . $rawData['Class_ID'] . "'
      UNION
      SELECT 	  `tb_student`.`Std_ID`, 
                `tb_student`.`Std_Title`,
                `tb_student`.`Std_FirstName`, 
                `tb_student`.`Std_LastName`,
                `tb_checked`.`Status`,
                `tb_checked`.`Time`
      FROM `tb_student` 
      LEFT JOIN `tb_checked`
      ON `tb_student`.`Std_No` = `tb_checked`.`Std_No`
      AND `tb_student`.`Class_ID` =  `tb_checked`.`Class_ID`
      WHERE `tb_checked`.`Status` IS NOT NULL
      AND `tb_checked`.`Date` =  CURRENT_DATE()
      AND `tb_checked`.`Class_ID` = '" . $rawData['Class_ID'] . "'
      AND `tb_checked`.`Schedule_ID` = '" . $rawData['Schedule_ID'] . "'
      ORDER BY  `Std_ID`
      "
    );

    $response->getBody()->write(\json_encode($query));
    return $response;
  }

  public function getTimeCheck(Request $request, Response $response, $args)
  {
    $db = new \Tools\Database();
    $rawData = json_decode(file_get_contents('php://input'), true);

    $query = $db->query(
      "SELECT 	`tb_user`.`Username`,
                `tb_checked`.`Std_No`, 
                `tb_checked`.`Schedule_ID`, 
                `tb_checked`.`Class_ID`, 
                `tb_checked`.`Time` 
      FROM `tb_checked`
  
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
