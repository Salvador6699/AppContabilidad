<?php
class Result
{
    public $message;
    public $success;
    public $result;

    public function __construct()
    {
        $this->message = '';
        $this->success = false;
        $this->result = [];
    }
}
