<?php
require_once($_SERVER['DOCUMENT_ROOT']."/admin/include/init.php");
require_once($_SERVER['DOCUMENT_ROOT']."/admin/PHPExcel-1.8/Classes/PHPExcel.php");
require_once($_SERVER['DOCUMENT_ROOT']."/admin/PHPExcel-1.8/Classes/PHPExcel/IOFactory.php");
header('Content-Type: text/html; charset=utf-8');
$uploadBase = "product_excel/";

if (!is_dir($uploadBase)){
    if(@mkdir($uploadBase, 0777)) {
        if(is_dir($uploadBase)) {
            @chmod($uploadBase, 0777);
        }
    }
    else {
        
    }
}

error_reporting(E_ALL);

ini_set("display_errors", 1);



 $reset_excel = 'delete from product_test';
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
            $filename = "product_excel/{$name}";
            

            
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
                
                for ($i = 3 ; $i <= $maxRow ; $i++) 
                {
                    $B = $objWorksheet->getCell('B' . $i)->getValue();  //상품코드
                    $C = $objWorksheet->getCell('C' . $i)->getValue();  //판매코드
                    $D = $objWorksheet->getCell('D' . $i)->getValue();  //중분류
                    $E = $objWorksheet->getCell('E' . $i)->getValue();  //세분류
                    $F = $objWorksheet->getCell('F' . $i)->getValue();  //신제품순번
                    $G = $objWorksheet->getCell('G' . $i)->getValue();  //신제품표기
                    $H = $objWorksheet->getCell('H' . $i)->getValue();  //베스트 상품표기
                    $I = $objWorksheet->getCell('I' . $i)->getValue();  //상품명
                    $J = $objWorksheet->getCell('J' . $i)->getValue();  //규격
                    $K = $objWorksheet->getCell('K' . $i)->getValue();  //입수량
                    $L = $objWorksheet->getCell('L' . $i)->getValue();  //보관
                    $M = $objWorksheet->getCell('M' . $i)->getValue();  //유통기한
                    $N = $objWorksheet->getCell('N' . $i)->getValue();  //상품이미지
                    $O = $objWorksheet->getCell('O' . $i)->getValue();  //head copy
                    $P = $objWorksheet->getCell('P' . $i)->getValue();  //상품 특징
                    $Q = $objWorksheet->getCell('Q' . $i)->getValue();  //조리1 아이콘
                    $R = $objWorksheet->getCell('R' . $i)->getValue();  //조리1 제목
                    $S = $objWorksheet->getCell('S' . $i)->getValue();  //조리1 설명
                    $T = $objWorksheet->getCell('T' . $i)->getValue();  //조리2 아이콘
                    $U = $objWorksheet->getCell('U' . $i)->getValue();  //조리2 제목
                    $V = $objWorksheet->getCell('V' . $i)->getValue();  //조리2 설명
                    $W = $objWorksheet->getCell('W' . $i)->getValue();  //추천업소1
                    $X = $objWorksheet->getCell('X' . $i)->getValue();  //추천업소2
                    $Y = $objWorksheet->getCell('Y' . $i)->getValue();  //추천업소3
//                     $Y = $objWorksheet->getCell('Y' . $i)->getValue();
//                     $Z = $objWorksheet->getCell('Z' . $i)->getValue();
//                     $AA = $objWorksheet->getCell('AA' . $i)->getValue();
//                     $AB = $objWorksheet->getCell('AB' . $i)->getValue();
//                     $AC = $objWorksheet->getCell('AC' . $i)->getValue();
//                     $AD = $objWorksheet->getCell('AD' . $i)->getValue();
//                     $AE = $objWorksheet->getCell('AE' . $i)->getValue();
//                     $AF = $objWorksheet->getCell('AF' . $i)->getValue();
//                     $AG = $objWorksheet->getCell('AG' . $i)->getValue();
//                     $AH = $objWorksheet->getCell('AH' . $i)->getValue();
                    
                    
                    $N = addslashes($N);
                    $P = addslashes(preg_replace('/\r\n|\r|\n/','<br>',$P));
                     
                     //$Q = str_replace("'","''",$Q);
                     //$Q = preg_replace('/\r\n|\r|\n/','<br>',$Q);
                    $S = addslashes(preg_replace('/\r\n|\r|\n/','<br>',$S));
                    $V = addslashes(preg_replace('/\r\n|\r|\n/','<br>',$V));
                     //$AB = addslashes(preg_replace('/\r\n|\r|\n/','<br>',$AB));
                    /*
                     if(!strpos($L, '보관')){
                         $L=$L.'보관';
                     }
                      if (strpos($S,'CONCATENATE')) {
                         $S=$R.'에 조리 시';
                     }
                     if (strpos($V,'CONCATENATE')) {
                         $V=$U.'에 조리 시';
                     }
                     if (strpos($Y,'CONCATENATE')) {
                         $Y=$X.'에 조리 시';
                     } */
                  
                                $query = "
                                insert into product_test set
                                    product_num='{$B}',
                                    product_code='{$C}',
                                    product_type='{$D}',
                                    product_cate = '{$E}',
                                    new_num='{$F}',                                    
                                    product_new='{$G}',
                                    product_popular='{$H}',
                                    product_name='{$I}',
                                    product_standard='{$J}',
                                    product_ea='{$K}',
                                    product_storage='{$L}',
                                    product_expire='{$M}',
                                    product_img='{$N}',
                                    product_headcopy='{$O}',
                                    product_feature='{$P}',
                                    cook_method_1='{$Q}',
                                    cook_title_1='{$R}',
                                    cook_desc_1='{$S}',
                                    cook_method_2='{$T}',
                                    cook_title_2='{$U}',
                                    cook_desc_2='{$V}',
                                    reco1='{$W}',
                                    reco2='{$X}',
                                    reco3='{$Y}',
                                    submit_date = now()+0
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
	"msg":"저장되었습니다."
}
