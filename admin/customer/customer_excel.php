<?php
require_once($_SERVER['DOCUMENT_ROOT']."/admin/include/init.php");
require_once($_SERVER['DOCUMENT_ROOT']."/admin/PHPExcel-1.8/Classes/PHPExcel.php");
require_once($_SERVER['DOCUMENT_ROOT']."/admin/PHPExcel-1.8/Classes/PHPExcel/IOFactory.php");
header('Content-Type: text/html; charset=utf-8');
$uploadBase = "excel/";

if (!is_dir($uploadBase)){
    if(@mkdir($uploadBase, 0777)) {
        if(is_dir($uploadBase)) {
            @chmod($uploadBase, 0777);
        }
    }
    else {
        
    }
}


$reset_excel = 'delete from customer';
sql_query($reset_excel);

for( $i=0 ; $i < count($_FILES['upload']['name']); $i++ ) {
    $name = $_FILES['upload']['name'][$i];
    //     $name = iconv("utf-8","CP949",$name); //한글 파일명이 안되가지구.....
    $fileType = $_FILES['upload']['type'][$i];
    
    
    if($fileType !== "")
    {
        if($fileType !== "application/vnd.ms-excel" && $fileType !== "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet")
        {
            ?>
            {
            	"isSuc":"fail",
            	"msg":"xlsx 혹은 xls 파일만 가능합니다."
            }
            <?php
            exit;
        }
        
        if(move_uploaded_file($_FILES['upload']['tmp_name'][$i], "$uploadBase/$name"))
        {
            $objPHPExcel = new PHPExcel();
            $filename = "excel/{$name}";
            
            try {
                
                $objReader = PHPExcel_IOFactory::createReaderForFile($filename);
                $objReader->setReadDataOnly(true);
                $objExcel = $objReader->load($filename);
                $objExcel->setActiveSheetIndex(0);
                $objWorksheet = $objExcel->getActiveSheet();
                $rowIterator = $objWorksheet->getRowIterator();
                foreach ($rowIterator as $row) 
                {
                    $cellIterator = $row->getCellIterator();
                    $cellIterator->setIterateOnlyExistingCells(false);
                }
                $maxRow = $objWorksheet->getHighestRow();
                
                for ($j = 6 ; $j <= $maxRow ; $j++)
                {
                    $B = $objWorksheet->getCell('B' . $j)->getValue();
                    $C = $objWorksheet->getCell('C' . $j)->getValue();
                    $D = $objWorksheet->getCell('D' . $j)->getValue();
                    $E = $objWorksheet->getCell('E' . $j)->getValue();
                    $F = $objWorksheet->getCell('F' . $j)->getValue();
                    $G = $objWorksheet->getCell('G' . $j)->getValue();
/*                     $H = $objWorksheet->getCell('H' . $j)->getValue();
                    $I = $objWorksheet->getCell('I' . $j)->getValue();
                    $J = $objWorksheet->getCell('J' . $j)->getValue();
                    $K = $objWorksheet->getCell('K' . $j)->getValue();
                    $L = $objWorksheet->getCell('L' . $j)->getValue();
                    $M = $objWorksheet->getCell('M' . $j)->getValue();
                    $N = $objWorksheet->getCell('N' . $j)->getValue();
                    $O = $objWorksheet->getCell('O' . $j)->getValue();
                    $P = $objWorksheet->getCell('P' . $j)->getValue();
                    $Q = $objWorksheet->getCell('Q' . $j)->getValue();
                    $R = $objWorksheet->getCell('R' . $j)->getValue();
                    $S = $objWorksheet->getCell('S' . $j)->getValue();
                    $T = $objWorksheet->getCell('T' . $j)->getValue();
 */                    
//                     $F = preg_replace('/\r\n|\r|\n/','@',$F);
//                     $G = preg_replace('/\r\n|\r|\n/','@',$G);
//                     $H = preg_replace('/\r\n|\r|\n/','@',$H);
//                     $I = preg_replace('/\r\n|\r|\n/','@',$I);
//                     $J = preg_replace('/\r\n|\r|\n/','@',$J);
//                     $K = preg_replace('/\r\n|\r|\n/','@',$K);
//                     $L = preg_replace('/\r\n|\r|\n/','@',$L);
//                     $M = preg_replace('/\r\n|\r|\n/','@',$M);
//                     $S = preg_replace('/\r\n|\r|\n/','@',$S);

                  
          
                                $query = "
                                insert into customer
                                    set
                                customer_name = '{$B}',
                                customer_area = '{$C}',
                                customer_addr = '{$D}',
                                customer_phone = '{$E}',
                                customer_fax = '{$F}'
                                ";
                            
                            sql_query($query);
                        
                    }
                    
                //}
            }
            catch (exception $e) 
            {
                ?>
                {
                	"isSuc":"fail",
                	"msg":"엑셀파일을 읽는도중 오류가 발생하였습니다.2"
                }
                <?php
                exit;
            }
        }
        else
        {
            ?>
            {
            	"isSuc":"fail",
            	"msg":"파일 업로드에 실패하였습니다.3"
            }
            <?php
            exit;
        }
    }
}

?>
{
	"isSuc":"success",
	"msg":"저장되었습니다"
}
