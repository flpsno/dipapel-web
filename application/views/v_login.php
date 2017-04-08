<?php $this->load->view('cabecalho', $titulo); ?>

<div class="container">
    <div class="page-header">
        <h1>Login</h1>
    </div>
</div>

<div class="container">
        <div class="jumbotron">
        <div class="row">
            <div class="col-sm-4 "></div>
            <div class="col-sm-4 ">

      <form class="form-signin" role="form" method="post" action="<?= base_url('index.php/login/logar') ?>">
        <?php if ($erro != ''):
			echo '<div class="alert alert-danger" role="alert" style="margin-top: 10px;">'.$erro.'</div>';
        endif;  ?>
      	<p>Usuário:</p>
        <input type="text" class="form-control" placeholder="Email address" required autofocus name="usuario">
        <br>
        <p>Senha:</p>
        <input type="password" class="form-control" placeholder="Password" required name="senha">
        <br>
        <button class="btn btn-md btn-primary btn-block" type="submit">Fazer login</button>

      </form>
            </div>
            <div class="col-sm-4 "></div>
        </div>
	</div> <!-- /container -->
	</div>
<?php $this->load->view('rodape'); ?>
