<?php
require_once($_SERVER['DOCUMENT_ROOT']."/admin/include/init.php");
require_once($_SERVER['DOCUMENT_ROOT']."/admin/include/header.php");
$query ="select * from product_banner";
$result = sql_query($query);


?>
<script>

function winOpen(url)
{
    var name = "popup";
    var option = "width = 800, height = 800, top = 10, left = 200, location = no, scrollbars=yes";
    window.open(url, name, option);
}
</script>



<div id="main" class="container">
	<div class="search">
		<h1>배너 관리</h1>
	</div>
    <div class="btn-wrap">
    	<a href="javascript:winOpen('product_banner_write.php');" class="new-btn"><input class="blue" type="button" value="배너 등록"></a>
    </div>
	<table border="1">
		<colgroup>
			<col width="5%">
			<col width="15%">
			<col width="15%">
			<col width="15%">
			<col width="40%">
			<col width="15%">
		</colgroup>
		<thead>
    		<tr>
    			<th>No</th>
    			<th>3차 카테고리</th>
    			<th>4차 카테고리</th>
    			<th>카테고리 설명글</th>
    			<!-- <th>PC</th> -->
    			<th>PC 배너 이미지</th>
    			<!-- <th>Mobile</th> -->
    			<th>모바일 배너 이미지</th>
    		<tr>
		</thead>
		<tbody>
		<?php 
		for ($i = 0; $i < sql_count($result); $i++) {
		    $row = sql_fetch($result);
		?>
		<tr>
			<td><?php echo $i+1?></td>
			<td><a href="javascript:winOpen('product_banner_edit.php?idx=<?php echo $row['idx']?>');"><?php echo $row['cate3']?></a></td>
			<td><?php echo $row['cate4']?></td>
			<td><?php echo $row['contents']?></td>
			<!-- <td><?php echo $row['banner']?></td> -->
			<td>
			<?php if (isset($row['banner']) && $row['banner']!="") {
				?>
			<img src="/img/product_banner/<?php echo $row['banner']?>" height="150">
			<?php 
				}
			?>
			</td>
			<!-- <td><?php echo $row['banner_mo']?></td> -->
			
			<td>
				<?php if (isset($row['banner_mo']) && $row['banner_mo']!="") {
				?>
				<img src="/img/product_banner/<?php echo $row['banner_mo']?>" height="150">
				<?php 
				}
				?>
			</td>
			
		</tr>
		<?php 
		}	
		?>
		</tbody>
	</table>
</div>