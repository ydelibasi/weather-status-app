<?php

use Phalcon\Cli\Task;

class NotifyTask extends Task
{
    public function mainAction()
    {
        echo 'Main Action' . PHP_EOL;
    }

    /**
     * sending daily weather status messages to registered users
     */
    public function weatherStatusAction()
    {
        $sending_hour = '09';
        $today = date('Y-m-d');
        $service_id = Helper::DEFAULT_SERVICE_ID;
        $city_forecasts = array();

        $query = "
            SELECT u.* FROM user u INNER JOIN subscription s on u.id = s.user_id
            WHERE s.status = 1 AND s.service_id = {$service_id}";
        $users = $this->db->query($query)->fetchAll();

        foreach ($users as $user) {
            $user_timezone = new DateTimeZone($user['timezone']);
            $locale_datetime = new DateTime('', $user_timezone);
            $locale_hour = $locale_datetime->format('H');
            $city_id = $user['city_id'];
            $message = '';
            if ($locale_hour == $sending_hour) {
                if (!array_key_exists($city_id, $city_forecasts)) {
                    $query = "
                        SELECT w.* FROM weather_status w 
                        WHERE w.forecast_date = '{$today}' AND city_id = {$city_id}";
                    $weather_status = $this->db->fetchOne($query);
                    if ($weather_status) {
                        $message = $weather_status['min_degree']."/".$weather_status['max_degree']." degree, "
                            .$weather_status['description'];
                        $city_forecasts[$city_id] = $message;
                    }
                } else {
                    $message = $city_forecasts[$city_id];
                }
                if (!empty($message)) {
                    echo "Weather Status sent to {$user['email']}. msg: {$message}" . PHP_EOL;
                    $this->sendMessage($message);
                }
            }
        }
        return true;
    }

    private function sendMessage($message)
    {
        // weather status message will send to user in here
        return true;
    }
}
