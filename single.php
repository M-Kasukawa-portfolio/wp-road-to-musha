<?php get_header(); ?>
    <main class="u-ptb">
      <div class="l-container-s">
        <!-- single-article -->
        <?php if(have_posts()): ?>
          <?php while(have_posts()): the_post(); ?>
          <article id="post-<?php the_ID(); ?>" <?php post_class("single-article"); ?>>
            <div class="c-meta">
              <?php
              $categories = get_the_category();
              if($categories):
              ?>
              <?php foreach($categories as $category): ?>
                <span class="c-label c-label--<?php echo esc_attr(sanitize_html_class($category->slug)); ?>"><?php echo esc_html($category->name); ?></span>
              <?php endforeach; ?>
              <?php endif; ?>
              <time datetime="<?php the_time('Y-m-d'); ?>" class="c-date"><?php the_time('Y/m/d'); ?></time>
            </div>

            <div class="single-title">
              <h1 class="c-title-level1"><?php the_title(); ?></h1>
            </div>
            <?php if(has_post_thumbnail()): ?>
              <div class="single-thumbnail">
                <?php the_post_thumbnail('large'); ?>
              </div>
            <?php endif; ?>
            <div class="single-contents">
              <?php the_content(); ?>
            </div>

            <a href="https://www.google.com/" target="_blank" class="single-banner" rel="noopener noreferrer">
              <picture>
                <source media="(max-width: 767px)" srcset="<?php echo get_template_directory_uri(); ?>/assets/img/banner-sp.png" />
                <source media="(min-width: 768px)" srcset="<?php echo get_template_directory_uri(); ?>/assets/img/banner.png" />
                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/banner.png" width="1520" height="338" alt="模写修行 駆け出しエンジニアのためのコーディング練習教材 詳しくはこちら" />
              </picture>
            </a>
          </article>
        <?php endwhile; ?>
        <?php endif; ?>
        <!-- end single-article -->

        <!-- end single-recommend -->
        <aside class="single-recommend">
          <h2 class="single-recommend-title">おすすめ記事</h2>

          <div class="single-recommend-posts">
            <div class="c-posts c-posts--col2">
              <?php
                $categories = get_the_category(); //記事の取得
                $category = $categories[0];
                $category_id = $category->term_id;
                $current_id = get_the_ID();
                $recommend_post = new WP_Query(array(
                    "cat" => $category_id,
                    'post__not_in' => array($current_id),
                    'orderby' => 'rand',
                    'posts_per_page' => 6
                ));


                if($recommend_post->have_posts()): //記事があるかどうかチェック
                  while($recommend_post->have_posts()): $recommend_post->the_post();
                  ?>
                  <article class="c-post">
                  <div class="c-meta">
                    <?php
                    $current_categories = get_the_category();
                    if($current_categories):
                    ?>
                    <?php foreach($current_categories as $cat): ?>
                     <span class="c-label c-label--<?php echo sanitize_html_class($cat->slug); ?>"><?php echo esc_html($cat->name); ?></span>
                    <?php endforeach; ?>
                    <?php endif; ?>
                    <time datetime="<?php the_time('Y-m-d'); ?>" class="c-date"><?php the_time('Y/m/d'); ?></time>
                  </div>
                  <a href="<?php the_permalink(); ?>" class="c-post-thumbnail">
										<?php the_post_thumbnail('medium'); ?>
									</a>
                  <h3 class="c-post-title">
                  <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                  </h3>
                </article>
                <?php
                endwhile;
                endif;
                ?>
            </div>
          </div>
        </aside>
        <!-- end single-recommend -->
      </div>
    </main>

<?php get_footer(); ?>

