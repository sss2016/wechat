<?php
/**
 * Created by PhpStorm.
 * User: weiyalin
 * Date: 2017/8/31
 * Time: 20:31
 */

namespace App\Http\Controllers;

use Log;
use Illuminate\Http\Request;
class WechatController extends Controller
{
    /**
     * 处理微信的请求消息
     * @return string
     */
    public function serve()
    {
        Log::info('request arrived.');
        $app = app('wechat');
        $app->server->setMessageHandler(function($message) use ($app){

            if ($message->MsgType=='event') {

                $user_openid = $message->FromUserName;

                if ($message->Event=='subscribe') {

                    return '欢迎关注';

                }else if ($message->Event=='unsubscribe') {

                    return '已取消关注';

                }
            }
        });
        Log::info('return response.');
        return $app->server->serve();
    }

    public function menu_add()
    {
        $app = app('wechat');
        $menu = $app->menu;
        $menu->destroy();
        $buttons = [
            [
                "type" => "view",
                "name" => "报名",
                "url" =>  env('APP_URL') . '/enroll'
            ],

        ];
        $menu->add($buttons);
        echo "OK";
    }
    public function sign(Request $request){
        $name = $request->name;
        $num = $request->num;
        $user = session('wechat.oauth_user');
        $openid = $user->id;
        echo $name.'=='.$num.'=='.$openid;
    }
}