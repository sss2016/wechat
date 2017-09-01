<?php
namespace App\Http\Controllers\vertiy;
use App\Http\Controllers\Controller;
use EasyWeChat\Foundation\Application;
class serverController extends Controller{
    function vertiy(){
//        $options = [
//            'debug'  => true,
//            'app_id' => 'wxde73fc69ecd9fb77',
//            'secret' => '011e665f7f82702303499fe5a78423b4',
//            'token'  => 'easywechat',
//            // 'aes_key' => null, // 可选
//            'log' => [
//                'level' => 'debug',
//                'file'  => '/tmp/easywechat.log', // XXX: 绝对路径！！！！
//            ],
//            //...
//        ];
//        $app = new Application($options);
//        $response = $app->server->serve();
//        return $response;
        $wechat = app('wechat');
        $wechat->server->setMessageHandler(function($message){
            return "欢迎关注 overtrue！";
        });

//        Log::info('return response.');

        return $wechat->server->serve();

    }
}