<div class="auth-container">
    <!-- Bloc gauche : texte + formulaire -->
    <div class="auth-left">
        <h1>Connexion</h1>
        <form action="/auth" method="post">
            <div class="form-group">
                <label for="username">Pseudo</label>
                <input type="text" id="username" name="username" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input type="password" id="password" name="password" required>
            </div>

            <button type="submit" class="cta">Se connecter</button>
        </form>
    </div>

    <!-- Bloc droit : image -->
    <div class="auth-right">
        <img src="\assets\img\inscription.png" alt="Illustration connexion" width="720" height="886">
    </div>
</div>
