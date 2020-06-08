<?php


namespace App\Response;


class Response
{
    public $message;
    public $status;
    public $status_code;
    public $data;

    public function __construct( $message, bool  $status,  $data, $status_code = 0)
    {
        $this->message = $message;
        $this->status = $status;
        $this->status_code = $status_code;
        $this->data = $data;

    }

    public function send()
    {
        return $this->consolidate();
    }

    public function consolidate()
    {
        return [
            'status' => $this->status,
            'status_code' => $this->status_code,
            'message' => $this->message,
            'data' => $this->data
        ];
    }
}
