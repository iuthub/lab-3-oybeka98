<?php $playlist = $_REQUEST["playlist"];?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
 "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Music Viewer</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<link href="viewer.css" type="text/css" rel="stylesheet" />
	</head>
	<body>
		<div id="header">

			<h1>190M Music Playlist Viewer</h1>
			<h2>Search Through Your Playlists and Music</h2>
		</div>


		<div id="listarea">
			<ul id="musiclist">
			<?php

			chdir("./songs");
			if (isset($playlist))
			{	
				$songs = file($playlist, FILE_IGNORE_NEW_LINES);
				foreach ($songs as $song) 
				{
				 ?>
				<li class="mp3item"><a href="songs/<?=$song?>" download><?=$song?></a> (<?=getSize($song)?>)
				</li> 
			<?}}
			else
			{
			foreach (glob("*.m*") as $filename) 
			{?>
			<li class="mp3item">
				<a href="songs/<?= $filename ?>" download><?=$filename?></a> (<?=getSize($filename)?>)
			</li> 
			<?}
			foreach (glob("*.txt") as $filename) {
			?>
			<li class="playlistitem">
				<a href="music.php?playlist=<?= $filename ?>"><?= $filename?></a>
			</li>
			<?}}
			function getSize($filename)
			{
				$songsize = filesize($filename);
				if (0 <= $songsize  && $songsize <= 1023) {
					return $songsize  . " b";
				}
				else if (1024 <= $songsize && $songsize <= 1048575) {

					return round($songsize >> 10)." kb";
				}
				else if ($songsize >= 1048576) {

					return ($songsize>> 20)." mb";
				}
				return 0;
			}
			?>
			</ul>
		</div>
	</body>
</html>
