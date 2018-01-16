<?php
/**
 * comunica com a API do vestaCP via HTTP
 *
 * @package Custom_Admin_Settings
 */

/**
 * Creates the submenu page for the plugin.
 *
 * Provides the functionality necessary for rendering the page corresponding
 * to the submenu with which this page is associated.
 *
 * @package Custom_Admin_Settings
 */

class Comunica_vesta {
    public function __construct(  ) {
      // $this->consulta();
    }
    private static $instance;
    public static function get_instance() {

      if ( null == self::$instance ) {
        self::$instance = new Comunica_vesta();
      }

      return self::$instance;

    }
    private function cria_dados_auth($user, $senha){
      $postvars = array(
    	    'user' => $user,
    	    'password' => $senha,
    	);
      return $postvars;
    }
    public function consulta($args){
      $deserializer = new Deserializer();
      $user=$deserializer->get_value(  'brasa-vesta-user' );
      $senha=$deserializer->get_value( 'brasa-vesta-password' );
      $hostname=$deserializer->get_value( 'brasa-vesta-endereco' );
      $postvars= $this->cria_dados_auth($user, $senha);
      $postvars = array_merge($postvars,$args);
      if ($deserializer->get_value( 'brasa-vesta-ssl' )) {
        add_action('http_api_curl', function( $handle ){
            //Don't verify SSL certs
            curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, false);


         }, 10);
      }
      $response = wp_remote_post( 'https://' . $hostname . ':8083/api/', array(
      	'method' => 'POST',
      	'timeout' => 45,
      	'redirection' => 5,
      	'httpversion' => '1.0',
      	'blocking' => true,
      	'headers' => array(),
      	'body' => $postvars,
      	'cookies' => array()
          )
      );
      return $response ;

    }
    public function lista_user()
    {
      $vst_command = 'v-list-users';
      // Prepare POST query
      $postvars = array(
          'cmd' => $vst_command,
          'arg1' => 'json',
      );
      $resposta = $this->consulta($postvars);
      if (is_wp_error($resposta)) {
        return $resposta;
      }
      else{
        return json_decode($resposta['body'], true);
      }
    }
    public function cria_user($user,$senha,$nome,$sobrenome,$email)
    {
    // Pode retornar:
    // - a mensagem de erro de um wp_error do wp_remote_post,
    // - OK,
    // - String com erro do VestaCP

      // return "OK"; // Para teste das outras etapas isoladas
      $vst_command = 'v-add-user';
      // Prepare POST query
      $postvars = array(
    	    'cmd' => $vst_command,
    	    'arg1' => $user,
    	    'arg2' => $senha,
    	    'arg3' => $email,
    	    'arg4' => 'basico',
    	    'arg5' => $nome,
    	    'arg6' => $sobrenome
    	);
      $resposta = $this->consulta($postvars);
      // caso o wp_remote_post gere algum erro
      if (is_wp_error($resposta)) {
        return $resposta;
      }
      // caso a API do vesta retorne OK
      elseif ($resposta['body'] == 'OK') {
        return "OK";
      }
      // caso a API do vesta retorne algum erro
      else{
        return "Erro: ".json_encode($resposta['body']);
      }
    }


    public function cria_web($user,$dominio)
    {

      $vst_command = 'v-add-domain';
      // Prepare POST query
      $postvars = array(
    	    'cmd' => $vst_command,
          'arg1' => $user,
          'arg2' => $dominio,
    	);
      $resposta = $this->consulta($postvars);
      if (is_wp_error($resposta)) {
        return $resposta;
      }
      elseif ($resposta['body'] == 'OK') {
        return "OK";
      }
      else{
        return "Erro: ".json_encode($resposta['body']);
      }
    }
    public function cria_banco($user,$nome_base,$usuario_base,$senha_base)
    {

      $vst_command = 'v-add-database';
      // Prepare POST query
      $postvars = array(
    	    'cmd' => $vst_command,
          'arg1' => $user,
    	    'arg2' => $nome_base,
    	    'arg3' => $usuario_base,
    	    'arg4' => $senha_base,
          'arg5' => 'mysql',
          'arg6' => 'localhost',
          'arg7' => 'UTF8',
    	);
      $resposta = $this->consulta($postvars);
      if (is_wp_error($resposta)) {
        echo $resposta->get_error_message();
      }
      elseif ($resposta['body'] == 'OK') {
        return "OK";
      }
      else{
        return "Erro: ".json_encode($resposta['body']);
      }
    }


    public function teste_api($comando,$user,$senha_banco)
    {

      $vst_command = $comando;
      // Prepare POST query
      $postvars = array(
          'cmd' => $vst_command,
          'arg1' => $user,
          'arg2' => $senha_banco,

      );
      $resposta = $this->consulta($postvars);
      if (is_wp_error($resposta)) {
        echo $resposta->get_error_message();
      }
      elseif ($resposta['body'] == 'OK') {
        return "OK";
      }
      else{
        return "Erro: ".json_encode($resposta['body']);
      }
    }

   public function render() {

   }
   public function pega_paginas($acao,$selecionado)
   {

   }
}
