<?php

require_once 'database.php';
include 'simple_html_dom.php'; 

function clearData($value){
    $value = strip_tags($value);
    $value = htmlspecialchars($value);
    $value = stripslashes($value);
    $value = trim($value);
    return $value;
}

function add($array, $connect)
{
    foreach ($array as $item);
    $item =  extract($item, EXTR_PREFIX_SAME, 'dat');
    $status = clearData($status);
    $number = clearData($number);
    $price = (float)str_replace("&nbsp;","", htmlentities($price));
    $link = clearData($link);
    $lotId = (int)clearData($lotId);
    $date =date('Y-m-d H:i:s', strtotime(preg_replace("/&#?[a-z0-9]{2,8};/i", " ", $date)));
    $check = mysqli_query($connect, "SELECT * FROM `lots` WHERE `link` = '$link' and `lotId` = '$lotId'");
    if (mysqli_num_rows($check) > 0) {
        echo "Ранее добавленный лот " . 'Номер лота:' . $number . ' Ссылка :' . $link . ' id:' . $idLot . ' дата:' . $date . ' статус:' . $status . ' сумма: ' . $price . "<br>";
    } else {
        echo "Добавлен: " . 'Номер лота:' . $number . ' Ссылка :' . $link . ' id:' . $lotId . ' дата:' . $date . ' статус:' . $status .' сумма: ' . $price . "<br>";
        mysqli_query($connect, "INSERT INTO `lots` (`status`,`startPrice`,`number`,`link`, `lotId`,`date`) VALUES ('$status' , '$price' , '$number', '$link ', '$lotId', '$date' )");    }
}

$ch = curl_init();
$url = 'http://www.arbitat.ru/';


curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "ctl00%24ctl00%24BodyScripts%24BodyScripts%24scripts=ctl00%24ctl00%24MainContent%24ContentPlaceHolderMiddle%24UpdatePanel2%7Cctl00%24ctl00%24MainContent%24ContentPlaceHolderMiddle%24PurchasesSearchResult%24ctl01%24ctl02&");
curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');
curl_setopt($ch, CURLHEADER_UNIFIED, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

$headers = array();
$headers[] = 'Accept: */*';
$headers[] = 'Accept-Language: ru-RU,ru;q=0.9,en-US;q=0.8,en;q=0.7';
$headers[] = 'Cache-Control: no-cache';
$headers[] = 'Connection: keep-alive';
$headers[] = 'Content-Type: application/x-www-form-urlencoded; charset=UTF-8';
$headers[] = 'Cookie: __ddg1_=KoxikwoBXW8HIxpVcXgh; _ym_uid=167000636042593047; _ym_d=1670006360; _ym_isad=1; ASP.NET_SessionId=f3sgcfwapsooy0scxxnxmmen';
$headers[] = 'Origin: http://www.arbitat.ru';
$headers[] = 'Referer: http://www.arbitat.ru/';
$headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36';
$headers[] = 'X-Microsoftajax: Delta=true';
$headers[] = 'X-Requested-With: XMLHttpRequest';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
$fileName = 'site.html';
$file = fopen($fileName, 'w');
curl_setopt($ch, CURLOPT_FILE, $file);
$res = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'Ошибка:' . curl_error($ch);
}
// Create DOM
$html = file_get_html($fileName);

foreach ($html->find('.gridRow') as $post) {
    $numberId = $post->find('.gridAltColumn', 0);
    $linkId = $post->find('.tip-lot', 0);
    $dateId = $post->find('td', 7);
    $statusId = $post->find('td', 8);
    $priceId = $post->find('td', 4);
    $idLotId = $post->find('td', 2);
    $array[] = [
        'number' => $numberId->plaintext,
        'date' => $dateId->plaintext,
        'link' =>  $url . $linkId->href,
        'lotId' => $idLotId->plaintext,
        'status' => $statusId->innertext,
        'price' => $priceId->plaintext,
    ];
}

$row3 = array_slice($array, 2, 1);
$row4 = array_slice($array, 3, 1);
$row6 = array_slice($array, 5, 1);

add($row3, $connect);
add($row4, $connect);
add($row6, $connect);
?>
