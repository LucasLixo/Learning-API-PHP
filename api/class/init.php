<?php

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
    public function endpoint_exists()
    {
        // Verifica se o método da classe é válido
        return method_exists($this, $this->endpoint);
    }

    // --------------------------------------------------
    public function error_response($message)
    {
        // Retorna um erro da API
        return [
            'status' => 'ERROR',
            'message' => $message,
            'results' => []
        ];
    }

    // --------------------------------------------------
    public function status()
    {
        return 'Hello World';
    }

    // --------------------------------------------------
    public function data()
    {
        return $this->params;
    }

    // --------------------------------------------------
    public function clients()
    {
        $csvFile = __DIR__ . '/../db/clientes.csv';

        if (!file_exists($csvFile) || !is_readable($csvFile)) {
            return 'Arquivo CSV não encontrado ou não legível.';
        }

        $data = array();

        if (($handle = fopen($csvFile, 'r')) !== false) {
            while (($row = fgetcsv($handle, 1000, ',')) !== false) {
                $data[] = $row;
            }
            fclose($handle);
        } else {
            return 'Erro ao abrir o arquivo.';
        }

        return $data;
    }
    
    // --------------------------------------------------
    public function lanchonete()
    {
        $csvFile = __DIR__ . '/../db/lanchonete.csv';

        if (!file_exists($csvFile) || !is_readable($csvFile)) {
            return 'Arquivo CSV não encontrado ou não legível.';
        }

        $data = array();

        if (($handle = fopen($csvFile, 'r')) !== false) {
            while (($row = fgetcsv($handle, 1000, ',')) !== false) {
                $data[] = $row;
            }
            fclose($handle);
        } else {
            return 'Erro ao abrir o arquivo.';
        }

        return $data;
    }
}
?>
