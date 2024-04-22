<?
if(!function_exists('pa')){
    function pa($a,$br=0,$mes='',$t='pre'):bool{$backtrace = debug_backtrace(); $fileinfo = '';$sbr='';
        if(!empty($backtrace[0]) && is_array($backtrace[0])){$fileinfo = $backtrace[0]['file'] . ":" . $backtrace[0]['line'];}
        while($br){$sbr.=(empty($t) ? PHP_EOL : '<br>');$br--;}
        echo $fileinfo.$sbr.$mes.(empty($t) ? '' : '<'.$t.'>'); print_r($a=(!empty($a)?$a:[])); echo(empty($t) ? '' : '</'.$t.'>').PHP_EOL;
        return true;
}}
if(!function_exists('is_date')){
function is_date($value){ // */  проверка строки на дату  // */
    if(is_a($value, 'DateTime')){return $value;}
    if(is_string($value)){try{return $d = (new \DateTime($value));}catch(\Exception $e){return false;}}
return false;
}}
if(!function_exists('str_contains')){
function str_contains(string $haystack, string $needle){
    return strpos($haystack, $needle) !== false;
}}
if(!function_exists('json_validate')){
function json_validate($haystack){
    if(!is_string($haystack)){return false;}
    json_decode($haystack);
    return json_last_error() === JSON_ERROR_NONE;
}}
if(!function_exists('rr')){
function rr($ar){
    if(empty($ar['type']) || empty($ar['bitrix'])){return false;}
    if(is_array($ar['bitrix'])){
        $data = $ar['bitrix'][0] ?? '';
        foreach($ar['bitrix'] as $k => $v){if(empty($v)){unset($ar['bitrix'][$k]);}}}
    if(empty($ar['bitrix']) || empty($data)){return false;}
    
    $html = '';
    
    if('money' == $ar['type']){
        $html = $data.' руб.';}
elseif('link' == $ar['type']){//pa($ar['bitrix']);
    foreach($ar['bitrix'] as $url){
        $pathinfo = pathinfo($url);
        $html .= '<a href="'.$url.'" target="_blank" style="background-repeat: no-repeat; padding-top: 50px;
        background-image: url(\'/assets/img/svg/'.(('doc' == strtolower($pathinfo['extension'] ?? 'pdf')) ? 'doc' : 'pdf').'.svg\');
        width: 65px; height: 85px;"> </a>';/*$pathinfo['filename']*/
    }}
elseif('mdate' == $ar['type']){//pa($ar['bitrix']);
    $html .= '<div class="progress__bar"><div class="progress__bar__line">';
    foreach($ar['bitrix'] as $k => $date){
        $html .= '
            <div class="progress__bar__line__'.($k+1).'">
                <div id="'.($k+1).'_dot" class="progress__bar__dot '.(0 == $k ? 'active' : '').'"></div>
                <p class="black__text">
                     Информация 
                    <br>
                    Дата: '.$date.'
                </p>
            </div>
        ';
    }$html.='</div></div>';}
elseif('mstring' == $ar['type']){//pa($ar['bitrix']);
    $html .= '<div class="progress__bar"><div class="progress__bar__line">';
    foreach($ar['bitrix'] as $k => $string){
        $html .= '
            <div class="progress__bar__line__'.($k+1).'">
                <div id="'.($k+1).'_dot" class="progress__bar__dot '.(0 == $k ? 'active' : '').'"></div>
                <p class="black__text">
                     Информация 
                    <br>
                    '.$string.'
                </p>
            </div>
        ';
    }$html.='</div></div>';}else{$html = $data;}

    return (empty($html)) ? false : $html;
}}
?>