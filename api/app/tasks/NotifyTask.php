<?php

use Phalcon\Cli\Task;

class NotifyTask extends Task
{
    public function mainAction()
    {
        echo 'Main action' . PHP_EOL;
    }

    /**
     *
     */
    public function weatherStatusAction()
    {
        $users = $this->db->query("select * from user")->fetchAll();
        foreach ($users as $user) {
            //TODO: send weather status
            echo $user['email']. PHP_EOL;
        }


    }
}
