<rss version="2.0" 
	xmlns:media="http://search.yahoo.com/mrss/" 
	xmlns:jwplayer="http://developer.longtailvideo.com/trac/wiki/FlashFormats">
	<channel>
		<title></title>
		<?php foreach ($videos as $video): ?>
		<item>
			<title><?php echo $video['title']; ?></title>
			<description><?php echo $video['description']; ?></description>
			<media:group>
                            <media:content url="<?php echo BASE_URI; ?>/assets/video/<?php echo $video['video'] . '?'. time(); ?>" />
				<media:thumbnail url="<?php echo BASE_URI; ?>/assets/img/wildcat-football-plate.jpg" />
			</media:group>
		</item>
		<?php endforeach; ?>
	</channel>
</rss>