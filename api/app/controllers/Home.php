<?php

  class HomeController extends Controller {

    public function __construct(){
      //Define All required models here
      $this->user = $this->model('Users');
    }

    public function index(){
      $data = [
        'title' => 'Home Page'
      ];
      echo json_encode($data);
    }

    public function about(){
      $data = [
        'title' => 'About Page'
      ];
      
      $this->view('about', $data);
    }

    public function contact(){
      $this->view('contact');
    }
  }