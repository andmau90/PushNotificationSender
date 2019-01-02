<?php 

define( "STR_ADM_SERVICE", 'adm' );
define( "STR_FCM_SERVICE", 'fcm' );
define( "STR_GCM_SERVICE", 'gcm' );

class Configurator{

    private static $SERVICES = array( STR_GCM_SERVICE, STR_FCM_SERVICE, STR_ADM_SERVICE );
    private static $TYPES = array( 'simple', 'category', 'feed', 'url' );

    public static function getIsProd( $argv ){
        return in_array( 'prod', $argv ) ? true : false;
    }

    public static function getService( $argv ){
        return Configurator::findTheSameItemBetweenArrays( $argv, Configurator::$SERVICES );
    }

    public static function getMsgType( $argv ){
        return Configurator::findTheSameItemBetweenArrays( $argv, Configurator::$TYPES );
    }

    private static function findTheSameItemBetweenArrays( $source, $base ){
        for( $i = 0; $i < count( $source ); $i++ ){
            if(in_array( $source[ $i ], $base )){
                return $source[ $i ];
            }
        }
        return $base[ 0 ];
    }
}