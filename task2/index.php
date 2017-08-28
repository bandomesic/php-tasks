<?php

require('TourXML.php');
require('Tour.php');

$parser = new TourXML();
$parser->load('tours.xml');

$tour = new Tour($parser->getData());

$tour->printCSV();
$tour->getCSV();