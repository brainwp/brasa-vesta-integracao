<?php
/**
 * Template Name: Cadastra Lote
 */
get_header(); ?>

<div class="wrap">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php
			// $consulta = new Comunica_vesta();
			// $teste= $consulta->teste_api('v-teste');
			// echo 'taete'.$teste;

			// echo $html; ?>

			<h2>Cadastro de Lotes no Sítio Brasa:</h2>
			<p>Preencha e envie cada formuário separadamente e em ordem.</p>

			<?php
			// echo "</pre>";
			// print_r($_POST);
			?>
			<img class="ajax-loader" src="<?php echo BRASA_VESTA_PLUGIN_URL . "assets/images/loader.gif" ?>" alt="ajax_loader">

			<form id="form-lote-user" class="form-lote" action="" method="post">

				<h3>Passo 1:</h3>
				<p>O formuário abaixo cria o usuário no Vesta.</p>

				<input type="text" name="user"  placeholder="Nome de usuário">
				<input type="password" name="senha"   placeholder="Senha">
				<input type="password" name="senhaconf"   placeholder="Confirme a senha">
				<input type="text" name="nome"   placeholder="Nome">
				<input type="text" name="sobrenome"   placeholder="Sobrenome">
				<input type="email" name="email"   placeholder="E-mail">
				<input type="submit" id="btn-cria-tudo-1" value="Cadastrar" />
				<input type="hidden" name="acao" value="cria_user" />
			</form>

			<hr>

			<form id="form-lote-web" class="form-lote" action="" method="post">

				<h3>Passo 2:</h3>
				<p>Preencha abaixo com o domínio do seu site.</p>

				<input type="text" name="dominio"   placeholder="Domínio">
				<input type="submit" id="btn-cria-tudo-2" value="Criar" />
				<input type="hidden" name="acao" value="cria_web" />
				<input type="hidden" id="hidden-user" name="user" />
			</form>

			<hr>

			<form id="form-lote-banco" class="form-lote" action="" method="post">

				<h3>Passo 3:</h3>
				<p>Crie o banco de dados.</p>

				<input type="password" name="senha_banco"   placeholder="Senha do banco">
				<input type="password" name="senha_bancoconf"   placeholder="Confirme a senha do banco">
				<input type="submit" id="btn-cria-tudo-3" value="Criar" />
				<input type="hidden" name="acao" value="cria_banco" />
				<input type="hidden" id="hidden-banco" name="user" />
			</form>

			<div id="resultado"></div><!-- resutado -->


		</main><!-- #main -->
	</div><!-- #primary -->
</div><!-- .wrap -->

<?php get_footer();
?>
<script>// A $( document ).ready() block.
</script>
