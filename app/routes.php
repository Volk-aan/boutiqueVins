<?php
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use CitadelleDuVin\Domain\Pages;
use CitadelleDuVin\Domain\Produit;
use CitadelleDuVin\Domain\User;
use CitadelleDuVin\Form\Type\PageType;
use CitadelleDuVin\Form\Type\ProduitType;
use CitadelleDuVin\Form\Type\UserType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\HttpFoundation\File\UploadedFile;
date_default_timezone_set('Europe/Brussels');



// Home page
$app->get('/', function () use ($app) {
    $pageAccueil = $app['dao.pages']->find(3);

    if ($app['security.authorization_checker']->isGranted('IS_AUTHENTICATED_FULLY')) {
        $token = $app['security.token_storage']->getToken();
        if (null !== $token) {
            $user = $token->getUser();
        }
        $qtPanier = $app['dao.panier']->qtCart($user->getId());
        $app['session']->set('panier', $qtPanier);
    }
    return $app['twig']->render('index.html.twig', array('accueil' => $pageAccueil));
})->bind('home');

// FAQ page
$app->get('/FAQ', function () use ($app) {
    $pageFAQ = $app['dao.pages']->find(1);
    return $app['twig']->render('faq.html.twig', array('faq' => $pageFAQ));
})->bind('faq');

// Infos générales page
$app->get('/infoGenerales', function () use ($app) {
    $infoGen = $app['dao.pages']->find(2);
    return $app['twig']->render('infoGenerales.html.twig', array('infoGenerales' => $infoGen));
})->bind('infoGenerales');

// Shop page
$app->get('/shop', function () use ($app) {
    $produits = $app['dao.produit']->findAll();
    return $app['twig']->render('shop.html.twig', array('produits' => $produits));
})->bind('shop');

// Contact page
$app->get('/contact', function () use ($app){
    return $app['twig']->render('contact.html.twig');
})->bind('contact');

// Connexion page
$app->get('/connexion', function () use ($app){
    return $app['twig']->render('login.html.twig');
})->bind('connexion');


// Login form
$app->get('/login', function(Request $request) use ($app) {
    return $app['twig']->render('login.html.twig', array(
        'error'         => $app['security.last_error']($request),
        'last_username' => $app['session']->get('_security.last_username'),
    ));
})->bind('login');

// Cart page
$app->get('/panier', function () use ($app){
    $token = $app['security.token_storage']->getToken();
    if (null !== $token) {
        $user = $token->getUser();
    }
    $panier = $app['dao.panier']->find($user->getId());
    return $app['twig']->render('cart.html.twig',array('produits' => $panier));
})->bind('panier');

// ajout panier
$app->get('/panier/ajouter/{id}', function ($id) use ($app){
    $produit = $app['dao.produit']->find($id);
    $panier = new CitadelleDuVin\Domain\Panier;
    $panier->setProduct($produit);
    $token = $app['security.token_storage']->getToken();
    if (null !== $token) {
        $user = $token->getUser();
    }
    $panier->setUser($user->getId());
    $app['dao.panier']->save($panier);
    $qtPanier = $app['dao.panier']->qtCart($user->getId());
    $app['session']->set('panier', $qtPanier);
    return $app->redirect('/shop');
})->bind('ajouter');

// diminuer panier
$app->get('/panier/diminuer/{id}', function ($id) use ($app){
    $produit = $app['dao.produit']->find($id);
    $panier = new CitadelleDuVin\Domain\Panier;
    $panier->setProduct($produit);
    $token = $app['security.token_storage']->getToken();
    if (null !== $token) {
        $user = $token->getUser();
    }
    $panier->setUser($user->getId());
    $app['dao.panier']->decreaseQuantity($panier);
    $qtPanier = $app['dao.panier']->qtCart($user->getId());
    $app['session']->set('panier', $qtPanier);
    return $app->redirect('/panier');
})->bind('diminuer');

//augmenter panier
$app->get('/panier/augmenter/{id}', function ($id) use ($app){
    $produit = $app['dao.produit']->find($id);
    $panier = new CitadelleDuVin\Domain\Panier;
    $panier->setProduct($produit);
    $token = $app['security.token_storage']->getToken();
    if (null !== $token) {
        $user = $token->getUser();
    }
    $panier->setUser($user->getId());
    $app['dao.panier']->increaseQuantity($panier);
    $qtPanier = $app['dao.panier']->qtCart($user->getId());
    $app['session']->set('panier', $qtPanier);
    return $app->redirect('/panier');
})->bind('augmenter');

//vider panier
$app->get('/panier/vider/', function () use ($app){
    $token = $app['security.token_storage']->getToken();
    if (null !== $token) {
        $user = $token->getUser();
    }
    $app['dao.panier']->clearCart($user->getId());
    $qtPanier = $app['dao.panier']->qtCart($user->getId());
    $app['session']->set('panier', $qtPanier);
    return $app->redirect('/panier');
})->bind('vider');


