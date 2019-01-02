<?php

abstract class BaseConfig{

    private $mApikey = '';
    private $mRegistrationIds = array();
    private $mMsg = array();
    private $mSchedulePushResult;

    public function __construct( $apiKey ){
        $this->mApikey = $apiKey;
    }

    //Force Extending class to define this method
    abstract protected function send( $apiKey, $msg, $registrationIds );
    
    public function schedulePush( ){
        $this->mSchedulePushResult = $this->send( $this->getApiKey(), $this->getMsg(), $this->getRegistrationIds() );
    }

    public function setRegistrationIds( $registrationIds=array() ){
        $this->mRegistrationIds = $registrationIds;
    }

    public function getRegistrationIds(){
        return $this->mRegistrationIds;
    }

    public function getSchedulePushResult(){
        return $this->mSchedulePushResult;
    }

    public function getMsg(){
        return $this->mMsg;
    }

    public function setMsg( $msg=array() ){
        $this->mMsg = $msg;
    }

    public function getApiKey(){
        return $this->mApikey;
    }

    protected function curl( $url, $headers, $fields ){
        $ch = curl_init();
        curl_setopt( $ch,CURLOPT_URL, $url );
        curl_setopt( $ch,CURLOPT_POST, true );
        curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch, CURLOPT_POSTFIELDS, $fields );
        curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers );
        $result = curl_exec( $ch );
        curl_close( $ch );
        return $result;
    }
}