<?php get_header(); ?>
  <main>
     <!-- page-kv -->
     <div class="c-page-kv">
                <div class="l-container">
                    <h1 class="c-title-level1 c-title-level1--center">404 エラー</h1>
                </div>
            </div>
            <!-- end page-kv -->

            <div class="u-ptb">
                <div class="l-container-s">
                    <p class="error-text"><span>申し訳ございません。お探しのページは見つかりませんでした。</span><span>入力したアドレスが間違っているか、ページが移動・削除された可能性があります。</span></p>

                    <div class="error-button">
                        <a href="<?php echo home_url(); ?>" class="c-button c-button--size-medium">トップへ</a>
                    </div>
                </div>
            </div>
  </main>
<?php get_footer(); ?>