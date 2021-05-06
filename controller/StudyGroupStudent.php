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
    $query = $db->query("INSERT INTO `tb_student`
        (
        Std_ID,
        Std_FirstName	,
        Std_LastName,
        Class_ID
        )
        VALUES
        (
        '" . $rawData['Year'] . "',
        '" . $rawData['Term'] . "',
        '" . $rawData['Start_SchYear'] . "',
        '" . $rawData['End_SchYear'] . "'
        );");

    $response->getBody()->write(\json_encode($query));
    return $response;
  }
}
