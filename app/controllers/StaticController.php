<?php

class StaticController
{
    public function confidentialite(): void
    {
        View::render('static/confidentialite');
    }

    public function mentionsLegales(): void
    {
        View::render('static/mentions_legales');
    }
}
