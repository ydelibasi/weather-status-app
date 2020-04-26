<?php

class WeatherStatus extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    protected $id;

    /**
     *
     * @var integer
     */
    protected $city_id;

    /**
     *
     * @var string
     */
    protected $min_degree;

    /**
     *
     * @var string
     */
    protected $max_degree;

    /**
     *
     * @var string
     */
    protected $description;

    /**
     *
     * @var string
     */
    protected $forecast_date;

    /**
     * Method to set the value of field id
     *
     * @param integer $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Method to set the value of field city_id
     *
     * @param integer $city_id
     * @return $this
     */
    public function setCityId($city_id)
    {
        $this->city_id = $city_id;

        return $this;
    }

    /**
     * Method to set the value of field min_degree
     *
     * @param string $min_degree
     * @return $this
     */
    public function setMinDegree($min_degree)
    {
        $this->min_degree = $min_degree;

        return $this;
    }

    /**
     * Method to set the value of field max_degree
     *
     * @param string $max_degree
     * @return $this
     */
    public function setMaxDegree($max_degree)
    {
        $this->max_degree = $max_degree;

        return $this;
    }

    /**
     * Method to set the value of field description
     *
     * @param string $description
     * @return $this
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Method to set the value of field forecast_date
     *
     * @param string $forecast_date
     * @return $this
     */
    public function setForecastDate($forecast_date)
    {
        $this->forecast_date = $forecast_date;

        return $this;
    }

    /**
     * Returns the value of field id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Returns the value of field city_id
     *
     * @return integer
     */
    public function getCityId()
    {
        return $this->city_id;
    }

    /**
     * Returns the value of field min_degree
     *
     * @return string
     */
    public function getMinDegree()
    {
        return $this->min_degree;
    }

    /**
     * Returns the value of field max_degree
     *
     * @return string
     */
    public function getMaxDegree()
    {
        return $this->max_degree;
    }

    /**
     * Returns the value of field description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Returns the value of field forecast_date
     *
     * @return string
     */
    public function getForecastDate()
    {
        return $this->forecast_date;
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("weather_status_app");
        $this->setSource("weather_status");
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return WeatherStatus[]|WeatherStatus|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null): \Phalcon\Mvc\Model\ResultsetInterface
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return WeatherStatus|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
