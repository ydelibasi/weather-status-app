<?php

class GiftCode extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var string
     */
    protected $code;

    /**
     *
     * @var integer
     */
    protected $user_id;

    /**
     *
     * @var string
     */
    protected $usage_date;

    /**
     * Method to set the value of field code
     *
     * @param string $code
     * @return $this
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

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
     * Method to set the value of field usage_date
     *
     * @param string $usage_date
     * @return $this
     */
    public function setUsageDate($usage_date)
    {
        $this->usage_date = $usage_date;

        return $this;
    }

    /**
     * Returns the value of field code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
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
     * Returns the value of field usage_date
     *
     * @return string
     */
    public function getUsageDate()
    {
        return $this->usage_date;
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("weather_status_app");
        $this->setSource("gift_code");
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return GiftCode[]|GiftCode|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null): \Phalcon\Mvc\Model\ResultsetInterface
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return GiftCode|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
