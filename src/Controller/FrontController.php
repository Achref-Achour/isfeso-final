<?php

namespace App\Controller;
use App\Entity\Newsletter;
use App\Entity\Adhesion;
use App\Entity\Formation;
use App\Entity\ContactIsfeso;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;

class FrontController extends AbstractController
{
    
   
    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        return $this->render('front/index.html.twig');
    }
    



    /**
     * @Route("/OEFS", name="oefs")
     */
    public function Oefs()
    {
        return $this->render('front/oefs.html.twig');
    }

       /**
     * @Route("/Charte-ISFESO", name="charte_isfeso")
     */
    public function charteI()
    {
        return $this->render('front/charte.html.twig');
    }


    /**
     * @Route("/Charte-Orthodontistes", name="charte_ortho")
     */
    public function charteOrth()
    {
        return $this->render('front/charte-ortho.html.twig');
    }


    /**
     * @Route("/formations", name="Formations")
     */
    public function Formations()
    {
        return $this->render('front/Formation.html.twig');
    }


    /**
     * @Route("/Charte-Membres", name="charte_membres")
     */
    public function charteMembres()
    {
        return $this->render('front/charte-membre.html.twig');
    }



    /**
     * @Route("/Contact", name="contact")
     */
    public function Contact(\Swift_Mailer $mailer, Request $request)
    {$recaptcha_response=$request->request->get('recaptcha_response');

        if ($request->isMethod('POST') && isset($recaptcha_response)) {
            $recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
            $recaptcha_secret = '6Ld9ae0UAAAAAMnof8Fnl-JVesLzvXgfFbgNlZ8I';
            $recaptcha = file_get_contents($recaptcha_url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response);
            $recaptcha = json_decode($recaptcha);
            // dd($recaptcha);
            // if($Return->success == true && $Return->score > 0.5){
            if ($recaptcha->success == true && $recaptcha->score >= 0.5) {
                $nom = $request->request->get('nom');
                $prenom =  $request->request->get('prenom');
                $mail = $request->request->get('email');
                $tel = $request->request->get('tel');
                $sujet = $request->request->get('sujet');
                
                if($nom != null && $prenom != null && $mail!= null && $tel!= null && $sujet != null){
    
                    $entityManager = $this->getDoctrine()->getManager();
    
                    $contact = new ContactIsfeso();
                    $contact->setNom($nom)
                            ->setPrenom($prenom)
                            ->setEmail($mail)
                            ->setTel($tel)
                            ->setSujet($sujet)
                            ->setCreatedAt(new \DateTime('now'));
    
                    // tell Doctrine you want to (eventually) save the Product (no queries yet)
                    $entityManager->persist($contact);
                    // actually executes the queries (i.e. the INSERT query)
                    $entityManager->flush();
    
                    $message = (new \Swift_Message('Contact Isfeso'))
                    ->setFrom('noreply@basmiletech.com')
                    ->setTo('contact@isfeso.com')
                    ->setBcc('achref@basmiletech.com')
                    ->setBody($sujet.'<br><b>Nom: </b>'.$nom.'<br><b>prenom: </b>'.$prenom.'<br> <b>Mail: </b> '.$mail.'<br><b>Tél: </b>'.$tel, 'text/html');
                    
                    $mailer->send($message);
                    
                    $this->addFlash('success', 'Votre demande a  été envoyé avec succés,  notre équipe vous contactera le plutôt possible');
    
                }else{
    
                    $this->addFlash('success1', 'Veuillez vérifier les champs de formulaire');
                    return $this->render('front/contact.html.twig');
    
                }
            } 
            else {
                $this->addFlash('success1', 'Vous êtes un robot');
                    return $this->render('front/contact.html.twig');
                   }

         }
         
         return $this->render('front/contact.html.twig');

    

    }


    /**
     * @Route("/Arcade-Etroites", name="arcade_etroite")
     */
    public function ArcadeEtroites()
    {
        return $this->render('galerie/arcade-etroites.html.twig');
    }



    /**
     * @Route("/Articule-Inverse", name="articule_inverse")
     */
    public function ArticuleInverse()
    {
        return $this->render('galerie/articule-inverse.html.twig');
    }



    /**
     * @Route("/Beance", name="beance")
     */
    public function Beance()
    {
        return $this->render('galerie/beance.html.twig');
    }



    /**
     * @Route("/Chevauchement-haut", name="chevauchement_haut")
     */
    public function ChevauchementHaut()
    {
        return $this->render('galerie/chevauchement.html.twig');
    }



    /**
     * @Route("/Chevauchement-bas", name="chevauchement_bas")
     */
    public function ChevauchementBas()
    {
        return $this->render('galerie/chevauchement-bas.html.twig');
    }



    /**
     * @Route("/Chirurgie", name="chirurgie")
     */
    public function Chirurgie()
    {
        return $this->render('galerie/chirurgie.html.twig');
    }



    /**
     * @Route("/DentsArriere", name="DentsArriere")
     */
    public function DentsArriere()
    {
        return $this->render('galerie/dents-arriere.html.twig');
    }



    /**
     * @Route("/DentsAvant", name="DentsAvant")
     */
    public function DentsAvant()
    {
        return $this->render('galerie/dents-avant.html.twig');
    }



    /**
     * @Route("/DentsEcartees", name="DentsEcartees")
     */
    public function DentsEcartees()
    {
        return $this->render('galerie/dents-ecartees.html.twig');
    }



    /**
     * @Route("/DentsIncluses", name="DentsIncluses")
     */
    public function DentsIncluses()
    {
        return $this->render('galerie/dents-incluses.html.twig');
    }



    /**
     * @Route("/Disjonction", name="Disjonction")
     */
    public function Disjonction()
    {
        return $this->render('galerie/disjonction.html.twig');
    }



    /**
     * @Route("/Esthetique", name="esthetique")
     */
    public function Esthetique()
    {
        return $this->render('galerie/esthetique.html.twig');
    }



    /**
     * @Route("/Parodontie", name="Parodontie")
     */
    public function Parodontie()
    {
        return $this->render('galerie/parodontie.html.twig');
    }



    /**
     * @Route("/Regles-Appareillage", name="regle-appareillage")
     */
    public function RegleAppareillage()
    {
        return $this->render('front/regle-appareillage.html.twig');
    }



    /**
     * @Route("/Rcc", name="rcc")
     */
    public function Rcc()
    {
        return $this->render('front/rcc.html.twig');
    }



    /**
     * @Route("/Aligneurs", name="aligneurs")
     */
    public function Aligneurs()
    {
        return $this->render('front/aligneurs.html.twig');
    }



    /**
     * @Route("/Adhesion", name="adhesion")
     */
    public function Adhesion(\Swift_Mailer $mailer, LoggerInterface $logger, Request $request)
    {$recaptcha_response=$request->request->get('recaptcha_response');

        if ($request->isMethod('POST') && isset($recaptcha_response)) {
            $recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
            $recaptcha_secret = '6Ld9ae0UAAAAAMnof8Fnl-JVesLzvXgfFbgNlZ8I';
            $recaptcha = file_get_contents($recaptcha_url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response);
            $recaptcha = json_decode($recaptcha);
            // dd($recaptcha);
            // if($Return->success == true && $Return->score > 0.5){
                if ($recaptcha->success == true && $recaptcha->score >= 0.5) {
                $nom = $request->request->get('nom');
                $prenom =  $request->request->get('prenom');
                $sexe = $request->request->get('sexe');
                $pays= $request->request->get('pays');
                $mail = $request->request->get('email');
                $tel = $request->request->get('tel');
                $adresse = $request->request->get('adresse');
                
                        if($nom != null && $prenom != null && $mail!= null && $tel!= null && $adresse != null && $sexe != null && $pays != null ){

                            $entityManager = $this->getDoctrine()->getManager();

                            $adhesion = new Adhesion();
                            $adhesion->setNom($nom)
                                    ->setPrenom($prenom)
                                    ->setEmail($mail)
                                    ->setTelephone($tel)
                                    ->setAdresse($adresse)
                                    ->setPays($pays)
                                    ->setSexe($sexe)
                                    ->setDate(new \DateTime('now'));

                            // tell Doctrine you want to (eventually) save the Product (no queries yet)
                            $entityManager->persist($adhesion);
                            // actually executes the queries (i.e. the INSERT query)
                            $entityManager->flush();

                            $message = (new \Swift_Message('Adhésion Isfeso'))
                                ->setFrom('noreply@basmiletech.com')
                                ->setTo(['contact@isfeso.com','yossra@basmiletech.com'])
                                ->setBcc('achref@basmiletech.com')
                                ->setBody('<br><b>Nom: </b>'.$nom.'<br><b>prenom: </b>'.$prenom.'<br> <b>Mail: </b> '.$mail.'<br><b>Tél: </b>'.$tel.'<br><b>Adresse: </b>'.$adresse.'<br><b>Pays: </b>'.$pays.'<br><b>Sexe: </b>'.$sexe, 'text/html');
                                
                                $mailer->send($message);
                            
                            $this->addFlash('success', 'Vos données sont bien enregistrer' );
                            return $this->redirect("https://www.mypos.eu/vmp/btn/BGQN5WKXXS461", 301);
                            // return $this->render('front/adhesionpaiement.html.twig');
                        }
                        else{

                            $this->addFlash('success1', 'Veuillez vérifier les champs de formulaire');
                            return $this->render('front/adhesion.html.twig');
                        }
                    }
                else {
                    $this->addFlash('success1', 'Vous êtes un robot');
                        return $this->render('front/contact.html.twig');
                    }
        

         }

        return $this->render('front/adhesion.html.twig');
    }



    /**
     * @Route("/Articles", name="articles")
     */
    public function Articles()
    {
        return $this->render('front/articles.html.twig');
    }



    /**
     * @Route("/Newsletter", name="newsletter")
     */
    public function Newsletter(Request $request)
    {
        if ($request->isMethod('POST')) {
            
            $mail = $request->request->get('newsletter');
           
            
            if($mail!= null ){

                $entityManager = $this->getDoctrine()->getManager();

                $newsletter = new Newsletter();
                $newsletter->setEmail($mail)
                           ->setDat(new \DateTime('now'));

                $entityManager->persist($newsletter);
                $entityManager->flush();

                
                $this->addFlash('success', 'Vous êtes maintenant inscrit sur la liste de la Newsletter');
                
            }
            else{

                $this->addFlash('success1', 'Veuillez vérifier votre E-mail');
                
                return $this->redirect('/#newsletter', 308);

            }}
            return $this->redirect('/#newsletter', 308);
    }



    /**
     * @Route("/Diagnostique", name="diagnostique")
     */
    public function Diagnostique()
    {
        return $this->render('front/diagnostique.html.twig');
    }

 /**
     * @Route("/Inscription-Formation", name="InscriptionFormation")
     */
    public function InscriptionFormation(\Swift_Mailer $mailer,LoggerInterface $logger, Request $request)
    {$recaptcha_response=$request->request->get('recaptcha_response');

        if ($request->isMethod('POST') && isset($recaptcha_response)) {
            $recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
            $recaptcha_secret = '6Ld9ae0UAAAAAMnof8Fnl-JVesLzvXgfFbgNlZ8I';
            $recaptcha = file_get_contents($recaptcha_url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response);
            $recaptcha = json_decode($recaptcha);
            // dd($recaptcha);
            // if($Return->success == true && $Return->score > 0.5){
            if ($recaptcha->success == true && $recaptcha->score >= 0.5) {
                // dd($request->request);
                $nom = $request->request->get('nom');
                $prenom =  $request->request->get('prenom');
                $mail = $request->request->get('email');
                $tel = $request->request->get('tel');
                $profession = $request->request->get('profession');
                $pays = $request->request->get('pays');
                $Ville = $request->request->get('Ville');
                $codepostale = $request->request->get('codepostale');
                $adresse = $request->request->get('adresse');
                $formation = $request->request->get('formation');
                if($nom != null && $prenom != null && $mail!= null && $tel!= null && $profession != null && $pays != null && $Ville != null && $codepostale != null && $adresse != null && $formation != null ){
    
                    $entityManager = $this->getDoctrine()->getManager();
    
                    $formation = new Formation();
                    $formation->setNom($nom)
                            ->setPrenom($prenom)
                            ->setEmail($mail)
                            ->setTel($tel)
                            ->setProfession($profession)
                            ->setPays($pays)
                            ->setVille($Ville)
                            ->setCodepostale($codepostale)
                            ->setAdresse($adresse)
                            ->setFormation($request->request->get('formation'))
                            ->setDate(new \DateTime('now'));
    
                    // tell Doctrine you want to (eventually) save the Product (no queries yet)
                    $entityManager->persist($formation);
                    // actually executes the queries (i.e. the INSERT query)
                    $entityManager->flush();
    
                    $message = (new \Swift_Message('Formation Isfeso'))
                    ->setFrom('noreply@basmiletech.com')
                    ->setTo('formation@basmile.com')
                    ->setBody(
                        '<b>Je suis un :</b>'.$profession.'<br><b>Nom: </b>'.$nom.'<br><b>prenom: </b>'.$prenom.'<br> <b>Mail: </b> '.$mail.'<br><b>Tél: </b>'.$tel.'<br><b>Pays: </b>'.$pays.'<br><b>Ville: </b>'.$Ville.'<br><b>Code postal: </b>'.$codepostale.'<br><b>Adresse: </b>'.$adresse.'<br><b>Formation: </b>'.$request->request->get('formation'), 'text/html');
                    
                    $mailer->send($message);
                    
                    $this->addFlash('success', 'Votre demande a  été envoyé avec succés,  notre équipe vous contactera le plutôt possible');
    
                }else{
    
                    $this->addFlash('success1', 'Veuillez vérifier les champs de formulaire');
                    return $this->render('front/InscriptionFormation.html.twig');
    
                }
            } 
            else {
                $this->addFlash('success1', 'Vous êtes un robot');
                    return $this->render('front/InscriptionFormation.html.twig');
                   }

         }
         
         return $this->render('front/InscriptionFormation.html.twig');

    

    }
   

}