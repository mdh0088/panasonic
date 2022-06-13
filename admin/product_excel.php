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

$reset_excel = 'delete from product';
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
                
                for ($j = 8 ; $j <= $maxRow ; $j++) 
                {
//                     $A = $objWorksheet->getCell('A' . $j)->getValue();
                    $B = $objWorksheet->getCell('B' . $j)->getValue();
                    $C = $objWorksheet->getCell('C' . $j)->getValue();
                    $D = $objWorksheet->getCell('D' . $j)->getValue();
                    $E = $objWorksheet->getCell('E' . $j)->getValue();
                    $F = $objWorksheet->getCell('F' . $j)->getValue(); 
                    $G = $objWorksheet->getCell('G' . $j)->getValue();
                    $H = $objWorksheet->getCell('H' . $j)->getValue();
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
                    $U = $objWorksheet->getCell('U' . $j)->getValue();
                    $V = $objWorksheet->getCell('V' . $j)->getValue();
                    $W = $objWorksheet->getCell('W' . $j)->getValue();
                    $X = $objWorksheet->getCell('X' . $j)->getValue();
                    $Y = $objWorksheet->getCell('Y' . $j)->getValue();
                    $Z = $objWorksheet->getCell('Z' . $j)->getValue();
                    $AA = $objWorksheet->getCell('AA' . $j)->getValue();
                    $AB = $objWorksheet->getCell('AB' . $j)->getValue();
                    $AC = $objWorksheet->getCell('AC' . $j)->getValue();
                    $AD = $objWorksheet->getCell('AD' . $j)->getValue();
                    $AE = $objWorksheet->getCell('AE' . $j)->getValue();
                    $AF = $objWorksheet->getCell('AF' . $j)->getValue();
                    $AG = $objWorksheet->getCell('AG' . $j)->getValue();
                    $AH = $objWorksheet->getCell('AH' . $j)->getValue();
                    $AI = $objWorksheet->getCell('AI' . $j)->getValue();
                    $AJ = $objWorksheet->getCell('AJ' . $j)->getValue();
                    $AK = $objWorksheet->getCell('AK' . $j)->getValue();
                    // $U = trim(addslashes(preg_replace('/\r\n|\r|\n/','<br>',$U)));
                    //$AF = trim(addslashes(preg_replace('/\r\n|\r|\n/','<br>',$AF)));
             
                     $B = trim(preg_replace('/\r\n|\r|\n/',' ',$B));
                     $C = trim(preg_replace('/\r\n|\r|\n/',' ',$C));
                     $D = trim(preg_replace('/\r\n|\r|\n/',' ',$D));
                     $E = trim(preg_replace('/\r\n|\r|\n/',' ',$E));
                     $F = trim(preg_replace('/\r\n|\r|\n/',' ',$F));
                     $G = trim(preg_replace('/\r\n|\r|\n/',' ',$G));
                     $H = trim(preg_replace('/\r\n|\r|\n/',' ',$H));
                     $I = trim(preg_replace('/\r\n|\r|\n/',' ',$I));
                     $J = trim(preg_replace('/\r\n|\r|\n/',' ',$J));
                     $K = trim(preg_replace('/\r\n|\r|\n/',' ',$K));
                     $L = trim(preg_replace('/\r\n|\r|\n/',' ',$L));
                     $M = trim(preg_replace('/\r\n|\r|\n/',' ',$M));
                     $N = trim(preg_replace('/\r\n|\r|\n/',' ',$N));
                     $O = trim(preg_replace('/\r\n|\r|\n/',' ',$O));
                     $P = trim(preg_replace('/\r\n|\r|\n/',' ',$P));
                     $Q = trim(preg_replace('/\r\n|\r|\n/',' ',$Q));
                     $R = trim(preg_replace('/\r\n|\r|\n/',' ',$R));
                     $S = trim(preg_replace('/\r\n|\r|\n/',' ',$S));
                     $T = trim(preg_replace('/\r\n|\r|\n/',' ',$T));
                     $U = trim(preg_replace('/\r\n|\r|\n/',' ',$U));
                     $V = trim(preg_replace('/\r\n|\r|\n/',' ',$V));
                     $W = trim(preg_replace('/\r\n|\r|\n/',' ',$W));
                     $X = trim(preg_replace('/\r\n|\r|\n/',' ',$X));
                     $Y = trim(preg_replace('/\r\n|\r|\n/',' ',$Y));
                     $Z = trim(addslashes(preg_replace('/\r\n|\r|\n/','<br>',$Z)));
                     $AA = trim(addslashes(preg_replace('/\r\n|\r|\n/','<br>',$AA)));
                     $AB = trim(preg_replace('/\r\n|\r|\n/',' ',$AB));
                     $AC = trim(preg_replace('/\r\n|\r|\n/',' ',$AC));
                     $AD = trim(preg_replace('/\r\n|\r|\n/',' ',$AD));
                     $AE = trim(addslashes(preg_replace('/\r\n|\r|\n/','<br>',$AE)));
                     $AF = trim(addslashes(preg_replace('/\r\n|\r|\n/','<br>',$AF)));
                     $AG = trim(preg_replace('/\r\n|\r|\n/',' ',$AG));
                     $AH = trim(preg_replace('/\r\n|\r|\n/',' ',$AH));
                     $AI = trim(preg_replace('/\r\n|\r|\n/',' ',$AI));
                     $AJ = trim(preg_replace('/\r\n|\r|\n/',' ',$AJ));
                     $AK = trim(preg_replace('/\r\n|\r|\n/',' ',$AK));
                     
                     
                     
                     $query = "
                         insert into product
                         set
                         product_cate1='{$B}',
                         product_cate1_en='{$C}',
                         product_cate2='{$D}',
                         product_cate2_en='{$E}',
                         product_cate3='{$F}',
                         product_cate3_en='{$G}',
                         product_cate4='{$H}',
                         product_cate4_en='{$I}',
                         product_cate5='{$J}',
                         product_cate5_en='{$K}',
                         product_thumb='{$L}',
                         product_model='{$M}',
                         product_title='{$N}',
                         product_title_en='{$O}',
                         product_rating='{$P}',
                         product_rating_en='{$Q}',
                         product_size='{$R}',
                         product_size_en='{$S}',
                         product_auth='{$T}',
                         product_auth_en='{$U}',
                         product_auth_file='{$V}',
                         product_manual='{$W}',
                         product_map_1='{$X}',
                         product_map_2='{$Y}',
                         product_info='{$Z}',
                         product_info_en='{$AA}',
                         layer_type='{$AB}',
                         layer_title='{$AC}',
                         layer_title_en='{$AD}',
                         layer_conts='{$AE}',
                         layer_conts_en='{$AF}',
                         layer_img='{$AG}',
                         layer_img_en='{$AH}',
                         product_indi='{$AI}',
                         product_reco='{$AJ}',
                         product_series='{$AK}',
                         submit_date = now()+0
                         ";
                         sql_query($query);
                }
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
	"msg":"저장 되었습니다"
}
