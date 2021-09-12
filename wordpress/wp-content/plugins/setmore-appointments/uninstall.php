<?php
    /**
     * uninstall setmore appointments will delete hooks and data store elements
     */
    
    if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) exit();
    
    $setmore_booking_page_url = get_option( 'setmore_booking_page_url' );
    if (!empty($setmore_booking_page_url)) {
        delete_option( 'setmore_booking_page_url');
    }
    
    $languageOption = get_option( 'languageOption' );
    if (!empty($languageOption)) {
        delete_option( 'languageOption');
    }
?>
