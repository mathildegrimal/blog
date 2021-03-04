<?php
class BlogException extends Exception {
    static $prefs = [
        "0" => "Cannot access to dB: ",
        "1" => "Get comments : ",
        "2" => "Insert comments : ",
        "3" => "Get articles : ",        
        "4" => "Insert article : ",
        "5" => "Get id article : ",
         "6"=> "Get one article : ",
    ];

    public function __construct (int $BlogUseCase, string $mess) {
        parent::__construct (self::$prefs[$BlogUseCase] . $mess);
    }

    public function getErrorMessage(int $BlogUseCase, string $mess){
        return self::$prefs[$BlogUseCase] . $mess;
    }
}