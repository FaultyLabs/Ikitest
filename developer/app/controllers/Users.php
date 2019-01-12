<?php
  /**
   * Setting up controller
   */
  class UsersController extends Controller {
    /**
     * Models and Widgets are initialized Here
     */
    public function __construct(){
      //Define All required models here
      //API::get()->authenticate();
      $this->users = $this->model("Users");
    }

    /**
     * Index Page for getting started
     */
    public function index($id = ''){
      echo "Welcome to users api please use /api/v1/users";
      exit;
    }

    public function login(){
      if(Request::get()->getMethod() == 'POST' && Request::get()->has_post()){
        $body = (Object) json_decode(Request::get()->post());
        http_response_code(200);
        echo json_encode($this->users->user_authentication($body));
      }
    }
  }