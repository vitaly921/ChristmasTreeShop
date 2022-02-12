<?php get_header( )?>

  <section class="hero">
    <div class="container">
      <h1 class="hero-title"><?php the_field('main_title');?></h1>
      <p class="hero-description"><?php the_field('first_subtitle');?></p>

      <!-- Слайдер с цветами -->
      <div class="swiper-container trees-slider">
        <!-- Обертка слайдов -->
        <div class="swiper-wrapper">
          <!-- Слайды -->

          <?php
            // параметры по умолчанию
            $my_posts = get_posts( array(
              'numberposts' => 7,
              'category_name'    => 'trees',
              'orderby'     => 'date',
              'order'       => 'ASC',
            ) );

            foreach( $my_posts as $post ){
              setup_postdata( $post );
              ?>
              <div class="swiper-slide">
                <img src="<?php the_field('product_image')?>" alt="tree" class="slide-image">
              </div>
              <?php  // формат вывода the_title() ...
            }

            wp_reset_postdata(); // сброс
          ?>   
        </div>

        <!-- Стрелки слайдера -->
        <div class="swiper-button-prev swiper-button-prev-1"></div>
        <div class="swiper-button-next swiper-button-next-1"></div>
      </div>
      <!-- ./swiper-container -->

      <span class="hero-cta"><?php the_field('second_subtitle');?></span>

      <a data-fancybox data-src="#alert" href="javascript:;" class="button">Заказать ёлку</a>
      
    </div>
    <!-- /.container -->
  </section>

  <section class="reviews">
    <div class="container">
      <h2 class="section-title"><?php the_field('feedback_title');?></h2>

      <!-- Слайдер с отзывами -->
      <div class="swiper-container reviews-slider">
        <!-- обертка слайдов -->
        <div class="swiper-wrapper">
          <!-- слайды -->
          <?php
            global $post;

            $myposts = get_posts([ 
              'numberposts' => 5,
              'post_type'   => 'reviews',
            ]);

            if( $myposts ){
              foreach( $myposts as $post ){
                setup_postdata( $post );
                ?>
                <div class="swiper-slide review-slide d-flex flex-column flex-md-row align-items-center">
                  <div class="review-image d-flex align-items-center justify-content-center flex-column">
                    <img src="<?php the_field('review_image');?>" alt="review">
                    <span class="review-name"><?php the_title();?></span>
                    <span class="review-city"><?php the_field('review_city');?></span>
                  </div>
                  <div class="review-text">
                    <p class="review">
                      <?php the_content( );?>
                    </p>
                    <!-- <a href="javascript:;" id="review-1" class="review-link">Посмотреть фотографии ёлки</a> -->
                  </div>
                </div>
                <!-- ./swiper-slide -->
                <?php 
              }
            } else {
              // Постов не найдено
            }

            wp_reset_postdata(); // Сбрасываем $post
          ?>
          
        </div>
        <!-- ./swiper-wrapper -->

        <!-- If we need navigation buttons -->
        <a class="swiper-button-prev swiper-button-prev-2"></a>
        <a class="swiper-button-next swiper-button-next-2"></a>

      </div>
      <!-- ./swiper-container -->

    </div>
    <!-- /.container -->
  </section>

  <section class="advantages">
    <div class="container">
      <div class="row">
        <div class="col-md-4 mb-5 mb-md-0">
          <div class="advantages-wrapper">
            <img src="<?php the_field('first_image_feedback');?>" alt="Доставляем ёлки прямо до дверей квартиры" class="advantages-image">
          </div>
          <!-- /.advantage-wrapper -->
          <h3 class="advantages-title"><?php the_field('text_first_image_feedback');?></h3>
        </div>
        <!-- /.col -->
        <div class="col-md-4 mb-5 mb-md-0">
          <div class="advantages-wrapper">
            <img src="<?php the_field('second_image_feedback');?>" class="advantages-image">
          </div>
          <!-- /.advantages-wrapper -->
          <h3 class="advantages-title"><?php the_field('text_second_image_feedback');?></h3>
        </div>
        <!-- /.col -->
        <div class="col-md-4 mb-5 mb-md-0">
          <div class="advantages-wrapper">
            <img src="<?php the_field('third_image_feedback');?>" alt="Мы являемся первыми на рынке и всегда рады помочь с выбором ёлки" class="advantages-image">
          </div>
          <!-- /.advantages-wrapper -->
          <h3 class="advantages-title"><?php the_field('text_third_image_feedback');?></h3>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container -->
  </section>
  
  <section class="goods">
    <div class="container">
      <h2 class="section-title"><?php the_field('product_title');?></h2>
      <p class="section-description"><?php the_field('product_subtitle');?></p>

      <div class="row">
        <?php
            // параметры по умолчанию
            $my_posts = get_posts( array(
              'numberposts' => 12,
            ) );

            foreach( $my_posts as $post ){
              setup_postdata( $post );
              ?>
              <div class="col-lg-3 col-md-6">
                <form action="<?php echo admin_url('admin-ajax.php');?>" method="post" class="card">
                  <input type="hidden" name="action" value="send_product">
                  <input type="hidden" name="product" value="<?php the_title();?>">
                  <img src="<?php the_field('product_image')?>" alt="toy" class="card-image">
                  <h3 class="card-title"><?php the_title();?></h3>
                  <span class="card-label">Выберите цвет:</span>

                  <div class="colors d-flex align-items-center justify-content-between">
                    <?php $colors = get_field('product_colors');
                    
                      foreach($colors as $key => $color) { 
                        $checked = ($key == 0) ? 'checked' : '';
                        ?>
                        <label class="color-label <?php echo $color['value']; ?>" for="toy-<?php echo $id = $post->ID . "_" .$color['value']; ?>"></label>
                        <input class="color-input" type="radio" name="color" id="toy-<?php  echo $id = $post->ID . "_" .$color['value']; ?>" value="<?php echo $color['label']; ?>" <?php echo $checked; ?>>
                        
                        <?php
                      }
                    ?>
                    
                  </div>
                  <!-- /.colors -->

                  <span class="card-label">Количество:</span>

                  <div class="counter-group d-flex justify-content-center align-items-center">
                    <button class="counter-button counter-button-minus">-</button>
                    <input name="count" type="text" class="counter-input" value="1">
                    <button class="counter-button counter-button-plus">+</button>
                  </div>
                  <!-- /.counter-group -->

                  <button type='submit' class="button card-button">Заказать</button>
                  
                </form>
               <!-- /.card -->
              </div>
              <?php  // формат вывода the_title() ...
            }

            wp_reset_postdata(); // сброс
         ?>

      </div>
      <!-- /.row -->

      <!-- <a href="#" class="more">Все товары</a> -->
      
    </div>
    <!-- /.container -->
  </section>

  <section class="offer">
    <div class="container">
      <h2 class="section-title offer-title">Остались вопросы?</h2>
      <a data-fancybox data-src="#modal" href="javascript:;" class="offer-link">Закажите звонок нашего специалиста!</a>
      <span class="offer-label">или позвоните по телефону</span>
      <a href="<?php the_field('phone');?>" class="offer-phone"><?php the_field('phone');?></a>
    </div>
    <!-- /.container -->
  </section>

  <?php get_footer( )?>