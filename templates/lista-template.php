<?php
/**
 * Template Name: Mostra sites
 *
 *
 */
get_header(); ?>

<div class="wrap">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
      <h2>A roça toda: </h2>
      <row>

        <?php
				$consulta = new Comunica_vesta();
				$users= $consulta->lista_user();
				if (is_wp_error($users)) {
					echo $users->get_error_message();
				}
				else{
					// echo "<pre>";
					// print_r($users);
					// echo "</pre>";
					foreach ( $users as $key => $value) {
						if ($value['PACKAGE'] == 'basico') {?>
							<?php
							$domains=lista_domains($key,'json');
							foreach ($domains as $dominio => $vetor) {
								echo "<div class='col-md-3'><a href='http://".$dominio."' target='_blank'>".$key."</a></div>";
							}
						}
					}
				}
        ?>
        <row>
      </main><!-- #main -->
  	</div><!-- #primary -->
  </div><!-- .wrap -->

  <?php get_footer();
