<?php

namespace Controller;

use \Psr\Http\Message\ResponseInterface as Response;
use \Psr\Http\Message\ServerRequestInterface as Request;

class User
{
  public function login(Request $request, Response $response, $args)
  {
    $rawData = json_decode(file_get_contents('php://input'), true); // Data from Front-end

    $db = new \Tools\Database();
    $query =  $db->query("SELECT * FROM `tb_user` WHERE `Username` = '" . $rawData['username'] . "'");

    $returnData = null;

    if ($query['rowCount'] > 0) {
      if ($query['result'][0]['User_Password'] == $rawData['password']) {
        $returnData = array(
          "success" => true,
          "message" => "เข้าสู่ระบบสำเร็จ",
          "data" => $query['result'][0]
        );
      } else {
        $returnData = array(
          "success" => false,
          "message" => "ข้อมูลผู้ใช้งานไม่ถูกต้อง"
        );
      }
    } else {
      $returnData = array(
        "success" => false,
        "message" => "ข้อมูลผู้ใช้งานไม่ถูกต้อง"
      );
    }

    $response->getBody()->write(\json_encode($returnData));
    return $response;
  }
}
