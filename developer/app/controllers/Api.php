<?php
  /**
   * Setting up controller
   */
  class ApiController extends Controller {
    static public $url = '';
    /**
     * Models and Widgets are initialized Here
     */
    public function __construct(){
      //Define All required models here
      
    }

    /**
     * Index Page for getting started
     */
    public function v1($url = '', $id = ''){
      self::$url = $url;

      $this->{self::$url} = $this->model(ucfirst(self::$url));

      if(Request::get()->getMethod() == 'POST' && Request::get()->has_post()){
        if(empty($id)){
          $body = (Object) json_decode(Request::get()->post());
          $response = $this->{self::$url}->create_record($body);
          App::debug(json_encode($response), true);
          if($response !== false){
            echo json_encode([
              "status" => true,
              "message" => self::$url . " record created"
            ]);
            http_response_code(201);
          }else{
            echo json_encode([
              "status" => false,
              "message" => "unable to create new " . self::$url . " record"
            ]);
            http_response_code(200);
          }
        }else{
          echo json_encode([
            "status" => false,
            "message" => "Method not allowed"
          ]);
          http_response_code(405);
        }
      }

      if(Request::get()->getMethod() == 'PUT' && Request::get()->has_post()){
        $body = (Object) json_decode(Request::get()->post());
        echo json_encode($this->{self::$url}->update_record($body));
        http_response_code(201);
      }
      
      if(Request::get()->getMethod() == 'GET'){
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");

        if(empty($id)){
          $this->response('get_all');
        }else if(is_numeric($id)){
          $this->response('get_one', [$id]);
        }
      }

      if(Request::get()->getMethod() == 'DELETE' && is_numeric($id)){
        $response = $this->{self::$url}->delete($id);
        if($response !== false){
          echo json_encode([
            "status" => true,
            "message" => self::$url . " record deleted successfully"
          ]);
          http_response_code(200);
        }else{
          echo json_encode([
            "status" => false,
            "message" => "unable to delete record"
          ]);
          http_response_code(200);
        }
      }

    }

    protected function response(string $method, $params = []){
      if(method_exists($this->{self::$url}, $method)){
        $response = call_user_func_array([$this->{self::$url}, $method], $params);
        echo $this->get_response($response);
      }else{
        http_response_code(204);
        echo json_encode(
          ["error" => array("status" => false, "message" => "Method not found.")]
        );
      }
    }

    protected function get_response($response = []){
      if(!empty($response)){
        http_response_code(200);
        return json_encode([
          "status" => true,
          "message" => self::$url . " retrieved",
          "data" => $response
        ]);
      }else{
        http_response_code(404);
        return json_encode([
          "status" => false, 
          "message" => "No records found."
        ]);
      }
    }

    public function __destruct(){
      self::$url = null;
      unset($this->{self::$url});
    }
  }