<?php
namespace App\Http\Proxy;

class TokenProxy
{
    protected  $http;

    public  function __construct(\GuzzleHttp\Client $http)
    {
        $this->http=$http;
    }
    public  function  login($email,$password){
        if(auth()->attempt(['email'=>$email,'password'=>$password,'is_active'=>1])){
            return $this->proxy('password',[
                'username'=>request('email'),
                'password'=>request('password'),
                'scope'=>''
            ]);
        }
       return response()->json([
           'status'=>false,
           'message'=>'Credentials not match'
       ],421);
    }
    public  function  proxy($grantType,array $data=[])
    {
        $data=array_merge($data,[
            'client_id'=>env('PASSPORT_CLTENT_ID'),
            'client_secret'=>env('PASSPORT_CLTENT_SECRET'),
            //防止敏感信息被获取 直接给env
            'grant_type'=>$grantType,
        ]);
        $response=$this->http->post('http://www.goapp.com/oauth/token',[
            'form_params'=>$data
        ]);

        $token=json_decode((string) $response->getBody(),true);

        return response()->json([
            'token'=>$token['access_token'],
            'expires_in'=>$token['expires_in']
        ])->cookie('refreshToken',$token['refresh_token'],14400,null,null,false,true);
    }
}
