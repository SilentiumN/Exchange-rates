<?php
function CBR_XML_Daily_Ru() {
    static $rates;

    if ($rates === null) {
        $json = file_get_contents('https://www.cbr-xml-daily.ru/daily_json.js');
        $rates = json_decode($json, true);
    }

    return $rates;
}

