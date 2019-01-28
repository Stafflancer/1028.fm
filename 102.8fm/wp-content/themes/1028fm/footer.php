<?php
/**
 * The template for displaying the footer
 */
?>

		</div><!-- .site-content -->

		<footer id="colophon" class="site-footer" role="contentinfo">

			<div class="container footer">
				<div class="row">
					<div class="col-md-8 offset-md-2 copyright-text">
						<?php echo get_field('footer_copy_text', 'options'); ?>

						<p class="copyright"><a href="<?php echo get_field('copyright_link', 'options'); ?>" target="_blank"><img src="<?php echo get_field('copyright_image', 'options'); ?>" class="copy-img alignleft " alt="<?php echo get_field('copyright', 'options'); ?>"></a> - <?php echo get_field('copyright', 'options'); ?></p>
					</div>
				</div>
			</div>
			
			
		</footer><!-- .site-footer -->

<?php /*<script src="<?php echo get_template_directory_uri(); ?>/assets/js/jquery.mobile.custom.min.js"></script>*/?>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/main.js"></script>
<?php /*<script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>*/ ?>

<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script type="text/javascript">
    jQuery(document).ready(function(){
		jQuery('.carousel-slide').slick({
		  dots: true,
		  autoplay: true,
		  autoplaySpeed: 4000,
		  infinite: true,
		  speed: 500,
		  slidesToShow: 1,
		  adaptiveHeight: false,
		  arrows: false
		});

		jQuery('.js-slick').slick({
		    autoplay: true,
		    autoplaySpeed: 5000,
		    dots: true,
		    infinite: true,
		    // fade: true,
		    swipeToSlide: true,
		    speed: 1000,
		    arrows: false
		  });
		  
		  jQuery('.js-slick').on('beforeChange', function(event, slick, currentSlide, nextSlide) {
		    jQuery(slick.$slides).removeClass('is-animating');
		  });
		  
		  jQuery('.js-slick').on('afterChange', function(event, slick, currentSlide, nextSlide) {
		    jQuery(slick.$slides.get(currentSlide)).addClass('is-animating');
		  });

		// Works everywhere

		  // Hide/show animation hamburger function
		  jQuery('.navbar-toggler').on('click', function () {

		  // Take this line to first hamburger animations
		      jQuery('.animated-icon').toggleClass('open');

		  });

    });



  </script>

<?php wp_footer(); ?>





</body>
</html>
