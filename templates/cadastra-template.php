
<?php
/**
 * Template Name: Cadastra Lote
 *
 *
 */
//
// $post= $_POST;
// $html="";
// if ($post['acao'] == 'tudo') {
// 	cria_tudo($post['user'],
// 	$post['senha'],
// 	$post['nome'],
// 	$post['sobrenome'],
// 	$post['email'],
// 	$post['dominio'],
// 	'base',
// 	'base',
// 	$post['senha_base']);
// 	$html = "<h3 style='color:red'>As vezes demora para propagar o domínio.</h3><a style='color:red' href='http://".$post['dominio']."' target='_blank' > Instalar o Wordpress</a>";
// }

// cria_tudo('teste_cli8',
// 'teste_cli8',
// 'teste_cli8 nome',
// 'teste_cli8 sobre',
// 'brmagrini@gmail.com',
// 'testecli8.brunomagrini.com.br',
// 'base',
// 'base',
// 'senha_base');
get_header(); ?>

<div class="wrap">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php
			// $consulta = new Comunica_vesta();
			// $teste= $consulta->teste_api('v-teste');
			// echo 'taete'.$teste;

			// echo $html; ?>



      <?php
				$user=$_GET['user'];
				$senha=$_GET['senha'];
				$nome=$_GET['nome'];
				$sobrenome=$_GET['sobrenome'];
				$email=$_GET['email'];
				$endereco=$_GET['endereco'];
				$nome_base=$_GET['nome_base'];
				$senha_base=$_GET['senha_base'];
				$nomeusuario_base=$_GET['usuario_base'];
			?>
			<h2>Cadastrar Tudo:</h2>
			<?php
			// echo "</pre>";
			// print_r($_POST);
			?>
			<img class="ajax-loader" src="<?php echo BRASA_VESTA_PLUGIN_URL."assets/images/loader.gif" ?>" alt="ajax_loader">

			<form id="form-lote-user" class="form-lote" action="" method="post">
				<input type="text" name="user"  placeholder="Nome de usuário">
				<input type="password" name="senha"   placeholder="Senha">
				<input type="password" name="senhaconf"   placeholder="Confirme a senha">
				<input type="text" name="nome"   placeholder="Nome">
				<input type="text" name="sobrenome"   placeholder="Sobrenome">
				<input type="email" name="email"   placeholder="E-mail">
				<input type="submit" id="btn-cria-tudo" value="Cadastrar" />
				<input type="hidden" name="acao" value="cria_user" />
				<div class="resultado">

				</div>

			</form>
			<form id="form-lote-web" class="form-lote" action="" method="post">

				<select class="" name="user">
					<?php
						$consulta = new Comunica_vesta();
						$users= $consulta->lista_user();
						foreach ($users as $user => $value) {
							// print_r($user);

							if ($value['PACKAGE'] == 'basico') {
								echo "<option value='".$user."'>".$user."</option>";
							}
						}
					?>
				</select>
				<input type="text" name="dominio"   placeholder="Domínio">
				<input type="submit" id="btn-cria-tudo" value="Criar" />
				<input type="hidden" name="acao" value="cria_web" />
				<div class="resultado">

				</div>
			</form>
			<form id="form-lote-banco" class="form-lote" action="" method="post">
				<select class="" name="user">
					<?php
						$consulta = new Comunica_vesta();
						$users= $consulta->lista_user();
						foreach ($users as $user => $value) {
							// print_r($user);

							if ($value['PACKAGE'] == 'basico') {
								echo "<option value='".$user."'>".$user."</option>";
							}
						}
					?>
				</select>
				<input type="password" name="senha_base"   placeholder="Senha do banco">
				<input type="password" name="senha_baseconf"   placeholder="Confirme a senha do banco">
				<input type="submit" id="btn-cria-tudo" value="Criar" />
				<input type="hidden" name="acao" value="cria_banco" />
				<div class="resultado">

				</div>
			</form>



		</main><!-- #main -->
	</div><!-- #primary -->
</div><!-- .wrap -->

<?php get_footer();
?>
<script>// A $( document ).ready() block.
</script>
