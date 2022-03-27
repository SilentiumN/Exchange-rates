<?php
include "src/scripts/get_value.php";

$data = CBR_XML_Daily_Ru();
$data_valute = array_values($data["Valute"]);

echo "
<!DOCTYPE html>
<html lang='en'>
<head>
    <link rel='stylesheet' href='src/styles/reset.css'>
    <link rel='stylesheet' href='src/styles/main.scss'>
    <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
    <script src='https://kit.fontawesome.com/6f63988fc5.js' crossorigin='anonymous'></script>
    <script src='src/scripts/index.js'></script>
<body>
<table id='table'>
    <tr>
        <td><strong>Код</strong></td>
        <td><strong>За единиц</strong></td>
        <td><strong>Валюты</strong></td>
        <td><strong>Рублей РФ (сегодня)</strong></td>
        <td><strong>Рублей РФ (вчера)</strong></td>
        <td><strong>Разница</strong></td>
    </tr>";
    foreach ($data_valute as $data_one_valute => $items) {
        echo "<tr>
            <td>".$items["CharCode"]."</td>
            <td>".$items["Nominal"]."</td>
            <td><a href=''>".$items["Name"]."</a></td>
            <td>".round($items["Value"],4)." ₽ </td>
            <td>".round($items["Previous"], 4)." ₽ </td>";
            if ($items["Value"]>= $items["Previous"]) {
            echo "<td>+ ".round((($items["Value"] / $items["Previous"])- 1) * 100,4)."% </td>";
            }
            else {
            echo "<td>- ".round((1 - ($items["Value"] / $items["Previous"])) * 100,4)."% </td>";
            }
            echo "</tr>";
    }
echo "
</table>

<div id='converter-box'>
        
        
        <div class='text-field select'>
            <input type='number' id='input_1' value='1'>
            <input class='text-field__input' type='hidden' id='select_1' name='select_1' value='RUB'>
            <div id='select__head-1'> RUB <img src='src/images/select-chevron.png'></div>
                <ul class='select__list'>
                    <li class='select__item' id='RUB'> Российский рубль </li>";
                        foreach ($data_valute as $data_one_valute => $items) {
                            echo "<li class='select__item' id='".$items["CharCode"]."'>".$items["Name"]."</li>";
                        }
                        echo "</ul>
        </div>
        <i class='fa-solid fa-arrow-right-arrow-left' id='arrow_converter'></i>
        <div class='text-field select'>
            <input type='number' id='input_2' value='1'>
            <input class='text-field__input' type='hidden' id='select_2' name='select_2' value='RUB'>
            <div id='select__head-2'>RUB <img src='src/images/select-chevron.png'> </div>
                <ul class='select__list'>
                    <li class='select__item' id='RUB'> Российский рубль </li>";
                    foreach ($data_valute as $data_one_valute => $items) {
                        echo "<li class='select__item' id='".$items["CharCode"]."'>".$items["Name"]."</li>";
                    }
                echo "</ul>
        </div>
</div>
</body>
</html>";
