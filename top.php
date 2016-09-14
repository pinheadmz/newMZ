<?
	
	$label = (isset($_REQUEST['label']) ? $_REQUEST['label'] : '');

	function blogURL($label){
		if ($label && $label != 'ALL')
			return 'http://matthewzipkin.blogspot.com/feeds/posts/default/-/'. $label .'/?alt=rss&max-results=1000';
		else
			return 'http://matthewzipkin.blogspot.com/feeds/posts/default?alt=rss&max-results=1000';
	}
	
	$BLOG = blogURL($label);
	
	$BlogDOM = @simplexml_load_file($BLOG);
	$f = 0;
	$l = 4;
	$inc = 4;
	
	function printBlog($first, $last){
		global $BlogDOM;
		for($i = $first; $i < $last; $i++){
			$item = $BlogDOM->channel->item[$i];
			if (!$item)
				break;
			?>
				<div class="blogItem">
					<h3><a href="<?= $item->link ?>" target="_blank"><?= htmlspecialchars($item->title) ?></a></h3>
					<span style="float:left;font-style:italic;font-size:12px"><?= substr(htmlspecialchars($item->pubDate), 0, -15) ?></span><br>
					<p><?= $item->description; ?><p>						
				</div>
			<?	
		}
	}
	
	if ($label == "ALL"){
		printBlog($f, $l);
		exit();	
	}
	
	if (isset($_REQUEST['f']) && isset($_REQUEST['l'])){
		printBlog(intval($_REQUEST['f']), intval($_REQUEST['l']));
		exit();	
	}
	
	if ($label){
		printBlog($f, $l);
		exit();	
	}
	
?>	

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="Matthew Zipkin">
		<meta name="author" content="Matthew Zipkin">
		<meta name="format-detection" content="telephone=no">
		<link rel="icon" 
			  type="image/gif" 
			  href="i/star.gif">
		<link rel="apple-touch-icon" 
			  type="image/gif" 
			  href="i/star.gif">

		<title>Matthew Zipkin</title>

		<!-- Bootstrap core CSS -->
		<link href="bootstrap/css/bootstrap.css" rel="stylesheet">

		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>

	<body>
		<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="/"><span class="glyphicon glyphicon-home"></span></a>
				</div>
				<div class="collapse navbar-collapse">
					<ul class="MENU nav navbar-nav">
						<?= ($view == 'audio' ? '<li class="active">' : '<li>') ?><a href="audio.php">Audio</a></li>
						<?= ($view == 'music' ? '<li class="active">' : '<li>') ?><a href="music.php">Music</a></li>
						<?= ($view == 'web' ? '<li class="active">' : '<li>') ?><a href="web.php">Web</a></li>
						<?= ($view == 'fun' ? '<li class="active">' : '<li>') ?><a href="fun.php">Fun!</a></li>
					</ul>
				</div><!--/.nav-collapse -->
			</div>
		</div>
		<a name="top"></a> 

		<!-- Main jumbotron for a primary marketing message or call to action -->
		<div class="jumbotron">
			<div class="container" style="	background-image: url('i/cover.jpg');
											background-repeat: no-repeat;
											background-size: cover;
											background-position: right top;
											color: white;
											height: 400px;
											width: 100%;">
				<h1>Matthew Zipkin</h1>
				<? // <p>Creative technical solutions for talented visionaries.</p> ?>
				<ul class="jumboLinks">
					<li><a href="mailto:Matthew.Zipkin@gmail.com"><span class="glyphicon glyphicon-envelope"></span> Matthew.Zipkin@gmail.com</a></li>
					<li><a href="MatthewZipkin2014.pdf" target="_blank"><span class="glyphicon glyphicon-list-alt"></span> Resume</a></li>
					<li><a href="http://www.linkedin.com/in/matthewzipkin" target="_blank"><img src="i/logos/linked.png" ></a></li>
					<li><a href="https://github.com/pinheadmz" target="_blank"><img src="i/logos/github.jpg" ></a></li>
					<li><a href="http://www.imdb.com/name/nm3116436/" target="_blank"><img src="i/logos/imdb.png" ></a></li>
				</ul>
			</div>
		</div>

		<div class="container" id="blogContainer">