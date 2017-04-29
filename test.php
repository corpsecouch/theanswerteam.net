<html>
	<head>
		<title>Test</title>
	</head>
	<body>
		<?php
			//$blog = simplexml_load_file('http://posterous.com/api/readposts?hostname=theanswerteam&num_posts=5', 'SimpleXMLElement', LIBXML_NOCDATA);
			$ch = curl_init('http://posterous.com/api/readposts?hostname=theanswerteam&num_posts=5');
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HEADER, 0);
			$data = curl_exec($ch);
			curl_close($ch);
			
			$blog = new SimpleXmlElement($data, LIBXML_NOCDATA);
		?>
		<ul>
		<?php for($i = 0; $i < count($blog->post); $i++):?>
			<li>
				<?php if($i != 0):?>
					<span class="date"><?=date('F jS, Y', strtotime($blog->post[$i]->date))?></span>
					<a href="<?=$blog->post[$i]->url?>" target="_blank" class="title" onclick="_gaq.push(['_trackEvent', 'Index', 'Click', 'Blog: <?=$blog->post[$i]->title?>']);"><?=$blog->post[$i]->title?></a>
				<?php else:?>
					<span class="date"><?=date('F jS, Y', strtotime($blog->post[$i]->date))?></span>
					<a href="<?=$blog->post[$i]->url?>" target="_blank" class="title" onclick="_gaq.push(['_trackEvent', 'Index', 'Click', 'Blog: <?=$blog->post[$i]->title?>']);"><?=$blog->post[$i]->title?></a>
					<?php echo $blog->post[$i]->body;?>
				<?php endif;?>
			</li>
		<?php endfor;?>
		</ul>
	</body>
</html>