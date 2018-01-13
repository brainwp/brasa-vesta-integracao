<?php
add_action( 'wp_ajax_cria_lote_1', 'brasa_vesta_cria_lote_1' );
add_action( 'wp_ajax_nopriv_cria_lote_1', 'brasa_vesta_cria_lote_1' );
function brasa_vesta_cria_lote_1() {
  // Verifica NONCE
  check_ajax_referer( 'brasa_vesta_nonce' );
//Verifica se existe algum campo do formulário vazio, caso exista retorna o nome do campo.

foreach ($_POST as $key => $value) {
  if ($value == "") {
    // Tem que melhorar esse tratamento de erro
    echo $key;
    wp_die();
  }
  else{

  }
}
// Poe cada campo do formulario em uma variavel e cria outras necessárias
  $acao=$_POST['acao'];
  $action=$_POST['action'];
  $dominio=$_POST['dominio'];
  $email=$_POST['email'];
  $nome=$_POST['nome'];
  $senha=$_POST['senha'];
  $senha_base=$_POST['senha_base'];
  $senha_baseconf=$_POST['senha_baseconf'];
  $senhaconf=$_POST['senhaconf'];
  $sobrenome=$_POST['sobrenome'];
  $user=$_POST['user'];
  $consulta = new Comunica_vesta();

  // verifica se as senhas estão iguais
  if ($senha != $senhaconf) {
    echo "Senha inválida ou diferente da verificação.";
    wp_die();
  }
  if ($senha_base != $senha_baseconf) {
    echo "Senha do banco inválida ou diferente da verificação.";
    wp_die();
  }

  // Cria o usuário
  // Cria o usuário
  $cria_user= $consulta->cria_user($user,$senha,$nome,$sobrenome,$email);
  echo $cria_user;
  wp_die();

  if (is_wp_error($cria_user)) {
    echo $cria_user->get_error_message();
    wp_die();
  }
  else{
    json_encode($cria_user);
  }
  wp_die(); // All ajax handlers die when finished
}
add_action( 'wp_ajax_cria_lote_2', 'brasa_vesta_cria_lote_2' );
add_action( 'wp_ajax_nopriv_cria_lote_2', 'brasa_vesta_cria_lote_2' );
function brasa_vesta_cria_lote_2() {
  $acao=$_POST['acao'];
  $action=$_POST['action'];
  $dominio=$_POST['dominio'];
  $email=$_POST['email'];
  $nome=$_POST['nome'];
  $senha=$_POST['senha'];
  $senha_base=$_POST['senha_base'];
  $senha_baseconf=$_POST['senha_baseconf'];
  $senhaconf=$_POST['senhaconf'];
  $sobrenome=$_POST['sobrenome'];
  $user=$_POST['user'];
  $consulta = new Comunica_vesta();
  $cria_web= $consulta->cria_web($user,$dominio,$senha_base);
  echo $cria_web;
// Problemas na API - a função cria_web conecta com a API do vesta usando o comando v-add-domain que está retornando o erro "WEB_DOMAINS limit is reached :: upgrade user package" apesar de criar o dominio corretamente.
// Até onde euy cheguei na investigação e parece que o scrip v-add-domain está dsendo chamado duas vezes.

  // echo "OK";
  wp_die();
}

add_action( 'wp_ajax_cria_lote_3', 'brasa_vesta_cria_lote_3' );
add_action( 'wp_ajax_nopriv_cria_lote_3', 'brasa_vesta_cria_lote_3' );
function brasa_vesta_cria_lote_3() {
  $acao=$_POST['acao'];
  $action=$_POST['action'];
  $dominio=$_POST['dominio'];
  $email=$_POST['email'];
  $nome=$_POST['nome'];
  $senha=$_POST['senha'];
  $senha_base=$_POST['senha_base'];
  $senha_baseconf=$_POST['senha_baseconf'];
  $senhaconf=$_POST['senhaconf'];
  $sobrenome=$_POST['sobrenome'];
  $user=$_POST['user'];
  $nome_base = 'bd';
  $usuario_base = 'bd';
  $consulta = new Comunica_vesta();
  $cria_banco= $consulta->cria_banco($user,$nome_base,$usuario_base,$senha_base);
  echo $cria_banco;
  wp_die();
}



