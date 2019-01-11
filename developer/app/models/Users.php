<?php 

  class Users extends Model {
    public function create($params){
      if(is_object($params)){
        $this->fullName = $params->full_name;
        $this->userName = $params->user_name;
        $this->gender = $params->gender;
        $this->password	= $params->password;
        $this->email = $params->email;
        $this->phone = $params->phone;
        $this->address = $params->address;
        $this->stateId = $params->stateid;
        $this->status = '0';
        $this->isBlocked = '0';
        App::debug($this, true);
        $this->save();
      }
    }

    public function user_authentication($email = '', $password = ''){
    }

    public function update($params){
      if(is_object($params)){

      }
    }
  }