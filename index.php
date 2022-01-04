<!doctype html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <?php wp_head(); ?>
</head>

<body <?php body_class('no-js fonts-loading'); ?>>
  <?php wp_body_open(); ?>
  <?php do_action('get_header'); ?>

  <div id="app" class="wrapper" data-barba="wrapper" data-scroll>
    <?php echo \Roots\view(\Roots\app('sage.view'), \Roots\app('sage.data'))->render(); ?>
  </div>

  <div class="shutter shutter--container">
    <div class="shutter__move shutter__move--scroll-locked">
      <div class="shutter__content" data-src="/app/themes/KeleyOnMars/dist/animations/loading.json">
      </div>
    </div>
  </div>

  <div class="lines">
    <span class="lines__date" id="styledDate">
      _GALAXY <span><?php the_time('Y-m-d') . 'T' . the_time('H:i:s'); ?></span>
    </span>
    <?php echo (get_svg('images.svg.dots-round', ['class' => 'lines__doted'])); ?>
    <?php echo (get_svg('images.svg.circle', ['class' => 'lines__circle'])); ?>
    <?php echo (get_svg('images.svg.large-circle', ['class' => 'lines__circle lines__circle--larger'])); ?>
  </div>


  <?php do_action('get_footer'); ?>
  <?php wp_footer(); ?>

  <svg width="300" height="250">

    <!-- definitions -->
    <defs>
      <!-- identify the filter-->
      <filter id="blurFilter">
        <!-- filter processes -->
        <feGaussianBlur in="SourceGraphic" stdDeviation="2" /><!-- stdDeviation is amount of blur -->
      </filter>
    </defs>
  </svg>

  <script>
    // inline loadJS
    function loadJS(e, t) {
      "use strict";
      var n = window.document.getElementsByTagName("script")[0],
        o = window.document.createElement("script");
      return o.src = e, o.async = !0, n.parentNode.insertBefore(o, n), t && "function" == typeof t && (o.onload = t), o
    }
    // then load your JS
    if (sessionStorage.getItem('fonts-loaded')) {
      // fonts cached, add class to document
      document.documentElement.classList.remove('fonts-loading');
    } else {
      // load script with font observing logic
      loadJS("<?php get_theme_file_uri('/dist/scripts/font-css-async.js') ?>");
    }
  </script>
</body>

</html>