			
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
