<?php
namespace App\Library;
// 2014-05-07 by KaI2KId
class STTSWebService {
  protected $model;
  protected $constructor;
  protected $data;
  private $app_name = "silabus";

  public function __CALL($name,$param = "") {
    $p = (isset($param[0]) ? $param[0] : "");
    $ret = $this->request($this->model,$this->constructor,$name,$p);
    return $ret->response;
  }
  public function __GET($name) { return $this->$name(); }

  public function __construct($model,$constructor = "-") {
    $this->model = $model;
    $this->constructor = $constructor;
  }
  public function request($model,$constructor,$method,$param="") {
    $options = array(
      'http'=>array(
        'header'=>"token: ".config('app.ws_token')."\r\n"
      )
    );
    $context = stream_context_create($options);
    $url = "https://ws.stts.edu/".$model."/".$constructor."/".urlencode($method)."/".urlencode($param) . "&appname=" . $this->app_name;
    $data = file_get_contents($url,false,$context);
    if (in_array("Content-Type: application/json",$http_response_header)) {
      return json_decode($data);
    } else {
      return json_decode(json_encode(new \SimpleXMLElement($data,LIBXML_COMPACT,0)));
    }
  }
}