// Commander
$app->get('/panier/commander/}', function () use ($app){
    $commande = new CitadelleDuVin\Domain\Commande;
    $token = $app['security.token_storage']->getToken();
    if (null !== $token) {
        $user = $token->getUser();
    }
    $commande->setUser($user->getId());
    $dateCom = date("Y-m-d H:i:s");
    $commande->setDate($dateCom);
    $app['dao.commande']->save($commande);

    $commande = $app['dao.commande']->findIdCom($user->getId(),$dateCom);

    $panier = $app['dao.panier']->find($user->getId());
    $total = $app['dao.comporte']->save($panier,$commande->getId());
    $commande ->setPrice($total);
    $app['dao.commande']->updateTotal($commande);
    $app['dao.panier']->clearCart($user->getId());
    $qtPanier = $app['dao.panier']->qtCart($user->getId());
    $app['session']->set('panier', $qtPanier);
    return $app->redirect('/panier');
})->bind('commander');


//Fiche détails produit
$app->get('/shop/details/{id}', function ($id) use ($app){
    $produit = $app['dao.produit']->find($id);
    
    return $app['twig']->render('product.html.twig',array('product' => $produit));
})->bind('details');



// Dashboard client
$app->get('/compte', function () use ($app){
    $token = $app['security.token_storage']->getToken();
    if (null !== $token) {
        $user = $token->getUser();
    }
    $commandes = $app['dao.commande']->findByUser($user->getId());
    $user = $app['dao.user']->find($user->getId());

    return $app['twig']->render('compte.html.twig',array('commandes' => $commandes, 'client' => $user));
})->bind('compte');


// Dashboard client commande
$app->get('/compte/commande/pdf/{numCom}', function ($numCom) use ($app){
    $data = $app['dao.commande']->find($numCom);
    $token = $app['security.token_storage']->getToken();
    if (null !== $token) {
        $user = $app['dao.user']->find($token->getUser()->getId());
    }    
        $pdf = new \FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial','B',24);
        // Logo
        $pdf->Cell(10);
        $pdf->Cell(80,10,'Citadelle du Vin','C');
        $pdf->Cell(30);
        $pdf->SetFont('Arial','B',16);
        $pdf->Cell(60,10,'Facture '. $data->getId(),1,0,'C');
        $pdf->Ln(30);
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(10);
        $pdf->Cell(50,10,'Client: '. $user->getId());
        $pdf->Ln(5);
        $pdf->SetFont('Arial','',10);
        $pdf->Cell(10);
        $pdf->Cell(50,10,$user->getFirstname(). ' '. $user->getLastName() );
        $pdf->Ln(5);
        $pdf->Cell(10);
        $pdf->Cell(50,10,$user->getStreet());
        $pdf->Ln(5);
        $pdf->Cell(10);
        $pdf->Cell(50,10,$user->getPostalCode().' '.$user->getCity());
        $pdf->Ln(5);
        $pdf->Cell(10);
        $pdf->Cell(50,10,$user->getPhoneNumber());
        $pdf->Ln(30);
        $pdf->Cell(20);
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(30,10,utf8_decode('Quantité'));
        $pdf->Cell(100,10,utf8_decode('Désignation'));
        $pdf->Cell(50,10,'Prix');
        $pdf->Ln(10);
        $pdf->SetFont('Arial','',10);
        foreach($data->getList() as $products){
            $pdf->Cell(20);
            $pdf->Cell(30,10,$products->getQuantity());
            $pdf->Cell(100,10,utf8_decode($products->getProduct()->getName(). '  '. $products->getProduct()->getColor()->getName()));
            $pdf->Cell(100,10,$products->getProduct()->getPrice());
            $pdf->Ln(5);
        }
        $pdf->Ln(30);
        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(120);
        $tva=$data->getPrice() - round(($data->getPrice()/1.21),2). ' EUR';
        $pdf->Cell(50,10,'HTVA:'.($data->getPrice()-$tva). ' EUR');
        $pdf->Ln(5);
        $pdf->Cell(120);
        $pdf->Cell(50,10,'TVA 21%:'.$tva);
        $pdf->Ln(5);
        $pdf->Cell(120);
        $pdf->Cell(50,10,'TOTAL :'.$data->getPrice(). ' EUR');
        return new Response($pdf->Output(), 200, array(
            'Content-Type' => 'application/pdf'));
})->bind('pdf');

// Dashboard client
$app->get('/compte/edit/email/{newEmail}', function ($newEmail) use ($app){
    
    $token = $app['security.token_storage']->getToken();
    if (null !== $token) {
        $user = $token->getUser();
    }
    $commandes = $app['dao.commande']->findByUser($user->getId());
    $user = $app['dao.user']->find($user->getId());
    $user->setEmail($newEmail);
    $user->setUsername($newEmail);
    $app['dao.user']->editUser($user);
    $app['security.token_storage']->getToken()->getUser()->setUsername($newEmail);
})->bind('editEmail');

// Dashboard client
$app->get('/compte/edit/tel/{newTel}', function ($newTel) use ($app){
    
    $token = $app['security.token_storage']->getToken();
    if (null !== $token) {
        $user = $token->getUser();
    }
    $commandes = $app['dao.commande']->findByUser($user->getId());
    $user = $app['dao.user']->find($user->getId());
    $user->setPhoneNumber($newTel);
    $app['dao.user']->editUser($user);
    
})->bind('editTel');




