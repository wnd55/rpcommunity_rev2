<?php
/**
 * Created by PhpStorm.
 * User: webndesign
 * Date: 07.05.20
 * Time: 15:56
 */

namespace console\controllers;


use frontend\chat\ChatServer;
use Yii;
use yii\console\Controller;
use consik\yii2websocket\WebSocketServer;


Class ServerController extends Controller
{


    public function actionStart()
    {

        $server = new ChatServer();
        $server->port = 8080; //This port must be busy by WebServer and we handle an error

        $server->on(WebSocketServer::EVENT_WEBSOCKET_OPEN_ERROR, function ($e) use ($server) {
           echo "Error opening port " . $server->port . "\n";
            $server->port += 1; //Try next port to open
            $server->start();
        });

        $server->on(WebSocketServer::EVENT_WEBSOCKET_OPEN, function ($e) use ($server) {
            echo "Server started at port " . $server->port;
        });

        $server->start();




    }


}