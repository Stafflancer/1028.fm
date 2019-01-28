<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">	
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
	<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

	<?php wp_head(); ?>

    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/bootstrap.min.css" >
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/style.css">
    <link href="<?php echo get_template_directory_uri(); ?>/assets/css/font-awesome.min.css" rel="stylesheet" >
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/slick-style.css">
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>


    <script src="<?php echo get_template_directory_uri(); ?>/assets/js/popper.min.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/assets/js/bootstrap.min.js"></script>


<style>

</style>

</head>

<body <?php body_class(); ?>>

		
		<header id="sticky-header">
			<div class="container header" >
				<div class="row justify-content-between">
					<div class="logo">
						<div class="custom-logo">

							<?php if ( is_front_page() && is_home() ) : ?>
								<p class="site-title">
									<img src="<?php echo get_field('logo', 'options'); ?>" class="logo-img" alt="<?php echo get_field('text_logo', 'options'); ?>">
								</p>
							<?php else : ?>
								<p class="site-title">
									<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
										<img src="<?php echo get_field('logo', 'options'); ?>" class="logo-img" alt="<?php echo get_field('text_logo', 'options'); ?>">
									</a>
								</p>
							<?php endif; ?>
						
						</div>
						<div class="fix-logo">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
								<img src="<?php echo get_field('logo_sticky', 'options'); ?>" class="logo-img" alt="<?php echo get_field('text_logo', 'options'); ?>">
							</a>
						</div>
					</div>
					


					<div class="col-9 col-xs-8 col-sm-8 col-md-8 col-lg-6 navs">
						<div class="player-stream">
						<audio id="music"> <!--  autoplay="autoplay" -->
						  Your browser does not support the audio format.
						</audio> 
						<div id="audio_player" style="">
						
							<marquee behavior="scroll" direction="left">FM 102.8 KRASNOYARSK GLAVNY</marquee>

							<div style="display: none;"><progress id='progress-bar' min='0' max='100' value='0'>0% played</progress></div>
							<button id='btnPlayPause' class='play' title='play' accesskey="P">Play</button>
							<input type="range" id="volume-bar" title="volume" min="0" max="10" step="1" value="10">
							<button id='btnMute' class='mute' title='mute'>Mute</button>	
						
							<div id="song-source" data-track="http://84.22.142.130:8000/arstream"></div>
							
							
						</div>
						</div>

						<?php if ( has_nav_menu( 'primary' ) ) : ?>
							<?php if ( has_nav_menu( 'primary' ) ) : ?>
								<nav class="navbar navbar-expand-xl navbar-dark bg-faded">
								   
								   <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
								     <div class="animated-icon"><span></span><span></span><span></span></div>
								   </button>
								   <div class="collapse navbar-collapse" id="navbarNav">

						
								
								
												<?php
													wp_nav_menu( array(
														'theme_location' => 'primary',
														'menu_class'     => 'primary-menu navbar-nav',
													 ) );
												?>

										
									




									<? /*
								    <ul class="navbar-nav">
								      <li class="nav-item active">
								        <a class="nav-link" href="#">О нас</a>
								      </li>
								      <li class="nav-item">
								        <a class="nav-link" href="#">Реклама</a>
								      </li>
								      <li class="nav-item">
								        <a class="nav-link" href="#">Сетка вещания</a>
								      </li>
								      <li class="nav-item">
								        <a class="nav-link" href="#">Контакты</a>
								      </li>
								    </ul>
								    */ ?>
								    <div class="mobile-contacts">
                                        <?php
                                        if( have_rows('contact_item', 'options') ):
                                            while ( have_rows('contact_item', 'options') ) : the_row();
                                                ?>

                                                <div class="contact-item">
                                                    <a href="tel:<?php echo get_sub_field('contact_phone'); ?>"><?php echo get_sub_field('contact_phone'); ?></a>
                                                    <span><?php echo get_sub_field('contact_title'); ?></span>
                                                </div>

                                            <?php
                                            endwhile;
                                        endif;
                                        ?>

                                    </div>
								    
								    <ul class="socials">								      
									  
									  <?php 
									  $vk = get_field('vk_link', 'options');
									  if(!empty($vk)){ ?>
								      <li class="nav-item vk">
								        <a class="social-link" href="<?php echo get_field('vk_link', 'options'); ?>" target="_blank"><i class="fa fa-vk" aria-hidden="true"></i></a>
								      </li>
								      <?php } ?>
								      
								      <?php 
								      $fb = get_field('facebook_link', 'options');
								      if(!empty($fb)){ ?>
								      <li class="nav-item fb">
								        <a class="social-link" href="<?php echo get_field('facebook_link', 'options'); ?>" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a>
								      </li>
								  	  <?php } ?>

								      <?php
								      $ins = get_field('instagram_link', 'options');
								      if(!empty($ins)){ ?>
								      <li class="nav-item inst">
								        <a class="social-link" href="<?php echo get_field('instagram_link', 'options'); ?>" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a>
								      </li>				      
								      <?php } ?>

								    </ul>

								  </div>
								</nav>	
								<?php endif; ?>
						<?php endif; ?>

					</div>
					<div class="col-sm-6  col-md-3 col-lg-2  contacts">

                        <?php
                            if( have_rows('contact_item', 'options') ):
                                while ( have_rows('contact_item', 'options') ) : the_row();
                                ?>

                                    <div class="contact-item">
                                        <a href="tel:<?php echo get_sub_field('contact_phone'); ?>"><?php echo get_sub_field('contact_phone'); ?></a>
                                        <span><?php echo get_sub_field('contact_title'); ?></span>
                                    </div>

                                <?php
                                endwhile;
                            endif;
                        ?>

					</div>
				</div>
			</div>
		</header>		


		<div id="content" class="site-content">
