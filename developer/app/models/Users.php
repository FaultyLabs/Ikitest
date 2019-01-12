<?php 

  class Users extends Model {

    private function return_data(){
      return [
        'fullName',
        'userName',
        'email',
        'gender',
        'phone',
        'address',
        'stateId',
        'avatar',
        'signupDate',
        'status',
        'isBlocked'
      ];
    }

    public function create_record($params){
      $this->fullName = $params->full_name;
      $this->userName = $params->user_name;
      $this->gender = $params->gender;
      $this->password	= $params->password;
      $this->email = $params->email;
      $this->phone = $params->phone;
      $this->address = $params->address;
      $this->stateId = $params->stateid;
      /* $this->avatar = null;
      $this->signupDate = date("Y-m-d H:i:s");
      $this->status = '0';
      $this->isBlocked = '0'; */
      //var_dump($this, true);die();
      $this->save();
    }

    public function get_all(){
      return $this->read(
        $this->return_data()
      );
    }

    public function get_one($id){
      return $this->read(
        $this->return_data(),
        ['id' => $id]
      );
    }

    public function user_authentication($params = null){
      if(isset($params->email) && isset($params->password)){
        $response = $this->read(
          $this->return_data(),
          ['email' => $params->email, 'password' => $params->password]
        );
        if(!empty($response)){
          return ["status" => true, "message" => "User found", "data" => $response];
        }else{
          return ["status" => false, "message" => "User not found"];
        }
      }else{
        return ["status" => false, "message" => "Inavlid data entry"];
      }
    }
  }