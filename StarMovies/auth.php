<?php
require_once("templates/header.php");
?>
<div id="main-container" class="container-fluid">
    <div class="col-md-12">
        <div class="row" id="auth-row">
            <div class="col-md-4" id="login-container">
                <h2>Entrar</h2>
                <form action="<?= $BASE_URL ?>auth_process.php" method="POST">
                    <input type="hidden" name="type" value="login">
                    <div class="form-group">
                        <label for="email">E-mail</label>
                        <input type="email" class="form-control" name="email" id="email">
                    </div>
                    <div class="form-group">
                        <label for="password">Senha</label>
                        <input type="password" class="form-control" name="password" id="password">
                    </div>
                    <input type="submit" class="btn card-btn" value="Entrar">
                </form>
            </div>
            <div class="col-md-4" id="register-container">
                <h2>Criar conta</h2>
                <form action="<?= $BASE_URL ?>auth_process.php" method="POST">
                    <input type="hidden" name="type" value="register">
                    <div class="form-group">
                        <label for="emailr">E-mail</label>
                        <input type="email" class="form-control" name="emailr" id="emailr">
                    </div>
                    <div class="form-group">
                        <label for="name">Nome</label>
                        <input type="text" class="form-control" name="name" id="name">
                    </div>
                    <div class="form-group">
                        <label for="lastname">Sobrenome</label>
                        <input type="text" class="form-control" name="lastname" id="lastname">
                    </div>
                    <div class="form-group">
                        <label for="passwordr">Senha</label>
                        <input type="password" class="form-control" name="passwordr" id="passwordr">
                    </div>
                    <div class="form-group">
                        <label for="confirmpassword">Confirmar Senha</label>
                        <input type="password" class="form-control" name="confirmpassword" id="confirmpassword">
                    </div>
                    <input type="submit" class="btn card-btn" value="Registrar">
                </form>
            </div>
        </div>
    </div>
</div>
<?php
require_once("templates/footer.php")
?>