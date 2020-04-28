<?php

class Helper {

    const DEFAULT_SERVICE_ID = 1; // Weather Status Service
    const TOKEN_EXPIRE_TIME = 15;

    public static function createToken($user_id)
    {
        $api_token = md5(uniqid(mt_rand(), true));
        $token = new Token();
        $token->setToken($api_token);
        $token->setUserId($user_id);
        $token->setExpireAt(date('Y-m-d H:i:s',
            strtotime("+".self::TOKEN_EXPIRE_TIME." minutes", time())));
        $token->save();
        return $api_token;
    }
}
