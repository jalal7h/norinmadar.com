<?
$GLOBALS['block_layers']['is_about']="درباره ما";

function is_about($table_name=null , $page_id=null){
 
  	if($page_id){

		$title = table( $table_name , $page_id , "_title" , "_id" );
		create_box($title, $allow_eval=false, $framed=true, $position="center");
	
	} else {
		echo $content;
	}
  ?>
  <div class="is_about">
  <p class="line1">شركت نورين مدار </p>به طور متمرکز در زمینه فروش
‎لوازم جانبی خودرو فعالیت داشته و توانسته در مدت حیات خود سهم قابل توجهی در بازار را به خود اختصاص دهد که این امر <p class="line2">ناشی از قیمت مناسب، حذف واسطه ها، کیفیت خوب، خدمات شایسته و به روز بودن محصولات ميباشد
‎رضایت شما، رمز ماندگاری ماست.
</p>
  </div>
  <?
}