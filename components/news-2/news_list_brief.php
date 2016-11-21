<?

function news_list_brief(){

	echo "<div class=news_list_brief >";

	$count = 5;
	$start = $count * intval($_REQUEST['p']);
	$sql=dbq(" SELECT * FROM `news` ORDER BY `id` DESC LIMIT $start,$count ");

	if(mysql_num_rows($sql)==0){
		echo '<center><div style="text-align:center" class="warning">موردی یافت نشد</div></center>';
	}
	
	echo "
	<div class='head'>اخبار سایت</div>
	<div class='list'>
	";

	while($row=mysql_fetch_assoc($sql)){
		echo "
		<div class=record >
			<a href='./news-".$row['id'].".html' >
				<div class=name >» ".$row['name']."</div>
			</a>
		</div>
		";
	}
	
	echo "
	</div>
	<a href='./?page=43' ><div class='more' >بیشتر</div></a>
	</div>
	<div class=clear ></div>
	";
}


