<?php

include_once(dirname(__FILE__) . './inc/open.php');

class init
{
    private $endpoint;
    private $params;

    // --------------------------------------------------
    public function __construct($endpoint, $params = null)
    {
        $this->endpoint = $endpoint;
        $this->params = $params;
    }

    // --------------------------------------------------
    public function endpoint_exists(): bool
    {
        // Checks if the class method is valid
        return method_exists($this, $this->endpoint);
    }

    // --------------------------------------------------
    public function error_response($message): array
    {
        // Returns an API error
        return [
            'status' => 'ERROR',
            'message' => $message,
            'results' => []
        ];
    }

    // --------------------------------------------------
    public function status(): string
    {
        return 'Hello World';
    }

    // --------------------------------------------------
    public function data(): array
    {
        return $this->params;
    }

    // --------------------------------------------------
    public function customers(): string|array
    {
        return openCSV('customers');
    }

    // --------------------------------------------------
    public function cafeteria(): string|array
    {
        return openCSV('cafeteria');
    }
}
