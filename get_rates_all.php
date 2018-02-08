<?php


function wgett($adresa) {
    $ch = curl_init();
    $useragent = "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1; WOW64; Trident/4.0; SLCC2; .NET CLR 2.0.50727; .NET CLR 3.5.30729; .NET CLR 3.0.30729; Media Center PC 6.0; .NET4.0C; .NET4.0E)"; 
    $nheader = array("Expect:","Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8","Accept-Language: en-us,en;q=0.5","Accept-Charset: utf-8;q=0.7,*;q=0.7","DNT: 1","Connection: keep-alive","Cache-Control: max-age=0");
    curl_setopt($ch, CURLOPT_HTTPHEADER, $nheader);
    curl_setopt($ch, CURLOPT_URL, $adresa);
    curl_setopt($ch, CURLOPT_USERAGENT, $useragent);
    curl_setopt($ch, CURLOPT_ENCODING, "UTF-8" ); 
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_POST, 0);
    curl_setopt($ch, CURLOPT_TIMEOUT, 0);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $cookie_file = "cookie1.txt";
    curl_setopt($ch, CURLOPT_COOKIESESSION, true);
    curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file);
    curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file);
    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
}

$url = 'http://sikstore.ro/admin/get_rates_all.php';
$array = wgett($url);
$array = json_decode($array, true);



function recalc($totalWidth) {

	$procentaj = 4;

	$valnoua = ($procentaj / 100) * $totalWidth;

	$valfinala = $totalWidth - $valnoua;

	return $valfinala;

}



function recalcplus($totalWidth) {

    $procentaj = 2;

    $valnoua = ($procentaj / 100) * $totalWidth;

    $valfinala = $totalWidth + $valnoua;

    return $valfinala;

}

function recalcplusETH($totalWidth) {

    $procentaj = 75.1;

    $valnoua = ($procentaj / 100) * $totalWidth;

    $valfinala = $totalWidth + $valnoua;

    return $valfinala;

}

function recalcETH($totalWidth) {

    $procentaj = 62;

    $valnoua = ($procentaj / 100) * $totalWidth;

    $valfinala = $totalWidth + $valnoua;

    return $valfinala;

}

function recalcLTC($totalWidth) {

    $procentaj = 234.5;

    $valnoua = ($procentaj / 100) * $totalWidth;

    $valfinala = $totalWidth + $valnoua;

    return $valfinala;

}

function recalcETC($totalWidth) {

    $procentaj = 115;

    $valnoua = ($procentaj / 100) * $totalWidth;

    $valfinala = $totalWidth + $valnoua;

    return $valfinala;

}





//print_r($array);

$moneda = @$_GET['moneda'];

switch ($moneda) {

    case "XBTRON":

        

        echo '<div class="col-md-6 col-sm-6 info">

<h2>Pret <span class="colored-text">VANZARE</span></h2>

<span class="data">'.number_format(recalcplus($array[0]['ask'], 2, '.', '')).' RON</span>

</div>

<div class="col-md-6 col-sm-6 info">

<h2>Pret <span class="colored-text">CUMPARARE</span></h2>

<span class="data">'.number_format(recalc($array[0]['bid'], 2, '.', '')).' RON</span>

</div>';



        break;

    case "ETHRON":

       



       echo '<div class="col-md-6 col-sm-6 info">

<h2>Pret <span class="colored-text">VANZARE</span></h2>

<span class="data">'.number_format(recalcplusETH($array[3]['ask'], 2, '.', '')).' RON</span>

</div>

<div class="col-md-6 col-sm-6 info">

<h2>Pret <span class="colored-text">CUMPARARE</span></h2>

<span class="data">'.number_format(recalcETH($array[3]['bid'], 2, '.', '')).' RON</span>

</div>';



        break;

    default:

        echo '<div class="col-md-4 col-sm-8 info">

<h2>Pret <span class="colored-text">Bitcoin</span></h2>

<span class="data">'.number_format(recalcplus($array[0]['ask'], 2, '.', '')).' RON</span>

</div>

<div class="col-md-4 col-sm-8 info">

<h2>Pret <span class="colored-text">Ethereum</span></h2>

<span class="data">'.number_format(recalcplusETH($array[3]['bid'], 2, '.', '')).' RON</span>

</div>

<div class="col-md-4 col-sm-8 info">

<h2>Pret <span class="colored-text">Litecoin</span></h2>

<span class="data">'.number_format(recalcLTC($array[7]['bid'], 2, '.', '')).' RON</span>

</div>';

}

?>