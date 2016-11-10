<?

function share_tools( $title , $link  ){
	ob_start();

	?>
	<div class="share_tools">
		
		<a class="facebook" href="https://www.facebook.com/sharer/sharer.php?u=<?=urlencode($link)?>">
			<img src="<?=_URL?>/template/image/facebook.png"/>
		</a>
		
		<a class="twitter" href="https://twitter.com/intent/tweet?text=<?=urlencode($title)?>&url=<?=urlencode($link)?>" class="shortenUrl" data-social-url="https://twitter.com/intent/tweet?text=<?=urlencode($title)?>&url=<?=urlencode($title)?>" data-target-url="<?=$link?>">
			<img src="<?=_URL?>/template/image/twitter.png"/>
		</a>

		<a class="gplus" href="https://plus.google.com/share?url=<?=urlencode($link)?>&hl=fa">
			<img src="<?=_URL?>/template/image/google.png"/>
		</a>

		<a class="balatarin" href="http://balatarin.com/links/submit?phase=2&url=<?=urlencode($link)?>&title=<?=urlencode($title)?>">
			<img src="<?=_URL?>/template/image/balatarin.png"/>
		</a>

	</div>
	<?
	$c = ob_get_contents();
	ob_end_clean();
	return $c;
}

