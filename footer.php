<!-- パンくずリスト -->
<?php get_template_part("template-parts/breadcrumb"); ?>
<!-- end パンくずリスト -->

<?php if(!is_page('contact')): ?>    <!--お問い合わせページではctaを表示しない -->
    <!-- cta -->
    <div class="c-cta">
      <div class="l-container-s">
        <div class="c-cta-inner">
          <div class="c-cta-screenshot">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/img-cta-screenshot.png" width="640" height="362" alt="模写修行のPC画面のスクリーンショット" />
          </div>

          <div class="c-cta-body">
            <div class="c-cta-logo">
              <img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo-moshashugyo.png" width="850" height="102" alt="模写修行" />
            </div>
            <p class="c-cta-copy">駆け出しエンジニアのためのコーディング練習教材</p>
            <div class="c-cta-button">
              <a href="https://www.google.com/" class="c-button c-button--size-medium c-button--white" target="_blank" rel="noopener noreferrer">詳しくはこちら</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- end cta -->
<?php endif; ?>

    <!-- footer -->
    <footer class="footer">
      <div class="l-container">
        <div class="footer-inner">
          <div class="footer-site-info">
            <div class="footer-logo">
              <a href="index.html">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo.png" width="640" height="84" alt="武者への道 Presented by 模写修行" />
              </a>
            </div>

            <p class="footer-site-description"><span>武者への道は駆け出しデザイナー・エンジニアを</span><span>応援するメディアです</span></p>

            <div class="footer-sns">
              <div class="c-sns">
                <a href="https://www.google.com/" class="c-sns-icon" target="_blank" rel="noopener noreferrer">
                  <img src="<?php echo get_template_directory_uri(); ?>/assets/img/icon-sns-twitter.svg" width="400" height="400" alt="twitter" />
                </a>

                <a href="https://www.google.com/" class="c-sns-icon" target="_blank" rel="noopener noreferrer">
                  <img src="<?php echo get_template_directory_uri(); ?>/assets/img/icon-sns-facebook.svg" width="1024" height="1024" alt="facebook" />
                </a>
              </div>
            </div>
          </div>

          <nav class="footer-nav">
            <?php
            $args = [
              "menu" => "footer-nav",
              "menu_class" => "footer-nav-list",
              "list_item_class" => "footer-nav-item",
              "container" => false,
            ];
            wp_nav_menu($args);
            ?>
          </nav>
        </div>
        <small class="footer-copyright">&copy; 2024 Road to MUSHA, inc.</small>
      </div>
    </footer>
    <!-- end footer -->
    <?php wp_footer(); ?>
  </body>
</html>