<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <meta name="format-detection" content="telephone=no" />

    <!-- google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;700&display=swap" rel="stylesheet" />

    <!-- css -->
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/main.css" type="text/css" />

    <!-- js -->
    <script src="<?php echo get_template_directory_uri(); ?>/assets/js/main.js" defer></script>
    
    <?php wp_head(); ?>
  </head>

  <body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <!-- header -->
    <header class="header">
      <div class="l-container">
        <div class="header-head-inner">
          <h1 class="header-logo">
            <a href="<?php echo home_url(); ?>">
              <picture>
                <source media="(max-width: 499px)" srcset="<?php echo get_template_directory_uri(); ?>/assets/img/logo-sp.png" />
                <source media="(min-width: 500px)" srcset="<?php echo get_template_directory_uri(); ?>/assets/img/logo.png" />
                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo.png" width="640" height="84" alt="武者への道 Presented by 模写修行" loading="lazy" />
              </picture>
            </a>
          </h1>

          <div class="search-modal-wrap">
            <button class="search-modal-open js-search-modal-open">記事検索</button>

            <div class="modal-bg js-modal-bg"></div>

            <dialog class="search-modal js-search-modal" aria-label="記事検索のモーダル">
              <div class="search-modal-inner">
                <div class="search-modal-contents js-search-modal-contents">
                  <button class="search-modal-close js-search-modal-close">
                    <span class="u-visually-hidden">閉じる</span>
                  </button>
									<label for="search" class="search-label">キーワードを入力</label>
								
                    <form class="search-modal-contents-inner" action="<?php echo home_url('/'); ?>" method="GET">
                      <input type="text" name="s" id="search" class="search-textarea" placeholder="" />
                      <button type="submit" class="search-modal-submit">
                        <span>検索する</span>
                      </button>
                    </form>
									
                </div>
              </div>
            </dialog>

          </div>

          <div class="c-sns">
            <a href="https://www.google.com/" class="c-sns-icon" target="_blank" rel="noopener noreferrer">
              <img src="<?php echo get_template_directory_uri(); ?>/assets/img/icon-sns-twitter.svg" width="400" height="400" alt="twitter" loading="lazy" />
            </a>

            <a href="https://www.google.com/" class="c-sns-icon" target="_blank" rel="noopener noreferrer">
              <img src="<?php echo get_template_directory_uri(); ?>/assets/img/icon-sns-facebook.svg" width="1024" height="1024" alt="facebook" loading="lazy" />
            </a>
          </div>
        </div>
      </div>

      <nav class="header-nav">
        <div class="l-container">
          <ul class="header-list">
            <li class="header-item">
              <a href="<?php echo get_category_link(get_cat_ID('HTML/CSS')); ?>">HTML/CSS</a>
            </li>
            <li class="header-item">
              <a href="<?php echo get_category_link(get_cat_ID('JavaScript')); ?>">JavaScript</a>
            </li>
            <li class="header-item">
              <a href="<?php echo get_category_link(get_cat_ID('WordPress')); ?>">WordPress</a>
            </li>
            <li class="header-item">
              <a href="<?php echo get_category_link(get_cat_ID('webデザイン')); ?>">webデザイン</a>
            </li>
            <li class="header-item">
              <a href="<?php echo get_category_link(get_cat_ID('web制作')); ?>">web制作</a>
            </li>
          </ul>
        </div>
      </nav>
    </header>
    <!-- end header-->