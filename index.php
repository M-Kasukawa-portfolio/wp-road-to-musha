<?php get_header(); ?>
    <main>
			<!-- top-kv -->
			<!-- トップページのKV（日付アーカイブも同じ） -->
			<?php if(is_home()): ?>
				<?php
						// おすすめ記事を取得するクエリ
						$recommend_post = new WP_Query(array(
							'post_type' => 'post',
							'posts_per_page' => 1,
							'meta_query' => array(
								array(
									'key' => 'recommend_post',
									'value' => '1',
									'compare' => '=',
								),
							),
						));
				if($recommend_post->have_posts()):
				?>
				<div class="top-kv">
					<div class="l-container">
						<div class="top-kv-inner">
							<?php while($recommend_post->have_posts()): $recommend_post->the_post();?>
								<article class="top-kv-recommend">
									<a href="<?php the_permalink(); ?>" class="top-kv-recommend-link">
										<div class="top-kv-recommend-thumbnail">
												<?php the_post_thumbnail('medium'); ?>
										</div>
										<div class="top-kv-recommend-body">
											<?php
											$categories = get_the_category();
											if($categories):
											?>
												<?php foreach($categories as $category): ?>
													<span class="c-label c-label--<?php echo esc_attr(sanitize_html_class($category->slug)); ?>"><?php echo esc_html($category->name); ?></span>
												<?php endforeach; ?>
											<?php endif; ?>
											<h2 class="top-kv-recommend-title"><?php the_title(); ?></h2>
											<div class="top-kv-recommend-date">
												<time datetime="<?php the_time('Y-m-d'); ?>" class="c-date"><?php the_time('Y/m/d'); ?></time>
											</div>
										</div>
									</a>
								</article>
							<?php endwhile; ?>
							<div class="top-kv-character">
								<img src="<?php echo get_template_directory_uri(); ?>/assets/img/img-kv-character.png" width="400" height="569" alt="おすすめの記事" />
							</div>
						</div>
					</div>

					<div class="top-kv-treat">
						<img src="<?php echo get_template_directory_uri(); ?>/assets/img/img-kv-treat.png" width="500" height="172" alt="" />
					</div>
				</div>
				<?php endif; ?>

			<!-- 『日付』の記事一覧 -->
			<?php elseif(is_date()): ?>
			<div class="c-page-kv">
				<div class="l-container">
					<h1 class="c-title-level1">『<?php the_time('Y/m/d'); ?>』の記事一覧</h1>
				</div>
			</div>

			<!-- 『カテゴリー』の記事一覧 -->
			<?php elseif(is_category()): ?>
			<div class="c-page-kv">
				<div class="l-container">
					<h1 class="c-title-level1">『<?php single_cat_title(); ?>』の記事一覧</h1>
				</div>
			</div>

			<!-- 『検索キーワード』の検索結果 -->
			<?php elseif(is_search()): ?>
				<div class="c-page-kv">
          <div class="l-container">
					<?php if(empty(get_search_query())): ?>
                <h1 class="c-title-level1">検索結果</h1>
            <?php else: ?>
							<h1 class="c-title-level1">『<?php echo esc_html(get_search_query()); ?>』の検索結果</h1>
            <?php endif; ?>
          </div>
        </div>
			<?php endif; ?>
      <!-- end top-kv -->


      <div class="u-ptb">
        <div class="l-container">
          <!-- posts -->
					<?php if(have_posts()): ?>
          	<div class="c-posts c-posts--col3">
							<?php while(have_posts()): the_post(); ?>
								<article id="post-<?php the_ID(); ?>" <?php post_class("c-post"); ?>>
									<div class="c-meta">
									<?php
									$categories = get_the_category();
									if($categories):
									?>
										<?php foreach($categories as $category): ?>
											<span class="c-label c-label--<?php echo sanitize_html_class($category->slug); ?>"><?php echo esc_html($category->name); ?></span>
										<?php endforeach; ?>
										<?php endif; ?>
										<time datetime="<?php the_time('Y-m-d'); ?>" class="c-date"><?php the_time('Y/m/d'); ?></time>
									</div>
									<a href="<?php the_permalink(); ?>" class="c-post-thumbnail">
										<?php the_post_thumbnail('medium'); ?>
									</a>
									<h2 class="c-post-title">
										<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
									</h2>
								</article>
							<?php endwhile; ?>
						</div>
					<?php else: ?>
						<?php if(is_search() && !empty(get_search_query())): ?>
							<p>『<?php echo esc_html(get_search_query()); ?>』の検索結果が見つかりませんでした。</p>
						<?php endif; ?>
					<?php endif; ?>
          
          <!-- end posts -->

          <!-- pagination -->
     			<!-- pagination -->
					<?php if(function_exists('wp_pagenavi')): ?>
							<?php wp_pagenavi(); ?>
					<?php endif; ?>
          <!-- end pagination -->
        </div>
      </div>
    </main>

		<?php get_footer(); ?>

