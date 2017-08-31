<?php
namespace App\Http\Controllers\vertiy;
use App\Http\Controllers\Controller;
use EasyWeChat\Foundation\Application;
class serverController extends Controller{
    function vertiy(){
        $options = [
            'debug'  => true,
            'app_id' => 'your-app-id',
            'secret' => 'you-secret',
            'token'  => 'easywechat',
            // 'aes_key' => null, // 可选
            'log' => [
                'level' => 'debug',
                'file'  => '/tmp/easywechat.log', // XXX: 绝对路径！！！！
            ],
            //...
        ];
        $app = new Application($options);
        $response = $app->server->serve();
        return $response;
    }
}