// Administration page
$app->get('/administration', function () use ($app){
    $pages = $app['dao.pages']->findAll();

    return $app['twig']->render('admin/layout.html.twig', array('pages' => $pages));
})->bind('administration');

// Administration page avec FORM
$app->match('/administration/pages/{id}', function ($id, Request $request) use ($app) {
    $pages = $app['dao.pages']->findAll();
    $page = $app['dao.pages']->find($id);

        $pageForm = $app['form.factory']->create(PageType::class, $page);
        $pageForm->handleRequest($request);
        if ($pageForm->isSubmitted() && $pageForm->isValid()) {
            $app['dao.pages']->save($page);
            $app['session']->getFlashBag()->add('success', 'Your page was successfully edited.');
        }
        $pageFormView = $pageForm->createView();

        return $app['twig']->render('admin/pages.html.twig', array(
            'pages' => $pages,
            'page' => $page, 
            'pageForm' => $pageFormView));

})->bind('administration-pages');

// Administration produits avec FORM
$app->match('/administration/produits', function (Request $request) use ($app) {
    $pages = $app['dao.pages']->findAll();
    $produits = $app['dao.produit']->findAll();
    $colors = $app['dao.color']->findAll();
    $lands = $app['dao.land']->findAll();
    $tastes = $app['dao.taste']->findAll();
    $produit = new Produit();

       $produitForm = $app['form.factory']->create(ProduitType::class, $produit)
       ->add('color', ChoiceType::class, array(
        'choices' => $colors,
        'choice_label' => function($colors, $key, $index) {
            /** @var Category $colors */
            return $colors->getName();
        }))
       ->add('land', ChoiceType::class, array(
            'choices' => $lands,
            'choice_label' => function($lands, $key, $index) {
                /** @var Category $lands */
                return $lands->getName();
            },
            ))
        ->add('taste', ChoiceType::class, array(
                'choices' => $tastes,
                'choice_label' => function($tastes, $key, $index) {
                    /** @var Category $lands */
                    return $tastes->getName();
                },
                ));

       $produitForm->handleRequest($request);
        if ($produitForm->isSubmitted() && $produitForm->isValid()) {
            $file = $produitForm['picture']->getData();
            $extension = $file->guessExtension();
                if (!$extension) {
                    // extension cannot be guessed
                    $extension = 'bin';
                }
                $rand = rand(1, 99999);
                $name =  $rand + '.' + $extension;
                $file->move(__DIR__.'/../web/images/upload/', $name);
                $produit->setPicture($name);
            $app['dao.produit']->save($produit);
            $app['session']->getFlashBag()->add('success', 'Your product was successfully added.');
            return $app->redirect('/administration/produits');
        }
        $produitFormView = $produitForm->createView();

        return $app['twig']->render('admin/produits.html.twig', array(
            'pages' => $pages,
            'produit' => $produit,
            'produits' => $produits,
            'produitForm' => $produitFormView
        ));
})->bind('administration-produits');


//Administration delete product
$app->get('/administration/produits/delete/{id}', function ($id) use ($app){

    $produit = $app['dao.produit']->find($id); 
    $app['dao.produit']->delete($produit);

    return $app->redirect('/administration/produits');
})->bind('product-delete');

// Administration clients
$app->get('/administration/utilisateurs', function () use ($app){
    $pages = $app['dao.pages']->findAll();
    $users = $app['dao.user']->findAll();
    return $app['twig']->render('admin/clients.html.twig', array('pages' => $pages, 'users' =>$users));
})->bind('administration-clients');

// Administration commandes
$app->get('/administration/commandes', function () use ($app){
    $pages = $app['dao.pages']->findAll();
    $commandes = $app['dao.commande']->findAll();

    return $app['twig']->render('admin/commandes.html.twig', array('pages' => $pages, 'commandes' =>$commandes));
})->bind('administration-commandes');

// Add a user
$app->match('/user/add', function(Request $request) use ($app) {
    $user = new User();
    $userForm = $app['form.factory']->create(UserType::class, $user);
    $userForm->handleRequest($request);
    if ($userForm->isSubmitted() && $userForm->isValid()) {
        // generate a random salt value
        $salt = substr(md5(time()), 0, 23);
        $user->setSalt($salt);
        $plainPassword = $user->getPassword();
        // find the default encoder
        $encoder = $app['security.encoder.bcrypt'];
        // compute the encoded password
        $password = $encoder->encodePassword($plainPassword, $user->getSalt());
        $user->setPassword($password); 
        try{
            $app['dao.user']->save($user);
            $app['session']->getFlashBag()->add('success', 'Votre compte a bien été créé, vous pouvez vous connecter.');
        }
        catch(Exception $e){
            $app['session']->getFlashBag()->add('error', 'Erreur de création: Compte existant.');
        }
        
        
    }
    return $app['twig']->render('user_form.html.twig', array(
        'title' => 'Nouveau compte',
        'userForm' => $userForm->createView()));
})->bind('admin_user_add');





