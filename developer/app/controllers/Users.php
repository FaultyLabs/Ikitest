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
      
      if(Request::get()->getMethod() == 'GET'){
        if(empty($id)){
          http_response_code(200);
          echo json_encode(
            $this->users->read([
              'fullName',
              'userName',
              'gender',
              'email',
              'phone',
              'address',
              'stateId',
              'avatar',
              'status',
              'isBlocked'
            ])
          );
        }else if(is_numeric($id)){
          http_response_code(200);
          echo json_encode(
            $this->users->read([
              'fullName',
              'userName',
              'gender',
              'email',
              'phone',
              'address',
              'stateId',
              'avatar',
              'status',
              'isBlocked'
            ], ['id' => $id])
          );
        }
      }
    }

    public function delete($id = ''){
      if(Request::get()->getMethod() == 'DELETE' ){
        echo 'deleting user';
      }
      /* if(is_numeric($id)){
        $this->users->delete($id);
      } */
    }

    public function update($id = ''){
      if(is_numeric($id)){
        
      }
    }
  }