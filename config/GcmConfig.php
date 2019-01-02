<?php

include_once 'BaseConfig.php';

class GcmConfig extends BaseConfig{
    
    public function __construct( $apiKey ){
        parent::__construct( $apiKey );
    }

    protected function send( $apiKey, $msg, $registrationIds ){
        $fields = array
        (
            'registration_ids' 	=> $registrationIds,
            'data'			=> $msg
        );
    
        $headers = array
        (
            'Authorization: key=' . $apiKey,
            'Content-Type: application/json'
        );
    
        return $this->curl( 'https://android.googleapis.com/gcm/send', $headers, json_encode( $fields ));
    }
} 