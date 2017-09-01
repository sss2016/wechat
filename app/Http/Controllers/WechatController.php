<?php
/**
 * Created by PhpStorm.
 * User: weiyalin
 * Date: 2017/8/31
 * Time: 20:31
 */

namespace App\Http\Controllers;

use Log;
use DB;
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
        $name = trim($request->name);
        $num = trim($request->num);
        if( strlen($name) == 0 ||  strlen($num) == 0){
            return json_encode(['code' => 1, 'msg' => '请将数据填写完整']);
        }
        $user = session('wechat.oauth_user');
        $openid = $user->id;

        $count = DB::table("user_info")
            ->where('open_id',$openid)
            ->count();

        if($count){
            return json_encode(['code' => 1, 'msg' => '已报名，请不要重复报名']);
        }

        DB::table('user_info')->insert([
            'user_name' =>$name,
            'user_phone'=>$num,
            'open_id'   =>$openid
        ]);
        return json_encode(['code' => 0, 'msg' => '报名成功']);
    }

}