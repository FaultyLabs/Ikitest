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
      if(Request::get()->getMethod() == 'POST' && Request::get()->has_post()){
        $body = (Object) json_decode(Request::get()->post());
        $this->users->create($body);

        http_response_code(201);
      }
    }


  }