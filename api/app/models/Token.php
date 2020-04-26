<?php

class Token extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    protected $user_id;

    /**
     *
     * @var string
     */
    protected $token;

    /**
     *
     * @var string
     */
    protected $expire_at;

    /**
     * Method to set the value of field user_id
     *
     * @param integer $user_id
     * @return $this
     */
    public function setUserId($user_id)
    {
        $this->user_id = $user_id;

        return $this;
    }

    /**
     * Method to set the value of field token
     *
     * @param string $token
     * @return $this
     */
    public function setToken($token)
    {
        $this->token = $token;

        return $this;
    }

    /**
     * Method to set the value of field expire_at
     *
     * @param string $expire_at
     * @return $this
     */
    public function setExpireAt($expire_at)
    {
        $this->expire_at = $expire_at;

        return $this;
    }

    /**
     * Returns the value of field user_id
     *
     * @return integer
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * Returns the value of field token
     *
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Returns the value of field expire_at
     *
     * @return string
     */
    public function getExpireAt()
    {
        return $this->expire_at;
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("weather_status_app");
        $this->setSource("token");
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Token[]|Token|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null): \Phalcon\Mvc\Model\ResultsetInterface
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Token|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
