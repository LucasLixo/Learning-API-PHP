<?php

require_once(dirname(__FILE__) . '/../../config/config.php');

class api_response {
    
    private $data;
    private $available_methods = ['GET', 'POST'];

    // ===============================================================
    public function __construct()
    {
        $this->data = [];
    }

    // ===============================================================
    public function check_method($method)
    {
        // check if method is valid
        return in_array($method, $this->available_methods);
    }

    // ===============================================================
    public function set_method($method)
    {
        // sets the response method
        $this->data['method'] = $method;
    }

    // ===============================================================
    public function get_method()
    {
        // returns the request method
        return $this->data['method'];
    }

    // ===============================================================
    public function set_variable($variable)
    {
        // sets the request variable
        $this->data['variable'] = $variable;
    }

    // ===============================================================
    public function get_variable()
    {
        // returns the current request variable
        return $this->data['variable'];
        // parse_str($this->data['variable'], $dataArray);
    }














    
    // ===============================================================
    public function api_request_error($message = '')
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
    public function send_api_status()
    {
        // send api status
        $this->data['status'] = 'SUCCESS';
        $this->data['message'] = 'API is running ok!';
        $this->send_response();
    }

    // ===============================================================
    public function send_response()
    {
        // output final response
        header("Content-Type:application/json");
        echo json_encode($this->data);
        die(1);
    }
}

?>