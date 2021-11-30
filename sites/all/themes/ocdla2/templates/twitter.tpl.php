<!-- Twitter template file, twitter.tpl.php -->
<!-- Generated <?php print date( 'D, d M Y H:i:s' ) ?> -->
<style type="text/css">
#latest_news a, #latest_news a:link {  font-size:14px; font-family:Verdana, sans-serif; }
#latest_news a, #latest_news a:link, #latest_news a:visited { color:#0099CC; }
.content p.tweet { margin-bottom:0px; }
</style>

<h2 id="latest_news"><a href="http://twitter.com/OregonDefense">OCDLA Twitter</a></h2>

<?php foreach( $tweets AS $tweet ): ?>
	<p class='tweet <?php print $tweet['zebra'] ?>'>
		<img height="10" width="7" border="0" alt="arrow" src="/images/images-buttons/arrow-trans.png" />
		<a href='<?php print $tweet['link'] ?>'>
			<?php print $tweet['text'] ?>
		</a>
	</p>
<?php endforeach; ?>