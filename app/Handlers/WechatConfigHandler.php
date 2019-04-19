<?php
namespace App\Handlers;

use App\Models\System\Wechat;
use EasyWeChat\Factory;

class WechatConfigHandler
{
    //[1-1]微信公众号设置
    public function app_config($account)
    {
        $wechat = Wechat::where('aid',$account)->first();
        if (!$wechat) {
            return $config = [];
        }
        $config = [
            'app_id'  => $wechat->wechat_app_id,      // AppID
            'secret'  => $wechat->wechat_secret,      // AppSecret
            'token'   => $wechat->wechat_token,       // Token
            'aes_key' => $wechat->wechat_aes_key,     // EncodingAESKey，兼容与安全模式下请一定要填写！！！
            'response_type' => 'array',
            'oauth'   => [
                //'scopes'   => array_map('trim', explode(',', env('WECHAT_OFFICIAL_ACCOUNT_OAUTH_SCOPES', 'snsapi_userinfo'))),
                'scopes'   => 'snsapi_userinfo',
                //'callback' => env('WECHAT_OFFICIAL_ACCOUNT_OAUTH_CALLBACK', '/oauth_callback'),
                'callback' => '/oauth_callback/'.$account,
            ],
            'log' => [
                'level' => 'debug',
                'file' => storage_path('logs/wechat.log'),  //这个必须要有，要不调试有问题，你都会找不到原因
            ],
        ];
        return $config;
    }

    //[1-2]生成微信公众号相关
    public function app($account)
    {
        $app = Factory::officialAccount($this->app_config($account));
        return $app;
    }

    //[2-1]微信支付设置
    public function pay_config($account)
    {
        $wechat = Wechat::where('aid',$account)->first();
        if (!$wechat) {
            return $config = [];
        }
        $config = [
            'app_id'      => $wechat->wechat_app_id,      // AppID
            'secret'      => $wechat->wechat_secret,      // AppSecret
            'mch_id'      => $wechat->pay_mch_id,
            'key'         => $wechat->pay_api_key,   // API 密钥
            // 如需使用敏感接口（如退款、发送红包等）需要配置 API 证书路径(登录商户平台下载 API 证书)
            'cert_path'   => $wechat->pay_cert_path, // XXX: 绝对路径！！！！
            'key_path'    => $wechat->pay_key_path,      // XXX: 绝对路径！！！！
            'notify_url'  => 'http://'.$_SERVER['HTTP_HOST'].'/wechat/order/index',     // 你也可以在下单时单独设置来想覆盖它
        ];
        return $config;
    }

    //[2-2]生成微信支付相关
    public function pay($account)
    {
        $pay = Factory::payment($this->pay_config($account));
        return $pay;
    }

    //[3-1]微信小程序设置
    public function mini_config($account)
    {
        $wechat = Wechat::where('aid',$account)->first();
        if (!$wechat) {
            return $config = [];
        }
        $config = [
            'app_id'  => $wechat->wechat_app_id,         // AppID
            'secret'  => $wechat->wechat_secret,     // AppSecret
            'response_type' => 'array',
        ];
        return $config;
    }

    //[3-2]微信小程序相关
    public function miniProgram($account)
    {
        $miniProgram = Factory::miniProgram($this->mini_config($account));
        return $miniProgram;
    }

    //[4-1]微信开放平台设置参数
    public function opconfig($account)
    {
        $wechat = Wechat::where('aid',$account)->first();
        if (!$wechat) {
            return $config = [];
        }
        $config = [
            'app_id'   => $wechat->op_app_id,
            'secret'   => $wechat->op_secret,
            'token'    => $wechat->op_token,
            'aes_key'  => $wechat->op_aes_key
        ];
        return $config;
    }

    //[4-2]微信开放平台相关
    public function openPlatform($account)
    {
        $openPlatform = Factory::openPlatform($this->opconfig($account));
        return $openPlatform;
    }

    //[5-1]微信企业号设置参数
    public function workconfig($account)
    {
        $wechat = Wechat::where('aid',$account)->first();
        if (!$wechat) {
            return $config = [];
        }
        $config = [
            'corp_id'   => $wechat->work_corp_id,
            'agent_id'   => $wechat->work_agent_id,
            'secret'    => $wechat->work_secret,

            'response_type' => 'array',
        ];
        return $config;

    }

    //[5-2]微信企业号相关
    public function work($account)
    {
        $work = Factory::work($this->workconfig($account));
        return $work;
    }
}