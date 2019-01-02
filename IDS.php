<?php

class IDS
{
    public function getAmazonClientSecret()
    {
        return 'PUT_HERE_AMAZON_SECRET';
    }

    public function getAmazonClientId()
    {
        return 'PUT_HERE_AMAZON_CLIENT_ID';
    }

    public function getGcmApiKey()
    {
        return 'PUT_HERE_GCM_API_KEY';
    }

    public function getFcmApiKeyProd()
    {
        return 'PUT_HERE_FCM_API_KEY_PRODUCTION';
    }

    public function getFcmApiKeyDebug()
    {
        return 'PUT_HERE_FCM_API_KEY_DEBUG';
    }

    public function getRegIds($service)
    {
        switch ($service) {
            case STR_ADM_SERVICE:
                return array(
                    'PUT_HERE_LIST_OF_AMAZON_DEVICE_ID'
                );
            case STR_FCM_SERVICE:
                return array(
                    'PUT_HERE_LIST_OF_FCM_DEVICE_ID'
                );
            case STR_GCM_SERVICE:
                return array(
                    'PUT_HERE_LIST_OF_GCM_DEVICE_ID'
                );
            default:
                return array();
        }
    }
}