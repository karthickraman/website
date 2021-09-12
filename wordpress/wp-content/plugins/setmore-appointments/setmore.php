<?php

/*
Plugin Name: Setmore
Plugin URI: https://www.setmore.com/
Description: Setmore Appointments ��� Take customer appointments online for free
Version: 11.6
Author: Setmore Appointments
Author URI: https://www.setmore.com/?utm_source=wordpress%20plugin%20directory&utm_medium=integrations&utm_campaign=wp_plugin_home
License: GPL
*/
/*===========================================
Do the work, create a database field
===========================================*/

/* Runs on plugin deactivation*/
register_deactivation_hook( __FILE__, 'deleteSetmoreConfig' );

function deleteSetmoreConfig() {
	/* Deletes the database field */
  delete_option('setmore_booking_page_url');
  delete_option('languageOption');
}

function register_plugin_settings() {
//register our settings
register_setting( 'register-settings-group', 'setmore_booking_page_url' );
// register_setting( 'register-settings-group', 'setmore_booking_page_text' );
// register_setting( 'register-settings-group', 'buttonOption', $args);
	 $args = array(
            'type' => 'string',
        'description'       => '',
        'show_in_rest' => array(
                'name' => 'languageOption',
            ),
            'default'      => 'English',
            );
register_setting( 'register-settings-group', 'languageOption',$args);
}
/*===========================================
Create an admin menu to me loaded
===========================================*/

if ( is_admin() ){
/* Call the html code */
add_action('admin_menu', 'setmore_admin_menu');

function setmore_admin_menu() {
add_action( 'admin_init', 'register_plugin_settings' );
$page_title = 'Setmore Booking Appointments';
$menu_title = 'Setmore';
$capability = 'manage_options';
$menu_slug  = 'setmoreBookingAppointments';
$function   = 'setmore_extra_menu_info_page';
$icon_url   = get_bloginfo('wpurl').'/wp-content/plugins/setmore-appointments/setmore.png';
$position   = 35;

add_menu_page( $page_title,
$menu_title,
$capability,
$menu_slug,
$function,
$icon_url,
$position );
}
}
/*===========================================
Add all the necessary dependencies
===========================================*/
add_action('init','initialize_setmore');
add_action('init','init_shortCode');
add_action("plugins_loaded", "setmore_widget_init");

function initialize_setmore() {
wp_register_script('jquery',	'https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js');
}

function init_shortCode(){
//added as default button
add_shortcode( 'setmore', 'addIframe_setmore' );
}

function addIframe_setmore(){
$bookingPageUrl = get_option('setmore_booking_page_url');
$bookingButtonName = get_option('setmore_booking_page_text');
$bookingButtonLang = get_option('languageOption');
$url = $bookingPageUrl."?lang=".$bookingButtonLang;
$i = '<p><script id="setmore_script" type="text/javascript" src = "' . esc_url( plugins_url( '/script/setmoreFancyBox.js', __FILE__ ) ) . '"></script><a id="Setmore_button_iframe" style="float:none" href='.$url.'> <img border="none" src="https://storage.googleapis.com/setmore-assets/2.0/Images/Integration/book-now-blue.svg" alt="Book an appointment with Personnel Calendar using SetMore" /></a></p>';
return $i;
}

function setmore_widget_init() {
add_action('widgets_init', 'setmore_widget_load_widgets');
}

function setmore_widget_load_widgets() {
require_once('setmore_widget.php');
register_widget('setmore_widget');
}

