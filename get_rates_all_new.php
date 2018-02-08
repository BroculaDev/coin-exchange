<?php
function wgett($adresa) {
    // $nonce = strtotime("now");
    // $api_key = '2CEPOGEMf05vRL1SwAqv0kIM0pAN8ong';
	// $hmac = hash_mac('sha256',$nonce.$api_key,$nonce); // nu exista pe server, refacut altfel
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

// $url = 'https://www.bitstamp.net/api/v2/ticker/btceur/';
// $url = 'https://www.bitstamp.net/api/v2/ticker/ltceur/';
// $url = 'https://www.bitstamp.net/api/v2/ticker/etheur/';
// $array = wgett($url);
// $array = json_decode($array, true);

$moneda = '';
if(!isset($_GET['moneda'])){
	$lista = array(
		'btc' => json_decode(wgett('https://www.bitstamp.net/api/v2/ticker/btceur/'), true),
		'eth' => json_decode(wgett('https://www.bitstamp.net/api/v2/ticker/etheur/'), true),
		'ltc' => json_decode(wgett('https://www.bitstamp.net/api/v2/ticker/ltceur/'), true)
	);
}
else{
	$lista = json_decode(wgett('https://www.bitstamp.net/api/v2/ticker/'.$_GET['moneda'].'eur/'), true);
	$moneda = $_GET['moneda'];
} 

// print_r('<pre>');print_r($lista);print_r('</pre>');

// exit;


function recalcCumparare($totalWidth) {
	$procentaj = 4.9;
	$valnoua = ($procentaj / 100) * $totalWidth;
	$valfinala = $totalWidth - $valnoua;
	return $valfinala;
}

function recalcVanzare($totalWidth) {
    $procentaj = 9;
    $valnoua = ($procentaj / 100) * $totalWidth;
    $valfinala = $totalWidth + $valnoua;
    return $valfinala;
}

//print_r($array);

// print 'asdsdffd';
// var_dump($moneda);

switch ($moneda) {
    case "btc":
    case "eth":
    case "ltc":
        $bloc = '<div class="col-md-6 col-sm-6 info">
			<h2>Pret <span class="colored-text">VANZARE</span></h2>
			<span class="data">'.number_format(recalcVanzare($lista['last']), 2, '.', '').' EUR</span>
		</div>
		<div class="col-md-6 col-sm-6 info">
			<h2>Pret <span class="colored-text">CUMPARARE</span></h2>
			<span class="data">'.number_format(recalcCumparare($lista['last']), 2, '.', '').' EUR</span>
		</div>';
	break;
    default:
		$bloc = '<div class="col-md-4 col-sm-8 info">
			<h2>Pret <span class="colored-text">Bitcoin</span></h2>
			<span class="data">'.number_format(recalcVanzare($lista['btc']['last']), 2, '.', ',').' EUR</span>
		</div>
		<div class="col-md-4 col-sm-8 info">
			<h2>Pret <span class="colored-text">Ethereum</span></h2>
			<span class="data">'.number_format(recalcVanzare($lista['eth']['last']), 2, '.', ',').' EUR</span>
		</div>
		<div class="col-md-4 col-sm-8 info">
			<h2>Pret <span class="colored-text">Litecoin</span></h2>
			<span class="data">'.number_format(recalcVanzare($lista['ltc']['last']), 2, '.', ',').' EUR</span>
		</div>';
};

print $bloc;

?>