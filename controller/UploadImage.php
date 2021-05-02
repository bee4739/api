<?php

namespace Controller;

use \Psr\Http\Message\ResponseInterface as Response;
use \Psr\Http\Message\ServerRequestInterface as Request;

class UploadImage
{
  public function createImage(Request $request, Response $response, $args)
  {
    $db = new \Tools\Database();
    $rawData = json_decode(file_get_contents('php://input'), true);
    $output = null;
    // $query = $db->query("SELECT `Username` FROM `tb_user`");
    // function create($username)
    // {
    //   if (!) {
    //     throw new \Exception(false);
    //   }
    //   return true;
    // }

    // try {
    //   create($rawData['username']);
    //   $output = array(
    //     "success" => true,
    //     "message" => "success"
    //   );
    // } catch (\Exception $e) {
    //   $output = array(
    //     "success" => false,
    //     "message" => "unsuccess"
    //   );
    // }
    @mkdir("imageStudent/" . $rawData['username'], 0777, true);

    $filename = "imageStudent/" . $rawData['username'] . "/" . time() . ".jpg";
    $ifp = fopen($filename, 'wb');
    $base64_string = explode(',', $rawData['image']);
    fwrite($ifp, base64_decode($base64_string[1]));
    fclose($ifp);

    $response->getBody()->write(\json_encode($output));
    return $response;
  }
}
