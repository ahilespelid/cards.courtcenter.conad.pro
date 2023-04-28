<?php 
namespace App\Controllers;
/// */ Юзаем PhpOffice 
use PhpOffice\PhpSpreadsheet\Spreadsheet; use PhpOffice\PhpSpreadsheet\Style\Fill; use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing; /// */

class HomeController {
    public function __construct(
        string $file = ''
    ){
        $this->file = (is_writable($dir = realpath($_SERVER['DOCUMENT_ROOT']).DS.'files')) ? $dir.DS.'resume.xlsx' : (mkdir($dir,777) ? $dir.DS : '').'resume.xlsx';
    }
    
public function run():?object{/*/// if(function_exists('pa')){pa(new Resume);return $this;}///*/ return null;}    

public function write():bool{
    $spreadsheet = new Spreadsheet(); $sheet = $spreadsheet->createSheet(1);
    foreach($this as $k => $v){$i=1;
        if(preg_match('#photo|hash|hashTime|birth|get|file|lates#i',$k,$m)){continue;}
        $exel []= array($i=>$k, ('name' == $k) ? str_replace("&nbsp;", ' ', $this->name['f']) : 
                                (('age' == $k) ? $this->age : str_replace(',', '|', str_replace(['"', '{', '}', 'https:', 'http:','\/','/','\\'], '', json_encode($v))) ));
    ++$i;}
///*/ Фотография
    file_put_contents($tPhotoFile = sys_get_temp_dir().DS.uniqid('pht').'.jpeg', base64_decode(explode(',', $this->photo)[1]),LOCK_EX);
    $d = new Drawing(); $d->setName('PHOTO'); $d->setDescription('Ahi Les');
    $d->setWidth(1); $d->setHeight(320); $d->setCoordinates('A1');
    $d->setPath($tPhotoFile); $d->setWorksheet($sheet);
///*/
    $sheet->getStyle('F1:Z16')->applyFromArray(['font'=>['color'=>['rgb' => '255,50,50'],'bold' => true,'size' => 11],'fill'=>['fillType' => Fill::FILL_SOLID,'startColor' => ['rgb' => '50,100,100']]]); 
    $sheet->fromArray($exel, NULL, 'F1'); $spreadsheet->removeSheetByIndex(0); ///*/ $spreadsheet->setActiveSheetIndex(1); ///*/
    return ((new Xlsx($spreadsheet))->save($this->file)) ? true : false;
    }
    public function render(array $data = [], string $view = 'first'):?object{
        $view = str_replace(['?', '\\', '/', ':', '"', '*', '>', '<', '|'], '',$view);
        $view = $_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR.'resource'.DIRECTORY_SEPARATOR.'veiw'.DIRECTORY_SEPARATOR.$view.DIRECTORY_SEPARATOR.'index.php';

        if(is_readable($view)){
            $detect = new \Detection\MobileDetect; $data['device'] = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'phone') : 'computer');
            extract($data, EXTR_SKIP); require $view; return $this;
        } else {throw new \Exception("Файл на вид по пути '$view' не найден.");}
        return null;
    }
    public function __set(string $name, mixed $value):void {$this->{$name} = $value;}
}