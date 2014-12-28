<?php 

function ab_make_links_clickable($text,$target='_blank'){
	$text = preg_replace('/(https?:\/\/[^\s"<>]+)/','<a href="$1" target="'.$target.'">$1</a>', $text);
	$text = preg_replace('/(^|[\n\s])@([^\s"\t\n\r<:]*)/is', '$1<a href="http://twitter.com/$2" target="'.$target.'">@$2</a>', $text);
	$text = preg_replace('/(^|[\n\s])#([^\s"\t\n\r<:]*)/is', '$1<a href="http://twitter.com/search?q=%23$2" target="'.$target.'">#$2</a>', $text);
	return $text;
}