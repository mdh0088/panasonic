<?php
require_once($_SERVER['DOCUMENT_ROOT']."/admin/include/init.php");
require_once($_SERVER['DOCUMENT_ROOT']."/admin/PHPExcel-1.8/Classes/PHPExcel.php");
require_once($_SERVER['DOCUMENT_ROOT']."/admin/PHPExcel-1.8/Classes/PHPExcel/IOFactory.php");


header('Content-Type: text/html; charset=utf-8');

$excel_idx = $_POST['excel_idx'];
$excel_idx_arr = explode('@', $excel_idx);

$query = " SELECT * FROM kmew where ";



for ($i = 0; $i < count($excel_idx_arr)-1; $i++) {
    if ($i==0) {
         $query .= "idx ='$excel_idx_arr[$i]'";  
    }else{
        $query .= "or idx ='$excel_idx_arr[$i]'";
    }
}

$result = sql_query($query);

$objPHPExcel = new PHPExcel();

// Add some data

$objPHPExcel->setActiveSheetIndex(0)

->setCellValue("B2", 'CATE1')
->setCellValue("C2", 'CATE1(영문)')
->setCellValue("D2", 'CATE2')
->setCellValue("E2", 'CATE2(영문)')
->setCellValue("F2", 'CATE3')
->setCellValue("G2", 'CATE3(영문)')
->setCellValue("H2", 'CATE4')
->setCellValue("I2", 'CATE4(영문)')
->setCellValue("J2", 'CATE5')
->setCellValue("K2", 'CATE5(영문)')
->setCellValue("L2", '썸네일 이미지')
->setCellValue("M2", '모델명')
->setCellValue("N2", '제품명')
->setCellValue("O2", '제품명(영문)')
->setCellValue("P2", '사이즈')
->setCellValue("Q2", '장수')
->setCellValue("R2", '장수(영문)')
->setCellValue("S2", '장당 무게')
->setCellValue("T2", '장당 무게(영문)')
->setCellValue("U2", '레이어 타입')
->setCellValue("V2", '레이어 타이틀')
->setCellValue("W2", '레이어 타이틀(영문)')
->setCellValue("X2", '레이어 본문')
->setCellValue("Y2", '레이어 본문(영문)')
->setCellValue("Z2", '레이어 이미지')
->setCellValue("AA2", '레이어 이미지(영문)');




for ($i=3; $row=sql_fetch($result); $i++)

{
    
    
    // Add some data
    
    $objPHPExcel->setActiveSheetIndex(0)
    
    ->setCellValue("B$i", $row['product_cate1'])
    ->setCellValue("C$i", $row['product_cate1_en'])
    ->setCellValue("D$i", $row['product_cate2'])
    ->setCellValue("E$i", $row['product_cate2_en'])
    ->setCellValue("F$i", $row['product_cate3'])
    ->setCellValue("G$i", $row['product_cate3_en'])
    ->setCellValue("H$i", $row['product_cate4'])
    ->setCellValue("I$i", $row['product_cate4_en'])
    ->setCellValue("J$i", $row['product_cate5'])
    ->setCellValue("K$i", $row['product_cate5_en'])
    ->setCellValue("L$i", $row['product_thumb'])
    ->setCellValue("M$i", $row['product_model'])
    ->setCellValue("N$i", $row['product_title'])
    ->setCellValue("O$i", $row['product_title_en'])
    ->setCellValue("P$i", $row['product_size'])
    ->setCellValue("Q$i", $row['product_ea'])
    ->setCellValue("R$i", $row['product_ea_en'])
    ->setCellValue("S$i", $row['product_weight'])
    ->setCellValue("T$i", $row['product_weight_en'])
    ->setCellValue("U$i", $row['layer_type'])
    ->setCellValue("V$i", $row['layer_title'])
    ->setCellValue("W$i", $row['layer_title_en'])
    ->setCellValue("X$i", $row['layer_conts'])
    ->setCellValue("Y$i", $row['layer_conts_en'])
    ->setCellValue("Z$i", $row['layer_img'])
    ->setCellValue("AA$i", $row['layer_img_en']);
    
    
//     $objPHPExcel->getActiveSheet()->getStyle("E$i")->getAlignment()->setWrapText(true);
//     $objPHPExcel->getActiveSheet()->getStyle("G$i")->getAlignment()->setWrapText(true);
//     $objPHPExcel->getActiveSheet()->getStyle("H$i")->getAlignment()->setWrapText(true);
//     $objPHPExcel->getActiveSheet()->getStyle("I$i")->getAlignment()->setWrapText(true);
//     $objPHPExcel->getActiveSheet()->getStyle("J$i")->getAlignment()->setWrapText(true);
//     $objPHPExcel->getActiveSheet()->getStyle("K$i")->getAlignment()->setWrapText(true);
//     $objPHPExcel->getActiveSheet()->getStyle("L$i")->getAlignment()->setWrapText(true);
//     $objPHPExcel->getActiveSheet()->getStyle("M$i")->getAlignment()->setWrapText(true);
//     $objPHPExcel->getActiveSheet()->getStyle("S$i")->getAlignment()->setWrapText(true); 
       $objPHPExcel -> getActiveSheet() -> getDefaultRowDimension() -> setRowHeight(20);
}


// Rename sheet

$objPHPExcel->getActiveSheet()->setTitle('Seet name');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet

$objPHPExcel->setActiveSheetIndex(0);


// 파일의 저장형식이 utf-8일 경우 한글파일 이름은 깨지므로 euc-kr로 변환해준다.

$filename = iconv("UTF-8", "EUC-KR", "KMEW관리");


// Redirect output to a client’s web browser (Excel5)

header('Content-Type: application/vnd.ms-excel');

header("Content-Disposition: attachment;filename=".$filename.".xls");

header('Cache-Control: max-age=0');


$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');

$objWriter->save('php://output');

exit;
?>