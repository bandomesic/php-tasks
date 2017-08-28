<?php

class Tour
{
    /**
     * Tours
     *
     * @var array
     */
    private $data;

    /**
     * Delimiter
     *
     * @var string
     */
    public $delimiter = '|';

    /**
     * Tour constructor
     *
     * @param array $data
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Titles for CSV
     *
     * @return string
     */
    private function getHeaders()
    {
        return implode($this->delimiter, array_keys($this->data[0]));
    }

    /**
     * Write CSV to file
     *
     * @return void
     */
    public function getCSV()
    {
        $csv = fopen('tours.csv', 'w');
        fwrite($csv, $this->getHeaders() . "\r\n");
        foreach ($this->data as $data) {
            fwrite($csv, implode($this->delimiter, $data) . "\r\n");
        }
    }

    /**
     * Show CSV
     *
     * @return void
     */
    public function printCSV()
    {
        echo $this->getHeaders() . '<br>';
        foreach ($this->data as $data) {
            echo implode($this->delimiter, $data) . '<br>';
        }
    }
}