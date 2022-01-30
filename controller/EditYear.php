<?php

namespace Controller;

use \Psr\Http\Message\ResponseInterface as Response;
use \Psr\Http\Message\ServerRequestInterface as Request;

class EditYear
{
  // public function editYear(Request $request, Response $response, $args)
  // {
  //   $db = new \Tools\Database();
  //   $rawData = json_decode(file_get_contents('php://input'), true);
  //   $query = $db->query("UPDATE `tb_year` SET 
  //     Year = '" . $rawData['YearE'] . "',
  //     Term = '" . $rawData['TermE'] . "',
  //     Start_SchYear = '" . $rawData['Start_SchYearE'] . "',
  //     End_SchYear = '" . $rawData['End_SchYearE'] . "',
  //     Start_Midterm = '" . $rawData['Start_MidtermE'] . "',
  //     End_Midterm = '" . $rawData['End_MidtermE'] . "',
  //     Start_Final = '" . $rawData['Start_FinalE'] . "',
  //     End_Final = '" . $rawData['End_FinalE'] . "'
  //     WHERE `tb_year`.`Year_ID` = '" . $rawData['Year_ID'] . "'");

  //   $response->getBody()->write(\json_encode($query));
  //   return $response;
  // }

  public function editYear(Request $request, Response $response, $args)
  {
    $db = new \Tools\Database();
    $rawData = json_decode(file_get_contents('php://input'), true);
    $query = $db->query("UPDATE `tb_year` SET 
      Year = '" . $rawData['YearE'] . "',
      Term = '" . $rawData['TermE'] . "',
      Start_SchYear = '" . $rawData['Start_SchYearE'] . "',
      End_SchYear = '" . $rawData['End_SchYearE'] . "'
      WHERE `tb_year`.`Year_ID` = '" . $rawData['Year_ID'] . "'");

    $response->getBody()->write(\json_encode($query));
    return $response;
  }
}
