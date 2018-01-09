<?php
use Symfony\Component\Debug\ErrorHandler;
use Symfony\Component\Debug\ExceptionHandler;
use Symfony\Component\HttpFoundation\Request;


// Register global error and exception handlers
ErrorHandler::register();
ExceptionHandler::register();

// Register service providers
$app->register(new Silex\Provider\DoctrineServiceProvider());
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../views',
));
$app->register(new Silex\Provider\AssetServiceProvider(), array(
    'assets.version' => 'v1'
));
$app->register(new Silex\Provider\SessionServiceProvider()); 

// pour la gestion des formulaires
$app->register(new Silex\Provider\FormServiceProvider());
$app->register(new Silex\Provider\LocaleServiceProvider());
$app->register(new Silex\Provider\TranslationServiceProvider());

$app->register(new Silex\Provider\SecurityServiceProvider(), array(
    'security.firewalls' => array(
        'secured' => array(
            'pattern' => '^/',
            'anonymous' => true,
            'logout' => true,
            'form' => array('login_path' => '/login', 'check_path' => '/login_check'),
            'users' => function () use ($app) {
                return new CitadelleDuVin\DAO\UserDAO($app['db']);
            },
        ),
    ),
    'security.role_hierarchy' => array(
        'ROLE_ADMIN' => array('ROLE_USER'),
    ),
    'security.access_rules' => array(
        array('^/admin', 'ROLE_ADMIN'),
    ),
));

// Register JSON data decoder for JSON requests
$app->before(function (Request $request) {
    if (0 === strpos($request->headers->get('Content-Type'), 'application/json')) {
        $data = json_decode($request->getContent(), true);
        $request->request->replace(is_array($data) ? $data : array());
    }
});

// Register services
$app['dao.land'] = function ($app) {
    return new CitadelleDuVin\DAO\PaysDAO($app['db']);
};

$app['dao.color'] = function ($app) {
    return new CitadelleDuVin\DAO\CouleurDAO($app['db']);
};

$app['dao.user'] = function ($app) {
    return new CitadelleDuVin\DAO\UserDAO($app['db']);
};

$app['dao.taste'] = function ($app){
    return new CitadelleDuVin\DAO\GoutDAO($app['db']);
};

$app['dao.role'] = function($app){
    return new CitadelleDuVin\DAO\RoleDAO($app['db']);
};

$app['dao.produit'] = function ($app) {
    $produitDAO = new CitadelleDuVin\DAO\ProduitDAO($app['db']);
    $produitDAO->setLandDAO($app['dao.land']);
    $produitDAO->setColorDAO($app['dao.color']);
    $produitDAO->setTasteDAO($app['dao.taste']);
    return $produitDAO;
};

$app['dao.panier'] = function($app){
    $panierDAO = new CitadelleDuVin\DAO\PanierDAO($app['db']);
    $panierDAO->setProductDAO($app['dao.produit']);
    return $panierDAO;
};

$app['dao.comporte'] = function($app){
    $comporteDAO = new CitadelleDuVin\DAO\ComporteDAO($app['db']);
    $comporteDAO->setProductDAO($app['dao.produit']);
    return $comporteDAO;
};

$app['dao.commande'] = function($app){
    $commandeDAO = new CitadelleDuVin\DAO\CommandeDAO($app['db']);;
    $commandeDAO->setComporteDAO($app['dao.comporte']);
    return $commandeDAO;
};

$app['dao.pages'] = function ($app) {
    return new CitadelleDuVin\DAO\PagesDAO($app['db']);
};



use Silex\Provider\FormServiceProvider;
use Silex\Provider\TwigServiceProvider;
use Silex\Provider\UrlGeneratorServiceProvider;
use Silex\Provider\ValidatorServiceProvider;
use Silex\Provider\ServiceControllerServiceProvider;
use Silex\Provider\TranslationServiceProvider;
use Silex\Provider\SwiftmailerServiceProvider;


$app->register(new FormServiceProvider());
$app->register(new TranslationServiceProvider());