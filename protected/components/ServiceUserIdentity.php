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
public $client_secret = 'fc529565e8593e0f6c059cff10b355a9';
public $redirect_uri = 'http://radio.colocall.com/register/facebook';
public $url = 'https://www.facebook.com/dialog/oauth';
    public $Token='https://graph.facebook.com/oauth/access_token';
    public $get_data='https://graph.facebook.com/me';

    public  function seturl(){
        $params =array('client_id'=>$this->client_id,
            'redirect_uri'  => $this->redirect_uri,
            'response_type' => 'code',
            'scope'=> 'email,user_birthday'
        );

        return $this->url."?"."client_id=".$this->client_id."&redirect_uri=".$this->redirect_uri."&response_type=code&scope=email";
    }
    public function getToken($code){
        $ku=curl_init();

        $query="client_id=".$this->client_id."&redirect_uri=".urlencode($this->redirect_uri)."&client_secret=".$this->client_secret.
            "&code=".$code;
        curl_setopt($ku,CURLOPT_URL,$this->Token."?".$query);
        curl_setopt($ku,CURLOPT_RETURNTRANSFER,TRUE);
        $result=curl_exec($ku);
        if(!$result){
            exit(curl_error($ku));
        }
        if($i=json_decode($result)){

            if($i->error){
                exit ($i->error->message);
            }

        }
        else{

                $token=array();
            parse_str($result,$token);

            if($token['access_token']){

                return $this->get_data($token['access_token']);
            }
        }

    }
    public function get_data($token){
        $ku=curl_init();

        $query="access_token=".$token;
        curl_setopt($ku,CURLOPT_URL,$this->get_data."?fields=email,name,birthday,gender&".$query);
        curl_setopt($ku,CURLOPT_RETURNTRANSFER,TRUE);
        $result=curl_exec($ku);
        if(!$result){
            exit(curl_error($ku));
        }
        return json_decode($result);

    }
}