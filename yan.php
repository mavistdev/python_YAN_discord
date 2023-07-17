<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
function rcya_query($token, $arFields = array()){
    $string = '';
    foreach($arFields as $k=>$v){
        $string .= $v.'&';
    }    
    $request_url = 'https://partner2.yandex.ru/api/statistics2/get.json?lang=ru&pretty=1&'.$string;    
    $headers = array('Authorization: OAuth '.$token);
    
    $ch = curl_init();
    curl_setopt ($ch, CURLOPT_URL,$request_url);
    curl_setopt ($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.6) Gecko/20070725 Firefox/2.0.0.6");
    curl_setopt ($ch, CURLOPT_TIMEOUT, 60);
    curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt ($ch, CURLOPT_HEADER, 0);
    curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt ($ch, CURLOPT_HTTPHEADER, $headers);
    $request = curl_exec ($ch);
    curl_close($ch);
    $arRequest = json_decode($request, true);
    
    return $arRequest;
}

{
$wrdn = rcya_query(
        '', // Ваш токен
        array( //массив с параметрами запроса
            'dimension_field=date|day',
            'period=thismonth', //период - текущий месяц
            'entity_field=page_level',
            'field=partner_wo_nds', 
            'filter=["page_id","=","Айди площадки"]',
            'field=fillrate'
            )
        );

foreach($wrdn['data']['points'] as $k => $item){
        if($item['dimensions']['date'][0] == date("Y-m-").(date("d")-1)){
                $wrdnday_price['yesterday'] = $item['measures'][0]['partner_wo_nds'];
        }
                
        if($item['dimensions']['date'][0] == date("Y-m-d")){
                $wrdnday_price['today'] = $item['measures'][0]['partner_wo_nds'];
        }
    }

$warden = rcya_query(
        '', // Ваш токен
        array(
            'dimension_field=date|day',
            'period=thismonth',
            'entity_field=page_level',
            'field=partner_wo_nds',
            'filter=["page_id","=","Айди площадки"]',
            'field=fillrate'
            )
        );

foreach($warden['data']['points'] as $k => $item){
        if($item['dimensions']['date'][0] == date("Y-m-").(date("d")-1)){
                $wardenday_price['yesterday'] = $item['measures'][0]['partner_wo_nds'];
        }
                
        if($item['dimensions']['date'][0] == date("Y-m-d")){
                $wardenday_price['today'] = $item['measures'][0]['partner_wo_nds'];
        }
    }

$wardenrek = rcya_query(
        '', // Ваш токен
        array(
            'dimension_field=date|day',
            'period=thismonth',
            'entity_field=page_level',
            'field=partner_wo_nds',
            'filter=["page_id","=","Айди площадки"]',
            'field=fillrate'
            )
        );

foreach($wardenrek['data']['points'] as $k => $item){
        if($item['dimensions']['date'][0] == date("Y-m-").(date("d")-1)){
                $wardenrekday_price['yesterday'] = $item['measures'][0]['partner_wo_nds'];
        }
                
        if($item['dimensions']['date'][0] == date("Y-m-d")){
                $wardenrekday_price['today'] = $item['measures'][0]['partner_wo_nds'];
        }
    }

$wardenmobile = rcya_query(
        '', // Ваш токен
        array(
            'dimension_field=date|day',
            'period=thismonth',
            'entity_field=page_level',
            'field=partner_wo_nds',
            'filter=["page_id","=","айди площадки"]',
            'field=fillrate'
            )
        );

foreach($wardenmobile['data']['points'] as $k => $item){
        if($item['dimensions']['date'][0] == date("Y-m-").(date("d")-1)){
                $wmday_price['yesterday'] = $item['measures'][0]['partner_wo_nds'];
        }
                
        if($item['dimensions']['date'][0] == date("Y-m-d")){
                $wmday_price['today'] = $item['measures'][0]['partner_wo_nds'];
        }
    }
// строим вывод в словарь
$data = ['wrdn' => ['today' => $wrdnday_price['today'], 'yesterday' => $wrdnday_price['yesterday'], 'mounth' => $wrdn['data']['totals'][2][0]['partner_wo_nds']], 'warden' => ['today' => $wardenday_price['today'], 'yesterday' => $wardenday_price['yesterday'], 'mounth' => $warden['data']['totals'][2][0]['partner_wo_nds']], 'wardenmobile' => ['today' => $wmday_price['today'], 'yesterday' => $wmday_price['yesterday'], 'mounth' => $wardenmobile['data']['totals'][2][0]['partner_wo_nds']], 'pskovabout' => null];

header('Content-type: application/json');
echo json_encode( $data );
}
