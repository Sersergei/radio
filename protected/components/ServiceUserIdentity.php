<?php

/**
 * Created by PhpStorm.
 * User: Сергей
 * Date: 30.11.2015
 * Time: 0:06
 */
class ServiceUserIdentity
{
public $client_id = '433471736844421';
public $client_secret = 'eb1814bd3980ab9a306dc35073021fb3';
public $redirect_uri = 'http://radio.colocall.com/register/facebook';
public $url = 'https://www.facebook.com/dialog/oauth';

    public  function seturl(){
        $params =array('client_id'=>$this->client_id,
            'redirect_uri'  => $this->redirect_uri,
            'response_type' => 'code',
            'scope'=> 'email,user_birthday'
        );
        return $link = '<p><a href="' . $this->url . '?' .
            urldecode(http_build_query($params)) . '">Аутентификация через Facebook</a></p>';
    }
}