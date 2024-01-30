<?php
/**
 * Controller par défaut
 * Index
 */

class IndexController
{
    /**
     * Page d'accueil
     */
    public function index()
    {
        // open view
        view('index');
    }

    /**
     * Page de contact
     */
    public function contact()
    {
        // include view
        view('contact');
    }

    /**
     * Page à propos
     */
    public function about()
    {
        // include view
        view('about');
    }
}