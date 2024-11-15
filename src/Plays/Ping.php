<?php

namespace PHPPlay\Plays;

use PHPPlay\AnsiblePlaybook;

class Ping extends AnsiblePlaybook
{

    /**
     * @inheritDoc
     */
    public function base()
    {
        if (defined('ABSPATH')) {
            return ABSPATH . 'ansible/';
        }
        return __DIR__ . '/';
    }
}
