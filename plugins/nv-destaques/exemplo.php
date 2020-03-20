<?php 
  $Postquery = array( 
  'posts_per_page' => 5,
  'post_status' => array('publish'),
  'post_type' => 'post',
  'meta_query' => array(
    array(
      'key' => 'destaque',
      'value' => true,
      'compare' => 'NOT EXISTS',
      )
    )
  );
  $Postquery = new WP_Query($Postquery);
?>
  <?php if($Postquery->have_posts()): ?>
  <?php while ($Postquery->have_posts()): $Postquery->the_post(); ?>
  <div class="pure-u-1 pure-u-md-3-6 pure-u-lg-2-6">
    <div class="destaque-home">
      <div class="pure-g">
        <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'destaque-m' ); ?>
        <div class="pure-u-1 pure-u-md-1 pure-u-lg-1">
          <a href="<?php the_permalink() ?>">
            <img src="<?php echo $image[0]; ?>" alt="">
          </a>
        </div>
        <div class="pure-u-2-6 pure-u-md-2-6 pure-u-lg-2-6">
          <span class="cat-destaque">
            <?php the_category(); ?>
          </span>
        </div>
        <div class="pure-u-4-6 pure-u-md-4-6 pure-u-lg-4-6">
          <div class="data">Publicada em: <?php the_time('j \d\e F \d\e Y') ?></div>
        </div>
        <div class="pure-u-1 pure-u-md-1 pure-u-lg-1">
          <div class="titulo"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></div>
        </div>
      </div>
    </div>
  </div>
<?php endwhile; else:?>
<?php endif;?>