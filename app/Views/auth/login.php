<div class="auth-container">

    <!-- Bloc gauche : texte + formulaire -->
    <div class="auth-left">
        <h1>Connexion</h1>

        <form action="/auth" method="post" aria-label="Formulaire de connexion">

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input type="password" id="password" name="password" required>
            </div>

            <button type="submit" class="cta btn">Se connecter</button>

            <p class="auth-register"> Pas de compte ? <a href="/inscription">Inscrivez-vous</a> </p>

        </form>
    </div>

    <!-- Bloc droit : image -->
    <div class="auth-right">
        <img src="/assets/img/inscription.png"
             alt="Illustration représentant la connexion à un compte">
    </div>

</div>
