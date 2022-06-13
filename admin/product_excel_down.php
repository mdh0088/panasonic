<?php
require_once($_SERVER['DOCUMENT_ROOT']."/admin/include/init.php");
require_once($_SERVER['DOCUMENT_ROOT']."/admin/PHPExcel-1.8/Classes/PHPExcel.php");
require_once($_SERVER['DOCUMENT_ROOT']."/admin/PHPExcel-1.8/Classes/PHPExcel/IOFactory.php");


header('Content-Type: text/html; charset=utf-8');

$excel_idx = $_POST['excel_idx'];
$excel_idx_arr = explode('@', $excel_idx);

$query = " SELECT * FROM product where ";



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

->setCellValue("B7", '카테고리1')
->setCellValue("C7", '카테고리1(영문)')
->setCellValue("D7", '카테고리2')
->setCellValue("E7", '카테고리2(영문)')
->setCellValue("F7", '카테고리3')
->setCellValue("G7", '카테고리3(영문)')
->setCellValue("H7", '카테고리4')
->setCellValue("I7", '카테고리4(영믄)')
->setCellValue("J7", '카테고리5')
->setCellValue("K7", '카테고리5(영문)')
->setCellValue("L7", '썸네일 이미지')
->setCellValue("M7", '모델명')
->setCellValue("N7", '제품명')
->setCellValue("O7", '제품명(영문)')
->setCellValue("P7", '정격')
->setCellValue("Q7", '정격(영문)')
->setCellValue("R7", '사이즈')
->setCellValue("S7", '사이즈(영문)')
->setCellValue("T7", '인증')
->setCellValue("U7", '인증(영문)')
->setCellValue("V7", '인증 파일')
->setCellValue("W7", '설명서')
->setCellValue("X7", '도면 DWG')
->setCellValue("Y7", '도면 PNG')
->setCellValue("Z7", '제품설명')
->setCellValue("AA7", '제품설명(영문)')
->setCellValue("AB7", '레이어 타입')
->setCellValue("AC7", '레이어 타이틀')
->setCellValue("AD7", '레이어 타이틀(영문)')
->setCellValue("AE7", '레이어 본문')
->setCellValue("AF7", '레이어 본문(영문)')
->setCellValue("AG7", '레이어 이미지')
->setCellValue("AH7", '레이어 이미지(영문)')
->setCellValue("AI7", '단일제품')
->setCellValue("AJ7", '추천제품')
->setCellValue("AK7", '시리즈 선정');




for ($i=8; $row=sql_fetch($result); $i++)

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
    ->setCellValue("P$i", $row['product_rating'])
    ->setCellValue("Q$i", $row['product_rating_en'])
    ->setCellValue("R$i", $row['product_size'])
    ->setCellValue("S$i", $row['product_size_en'])
    ->setCellValue("T$i", $row['product_auth'])
    ->setCellValue("U$i", $row['product_auth_en'])
    ->setCellValue("V$i", $row['product_auth_file'])
    ->setCellValue("W$i", $row['product_manual'])
    ->setCellValue("X$i", $row['product_map_1'])
    ->setCellValue("Y$i", $row['product_map_2'])
    ->setCellValue("Z$i", $row['product_info'])
    ->setCellValue("AA$i", $row['product_info_en'])
    ->setCellValue("AB$i", $row['layer_type'])
    ->setCellValue("AC$i", $row['layer_title'])
    ->setCellValue("AD$i", $row['layer_title_en'])
    ->setCellValue("AE$i", $row['layer_conts'])
    ->setCellValue("AF$i", $row['layer_conts_en'])
    ->setCellValue("AG$i", $row['layer_img'])
    ->setCellValue("AH$i", $row['layer_img_en'])
    ->setCellValue("AI$i", $row['product_indi'])
    ->setCellValue("AJ$i", $row['product_reco'])
    ->setCellValue("AK$i", $row['product_series']);
    
    
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

$filename = iconv("UTF-8", "EUC-KR", "제품관리");


// Redirect output to a client’s web browser (Excel5)

header('Content-Type: application/vnd.ms-excel');

header("Content-Disposition: attachment;filename=".$filename.".xls");

header('Cache-Control: max-age=0');


$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');

$objWriter->save('php://output');

exit;
?>