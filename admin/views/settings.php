<div class="wrap">

    <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
    <form method="post" action="<?php echo esc_html( admin_url( 'admin-post.php' ) ); ?>">

        <div id="brasa-vesta-info-login">
            <h2>Informações de login</h2>
                <p>
                    <label>Usuário VestaCP</label>
                    <br />
                    <input type="text" name="brasa-vesta-user" value="<?php echo esc_attr( $this->deserializer->get_value( 'brasa-vesta-user' ) ); ?>" />
                </p>
                <p>
                    <label>Senha VestaCP</label>
                    <br />
                    <input type="password" name="brasa-vesta-password" value="<?php echo esc_attr( $this->deserializer->get_value( 'brasa-vesta-password' ) ); ?>" />
                </p>
                <p>
                    <label>Endereço VestaCP</label>
                    <br />
                    <input type="text" name="brasa-vesta-endereco" value="<?php echo esc_attr( $this->deserializer->get_value( 'brasa-vesta-endereco' ) ); ?>" />
                </p>
                <p>
                    <label>Permitir SSL local</label>
                    <input type="checkbox" name="brasa-vesta-ssl"  value="1" <?php if (esc_attr( $this->deserializer->get_value( 'brasa-vesta-ssl' ) ) == 1) {echo 'checked';} ?>/>
                    <br />

                    <label>Adiciona o código:</label>
                    <pre>
                      add_action('http_api_curl', function( $handle ){
                          //Don't verify SSL certs
                          curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false);
                          curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, false);


                       }, 10);
                    </pre>
                </p>

        </div><!-- #universal-message-container -->
        <div id="brasa-vesta-paginas">
            <h2>Páginas padrão</h2>
            <label>Página de Cadastro dos sites</label>
            <br />
            <?php $this->pega_paginas('cadastra', $this->deserializer->get_value( 'brasa-vesta-cadastra-page' )); ?>

            <br />
            <br />

            <label>Página de listagem dos sites</label>
            <br />
            <?php $this->pega_paginas('lista', $this->deserializer->get_value( 'brasa-vesta-lista-page' )); ?>

        </div><!-- #universal-message-container -->
        <div  id="brasa-vesta-ambiente">
            <h2>Ambiente onde está instalado o plugin</h2>
            <select name="brasa-vesta-ambiente">
              <option value="prod" <?php if (esc_attr( $this->deserializer->get_value( 'brasa-vesta-ambiente' ) ) == 'prod') {echo 'selected';} ?>>Produção</option>
              <option value="beta" <?php if (esc_attr( $this->deserializer->get_value( 'brasa-vesta-ambiente' ) ) == 'beta') {echo 'selected';} ?>>Beta</option>
              <option value="dev" <?php if (esc_attr( $this->deserializer->get_value( 'brasa-vesta-ambiente' ) ) == 'dev') {echo 'selected';} ?>>Desenvolvimento</option>
            </select>

        </div><!-- #universal-message-container -->
        <?php
            wp_nonce_field( 'acme-settings-save', 'acme-custom-message' );
            submit_button();
        ?>

    </form>

</div><!-- .wrap -->
