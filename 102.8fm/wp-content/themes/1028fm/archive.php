<?php
/**
 * The template for displaying archive pages
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each one. For example, tag.php (Tag archives),
 * category.php (Category archives), author.php (Author archives), etc.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

get_header(); ?>

	<div id="primary" class="content-area main homepage-content">
    <main id="main" class="site-main main articles-list" role="main">



		<div class="container news-row section">
			<div class="row">
				<div class="col-md-8 offset-md-2 list-news-row">
					<div class="archive-filter">
						<span>Новости за:&nbsp;&nbsp;</span>
						<input type="text" class="datepicker" value="<?php echo date("d.m.Y");?>" readonly="readonly">
						<input type="hidden" name="load_news_from_date" value="0">

                        <?php
						
						?>
						<script>
						init_datepicker();
						</script>
						<?php
						/*
						<div class="filter-select" style="">
							<select>
								<option value="0">День</option>
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
								<option value="5">5</option>
								<option value="6">6</option>
								<option value="7">7</option>
								<option value="8">8</option>
								<option value="9">9</option>
								<option value="10">10</option>
								<option value="11">11</option>
								<option value="12">12</option>
								<option value="13">13</option>
								<option value="14">14</option>
								<option value="15">15</option>
								<option value="16">16</option>
								<option value="17">17</option>
								<option value="18">18</option>
								<option value="19">19</option>
								<option value="20">20</option>
								<option value="21">21</option>
								<option value="22">22</option>
								<option value="23">23</option>
								<option value="24">24</option>
								<option value="25">25</option>
								<option value="26">26</option>
								<option value="27">27</option>
								<option value="28">28</option>
								<option value="29">29</option>
								<option value="30">30</option>
								<option value="31">31</option>
							</select>
						</div>
						<div class="filter-select" style="">
							<select>
								<option value="0">Месяц:</option>
								<option value="1">Январь</option>
								<option value="2">Февраль</option>
								<option value="3">Март</option>
								<option value="4">Апрель</option>
								<option value="5">Май</option>
								<option value="6">Июнь</option>
								<option value="7">Июль</option>
								<option value="8">Август</option>
								<option value="9">Сентябрь</option>
								<option value="10">Октябрь</option>
								<option value="11">Ноябрь</option>
								<option value="12">Декабрь</option>
							</select>
						</div>
						<div class="filter-select" style="">
							<select>
								<option value="0">Год:</option>
								<option value="1">2017</option>
								<option value="2">2018</option>
								<option value="3">2019</option>
							</select>
						</div>
                        */ ?>

					</div>
					
					
					
					<div class="news-list items" id="newsList">

						<?php if ( have_posts() ) : ?>

							

							<?php
							// Start the Loop.
							while ( have_posts() ) : the_post();

								/*
								 * Include the Post-Format-specific template for the content.
								 * If you want to override this in a child theme, then include a file
								 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
								 */
								?>


								<div class="item news-list-item">
									<div class="news-item">
										<div class="name-new"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
										<div class="excerpt"><?php echo kama_excerpt( array('maxchar'=>200, 'text'=>'') ); ?></div>
										<div class="date"><?php echo get_the_date(); ?>, <?php the_time(); ?></div>
									</div>
								</div>

								

								<?php 

							// End the loop.
							endwhile;
							
							
							/*
							// Previous/next page navigation.
							the_posts_pagination( array(
								//'prev_text'          => __( 'Previous page', 'twentysixteen' ),
								//'next_text'          => __( 'Next page', 'twentysixteen' ),
								'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'twentysixteen' ) . ' </span>',
							) );
							*/

						// If no content, include the "No posts found" template.
						else :
							get_template_part( 'template-parts/content', 'none' );

						endif;
						?>
					</div>
					<?php 
					$categories = get_the_category();
					$category_id = $categories[0]->cat_ID;
					?>
					<input type="hidden" name="category_id" value="<?php echo $category_id; ?>">
					<?php echo do_shortcode('[load_more_posts]'); ?>
					<script>var page = 2;</script>
				</div>
			</div>
		</div>

	</main><!-- .site-main -->
	</div><!-- .content-area -->


<?php get_footer(); ?>
