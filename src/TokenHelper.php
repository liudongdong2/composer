<?php
namespace shengxiaoweimo\helper;

USE Firebase\JWT\JWT;

class TokenHelper
{
    /**
     * @var int 令牌有效时间
     */
    private static $expireTime = 7200;

    /**
     * @var string 加密字符串
     */
    private static $signKey = '';

    /**
     * 初始化加密字符串和过期时间
     * @param string $key   加密字符串
     * @param int $expireTime   过期时间
     */
    public static function init($key = '' , $expireTime = 0)
    {
        if($key){
            static::$signKey = $key;
        }

        if($expireTime){
            static::$expireTime = $expireTime;
        }
    }

    /**
     * 生成一个新token
     * @param array $data
     * @return string
     */
    public static function getToken($data)
    {
        self::checkParam();
        try{
            $data['jwt_expire_time'] = time() + static::$expireTime;
            $jwt = JWT::encode($data, static::$signKey);
            return $jwt;
        }catch (\Exception $exception){
            throw new \ErrorException('create token fail : ' . $exception->getMessage());
        }
    }

    /**
     * 检测token是否有效
     * @param string $token
     * @return bool
     */
    public static function checkToken($token)
    {
        self::checkParam();
        $res = Self::getTokenData($token);
        if($res){
            return true;
        }

        return false;
    }

    /**
     * @param array $data
     * @return array|mixed|object    返回jwt加密前的原始数据
     */
    public static function getTokenData($token)
    {
        self::checkParam();
        try{
            $decoded = JWT::decode($token, static::$signKey, array('HS256'));
            $decoded = @json_decode(json_encode($decoded) , true);
            if(isset($decoded['jwt_expire_time']) && $decoded['jwt_expire_time'] > time()){
                unset($decoded['jwt_expire_time']);
                return $decoded;
            }
        } catch (\Exception $exception){
            throw new \ErrorException('token data get error : fail token');
        }
    }

    /**
     * 刷新token,返回新的token,原token失效
     * @param $token    {string}    需要刷新的token
     * @return string
     */
    public static function  refreshToken($token)
    {
        self::checkParam();
        try{
            $data = static::getTokenData($token);
            $jwt = static::getToken($data);
            return $jwt;

        } catch (\Exception $exception){
            throw new \ErrorException('refresh token fail : ' . $exception->getMessage());
        }
    }

    /**
     * 检测签名字符串
     * @throws \ErrorException
     */
    private static function checkParam()
    {
        if(!static::$signKey){
            throw new \ErrorException('check sign_key fail : this params not empty !');
        }
    }
}


