<?php
if ( !defined( 'ABSPATH' ) ) die;
class setmore_widget extends WP_Widget {

function __construct() {
$widget_ops = array( 'classname' => 'widget_setmore_widget', 'description' => __( 'setmore 		Booking Widget', 'setmore_widget' ) );
parent::__construct( 'setmore_widget', __( 'Setmore Widget', 'setmore_widget' ), $widget_ops );
}

/**
* Output
*
* @param array $args
* @param array $instance
*/
public function widget( $args, $instance ) {
?>
<?php $bookingPageUrl = get_option('setmore_booking_page_url');
$bookingButtonLang = empty( $instance['languageOption'] ) ? get_option('languageOption') : $instance['languageOption'];
$url = $bookingPageUrl."?lang=".$bookingButtonLang ;
$baseUrl = get_bloginfo('wpurl');
?>

<p>
<script id="setmore_script" type="text/javascript" src="<?php echo $baseUrl ?>/wp-content/plugins/setmore-appointments/script/setmoreFancyBox.js"></script>
<a id="Setmore_button_iframe" style="float:none" href="<?php echo $url ?>"><img border="none" src="https://storage.googleapis.com/setmore-assets/2.0/Images/Integration/book-now-blue.svg" alt="Book an appointment with Personnel Calendar using SetMore" /></a>
</p>

<?php
}


/**
* Outputs the options form on admin
*
* @param array $instance The widget options
*/
public function form( $instance ) {
extract($instance);
$defaults  = array(
'setmore_booking_page_text' => get_option('setmore_booking_page_text'),
'buttonOption'     => 'default',
'languageOption'      => 'English',
);
$instance  = wp_parse_args( (array)$instance, $defaults );
$setmore_booking_page_text = empty( $instance['setmore_booking_page_text'] ) ? $defaults['setmore_booking_page_text'] : $instance['setmore_booking_page_text'];
?>
<!-- setmore_booking_page_text -->
<!--
<p>
<label for="<?php echo $this->get_field_id( 'setmore_booking_page_text' ); ?>">
<?php _e( 'Setmore Booking Button Text', 'setmore' ); ?>:
</label>
<input id="<?php echo $this->get_field_id( 'setmore_booking_page_text' ); ?>" type="text" class="text widefat"
name="<?php echo $this->get_field_name( 'setmore_booking_page_text' ); ?>"
value="<?php echo $instance['setmore_booking_page_text']; ?>" placeholder="<?php echo $defaults['setmore_booking_page_text']; ?>">
</p> -->
<!-- Widget style -->
<!-- <p>
<label for="<?php echo $this->get_field_id( 'buttonOption' ); ?>">
<?php _e( 'buttonStyle', 'setmore' ); ?>: <em><?php _e( '(optional)', 'setmore' ); ?></em>
</label><br>
<input type="radio" name="<?php echo $this->get_field_name( 'buttonOption' ) ?>" value="default" <?php checked( 'default',$instance['buttonOption']) ?>>default Button<br>
<input type="radio" name="<?php echo $this->get_field_name( 'buttonOption' ); ?>" value="custom" <?php checked( 'custom',  $instance['buttonOption'] ) ?>>customised Button<br>
</p> -->
<!-- Widget deafult -->
<p>
<label for="<?php echo $this->get_field_id( 'languageOption' ); ?>">
<?php _e( 'language', 'setmore' ); ?>: <em><?php _e( '(optional)', 'setmore' ); ?></em>
</label>
<select id="<?php echo $this->get_field_id( 'languageOption' ); ?>" class="text widefat" name="<?php echo $this->get_field_name( 'languageOption' ); ?>">
<option value="Arabic" <?php selected( 'Arabic', $instance['languageOption'] ); ?> 						>Arabic</option>
<option value="Bulgarian" <?php selected( 'Bulgarian', $instance['languageOption'] ); ?> 						>Bulgarian</option>
<option value="Czech"  <?php selected( 'Czech', $instance['languageOption'] ); ?>>Czech</option>
<option value="Croatia" <?php selected( 'Croatia', $instance['languageOption'] ); ?> 						>Croatia</option>
<option value="Danish" <?php selected( 'Danish', $instance['languageOption'] ); ?> 						>Danish</option>
<option value = "Dutch"  <?php selected( 'Dutch', $instance['languageOption'] ); ?>>Dutch</option>
<option value="English"  <?php selected( 'English', $instance['languageOption'] ); ?>>English</option>
<option value="Estonian"  <?php selected( 'Estonian', $instance['languageOption'] ); ?>>Estonian</option>
<option value="French"  <?php selected( 'French', $instance['languageOption'] ) ?>>French</option>
<option value="Finnish"  <?php selected( 'Finnish', $instance['languageOption'] ); ?>>Finnish</option>
<option value="German"  <?php selected( 'German', $instance['languageOption'] ); ?>>German</option>
<option value = "Greek"  <?php selected( 'Greek', $instance['languageOption'] ); ?>>Greek</option>
<option value = "Hebrew"  <?php selected( 'Hebrew', $instance['languageOption'] ); ?>>Hebrew</option>
<option value = "Hungarian"  <?php selected( 'Hungarian', $instance['languageOption'] ); ?>>Hungarian</option>
<option value = "Italian"  <?php selected( 'Italian', $instance['languageOption'] ); ?>>Italian</option>
<option value = "Icelandic"  <?php selected( 'Icelandic', $instance['languageOption'] ); ?>>Icelandic</option>
<option value = "Japanese"  <?php selected( 'Japanese', $instance['languageOption'] ); ?>>Japanese</option>
<option value = "Korean"  <?php selected( 'Korean',$instance['languageOption'] ); ?>>Korean</option>
<option value = "Latin"  <?php selected( 'Latin', $instance['languageOption'] ); ?>>Latin</option>
<option value = "Latvian"  <?php selected( 'Latvian', $instance['languageOption'] ); ?>>Latvian</option>
<option value = "Lithuanian"  <?php selected( 'Lithuanian', $instance['languageOption'] ); ?>>Lithuanian</option>
<option value = "Norwegian"  <?php selected( 'Norwegian', $instance['languageOption'] ); ?>>Norwegian</option>
<option value = "Polish"  <?php selected( 'Polish', $instance['languageOption'] ) ?>>Polish</option>
<option value = "Portuguese"  <?php selected( 'Portuguese', $instance['languageOption'] ) ?>>Portuguese</option>
<option value = "Romanian"  <?php selected( 'Romanian', $instance['languageOption'] ); ?>>Romanian</option>
<option value = "Russian"  <?php selected( 'Russian', $instance['languageOption'] ); ?>>Russian</option>
<option value = "Serbian"  <?php selected( 'Serbian', $instance['languageOption'] ); ?>>Serbian</option>
<option value = "Slovenian"  <?php selected( 'Slovenian', $instance['languageOption'] ); ?>>Slovenian</option>
<option value = "Spanish"  <?php selected( 'Spanish', $instance['languageOption'] ); ?>>Spanish</option>
<option value = "Swedish"  <?php selected( 'Swedish', $instance['languageOption'] ); ?>>Swedish</option>
<option value = "Turkish"  <?php selected( 'Turkish', $instance['languageOption'] ); ?>>Turkish</option>
<option value = "Ukrainian"  <?php selected( 'Ukrainian', $instance['languageOption'] ); ?>>Ukrainian</option>
</select>

</p>



<br />
<?php
}
/**
* Processing widget options on save
*
* @param array $new_instance The new options
* @param array $old_instance The previous options
*
* @return array
*/
public function update( $new_instance, $old_instance ) {
$instance = $old_instance;
$instance['setmore_booking_page_text'] = esc_html($new_instance['setmore_booking_page_text']);
$instance['buttonOption'] = esc_html($new_instance['buttonOption']);
$instance['languageOption'] = esc_html($new_instance['languageOption']);
return $instance;
}


}
