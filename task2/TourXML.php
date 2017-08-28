<?php

class TourXML
{
    /**
     * XML
     *
     * @var string
     */
    private $xml;

    /**
     * Parsed data
     *
     * @var array
     */
    private $data = [];

    /**
     * Fields that will be parsed from XML
     *
     * @var array
     */
    public $fields = ['Title', 'Code', 'Duration', 'Inclusions'];

    /**
     * Price = MinPrice || MaxPrice
     *
     * @var string
     */
    public $price = 'MinPrice';

    /**
     * Default price currency
     *
     * @var string
     */
    public $currency = 'EUR';

    /**
     * Convert XML into a SimpleXMLElement object
     *
     * @param $file
     * @return void
     */
    public function load($file)
    {
        $this->xml = simplexml_load_file($file);
    }

    /**
     * Prepare data of tours as an array
     *
     * @return void
     */
    private function prepareData()
    {
        foreach ($this->xml->TOUR as $tour) {
            $array = [];

            foreach ($this->fields as $field) {
                $array[$field] = $this->cleanUpString($tour->$field);
            }

            $array[$this->price] = $this->getPrice($tour, $this->price);

            $this->data[] = $array;
        }
    }

    /**
     * Return tour price by MinPrice || MaxPrice
     *
     * @param object $tour
     * @param string $type
     * @return float
     */
    private function getPrice($tour, $type)
    {
        $prices = $this->preparePrices($tour);

        switch ($type) {
            case 'MinPrice':
                return min($prices);
                break;
            case 'MaxPrice':
                return max($prices);
                break;
        }
    }

    /**
     * Get all prices of tour with discount included
     *
     * @param object $tour
     * @return array
     */
    private function preparePrices($tour)
    {
        $array = [];

        for ($i = 0; $i < count($tour->DEP); $i++) {
            $array[] = number_format($this->calculatePriceWithDiscount($tour->DEP[$i][$this->currency], $tour->DEP[$i]['DISCOUNT']), 2, '.', '');
        }

        return $array;
    }

    /**
     * Calculate price with discount
     *
     * @param float $price
     * @param string $discount
     * @return float
     */
    private function calculatePriceWithDiscount($price, $discount)
    {
        $discountValue = (float) $price * (str_replace('%', '', $discount) / 100);
        $newPrice = (float) $price - $discountValue;

        return $newPrice;
    }

    /**
     * Clean up string
     *
     * @param string $string
     * @return string
     */
    public function cleanUpString($string)
    {
        $string = str_replace('&nbsp;&nbsp;', '', $string);
        $string = str_replace('&nbsp; ', ' ', $string);
        $string = trim($string);
        $string = strip_tags($string);
        $string = html_entity_decode($string);

        return $string;
    }

    /**
     * Get data as an array
     *
     * @return array
     */
    public function getData()
    {
        $this->prepareData();
        return $this->data;
    }
}