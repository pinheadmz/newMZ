<? $view='audio'; require_once('top.php'); ?>

			<div id="audio" class="row activePage">
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
			
<? require_once('bottom.php'); ?>