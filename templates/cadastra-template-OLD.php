
<?php
/**
 * Template Name: Cadastra Lote
 *
 *
 */

$post= $_POST;
$html="";
if ($post['acao'] == 'tudo') {
	cria_tudo($post['user'],
	$post['senha'],
	$post['nome'],
	$post['sobrenome'],
	$post['email'],
	$post['dominio'],
	'base',
	'base',
	$post['senha_base']);
	$html = "<h3 style='color:red'>As vezes demora para propagar o domínio.</h3><a style='color:red' href='http://".$post['dominio']."' target='_blank' > Instalar o Wordpress</a>";
}

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

			<?php echo $html; ?>



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


			<div id="tabs">
			  <ul>
			    <li><a href="#tabs-1">Cadastra Usuário</a></li>
			    <li><a href="#tabs-2">Cria WEB/DNS/MAIL</a></li>
					<li><a href="#tabs-3">Cria Banco</a></li>
					<li><a href="#tabs-4">Cria lote no sítio</a></li>
			  </ul>
			  <div id="tabs-1">
					<form class="form-cadastro" action="/lote" method="post">
						<input type="text" name="arg1" value="" placeholder="Nome de usuário">
						<input type="password" name="arg2" value="" placeholder="Senha">
						<input type="password" name="senhaconf" value="" placeholder="Confirme a senha">
						<input type="email" name="arg3" value="" placeholder="E-mail">
						<input type="hidden" name="arg4" value="basico" />
						<input type="text" name="arg5" value="" placeholder="Nome">
						<input type="text" name="arg6" value="" placeholder="Sobrenome">
						<input type="submit" id="btn-cria-user" value="Submit" />
						<input type="hidden" name="cmd" value="v-add-user" />
					</form>
				</div>
			  <div id="tabs-2">
					<form class="form-cadastro" action="/lote" method="post">
						<?php
						$consulta = new Comunica_vesta();
						$users= $consulta->lista_user();
						if (is_wp_error($users)) {
							echo $users->get_error_message();
						}
						else{
							?>
							<select name="arg1">
								<?php
							foreach ( $users as $key => $value) {
								if ($value['PACKAGE'] == 'basico') {
										echo "<option value=".$key.">".$key."</option>";
								}
							}
							 ?>
						 </select>
						<?php
						}
						?>
						<input type="text" name="arg2" value="" placeholder="Domínio">
						<input type="submit" id="btn-cria-web" value="Submit" />
						<input type="hidden" name="cmd" value="v-add-domain" />
					</form>
				</div>
			  <div id="tabs-3">
					<form class="form-cadastro" action="/lote" method="post">
						<?php
						$consulta = new Comunica_vesta();
						$users= $consulta->lista_user();
						if (is_wp_error($users)) {
							echo $users->get_error_message();
						}
						else{
							?>
							<select name="arg1">
								<?php
							foreach ( $users as $key => $value) {
								if ($value['PACKAGE'] == 'basico') {
										echo "<option value=".$key.">".$key."</option>";
								}
							}
							 ?>
						 </select>
						<?php
						}
						?>
						<input type="hidden" name="arg2" value="" placeholder="db_nome">
						<input type="hidden" name="arg3" value="" placeholder="db_user">
						<input type="hidden" name="arg4" value="" placeholder="db_pass">
						<input type="hidden" name="arg5" value="mysql" placeholder="db_pass">
						<input type="hidden" name="arg6" value="localhost" placeholder="db_pass">
						<input type="hidden" name="arg7" value="localhost" placeholder="db_pass">
						<input type="hidden" name="arg8" value="localhost" placeholder="db_pass">
						<input type="submit" id="btn-cria-web" value="Submit" />
						<input type="hidden" name="cmd" value="v-add-database" />
					</form>
			  </div>
				<div id="tabs-4">
					<form id="form-lote-sitio" action="" method="post">
						<input type="text" name="user" value="" placeholder="Nome de usuário">
						<input type="password" name="senha" value="" placeholder="Senha">
						<input type="password" name="senhaconf" value="" placeholder="Confirme a senha">
						<input type="text" name="nome" value="" placeholder="Nome">
						<input type="text" name="sobrenome" value="" placeholder="Sobrenome">
						<input type="email" name="email" value="" placeholder="E-mail">
						<input type="text" name="dominio" value="" placeholder="Domínio">
						<input type="password" name="senha_base" value="" placeholder="Senha do banco">
						<input type="password" name="senha_baseconf" value="" placeholder="Confirme a senha do banco">
						<input type="submit" id="btn-cria-tudo" value="Submit" />
						<input type="hidden" name="acao" value="tudo" />

					</form>
				</div>
			</div>


		</main><!-- #main -->
	</div><!-- #primary -->
</div><!-- .wrap -->

<?php get_footer();
?>
<script>// A $( document ).ready() block.
</script>
