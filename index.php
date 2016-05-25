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
						<li class="active"><a href="javascript:goto('Audio')">Audio</a></li>
						<li><a href="javascript:goto('Music')">Music</a></li>
						<li><a href="javascript:goto('Web')">Web</a></li>
						<li><a href="javascript:goto('Fun')">Fun!</a></li>
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

			<div id="Audio" class="row activePage">
				<h2 style="color:white">Latest audio work:</h2>

				<div id="blogMenu" class="col-md-2">
					<span style="color:white">Filter by category:</span><br>
					<div class="btn-group-vertical" style="width:150px">
						<button type="button" class="btn btn-default filter" onclick="loadLabel('ALL')" style="color:blue">→&nbsp;ALL&nbsp;←</button>
						<button type="button" class="btn btn-default filter" onclick="loadLabel('Best')">THE BEST</button>
						<button type="button" class="btn btn-default filter" onclick="loadLabel('Advertising')">Advertising</button>
						<button type="button" class="btn btn-default filter" onclick="loadLabel('Film')">Film & TV</button>
						<button type="button" class="btn btn-default filter" onclick="loadLabel('Music')">Music</button>
						<button type="button" class="btn btn-default filter" onclick="loadLabel('Sound Design')">Sound Design</button>
						<button type="button" class="btn btn-default filter" onclick="loadLabel('5.1 Surround')">5.1 Surround</button>
					</div>
				</div>

				<div id="blog" class="col-md-8">
					<div id='blogContent'>
						<? printBlog($f, $l); ?>
					</div>
					<button type="button" id="loadMoreButton" class="btn btn-primary" onclick="loadMore()">Load more...</button>
					<a href="#top"><button type="button" id="backToTop" class="btn btn-default" >Back to top</button></a>
				</div>
				
				<div class="col-md-2">
				</div>
				
			</div> <!-- /Audio -->

			<div id="Music" class="inactivePage">
				<h2 style="color:white">Original Music Projects:</h2>
				<div class="row">
					<div class="musicItem col-md-8 blogItem">
						<h3>The New Time</h3>
						<i>Downtempo House / Balearic / Chillout / Trip-Hop / Electronic</i><br>
						<iframe width="100%" height="300" scrolling="no" frameborder="no" src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/users/64015187&amp;color=ff5500&amp;auto_play=false&amp;hide_related=true&amp;show_comments=true&amp;show_user=true&amp;show_reposts=false"></iframe>
					</div>
					<div class="musicItem col-md-8 blogItem">
						<h3>The Illness</h3>
						<i>Progressive Rock / Alternative Metal</i><br>
						<a href="http://SpreadTheIllness.net" target="_blank">http://SpreadTheIllness.net</a><br>
						<iframe width="100%" height="300" scrolling="no" frameborder="no" src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/users/444257&amp;color=ff5500&amp;auto_play=false&amp;hide_related=true&amp;show_comments=true&amp;show_user=true&amp;show_reposts=false"></iframe>
					</div>
					<div class="musicItem col-md-8 blogItem">
						<h3>Melting Butterflies</h3>
						<i>Ambient / Downtempo / IDM / Acid Jazz / Electronic</i><br>
						<iframe width="100%" height="300" scrolling="no" frameborder="no" src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/users/8733123&amp;color=ff5500&amp;auto_play=false&amp;hide_related=true&amp;show_comments=true&amp;show_user=true&amp;show_reposts=false"></iframe>
					</div>
					<div class="musicItem col-md-8 blogItem">
						<h3>The Space Traveling Nostril Hairs</h3>
						<i>Electro Dub Funk</i><br>
						<iframe width="100%" height="300" scrolling="no" frameborder="no" src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/users/8010680&amp;color=ff5500&amp;auto_play=false&amp;hide_related=true&amp;show_comments=true&amp;show_user=true&amp;show_reposts=false"></iframe>
					</div>
					<div class="musicItem col-md-8 blogItem">
						<h3>The Bad Hand</h3>
						<i>Experimental Rock / Psychedelic </i><br>
						<a href="https://itunes.apple.com/us/artist/the-bad-hand/id202719042" target="_blank">View In iTunes</a>
					</div>
					<div class="musicItem col-md-8 blogItem">
						<h3>Precise Device</h3>
						<i>Funk Jam / Hip-Hop / Rock / Jazz</i><br>
						<iframe width="100%" height="300" scrolling="no" frameborder="no" src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/users/8011012&amp;color=ff5500&amp;auto_play=false&amp;hide_related=true&amp;show_comments=true&amp;show_user=true&amp;show_reposts=false"></iframe>
					</div>
				</div> <!-- /row -->
				<div class="row"><a href="#top"><button type="button" id="backToTop" class="btn btn-default" >Back to top</button></a></div>
			</div> <!-- /Music -->

			
			<div id="Web" class="inactivePage">
				<h2 style="color:white">Latest Web Projects:</h2>

				<div class="row">					
					<div class="webItem col-md-3 blogItem">
						<h3>The X Kids</h3>
						<ul>
							<li>Over 300 users in first year</li>
							<li>Registration and Scheduling</li>
							<li>Paypal and Coinbase (Bitcoin) API integration</li>
							<li>Complete "Admin" backend with database control</li>
							<li>Responsive CSS template / JavaScript/ PHP</li>
						</ul>
						<a href="http://TheXKids.org" target="_blank"><img src="i/web/xkids.png"><br><span>http://TheXKids.org</span></a>
					</div>
					
					<div class="webItem col-md-3 blogItem">
						<h3>FunZap!</h3>
						<ul>
							<li>Customizable social game</li>
							<li>Image upload and manipulation with PHP</li>
							<li>Create puzzles and send them to friends</li>
							<li>Javascript puzzle game</li>
						</ul>
						<a href="http://MatthewZipkin.com/funzap" target="_blank"><img src="i/web/funzap.png"><br><span>http://MatthewZipkin.com/funzap</span></a>
					</div>
					
					<div class="webItem col-md-3 blogItem">
						<h3>Chess</h3>
						<ul>
							<li>Javascript Chess game</li>
							<li>Computer player with strategy</li>
							<li>Designed to be educational</li>
							<li>Formatted for iPad</li>
						</ul>
						<a href="http://thexkids.org/games/chess/chess.html" target="_blank"><img src="i/web/chess.png"><br><span>http://thexkids.org/games/chess/chess.html</span></a>
					</div>
				</div> <!-- /row -->
				
				<div class="row">					
					<div class="webItem col-md-3 blogItem">
						<h3>Times-Tables Racing</h3>
						<ul>
							<li>Animated Javascript video game</li>
							<li>Control with mouse, keyboard or tilting iPad</li>
							<li>Fun and educational!</li>
						</ul>
						<a href="http://thexkids.org/games/racing/racing.html" target="_blank"><img src="i/web/racing.png"><br><span>http://thexkids.org/games/racing/racing.html</span></a>
					</div>
					
					<div class="webItem col-md-3 blogItem">
						<h3>Cherushii</h3>
						<ul>
							<li>Music producer homepage</li>
							<li>PHP integrated backend</li>
						</ul>
						<a href="http://Cherushii.com" target="_blank"><img src="i/web/cherushii.png"><br><span>http://Cherushii.com</span></a>
					</div>
					
					<div class="webItem col-md-3 blogItem">
						<h3>The Illness</h3>
						<ul>
							<li>Rock Band Homepage</li>
						</ul>
						<a href="http://SpreadTheIllness.net" target="_blank"><img src="i/web/ill.png"><br><span>http://SpreadTheIllness.net</span></a>
					</div>
				</div> <!-- /row -->
				
				<div class="row">
					<div class="webItem col-md-3 blogItem">
						<h3>CounterCode.club</h3>
						<ul>
							<li>Watch-only wallet for <a href="http://counterparty.co" target="_blank">Counterparty</a> cryptocurrency</li>
							<li>Javascript, Bitcore, PHP server storage backend</li>
							<li>Deterministically build public addresses from master public key</li>
							<li>Responsive Bootstrap template</li>
						</ul>
						<a href="http://CounterCode.club" target="_blank"><img src="i/web/counter.png"><br><span>http://CounterCode.club</span></a>
					</div>
					
					<div class="webItem col-md-3 blogItem">
						<h3>Say Bitcoin</h3>
						
						<ul>
							<li>Convert any Bitcoin base58 string into word-poem mnemonic</li>
						</ul>
						<a href="http://SayBitcoin.com" target="_blank"><img src="i/web/saybtc.png"><br><span>http://SayBitcoin.com</span></a>
					</div>
					
					<div class="webItem col-md-3 blogItem">
						<h3>Matthew Zipkin</h3>
						<ul>
							<li>Personal Website</li>
							<li>PHP building blog from RSS feed</li>
							<li>Responsive Bootstrap template</li>
							<li>Endless recursion!</li>
						</ul>
						<a href="http://MatthewZipkin.com" target="_blank"><img src="i/web/mz.png"><br><span>http://MatthewZipkin.com</span></a>
					</div>
					
				</div> <!-- /row -->
				
				<div class="row">
					<div class="webItem col-md-3 blogItem">
						<h3>Vote For Zipkin</h3>
						<ul>
							<li>Simple one-page view for political promotion</li>
							<li>Custom PHP backend for admin editing</li>
							<li>Accept Paypal and Bitcoin donations</li>
						</ul>
						<a href="http://VoteForZipkin.com" target="_blank"><img src="i/web/chuck.png"><br><span>http://VoteForZipkin.com</span></a>
					</div>
					
					
				</div> <!-- /row -->
				
				
				<div class="row"><a href="#top"><button type="button" id="backToTop" class="btn btn-default" >Back to top</button></a></div>
			</div> <!-- /Web -->

			<div id="Fun" class="inactivePage">
				<h3 style="color:white">
						I make fun, noisy toys! They are analog electronic synthesizers built from those parts they sell in the very back of Radio Shack. 
						I'm inspired by the DIY electronics community and I love making insane little gadgets.
				</h3>
				<a href="http://www.milothemadscientist.blogspot.com/" target="_blank"><h3>Milo The Mad Scientist blog</h3></a><br>
				<div class="row">
					
					<div class="funItem blogItem">
						<a href="http://www.milothemadscientist.blogspot.com/2011/09/9-volt-tesseract.html" target="_blank"><img src="i/toys/toy1.jpg" ></a>
					</div>
					<div class="funItem blogItem">
						<a href="http://www.milothemadscientist.blogspot.com/2009/05/time-bomb.html" target="_blank"><img src="i/toys/toy2.jpg" ></a>
					</div>
					<div class="funItem blogItem">
						<a href="http://www.milothemadscientist.blogspot.com/2009/02/the-penguin.html" target="_blank"><img src="i/toys/toy3.jpg" ></a>
					</div>
					<div class="funItem blogItem">
						<a href="http://www.milothemadscientist.blogspot.com/2008/11/funx-capacitor.html" target="_blank"><img src="i/toys/toy4.jpg" ></a>
					</div>
					<div class="funItem blogItem">
						<a href="http://www.milothemadscientist.blogspot.com/2012/06/idiot-box.html" target="_blank"><img src="i/toys/toy5.jpg" ></a>
					</div>
					<div class="funItem blogItem">
						<a href="http://www.milothemadscientist.blogspot.com/2011/09/9-volt-tesseract.html" target="_blank"><img src="i/toys/toy6.jpg" ></a>
					</div>
					<div class="funItem blogItem">
						<a href="http://www.milothemadscientist.blogspot.com/2011/09/zippy-stardust-radar-laserbeam-goggles.html" target="_blank"><img src="i/toys/toy7.jpg" ></a>
					</div>
					<div class="funItem blogItem">
						<a href="http://www.milothemadscientist.blogspot.com/2008/11/shadow-jar.html" target="_blank"><img src="i/toys/toy8.jpg" ></a>
					</div>
					<div class="funItem blogItem">
						<a href="http://www.milothemadscientist.blogspot.com/2008/12/casio-quellotone.html" target="_blank"><img src="i/toys/toy9.jpg" ></a>
					</div>
				</div>
				<div class="row"><a href="#top"><button type="button" id="backToTop" class="btn btn-default" >Back to top</button></a></div>
			</div> <!-- /Fun -->
			
		</div> <!-- /Container -->

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
			
			$('.MENU li').click(function(){
				$('.active').removeClass('active');
				$(this).addClass('active');
			});
			
			$('.filter').click(function(){
				$('.filter').css('color','black');
				$('.filter').each( function(i, v){
					var old = $(this).html();
					console.log(old);
					old = old.replace('→&nbsp;', '');
					old = old.replace('&nbsp;←', '');
					$(this).html(old);
				});
			
				$(this).html( '&#8594;&nbsp;' + $(this).html() + '&nbsp;&#8592;');
				$(this).css('color', 'blue');
			});
			
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
			
			function goto(page){
				$('.activePage').slideUp().removeClass('activePage');
				$('#' + page).slideDown().addClass('activePage');
			}
			
			$(document).ready(function(){
				var type = window.location.hash.substr(1);
				goto(type);
			});
		</script>
		<script type="text/javascript">

			  var _gaq = _gaq || [];
			  _gaq.push(['_setAccount', 'UA-28095888-1']);
			  _gaq.push(['_trackPageview']);

			  (function() {
				var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
				ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
				var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
			  })();
		</script>
	</body>
</html>
