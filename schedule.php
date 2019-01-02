<?php 

include 'Sender.php';

/*
 * before update the IDS class values
 * put the registration ids inside REG_IDS array
 * remember that this array could contains id for gcm, fcm and adm and if you send the push by firebase the ids about the other services will fail
 * 
 * command
 * php schedule.php gcm|adm|fcm feed|url|category|simple prod|dev
 * 
 * gcm => Google Cloud Messaging
 * adm => Amazon Device Messaging
 * fcm => Firebase Cloud Messaging
 * 
 * feed     => open article with feedId equal to sent value
 * url      => open url in internal webview (xhttp should open in external browser)
 * category => open the app on the rss category
 * simple   => open newsmemory apps
 * 
 * this arg is just for firebase and is not mandatory
 * prod     => (use production firebase account)
 * dev      => (use debug firebase account)
 * 
 * if you send one of the following kind of pushes update Msg.php MSG constant
 *  - category => MSG_CATEGORY
 *  - feed     => MSG_FEED
 *  - url      => MSG_URL
 *  - simple   => MSG_SIMPLE
 */

$sender = new Sender( $argv );
$sender->send();