<?php
/**
 * Performs all sanitization functions required to save the option values to
 * the database.
 *
 * This will also check the specified nonce and verify that the current user has
 * permission to save the data.
 *
 * @package Brasa_Vesta_Integracao
 */
class Serializer {
     public function init() {
    /**
     * Initializes the function by registering the save function with the
     * admin_post hook so that we can save our options to the database.
     */
     add_action( 'admin_post', array( $this, 'save' ) );
     }
    /**
     * Redirect to the page from which we came (which should always be the
     * admin page. If the referred isn't set, then we redirect the user to
     * the login page.
     *
     * @access private
     */
     public function save() {
          // First, validate the nonce and verify the user as permission to save.
     if ( ! ( $this->has_valid_nonce() && current_user_can( 'manage_options' ) ) ) {
         // TODO: Display an error message.
     }
     print_r($_POST);

     // If the above are valid, sanitize and save the option.
     if ( null !== wp_unslash( $_POST['brasa-vesta-user'] ) ) {
         $brasa_vesta_user = sanitize_text_field( $_POST['brasa-vesta-user'] );
         echo $brasa_vesta_user;
         update_option( 'brasa-vesta-user', $brasa_vesta_user );
     }
     if ( null !== wp_unslash( $_POST['brasa-vesta-password'] ) ) {
         $brasa_vesta_password = sanitize_text_field( $_POST['brasa-vesta-password'] );
         update_option( 'brasa-vesta-password', $brasa_vesta_password );
     }
     if ( null !== wp_unslash( $_POST['brasa-vesta-endereco'] ) ) {
         $brasa_vesta_endereco = sanitize_text_field( $_POST['brasa-vesta-endereco'] );
         update_option( 'brasa-vesta-endereco', $brasa_vesta_endereco );
     }
     if ( null !== wp_unslash( $_POST['brasa-vesta-cadastra-page'] ) ) {
         $brasa_vesta_cadastra = sanitize_text_field( $_POST['brasa-vesta-cadastra-page'] );
         update_option( 'brasa-vesta-cadastra-page', $brasa_vesta_cadastra );
     }
     if ( null !== wp_unslash( $_POST['brasa-vesta-lista-page'] ) ) {
         $brasa_vesta_lista = sanitize_text_field( $_POST['brasa-vesta-lista-page'] );
         update_option( 'brasa-vesta-lista-page', $brasa_vesta_lista );
     }
     if ( null !== wp_unslash( $_POST['brasa-vesta-ssl'] ) ) {
         update_option( 'brasa-vesta-ssl', true );
     }
     if ( null !== wp_unslash( $_POST['brasa-vesta-ambiente'] ) ) {
        // if ($_POST['brasa-vesta-ambiente'] == 'nenhum') {
        //   # code...
        // }
        $brasa_vesta_ambiente = sanitize_text_field( $_POST['brasa-vesta-ambiente'] );

         update_option( 'brasa-vesta-ambiente', $brasa_vesta_ambiente );
     }
     else{
       update_option( 'brasa-vesta-ssl', false );

     }
     $this->redirect();
   }
   /**
    * Determines if the nonce variable associated with the options page is set
    * and is valid.
    *
    * @access private
    *
    * @return boolean False if the field isn't set or the nonce value is invalid;
    *                 otherwise, true.
    */
   private function has_valid_nonce() {
       // If the field isn't even in the $_POST, then it's invalid.
       if ( ! isset( $_POST['acme-custom-message'] ) ) { // Input var okay.
           return false;
       }

       $field  = wp_unslash( $_POST['acme-custom-message'] );
       $action = 'acme-settings-save';

       return wp_verify_nonce( $field, $action );
   }
   /**
     * Redirect to the page from which we came (which should always be the
     * admin page. If the referred isn't set, then we redirect the user to
     * the login page.
     *
     * @access private
     */
   private function redirect() {

     // To make the Coding Standards happy, we have to initialize this.
     if ( ! isset( $_POST['_wp_http_referer'] ) ) { // Input var okay.
         $_POST['_wp_http_referer'] = wp_login_url();
     }

     // Sanitize the value of the $_POST collection for the Coding Standards.
     $url = sanitize_text_field(
         wp_unslash( $_POST['_wp_http_referer'] ) // Input var okay.
     );

     // Finally, redirect back to the admin page.
     wp_safe_redirect( urldecode( $url ) );
     exit;
   }
}
