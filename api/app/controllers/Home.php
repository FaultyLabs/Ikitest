<?php

  class HomeController extends Controller {

    public function __construct(){
      //Define All required models here
    }

    public function index(){
      $data = [
        'title' => 'Home Page'
      ];
      $this->view('index', $data);
    }
  }