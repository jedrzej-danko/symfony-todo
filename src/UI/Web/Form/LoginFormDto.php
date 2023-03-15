<?php

namespace App\UI\Web\Form;

class LoginFormDto
{
    public string $_username;

    public string $_target_path;
    public string $_password = '';

    /**
     * @param string $_username
     * @param string $_target_path
     */
    public function __construct(string $_username, string $_target_path)
    {
        $this->_username = $_username;
        $this->_target_path = $_target_path;
    }


}