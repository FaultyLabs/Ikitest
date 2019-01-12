<?php

  class HomeController extends Controller {

    public function __construct(){
      //Define All required models here
      $this->users = $this->model('Users');
    }

    public function index(){
      if(Request::get()->post()){
        $body = (Object) (Object) json_decode(Request::get()->post());
        $this->users->fullName = $params->full_name;
        $this->users->userName = $params->user_name;
        $this->users->gender = $params->gender;
        $this->users->password	= $params->password;
        $this->users->email = $params->email;
        $this->users->phone = $params->phone;
        $this->users->address = $params->address;
        $this->users->stateId = $params->stateid;
        $this->users->avatar = null;
        $this->users->signupDate = date("Y-m-d H:i:s");
        $this->status = '0';
        $this->isBlocked = '0';
        //var_dump($this->users, true);die();
        $this->users->save();
      }
      $data = [
        'title' => 'Home Page'
      ];
      $this->view('index', $data);
    }
  }