<?php

class api_verify
{

    private $data;
    private $available_methods = ['GET', 'POST'];
    private $valid_credentials = [
        'user' => 'admin',
        'pass' => 'password123'
    ];

    // ===============================================================
    public function __construct()
    {
        $this->data = [];
    }

    // ===============================================================
    public function check_method(string $method): bool
    {
        // check if method is valid
        return in_array($method, $this->available_methods);
    }

    // ===============================================================
    public function set_method(string $method): void
    {
        // sets the response method
        $this->data['method'] = $method;
    }

    // ===============================================================
    public function get_method(): string
    {
        // returns the request method
        return $this->data['method'];
    }

    // ===============================================================
    public function set_class(string $class): void
    {
        // sets the request class
        $this->data['class'] = $class;
    }

    // ===============================================================
    public function get_class(): string
    {
        // returns the current request class
        return $this->data['class'];
    }

    // ===============================================================
    public function set_function(string $function): void
    {
        // sets the request function
        $this->data['function'] = $function;
    }

    // ===============================================================
    public function get_function(): string
    {
        // returns the current request function
        return $this->data['function'];
    }

    // ===============================================================
    public function authenticate(string $user, string $pass): bool
    {
        if ($user === $this->valid_credentials['user'] && $pass === $this->valid_credentials['pass']) {
            return true;
        } else {
            return false;
        }
    }











    // ===============================================================
    public function add_data(string $key, mixed $value): void
    {
        // add new key to data
        $this->data[$key] = $value;
    }












    // ===============================================================
    public function api_request_error(string $message = ''): void
    {
        // output an api error message

        $data_error = [
            'status' => 'ERROR',
            'message' => $message,
            'results' => null
        ];

        $this->data['data'] = $data_error;
        $this->send_response();
    }

    // ===============================================================
    public function send_api_status(): void
    {
        // send api status
        $this->data['status'] = 'SUCCESS';
        $this->data['message'] = 'API is running ok!';
        $this->send_response();
    }

    // ===============================================================
    public function send_response(): void
    {
        // output final response
        header("Content-Type:application/json");
        echo json_encode($this->data);
        die(1);
    }
}
