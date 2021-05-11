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

    @mkdir("imageStudent/" . $rawData['username'], 0777, true);
    $fileDir = array();
    if ($dh = opendir("imageStudent/" . $rawData['username'])) {
      while (($file = readdir($dh)) !== false) {
        if ($file != "." && $file != "..") array_push($fileDir, explode('.', $file)[0]);
      }
      closedir($dh);
    }

    for ($i = 1; $i < 8; $i++) {
      if (array_search(strval($i), $fileDir) === false) {
        $filename = "imageStudent/" . $rawData['username'] . "/" . $i . ".jpg";
        $ifp = fopen($filename, 'wb');
        $base64_string = explode(',', $rawData['image']);
        fwrite($ifp, base64_decode($base64_string[1]));
        fclose($ifp);
        $output = array(
          "success" => true,
          "message" => $filename
        );

        break;
      } else {

        $output = array(
          "success" => false,
          "message" => "Image Full"
        );
      }
    }

    $fileDir2 = array();
    if ($dh2 = opendir("imageStudent/" . $rawData['username'])) {
      while (($file2 = readdir($dh2)) !== false) {
        if ($file2 != "." && $file2 != "..") array_push($fileDir2, explode('.', $file2)[0]);
      }
      closedir($dh2);
    }

    for ($i = 1; $i < 8; $i++) {
      if (array_search(strval($i), $fileDir2) === false) {
        break;
      } else {
        if ($i == 7) {
          $listImageStudent = array();
          if ($dh = opendir("imageStudent")) {
            while (($file = readdir($dh)) !== false) {
              if ($file != "." && $file != "..") array_push($listImageStudent, $file);
            }
            closedir($dh);
          }
          $dumpListImageStudent = \json_decode(\file_get_contents('listname.json'));
          $NewListImageStudent = array_merge($dumpListImageStudent, $listImageStudent);
          // $NewListImageStudent = array_unique($NewListImageStudent, SORT_REGULAR);
          $fJson = fopen('listname.json', 'w');
          fwrite($fJson, json_encode($listImageStudent));
          fclose($fJson);
        } else {
          $dumpListImageStudent = \json_decode(\file_get_contents('listname.json'));
          $dumpListImageStudent = \array_diff($dumpListImageStudent, [$rawData['username']]);
          // $dumpListImageStudent = array_unique($dumpListImageStudent, SORT_REGULAR);
          $fJson = fopen('listname.json', 'w');
          fwrite($fJson, json_encode($dumpListImageStudent));
          fclose($fJson);
        }
      }
    }

    $response->getBody()->write(\json_encode($output));
    return $response;
  }

  public function delImageinformation(Request $request, Response $response, $args)
  {
    $db = new \Tools\Database();
    $rawData = json_decode(file_get_contents('php://input'), true);
    $output = null;

    $path = "imageStudent/".$rawData['username'] ."/" .$rawData['imageName'] ;

    if (unlink($path)) {
      $output = array(
        "success" => true
      );
    } else {
      $output = array(
        "success" => false
      );
    } 

    // unlink("imageStudent");
 
    $response->getBody()->write(\json_encode($output));
    return $response;
  }
}
