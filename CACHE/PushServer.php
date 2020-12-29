<?php
/**
 * Created by PhpStorm.
 * User: zhengbingdong
 * Date: 2020/08/15
 * Time: 01:06
 */

class PushServer
{
    private static $instance;
    private static $server;
    public $messageHandler;//处理消息的对象

    //不能够在类外面创建该对象的实例
    private function __construct()
{
        //>>1.创建websocket对象
        self::$server = new swoole_websocket_server('0.0.0.0', 9502);
        //>>2.注册事件
        self::$server->on('open', [$this, 'onOpen']);//将当前类的onOpen方法作为open的事件处理函数
        self::$server->on('message', [$this, 'onMessage']);
        self::$server->on('close', [$this, 'onClose']);
        self::$server->on('workerStart',[$this,'onWorkerStart']);
    }

    //当客户端连上之后要执行的方法
    public function onOpen($server, $req)
{
        echo "connection open: {$req->fd}\n";
    }

    //客户端向服务器发送消息要执行的方法
    public function onMessage($server, $frame)
{
        //将传输的json转成数组
        $data = json_decode($frame->data,true);
        //检查方法是否存在
        if (method_exists($this->messageHandler,$data['cmd'])){
            call_user_func([$this->messageHandler,$data['cmd']],self::$server,$data['data']);
        }else{
            $outMessage = json_encode([
                'status' => 'error',
                'msg' => '非法操作'
            ]);
            echo $outMessage."\n";
            self::$server->push($frame->fd, $outMessage);
        }
    }

    //客户端和服务器端断开连接时执行的方法
    public function onClose($server,$fd)
{
        $online = [];
        foreach ($server->connections as $clientId) {
            array_push($online, $clientId);
            $outMessage = json_encode(
                [
                    'type' => 'close',
                    'fid' => $clientId,
                    'online' => $online,
                    'num' => count($server->connections)
                ]
            );
            self::$server->push($clientId, $outMessage);
        }
        echo "当前服务器共有 " . count($server->connections) . " 个连接\n";
        echo '客户端或服务器断开连接'.$fd."\n";
    }

    //服务器启动之后执行
    public function onWorkerStart(){
        echo 'onWorkerStart----------'.date('Y-m-d H:i:s')."\n";
        require './MessageHandler.php';
        $this->messageHandler = new MessageHandler();
    }

    public static function getInstance()
{
        if (!self::$instance instanceof self) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function start()
{
        self::$server->start();
    }
}

PushServer::getInstance()->start();//启动推送服务器