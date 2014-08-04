<?
	
	$label = ($_REQUEST['label'] ? $_REQUEST['label'] : '');

	function blogURL($label){
		if ($label && $label != 'ALL')
			return 'http://matthewzipkin.blogspot.com/feeds/posts/default/-/'. $label .'/?alt=rss&max-results=1000';
		else
			return 'http://matthewzipkin.blogspot.com/feeds/posts/default?alt=rss&max-results=1000';
	}
	
	$BLOG = blogURL($label);
	
	$BlogDOM = @simplexml_load_file($BLOG);
	$f = 0;
	$l = 8;
	$inc = 4;
	
	function printBlog($first, $last){
		global $BlogDOM;
		for($i = $first; $i < $last; $i++){
			$item = $BlogDOM->channel->item[$i];
			if (!$item)
				break;
			?>
				<div class="blogItem">
					<h3><?= htmlspecialchars($item->title) ?></h3>
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
	
	if ($_REQUEST['f'] && $_REQUEST['l']){
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
		<link rel="icon" href="favicon.ico">

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
					<a class="navbar-brand" href="#"><span class="glyphicon glyphicon-home"></span></a>
				</div>
				<div class="collapse navbar-collapse">
					<ul class="nav navbar-nav">
						<li class="active"><a href="#">Audio</a></li>
						<li><a href="#music">Music</a></li>
						<li><a href="#web">Web</a></li>
						<li><a href="#fun">Fun!</a></li>
					</ul>
				</div><!--/.nav-collapse -->
			</div>
		</div>

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
			<!-- Example row of columns -->
			<div class="row">
				<h2 style="color:white">Latest audio work:</h2>

				<div class="col-md-2">
					<span style="color:white">Filter by category:</span><br>
					<div class="btn-group-vertical">
						<button type="button" class="btn btn-default" onclick="loadLabel('ALL')">ALL</button>
						<button type="button" class="btn btn-default" onclick="loadLabel('Advertising')">Advertising</button>
						<button type="button" class="btn btn-default" onclick="loadLabel('Film')">Film</button>
						<button type="button" class="btn btn-default" onclick="loadLabel('Music')">Music</button>
						<button type="button" class="btn btn-default" onclick="loadLabel('5.1 Surround')">5.1 Surround</button>
					</div>
				</div>

				<div id="blog" class="col-md-8">
					<div id='blogContent'>
						<? printBlog($f, $l); ?>
					</div>
					<button type="button" id="loadMoreButton" class="btn btn-primary" onclick="loadMore()">Load more...</button>
				</div>
				
				<div class="col-md-2">
				</div>
				
			</div>

			<hr>

			<footer>
				<p>&copy; Matthew Zipkin 2014</p>
			</footer>
		</div> <!-- /container -->


		<!-- Bootstrap core JavaScript
		================================================== -->
		<!-- Placed at the end of the document so the pages load faster -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>
		<script>
			var last = <?= $l ?>;
			var label = <?= ($label ? $label : "''") ?>;
			function loadMore(){
				$('button').attr('disabled', 'disabled');
				$.post("index.php", {f: last, l: last + <?= $inc ?>, label: label}).done( function(data){
					$('#blogContent').append(data);
					$('button').removeAttr('disabled');
					last = last + <?= $inc ?>;
				});
			
			}
			
			function loadLabel(filter){
				$('button').attr('disabled', 'disabled');
				$.post("index.php", {label: filter}).done( function(data){
					$('#blogContent').html(data);
					$('button').removeAttr('disabled');
				});
				label = filter;
				if (filter == 'ALL'){
					label = '';
					last = 8;	
				}
			}
		</script>
	</body>
</html>
