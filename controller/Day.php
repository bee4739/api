<?php
// https://stackoverflow.com/questions/7061802/php-function-for-get-all-mondays-within-date-range

namespace Controller;

use \Psr\Http\Message\ResponseInterface as Response;
use \Psr\Http\Message\ServerRequestInterface as Request;

class Day
{

  public function day(Request $request, Response $response, $args)
  {
    // $db = new \Tools\Database();
    // $rawData = json_decode(file_get_contents('php://input'), true);
    // $query = $db->query("INSERT INTO `tb_schedule`(`Schedule_ID`, `Day`, `Start_Time`, `End_Time`, `Subject_PK`, `Class_ID`, `User_ID`) VALUES
    //      ");



    // $day = array();
    // $startDate = '2021-04-01';
    // $endDate = '2021-04-30';
    // for ($i = strtotime($startDate); $i <= strtotime($endDate); $i = strtotime('+1 day', $i)) {
    //   if (date('N', $i) == 1) { //Monday == 1
    //     // echo date('l Y-m-d', $i); //prints the date only if it's a Monday
    //     // array_push($day, date('l Y-m-d', $i));
    //     $query .= date('l Y-m-d', $i);
    //   }
    //   // elseif (date('N', $i) == 2) { //Monday == 1
    //   //   echo date('l Y-m-d', $i); //prints the date only if it's a Monday
    //   //   array_push($day, date('l Y-m-d', $i));
    //   // }
    // }
    // echo json_encode($query);
  }
}
