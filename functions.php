<?php
  // правильный способ подключить стили и скрипты темы
add_action( 'wp_enqueue_scripts', 'xmastree_scripts' );
function xmastree_scripts() {
    
    // подключаем файл стилей темы
	wp_enqueue_style( 'style', get_stylesheet_uri() );
	
    // функция get_template_directory_uri() используется, когда файл находится на сайте
    wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap-grid.min.css' );  	
    wp_enqueue_style( 'swiper', '//unpkg.com/swiper/swiper-bundle.min.css' );
	wp_enqueue_style( 'fancybox', '//cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css' );
    wp_enqueue_style( 'main', get_template_directory_uri() . '/css/style.css' );

	// подключаем js файл темы
    wp_enqueue_script( 'swiper', '//unpkg.com/swiper/swiper-bundle.min.js', array(), '1.0', true );
  
    // для подключения своего "jquery" нужно отключить тот, что по-умолчанию.
    wp_deregister_script( 'jquery-core' );
		wp_register_script( 'jquery-core', '//cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js');
    wp_enqueue_script( 'jquery' );

    wp_enqueue_script( 'fancybox', '//cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js', array('jquery'), '1.0', true );	
    wp_enqueue_script( 'script', get_template_directory_uri() .'/js/main.js', array('fancybox'), '1.0', true );
}

add_action( 'init', 'register_post_types' );
function register_post_types(){
	register_post_type( 'reviews', [
		'label'  => null,
		'labels' => [
			'name'               => 'Отзывы', // основное название для типа записи
			'singular_name'      => 'Отзыв', // название для одной записи этого типа
			'add_new'            => 'Добавить отзыв', // для добавления новой записи
			'add_new_item'       => 'Добавление отзыва', // заголовка у вновь создаваемой записи в админ-панели.
			'edit_item'          => 'Редактирование отзыва', // для редактирования типа записи
			'new_item'           => 'Новый отзыв', // текст новой записи
			'view_item'          => 'Смотреть отзыв', // для просмотра записи этого типа.
			'search_items'       => 'Искать отзыв', // для поиска по этим типам записи
			'not_found'          => 'Не найдено', // если в результате поиска ничего не было найдено
			'not_found_in_trash' => 'Не найдено в корзине', // если не было найдено в корзине
			'parent_item_colon'  => '', // для родителей (у древовидных типов)
			'menu_name'          => 'Отзывы', // название меню
		],
		'description'         => '',
		'public'              => true,
		// 'publicly_queryable'  => null, // зависит от public
		// 'exclude_from_search' => null, // зависит от public
		// 'show_ui'             => null, // зависит от public
		// 'show_in_nav_menus'   => null, // зависит от public
		'show_in_menu'        => null, // показывать ли в меню адмнки
		// 'show_in_admin_bar'   => null, // зависит от show_in_menu
		'show_in_rest'        => null, // добавить в REST API. C WP 4.7
		'rest_base'           => null, // $post_type. C WP 4.7
		'menu_position'       => null,
		'menu_icon'           => 'dashicons-format-status',
		//'capability_type'   => 'post',
		//'capabilities'      => 'post', // массив дополнительных прав для этого типа записи
		//'map_meta_cap'      => null, // Ставим true чтобы включить дефолтный обработчик специальных прав
		'hierarchical'        => false,
		'supports'            => [ 'title', 'editor' ], // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
		'taxonomies'          => [],
		'has_archive'         => false,
		'rewrite'             => true,
		'query_var'           => true,
	] );
}

add_theme_support( 'title-tag' );

add_action( 'wp_ajax_send_product', 'send_product' );
add_action( 'wp_ajax_nopriv_send_product', 'send_product' );
// при нажатии кнопки Заказать форма улетает на бэкэнд и обрабатывается здесь
function send_product() {
	$message = '<div class="message"><h2>Заказ оформлен!</h2>';

	$message .= '<h3>' . $_POST['product'] . '</h3>';
	$message .= '<p>Цвет: ' . $_POST['color'] . '</p>';
	$message .= '<p>Количество: ' . $_POST['count'] . '</p>';
	$message .= '<p>При готовности заказа, мы свяжемся с вами!</p></div>';
	echo $message;
	wp_die();

}

add_action( 'wp_ajax_send_phone', 'send_phone' );
add_action( 'wp_ajax_nopriv_send_phone', 'send_phone' );
// при нажатии кнопки Заказать форма улетает на бэкэнд и обрабатывается здесь
function send_phone() {
	$message = '<div class="message"><h2>Спасибо!</h2>';
	$message .= '<p>Очень скоро мы вам перезвоним!</p></div>';
	echo $message;
	wp_die();
}