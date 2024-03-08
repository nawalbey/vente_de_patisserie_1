<div class="class2">
    <div class="container-height">
        <div></div>
        <div class="container container_login">
            <form class="form1" action="../model/connexion.php" method="post">
                <h1>connexion</h1>
                <div>
                    <h2><?= isset($_SESSION['message_connexion']) ? $_SESSION['message_connexion'] : null; ?></h2>
                    <?php unset($_SESSION['message_connexion']); ?>
                </div>
                <div class="form-group">
                    <label for="email">Email :</label>
                    <input type="email" class="form-control" id="email" name="email">
                </div>

                <div class="form-group">
                    <label for="password">Password :</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>

                <div class="button2">
                    <button type="submit" id="bouton" class="btn mt-5 mb-5" name="connexion" value="submit">connexion</button>
                </div>
            </form>
        </div>
    </div>
</div>

