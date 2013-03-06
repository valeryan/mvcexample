<rss version="2.0" 
	xmlns:media="http://search.yahoo.com/mrss/" 
	xmlns:jwplayer="http://developer.longtailvideo.com/trac/wiki/FlashFormats">
	<channel>
		<title></title>
		<?php foreach ($videos as $video): ?>
		<item>
			<title><?php echo $video->title; ?></title>
			<description><?php echo $video->description; ?></description>
			<media:group>
                            <media:content url="<?php echo Config::read('site'); ?>video/<?php echo $video->file . '?'. time(); ?>" />
				<media:thumbnail url="<?php echo Config::read('site'); ?>img/wildcat-football-plate.jpg" />
			</media:group>
		</item>
		<?php endforeach; ?>
	</channel>
</rss>