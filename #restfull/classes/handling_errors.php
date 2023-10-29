<?php

class HandleError{
    private $code;
    private $status;
    private $message;

    public function __construct($code,$status,$message){
        $this->code=$code;
        $this->status=$status;
        $this->message=$message;

        http_response_code($code);
        echo json_encode(array(
            "status"=>$status,
            "message"=>$message
        ));
    }

}
// $han=new HandleError(400,1,"test");
