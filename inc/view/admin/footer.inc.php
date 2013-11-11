
            </div>
        </div>
    </div>


    <!-- script blocks -->
    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/purl.js"></script>

    <script src="../js/app/fn_helper.js"></script>

	<!-- user script -->
    <script>
	    $(document).ready(function() {

	        /* admin nav menu toggle active */
	        var cUriFname = $.url().attr('file');
	        $('.admin_nav li').each(function() {
	            if ($(this).children('a').attr('href').indexOf(cUriFname.split('-')[0]) == 0) {
	                $(this).addClass('active');
	                return;
	            }
	        });

	    });
	</script>