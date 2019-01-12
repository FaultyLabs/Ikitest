<?php 

  class History extends Model {
    private function return_data(){
      return [
        'userId',
        'quizId',
        'sessionKey',
        'completionTime',
        'score',
        'status',
        'date'
      ];
    }

    public function create_record($params){
      $this->userId = $params->userid;
      $this->quizId = $params->quizid;
      $this->sessionKey = $params->sessionkey;
      //$this->completionTime	= $params->time;
      $this->score = $params->score;
      //$this->status = $params->status;
      //$this->date = $params->date;
      return $this->save();
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
  }