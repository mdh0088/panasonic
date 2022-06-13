<?php
require_once($_SERVER['DOCUMENT_ROOT']."/admin/include/init.php");
require_once($_SERVER['DOCUMENT_ROOT']."/admin/PHPExcel-1.8/Classes/PHPExcel.php");
require_once($_SERVER['DOCUMENT_ROOT']."/admin/PHPExcel-1.8/Classes/PHPExcel/IOFactory.php");


header('Content-Type: text/html; charset=utf-8');

$excel_idx = $_POST['excel_idx'];
$excel_idx_arr = explode('@', $excel_idx);

$query = " SELECT * FROM customer where";



for ($i = 0; $i < count($excel_idx_arr)-1; $i++) {
    if ($i==0) {
        $query .= " idx ='$excel_idx_arr[$i]'";  
    }else{
        $query .= " or idx ='$excel_idx_arr[$i]'";
    }
}

$result = sql_query($query);

$objPHPExcel = new PHPExcel();

// Add some data

$objPHPExcel->setActiveSheetIndex(0)

->setCellValue("B5", '회사명')
->setCellValue("C5", '지역')
->setCellValue("D5", '주소')
->setCellValue("E5", '전화')
->setCellValue("F5", '팩스');




for ($i=6; $row=sql_fetch($result); $i++)

{
    
    
    // Add some data
    
    $objPHPExcel->setActiveSheetIndex(0)
    
    ->setCellValue("B$i", $row['customer_name'])
    ->setCellValue("C$i", $row['customer_area'])
    ->setCellValue("D$i", $row['customer_addr'])
    ->setCellValue("E$i", $row['customer_phone'])
    ->setCellValue("F$i", $row['customer_fax']);
    
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

$filename = iconv("UTF-8", "EUC-KR", "고객지원센터");


// Redirect output to a client’s web browser (Excel5)

header('Content-Type: application/vnd.ms-excel');

header("Content-Disposition: attachment;filename=".$filename.".xls");

header('Cache-Control: max-age=0');


$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');

$objWriter->save('php://output');

exit;
?>