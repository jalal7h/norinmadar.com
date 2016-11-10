<?

function social_sharebuttons( $url, $text){
	$url = urlencode($url);
	$c.= '
	<div class="social_sharebuttons">
		<span>اشتراک :‌ </span>
		<a target="_blank" href="https://plus.google.com/share?url='.$url.'" class="fa fa-google-plus-square fa-2x"></a >
		<a target="_blank" href="http://facebook.com/share.php?u='.$url.'" class="fa fa-facebook-square fa-2x"></a >
		<a target="_blank" href="https://twitter.com/share?url='.$url.'&text='.$text.'" class="fa fa-twitter-square fa-2x"></a >
		<a target="_blank" href="http://www.linkedin.com/shareArticle?mini=true&url='.$url.'&title='.$text.'&summary=&source=" class="fa fa-linkedin-square fa-2x"></a >
		<a target="_blank" href="http://www.tumblr.com/share/link?url='.$url.'" class="fa fa-tumblr-square fa-2x"></a >
		<a target="_blank" href="http://reddit.com/submit?url='.$url.'" class="fa fa-reddit-square fa-2x"></a >

	</div>';

	return $c;
}