function valida_form($form){

}
add_action( 'wp_ajax_cria_user', 'brasa_vesta_cria_user' );
add_action( 'wp_ajax_nopriv_cria_user', 'brasa_vesta_cria_user' );
function brasa_vesta_cria_user() {
  // Verifica NONCE
  check_ajax_referer( 'brasa_vesta_nonce' );

//Verifica se existe algum campo do formulário vazio, caso exista retorna o nome do campo.
  foreach ($_POST as $key => $value) {
    if ($value == "") {
      // Tem que melhorar esse tratamento de erro
      echo $key;
      wp_die();
    }
    else{
      $$key = $value;
    }
  }
  if ($senha != $senhaconf) {
    echo "Senha inválida ou diferente da verificação.";
    wp_die();
  }
  if ($senha_base != $senha_baseconf) {
    echo "Senha do banco inválida ou diferente da verificação.";
    wp_die();
  }
  $consulta = new Comunica_vesta();
  $cria_user= $consulta->cria_user($user,$senha,$nome,$sobrenome,$email);
  echo $cria_user;
  wp_die();
}



add_action( 'wp_ajax_lista_user', 'brasa_vesta_lista_user' );
add_action( 'wp_ajax_nopriv_lista_user', 'brasa_vesta_lista_user' );
function brasa_vesta_lista_user() {
  $consulta = new Comunica_vesta();
  $users= $consulta->lista_user();
  $opcoes= "";
  foreach ($users as $user => $value) {
    // print_r($user);
    if ($value['PACKAGE'] == 'basico') {
      $opcoes .= "<option value='".$user."'>".$user."</option>";
    }
  }
  echo $opcoes;
  wp_die();
}
add_action( 'wp_ajax_cria_web', 'brasa_vesta_cria_web' );
add_action( 'wp_ajax_nopriv_cria_web', 'brasa_vesta_cria_web' );
function brasa_vesta_cria_web() {
  foreach ($_POST as $key => $value) {
    if ($value == "") {
      // Tem que melhorar esse tratamento de erro
      echo $key;
      wp_die();
    }
    else{
      $$key = $value;
    }
  }

  $consulta = new Comunica_vesta();
  $cria_web= $consulta->cria_web($user,$dominio,$senha_base);

// Problemas na API - a função cria_web conecta com a API do vesta usando o comando v-add-domain que está retornando o erro "WEB_DOMAINS limit is reached :: upgrade user package" apesar de criar o dominio corretamente.
// Até onde euy cheguei na investigação e parece que o scrip v-add-domain está dsendo chamado duas vezes.

  // echo "OK";
  echo $cria_web;
  wp_die();
}
add_action( 'wp_ajax_cria_banco', 'brasa_vesta_cria_banco' );
add_action( 'wp_ajax_nopriv_cria_banco', 'brasa_vesta_cria_banco' );

function brasa_vesta_cria_banco() {
  foreach ($_POST as $key => $value) {
    if ($value == "") {
      // Tem que melhorar esse tratamento de erro
      echo $key;
      wp_die();
    }
    else{
      $$key = $value;
    }
  }
  if ($senha_base != $senha_baseconf) {
    echo "Senha do banco inválida ou diferente da verificação.";
    wp_die();
  }
  $nome_base = 'bd';
  $usuario_base = 'bd';
  $consulta = new Comunica_vesta();
  $cria_banco= $consulta->cria_banco($user,$nome_base,$usuario_base,$senha_base);
  if ($cria_banco == "OK") {
    $lote = $consulta->teste_api('v-teste',$user,$senha_base);
    echo $lote;
    wp_die();
  }
  else{
    echo $cria_banco;
    wp_die();
  }


}
