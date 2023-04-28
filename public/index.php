<?php
setlocale(LC_ALL, 'ru_RU.utf8'); error_reporting(E_ALL & ~E_DEPRECATED); header('Content-type: text/html; charset=utf-8');define('DS',DIRECTORY_SEPARATOR);

function glob_tree_search($path, $pattern, $_base_path = null){$ret = []; $_base_path = (is_null($_base_path)) ? '' : $_base_path.($path).DS; 
    foreach(glob($path.DS.$pattern, GLOB_BRACE) as $file){$ret[] = $_base_path.($file);}
    foreach(glob($path.DS.'*', GLOB_ONLYDIR) as $file){$ret = array_merge($ret, glob_tree_search($file, $pattern, $_base_path));} 
    return $ret;}
///*/
try{
    if(!file_exists($autoloadPath = $_SERVER['DOCUMENT_ROOT'].DS.'vendor'.DS.'autoload.php')){
        throw new Exception('Composer autoload file not found: '.$autoloadPath);
    }include_once($autoloadPath);}
catch(\Exception $e){
    file_put_contents(DS.'logs'.DS.'exception.txt', $crash = (new \DateTime())->format('Y-m-d H:i:s').' '.
                                                $e->getMessage().' '.PHP_EOL.
                                                $e->getFile().':'.
                                                $e->getLine().PHP_EOL.PHP_EOL, FILE_APPEND);
    $autoloadPath = (file_exists($autoloadPath)) ? $autoloadPath : 
        (!empty($searhAutoloadPath = glob_tree_search(realpath($_SERVER['DOCUMENT_ROOT']), 'vendor'.DS.'autoload.php')[0]) ? $searhAutoloadPath : false);
    if($autoloadPath){include_once($autoloadPath);}
    else{header('Location: mailto:ahilespelid@gmail.com?cc=ahilespelid@yandex.ru'.
                                                      '&subject=Please, send for me this is post | Прошу отправить это письмо мне.'.
                                                      '&body=#crash# '.preg_replace('/\R/u', "\t",$crash).
                                                           ' #host# '.$_SERVER['HTTP_HOST'].
                                                           ' #agent# '.$_SERVER['HTTP_USER_AGENT']);
    }
}
///*/
if(isset($_REQUEST['checkserver'])){\Btx\CRest::checkServer(); exit;}

$result = \Btx\CRest::call('profile');

pa($result);
(new \App\Controllers\HomeController)->render();

//
/*/
if($get = ($_REQUEST[$resume->hash] ?? false)){
    if(function_exists('send_file_apache')){send_file_apache($resume->file);}
    if(function_exists('pa')){pa($get);}
    echo $resume->file;
}
///* /
$resume->render()?->run()?->write();
///*/ 