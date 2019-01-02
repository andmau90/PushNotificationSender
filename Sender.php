<?php

include 'IDS.php';
include 'Msg.php';
include 'Configurator.php';
include 'config/GcmConfig.php';
include 'config/FcmConfig.php';
include 'config/AdmConfig.php';

class Sender{
    private $command;
    private $sender;
    private $ids;

    function __construct( $params ){
        $this->command = $params;
        $this->ids = new IDS();
    }

    private function getMsg( $mMsgType ){
        switch( $mMsgType ){
            case 'category':
                return Msg::$MSG_CATEGORY;
                break;
            case 'feed':
                return Msg::$MSG_FEED;
                break;
            case 'url':
                return Msg::$MSG_URL;
                break;
            default:
                return Msg::$MSG_SIMPLE;
        }
    }

    private function initAmazonSender(){
        $this->sender = new AdmConfig( $this->ids->getAmazonClientId(), $this->ids->getAmazonClientSecret());
    }

    private function initFirebaseSender(){
        /*
        * check if the app is registered in firebase console
        */
        if( Configurator::getIsProd( $this->command )){
            $this->sender = new FcmConfig( $this->ids->getFcmApiKeyProd());
        }
        else{
            $this->sender = new FcmConfig( $this->ids->getFcmApiKeyDebug());
        }
    }

    private function initGcmSender(){
        $this->sender = new GcmConfig( $this->ids->getGcmApiKey());
    }

    private function initSender(){
        $service = Configurator::getService( $this->command );
        switch( $service ){
            case STR_ADM_SERVICE:
                //provided by the app, you che see the value inside Log (search ADM)
                $this->initAmazonSender();
                break;
            case STR_FCM_SERVICE:
                //provided by the app, you che see the value inside Log (search FCM)
                $this->initFirebaseSender();
                break;
            default:
                //provided by the app, you che see the value inside Log (search GCM)
                $this->initGcmSender();
        }
        $this->sender->setRegistrationIds( $this->ids->getRegIds( $service ));
        $this->sender->setMsg( $this->getMsg( Configurator::getMsgType( $this->command )));
    }

    private function schedulePush(){
        $this->printContent();
        /**
         * You can see the push content received by the device if you search inside log
         * the following regex ^PUSH(_(adm|fcm|gcm))?$
         */
        $this->sender->schedulePush();
        $this->printResult();
    }

    public function send(){
        $this->initSender();
        $this->schedulePush();
    }

    public function printContent(){
        printf( '%s=========================== CONTENT ===========================%s', PHP_EOL, PHP_EOL );
        printf( 'Registration Ids: %s', PHP_EOL );
        print_r( $this->sender->getRegistrationIds() );
        printf( 'Message: %s', PHP_EOL );
        print_r( $this->sender->getMsg() );
    }

    public function printResult(){
        printf( '%s============================ RESULT ===========================%s', PHP_EOL, PHP_EOL );
        printf( 'Json response: %s', PHP_EOL );
        print_r( json_decode( $this->sender->getSchedulePushResult(), true ));
    }
}