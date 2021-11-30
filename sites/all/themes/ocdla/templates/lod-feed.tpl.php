<!-- LOD Feed template file, lod-feed.tpl.php -->
<!-- Generated <?php print date( 'D, d M Y H:i:s' ) ?> -->

<?php foreach( $items AS $item ): ?>
	<h6><?php print $item['title'] ?></h6>
	<!--<strong><?php print $item['author'] ?></strong>-->
	<span class="pubDate"><?php print $item['date'] ?></span>
	<div class="lod-feed-item">
		<?php print $item['description'] ?>
		<span class="read-more">
			<a target="_blank" href="<?php print $item['link'] ?>">Read more</a>
		</span>
	</div>
	
<?php endforeach; ?>