<?php
// https://stackoverflow.com/questions/7061802/php-function-for-get-all-mondays-within-date-range

namespace Controller;

use \Psr\Http\Message\ResponseInterface as Response;
use \Psr\Http\Message\ServerRequestInterface as Request;

class Day
{

  public function getDay(Request $request, Response $response, $args)
  {
    $db = new \Tools\Database();
    $rawData = json_decode(file_get_contents('php://input'), true);
    $query = $db->query("SELECT `tb_schedule`.`Schedule_ID`, `tb_schedule`.`Day`, `tb_class`.`Class_ID`, `tb_year`.`Year`, `tb_year`.`Term`, `tb_year`.`Start_SchYear`, `tb_year`.`End_SchYear` FROM `tb_schedule` LEFT JOIN `tb_class` ON `tb_schedule`.`Class_ID` = `tb_class`.`Class_ID` LEFT JOIN `tb_year` ON `tb_class`.`Year_ID` = `tb_year`.`Year_ID`
         ");
    // $day = array();
    // $startDate = '2021-04-01';
    // $endDate = '2021-04-30';
    // for ($i = strtotime($startDate); $i <= strtotime($endDate); $i = strtotime('+1 day', $i)) {
    //   if (date('N', $i) == 1) { //Monday == 1
    //     echo date('l Y-m-d', $i); //prints the date only if it's a Monday
    //     array_push($day, date('l Y-m-d', $i));
    //   }
    //   elseif (date('N', $i) == 2) { //Tuesday == 2
    //     echo date('l Y-m-d', $i); //prints the date only if it's a Monday
    //     array_push($day, date('l Y-m-d', $i));
    //   }
    //   elseif (date('N', $i) == 3) { //06Wednesday == 3
    //     echo date('l Y-m-d', $i); //prints the date only if it's a Monday
    //     array_push($day, date('l Y-m-d', $i));
    //   }
    //   elseif (date('N', $i) == 4) { //07Thursday == 4
    //     echo date('l Y-m-d', $i); //prints the date only if it's a Monday
    //     array_push($day, date('l Y-m-d', $i));
    //   }
    //   elseif (date('N', $i) == 5) { //08Friday == 5
    //     echo date('l Y-m-d', $i); //prints the date only if it's a Monday
    //     array_push($day, date('l Y-m-d', $i));
    //   }
    //   elseif (date('N', $i) == 6) { //09Saturday == 6
    //     echo date('l Y-m-d', $i); //prints the date only if it's a Monday
    //     array_push($day, date('l Y-m-d', $i));
    //   }
    //   elseif (date('N', $i) == 7) { //10Sunday == 7
    //     echo date('l Y-m-d', $i); //prints the date only if it's a Monday
    //     array_push($day, date('l Y-m-d', $i));
    //   }
    // }
    $response->getBody()->write(\json_encode($query));
    return $response;
  }
}