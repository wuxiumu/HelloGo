<?php
/**
 * Created by PhpStorm.
 * User: zhengbingdong
 * Date: 2020/08/15
 * Time: 01:06
 */

class MessageHandler
{
    public function join($server, $data)
    {
        foreach ($server->connections as $fd) {
            $outMessage = json_encode(
                [
                    'type' => 'join',
                    'client_id' => $fd,
                    'name' => $data['name'],
                    'num' => count($server->connections)
                ]
            );
            $server->push($fd, $outMessage);
        }
    }

    public function sendMessage($server, $data){
        foreach ($server->connections as $fd) {
            $outMessage = json_encode(
                [
                    'name' => $data['name'],
                    'content' => $data['content']
                ]
            );
            $server->push($fd, $outMessage);
        }
    }

    public function changeNickName($server, $data){
        foreach ($server->connections as $fd) {
            $outMessage = json_encode(
                [
                    'type' => 'changeNickName',
                    'before' => $data['before'],
                    'after' => $data['after']
                ]
            );
            $server->push($fd, $outMessage);
        }
    }

    public function outLine(){
        echo '-------------------------离开了';
    }
}