<?php
namespace frontend\daemon;


use yii\base\BootstrapInterface;
use frontend\daemon\ChatServer;
use consik\yii2websocket\WebSocketServer;

class ServerController implements BootstrapInterface
{


    public function bootstrap($app)
    {

        $server = new ChatServer();
        $server->port = 8080; //This port must be busy by WebServer and we handle an error

        $server->on(WebSocketServer::EVENT_WEBSOCKET_OPEN_ERROR, function($e) use($server) {
            //echo "Error opening port " . $server->port . "\n";
            $server->port += 1; //Try next port to open
            $server->start();
        });

        $server->on(WebSocketServer::EVENT_WEBSOCKET_OPEN, function($e) use($server) {
           // echo "Server started at port " . $server->port;
        });

        $server->start();

    }



}

