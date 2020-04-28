<?php

class Helper {

    public static function createToken($user_id)
    {
        $api_token = md5(uniqid(mt_rand(), true));
        $token = new Token();
        $token->setToken($api_token);
        $token->setUserId($user_id);
        $token->setExpireAt(date('Y-m-d H:i:s', strtotime("+15 minutes", time())));
        $token->save();
        return $api_token;
    }
}