/*===========================================
SetMore HTML page
===========================================*/
if( !function_exists("setmore_extra_menu_info_page") )
{
function setmore_extra_menu_info_page(){
	$scriptUrl = get_bloginfo("wpurl");
?>
<head>
<style>
	#submit {display: none;}
</style>
<?php 
      echo '<link rel="stylesheet" href="' . esc_url( plugins_url( '/sm-wordpress.css', __FILE__ ) ) . '">';
		  echo '<link rel="stylesheet" href="https://storage.googleapis.com/front-office/global-styles/v0.3/main.css">';  
         ?>
         </head>
<form method="post" action="options.php">
<?php settings_fields( 'register-settings-group' ); ?>
<?php do_settings_sections( 'register-settings-group' ); ?>
<?php $scriptUrl = get_bloginfo('wpurl'); ?>
<main class="container-mod">
      <header class="main-header">
        <nav class="fx">
          <a href="https://www.setmore.com" target="_blank" rel="noopener">
          <?php echo '<img src="' . esc_url( plugins_url( './setmore-logo.svg', __FILE__ ) ) . '" alt="Setmore logo" class="company-logo">'  ?>
          </a>
          <a class="ml-auto phn-link" href="tel:+1 (800) 749-4920">+1 (800) 749-4920</a>
        </nav>
      </header>
      <!-- Hero -->
      <section id="optionsCreation">
      <input type="hidden" id="setmore_booking_page_url" name="setmore_booking_page_url" value="<?php echo get_option('setmore_booking_page_url')?>" id="setmore_booking_page_url">
      <input type="hidden" id="languageOption" name="languageOption" value="<?php echo get_option('languageOption')  ?>" id="languageOption">
      </section>
      <section id= "connectBlock">
          <section class="hero-wrap" id="connect">
            <article>
              <h1>
                Add appointment booking to any page<span class="dot">.</span>
              </h1>
              <p>Embed a free booking calendar widget on your website and empower visitors to schedule their appointments online.</p>
              <input id="signup" value="Signup" type="button" siteUrl="<?php echo get_bloginfo('wpurl');?>" class="btn-primary" data-aos="fade-up"/>
              
              <input id="login" type="button" value="Login" class="btn-secondary" data-aos="fade-up" siteUrl="<?php echo get_bloginfo('wpurl');?>"/>
          
            </article>
            <figure>
              <picture>
                <source srcset="
                https://storage.googleapis.com/setmore-assets/2.0/Images/Wordpress-Plugin/curly-hair-girl-using-setmore.webp,
                https://storage.googleapis.com/setmore-assets/2.0/Images/Wordpress-Plugin/curly-hair-girl-using-setmore-2x.webp 2x
                  " type="image/webp">
                <source srcset="
                https://storage.googleapis.com/setmore-assets/2.0/Images/Wordpress-Plugin/curly-hair-girl-using-setmore.png,
                https://storage.googleapis.com/setmore-assets/2.0/Images/Wordpress-Plugin/curly-hair-girl-using-setmore-2x.png 2x
                  " type="image/png">
                <img src="https://storage.googleapis.com/setmore-assets/2.0/Images/Wordpress-Plugin/curly-hair-girl-using-setmore.png" 
                    alt="<%=hero_alt%>"/>
              </picture>
            </figure>
          </section>
          <!-- Features-card -->
          <section class="features-wrap">
            <ul class="card-features">
              <li>
                <div>
                  <figure>
                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48"><g fill="none" fill-rule="evenodd"><g><g><g><path d="M0 0H48V48H0z" transform="translate(-164 -1384) translate(140 1360) translate(24 24)"/><g stroke="#556784" stroke-linejoin="round" stroke-width="1.5" transform="translate(-164 -1384) translate(140 1360) translate(24 24) translate(1 1)"><rect width="45" height="39" x=".5" y="6.5" rx="3"/><path d="M0.5 18.5L45.5 18.5"/><path stroke-linecap="round" d="M12.5 11L12.5.5M33.5 11L33.5.5M30.5 26L21.5 38 15.5 32"/></g></g></g></g></g></svg>
                  </figure>
                  <h3>Turn traffic into clients</h3>
                </div>
                <p>
                  Make it simple for your customers and online visitors to self-book their appointments 24/7, right from your business website.
                </p>
              </li>
              <li>
                <div>
                  <figure>
                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48"><g fill="none" fill-rule="evenodd"><g><g><g><g><path d="M0 0H48V48H0z" transform="translate(-564 -1384) translate(140 1360) translate(400) translate(24 24)"/><g stroke="#556784" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" transform="translate(-564 -1384) translate(140 1360) translate(400) translate(24 24) translate(1 1)"><rect width="8" height="16" y="28" rx="1"/><path d="M8 41.126c21 7 14 7 38-5-1.381-1.86-3.778-2.66-6-2l-8.634 2.734"/><path d="M8 30h6c4.706 0 8 4 9 4h7c2 0 2 4 0 4H19M34.142 21.8c-1.01-1.01-1.405-2.484-1.035-3.864.37-1.381 1.448-2.46 2.829-2.83 1.38-.37 2.853.025 3.864 1.036.39.388.696.853.896 1.366.123.315.397.546.727.615.331.07.674-.034.913-.273l3.122-3.122c.78-.781.78-2.047 0-2.828l-3.2-3.2c1.872-.507 3.11-2.283 2.939-4.215-.172-1.932-1.705-3.462-3.637-3.63-1.932-.17-3.706 1.072-4.21 2.945L34.15.6c-.781-.78-2.047-.78-2.828 0l-2.9 2.898c-.213.212-.318.51-.288.808.03.299.193.568.444.734 1.352.896 2.029 2.519 1.714 4.11-.314 1.59-1.558 2.834-3.148 3.148-1.591.315-3.214-.362-4.11-1.714-.166-.25-.435-.414-.734-.444-.299-.03-.596.075-.808.288l-2.906 2.886c-.78.781-.78 2.047 0 2.828L29.9 27.456c.781.78 2.047.78 2.828 0l3.122-3.124c.239-.239.34-.581.272-.911-.07-.33-.3-.604-.614-.727-.513-.2-.978-.504-1.366-.894h0z"/></g></g></g></g></g></g></svg>
                  </figure>
                  <h3>No complex coding </h3>
                </div>
                <p>
                  Add a short snippet of code to any webpage or drag a widget to your sidebar and footer. It’s that simple to add your booking widget. <a target="_blank" href="https://support.setmore.com/en/articles/491016-add-the-book-appointment-button-to-your-website?utm_source=wordpress%20plugin%20internal&utm_medium=integrations&utm_campaign=wp_plugin_internal_learnmore" class="text-brandcolor">Learn more</a>
                </p>
              </li>
              <li>
                <div class="icon-title-wrap">
                  <figure>
                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48"><g fill="none" fill-rule="evenodd"><g><g><g><g><path d="M0 0H48V48H0z" transform="translate(-964 -1384) translate(140 1360) translate(800) translate(24 24)"/><g stroke="#556784" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"><path d="M8 18H2c-1.105 0-2-.895-2-2V2C0 .895.895 0 2 0h42c1.105 0 2 .895 2 2v14c0 1.105-.895 2-2 2H22" transform="translate(-964 -1384) translate(140 1360) translate(800) translate(24 24) translate(1 7)"/><path d="M41 5L33 13 29 9M27 40l2.94-12.742c.04-.172.06-.348.06-.524-.002-.996-.638-1.88-1.582-2.2L18 21V9c0-1.657-1.343-3-3-3s-3 1.343-3 3v19.386s-1.258-1.632-2.53-3.2C8.868 24.438 7.96 24.002 7 24H6c-.83 0-1.599.442-2.018 1.159-.42.717-.427 1.603-.02 2.327L11 40" transform="translate(-964 -1384) translate(140 1360) translate(800) translate(24 24) translate(1 7)"/></g></g></g></g></g></g></svg>
                  </figure>
                  <h3>Easy personalization</h3>
                </div>
                <p>
                  Modify how your booking button behaves on your site. Link users to your full Booking Page or to schedule individual services in a snap.
                </p>
              </li>
            </ul>
          </section>
      </section>
      <section id="third">
          <section>
            <h1 class="title-2">
              <strong> Let&apos;s get you more bookings! </strong>
            </h1>
            <div class="options-wrap fx">
              <div class="g-input-wrapper sm-url-holder mr-5" style="max-width: 450px">
                <label class="g-input-label">Booking Page URL</label>
                <div class="g-link">
              <div class="sm-url-wrap mr-2">
                <div class="sm-url-edit text-truncate" id="edit_booking_page_url" style="display:none">
                  <input id="text_booking_page_url" type="text" style="width: 450px" value="<?php echo get_option('setmore_booking_page_url')  ?>" />
                </div>
                <a class="sm-url text-truncate" id="booking_page_url" target="_blank" href="<?php echo get_option('setmore_booking_page_url')  ?>">
                <?php echo get_option('setmore_booking_page_url')  ?></a>
              </div>
              <i class="mr-1 g-data-tips copy_setmorewp_url" data-tips="Copy"
                ><svg
                  xmlns="http://www.w3.org/2000/svg"
                  width="12"
                  height="12"
                  viewBox="0 0 12 12"
                  fill="none"
                  class="centerer"
                >
                  <path
                    fill-rule="evenodd"
                    clip-rule="evenodd"
                    d="M8.0998 1.44472C8.04745 0.638063 7.37659 0 6.5567 0H1.54639L1.44472 0.00328929C0.638063 0.0556462 0 0.726505 0 1.54639V6.5567L0.00328929 6.65838C0.0556462 7.46503 0.726505 8.10309 1.54639 8.10309H2.10309L2.16185 8.09914C2.37319 8.07047 2.53608 7.88931 2.53608 7.6701C2.53608 7.43097 2.34223 7.23711 2.10309 7.23711H1.54639L1.47225 7.23312C1.13135 7.19618 0.865979 6.90743 0.865979 6.5567V1.54639L0.869972 1.47225C0.906913 1.13135 1.19566 0.865979 1.54639 0.865979H6.5567L6.63084 0.869972C6.97175 0.906913 7.23711 1.19566 7.23711 1.54639V2.10309L7.24107 2.16185C7.26974 2.37319 7.4509 2.53608 7.6701 2.53608C7.90924 2.53608 8.10309 2.34223 8.10309 2.10309V1.54639L8.0998 1.44472ZM10.3298 3.89687H5.5669C4.64452 3.89687 3.89679 4.64461 3.89679 5.56698V10.3299C3.89679 11.2522 4.64452 12 5.5669 12H10.3298C11.2522 12 11.9999 11.2522 11.9999 10.3299V5.56698C11.9999 4.64461 11.2522 3.89687 10.3298 3.89687ZM5.56694 4.76282H10.3298C10.7739 4.76282 11.134 5.12284 11.134 5.56694V10.3298C11.134 10.7739 10.7739 11.134 10.3298 11.134H5.56694C5.12284 11.134 4.76282 10.7739 4.76282 10.3298V5.56694C4.76282 5.12284 5.12284 4.76282 5.56694 4.76282Z"
                    fill="#181818"
                  /></svg></i>
              <i class="g-data-tips" id= "edit_option" data-tips="Edit">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  width="12"
                  height="12"
                  viewBox="0 0 12 12"
                  fill="none"
                  class="centerer"
                >
                  <path
                    fill-rule="evenodd"
                    clip-rule="evenodd"
                    d="M8.14338 0.677728C8.56331 0.248113 9.13751 0.00411871 9.73827 0L9.87652 0.00331365C10.4271 0.0334403 10.9494 0.264887 11.3435 0.657343C11.7676 1.08291 12.0039 1.66036 11.9999 2.26122C11.9958 2.862 11.7517 3.43619 11.3257 3.85218L4.19132 10.9866C4.19028 10.9877 4.18923 10.9887 4.18817 10.9898C4.18677 10.9912 4.18536 10.9926 4.18393 10.994C4.12594 11.0515 4.05366 11.0925 3.97454 11.1128L0.574239 11.9849C0.235783 12.0717 -0.0719246 11.764 0.0148368 11.4256L0.886456 8.02525C0.90691 7.94546 0.948432 7.87263 1.00668 7.81439L8.14338 0.677728ZM3.86251 10.0153L10.1465 3.73163L8.268 1.85313L1.98205 8.13809L3.86251 10.0153ZM1.57718 9.03277L2.96861 10.4218L1.09806 10.9012L1.57718 9.03277ZM9.74466 0.919097L9.62688 0.925273C9.37075 0.949805 9.12723 1.04818 8.92424 1.20939L10.7906 3.07577C10.9512 2.87424 11.0502 2.62998 11.0748 2.3728L11.0808 2.25504C11.0832 1.8996 10.9434 1.55798 10.6938 1.30749C10.4419 1.05665 10.1002 0.916867 9.74466 0.919097Z"
                    fill="#181818"
                  />
                </svg>
              </i>
            </div>
      
                <div class="g-input-msg">
                  <span>Message goes here</span>
                </div>
              </div>
              <div class="g-dropdown-wrap mr-5" style="max-width: 260px">
              <?php $setmore_booking_page_language = empty( get_option('languageOption') ) ? "English" : get_option('languageOption'); ?>
                <label class="g-drop-label">Booking Page Language</label>
                <button class="g-drop-btn">
                  <span><?php echo $setmore_booking_page_language?></span>
                  <i class="g-drop-arrow"></i>
                </button>
                <div class="g-drop-msg">
                  <span>Error</span>
                </div>
                <div class="g-dropmenu">
                  <ul class="dropDonwList">
                    <li class="selected">
                      <span>English</span>
                    </li>
                    <li>Arabic</li>
                    <li>Bulgarian</li>
                    <li>Czech</li>
                    <li>Croatia</li>
                    <li>Danish</li>
                    <li>Dutch</li>
                    <li>Estonian</li>
                    <li>French</li>
                    <li>Finnish</li>
                    <li>German</li>
                    <li>Greek</li>
                    <li>Hebrew</li>
                    <li>Hungarian</li>
                    <li>Italian</li>
                    <li>Icelandic</li>
                    <li>Japanese</li>
                    <li>Korean</li>
                    <li>Latin</li>
                    <li>Latvian</li>
                    <li>Lithuanian</li>
                    <li>Norwegian</li>
                    <li>Polish</li>
                    <li>Portuguese</li>
                    <li>Romanian</li>
                    <li>Russian</li>
                    <li>Serbian</li>
                    <li>Slovenian</li>
                    <li>Spanish</li>
                    <li>Swedish</li>
                    <li>Turkish</li>
                    <li>Ukrainian</li>
                  </ul>
                </div>
              </div>
              <div class="g-input-wrapper" style="max-width: 255px">
                <label class="g-input-label"
                  >Customize booking experience and more</label
                >

                <div class="g-link">
                  <a href="https://my.setmore.com" target="_blank">Open your Setmore dashboard</a>
                  <i class="g-data-tips copy_setmorewp_url" data-tips="Copy">
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      width="12"
                      height="12"
                      viewBox="0 0 12 12"
                      fill="none"
                      class="centerer"
                    >
                      <path
                        fill-rule="evenodd"
                        clip-rule="evenodd"
                        d="M8.0998 1.44472C8.04745 0.638063 7.37659 0 6.5567 0H1.54639L1.44472 0.00328929C0.638063 0.0556462 0 0.726505 0 1.54639V6.5567L0.00328929 6.65838C0.0556462 7.46503 0.726505 8.10309 1.54639 8.10309H2.10309L2.16185 8.09914C2.37319 8.07047 2.53608 7.88931 2.53608 7.6701C2.53608 7.43097 2.34223 7.23711 2.10309 7.23711H1.54639L1.47225 7.23312C1.13135 7.19618 0.865979 6.90743 0.865979 6.5567V1.54639L0.869972 1.47225C0.906913 1.13135 1.19566 0.865979 1.54639 0.865979H6.5567L6.63084 0.869972C6.97175 0.906913 7.23711 1.19566 7.23711 1.54639V2.10309L7.24107 2.16185C7.26974 2.37319 7.4509 2.53608 7.6701 2.53608C7.90924 2.53608 8.10309 2.34223 8.10309 2.10309V1.54639L8.0998 1.44472ZM10.3298 3.89687H5.5669C4.64452 3.89687 3.89679 4.64461 3.89679 5.56698V10.3299C3.89679 11.2522 4.64452 12 5.5669 12H10.3298C11.2522 12 11.9999 11.2522 11.9999 10.3299V5.56698C11.9999 4.64461 11.2522 3.89687 10.3298 3.89687ZM5.56694 4.76282H10.3298C10.7739 4.76282 11.134 5.12284 11.134 5.56694V10.3298C11.134 10.7739 10.7739 11.134 10.3298 11.134H5.56694C5.12284 11.134 4.76282 10.7739 4.76282 10.3298V5.56694C4.76282 5.12284 5.12284 4.76282 5.56694 4.76282Z"
                        fill="#181818"
                      ></path>
                    </svg>
                  </i>
                </div>
              </div>
            </div>
          </section>
          <!-- How to -->
          <section>
            <h2 class="title-2 mb-5">3 easy ways to add your Booking Button</h2>
            <ul class="card-wrap col-3 fx">
              <li>
                <figure>
                <?php echo '<img src="' . esc_url( plugins_url( './simple-text-snippet.svg', __FILE__ ) ) . '" alt="" />';  ?>
                </figure>
                <h4>Use a simple text snippet</h4>
                <p class="sub-desc">
                  Type <strong>[setmore]</strong> wherever you want to place your
                  Booking Button on your new post or webpage. Done.
                </p>
              </li>
              <li>
                <figure>
                <?php echo '<img src="' . esc_url( plugins_url( './widget-option.svg', __FILE__ ) ) . '" alt="" />';  ?>
                </figure>
                <h4>Use Add Widget option</h4>
                <p class="sub-desc">
                  Go to <strong>Dashboard &gt; Appearance &gt; Widgets</strong>,
                  find Setmore Widget, choose desired destination from the list
                  below, and click <strong>Add widget</strong>. Done.
                </p>
              </li>
              <li>
                <figure>
                <?php echo '<img src="' . esc_url( plugins_url( './drag-drop-option.svg', __FILE__ ) ) . '" alt="" />';  ?>
                </figure>
                <h4>Use drag & drop option</h4>
                <p class="sub-desc">
                  Go to <strong> Dashboard &gt; Appearance &gt; Widgets </strong>,
                  find Setmore Widget, drag & drop it on any component listed on the
                  left side of the widgets list. Done.
                </p>
              </li>
            </ul>
          </section>
          <!-- FAQ -->
          <section>
            <h2 class="title-2">Frequently Asked Questions</h2>
            <ul class="faq-wrap col-2">
              <li>
                <input type="radio" name="faq" id="faq1" />
                <label class="fx" for="faq1">
                  <strong>What is Setmore?</strong>
                </label>
                <div class="faq-ans">
                  Once you add your Setmore account details to the form fields
                  above, use the Widget menu to add the Setmore widget anywhere on
                  your site.
                </div>
              </li>
              <li>
                <input type="radio" name="faq" id="faq2" />
                <label class="fx" for="faq2">
                  <strong>How does the widget work?</strong>
                </label>
                <div class="faq-ans">
                  Once you add your Setmore account details below, use the Widget
                  menu to add the Setmore widget anywhere on your site.
                </div>
              </li>

              <li>
                <input type="radio" name="faq" id="faq3" />
                <label class="fx" for="faq3">
                  <strong>Where can I find my Booking Page URL?</strong>
                </label>
                <div class="faq-ans">
                  Log into the Setmore web app at www.setmore.com and navigate to
                  Settings > Booking Page.
                </div>
              </li>
              <li>
                <input type="radio" name="faq" id="faq4" />
                <label class="fx" for="faq4">
                  <strong>How do I make changes to the Booking Page?</strong>
                </label>
                <div class="faq-ans">
                  Log into the Setmore web app at www.setmore.com. You can update
                  services, staff, availability, and appearance under Settings.
                </div>
              </li>
              <li>
                <input type="radio" name="faq" id="faq5" />
                <label class="fx" for="faq5">
                  <strong>Does Setmore send reminders?</strong>
                </label>
                <div class="faq-ans">
                  Yes. Setmore sends automatic email confirmations for new or
                  rescheduled appointments, as well as email reminders, and text
                  reminders for users with Setmore Premium.
                </div>
              </li>
              <li>
                <input type="radio" name="faq" id="faq6" />
                <label class="fx" for="faq6">
                  <strong>Does Setmore support payments?</strong>
                </label>
                <div class="faq-ans">
                  Yes. Use your Square account with the free version of Setmore, or
                  Upgrade to Setmore Premium to integrate your Stripe account.
                </div>
              </li>
              <li>
                <input type="radio" name="faq" id="faq7" />
                <label class="fx" for="faq7">
                  <strong>Can I see appointments from my phone?</strong>
                </label>
                <div class="faq-ans">
                  Download the Setmore mobile app to access your appointments and
                  book on the go. Search for Setmore in Google Play or the App
                  Store.
                </div>
              </li>
              <li>
                <input type="radio" name="faq" id="faq8" />
                <label class="fx" for="faq8">
                  <strong>Does Setmore offer any upgrades?</strong>
                </label>
                <div class="faq-ans">
                  Once you add your Setmore account details to the form fields
                  above, use the Widget menu to add the Setmore widget anywhere on
                  your site.
                </div>
              </li>
            </ul>
          </section>
      </section>
      <footer class="main-footer fx mb-5">
        <span
          ><a target="_blank" href="https://support.setmore.com/en/articles/491016-add-the-book-appointment-button-to-your-website?utm_source=wordpress%20plugin%20internal&utm_medium=integrations&utm_campaign=wp_plugin_internal_learnmore">Learn more</a> about Setmore appointment booking app</span
        >
        <span class="ml-auto">
          Need more help? Check out <a target="_blank" href="https://support.setmore.com/en/articles/490966-wordpress?utm_source=wordpress%20plugin%20internal&utm_medium=integrations&utm_campaign=wp_plugin_internal_supportcenter">Setmore&apos;s Support Center</a>
        </span>
      </footer>
    </main>
    <?php submit_button(); ?>
</form>
<br/>
<script id="setmore_script" type="text/javascript" src="<?php echo$scriptUrl ?>/wp-content/plugins/setmore-appointments/script/setmoreFormScript.js"></script>
<?php
}
} ?>
