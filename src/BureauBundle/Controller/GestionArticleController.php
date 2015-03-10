<?php

namespace BureauBundle\Controller;

use BureauBundle\Entity\Article;
use BureauBundle\Entity\Secretariat;
use BureauBundle\Form\ArticleType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Translation\Tests\String;

class GestionArticleController extends Controller
{
    public function homeAction(){ return $this->render('BureauBundle:Tes:home.html.twig', array());}
    public function avoirtousAction()
    {
        $em = $this->getDoctrine()->getManager()->getRepository('BureauBundle:Article');
        $em->find();
        $resultat = $em;

        return $this->render('BureauBundle:Tes:Tous.html.twig',array('Articles' => $resultat) );
    }
    public function EditerAction( Request $request)
    {
        $article = new Article();
        $form = $this->createForm(new ArticleType(), $article);


            $form->handleRequest($request);
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($article);
                $em->flush();
                return $this->redirect($this->generateUrl('bureau_homepage'));
            }

        return $this->render('BureauBundle:tes:ajouter.html.twig', array(
            'formulaire' => $form->createView()
        ));


    }
    public function SupprimeAction ( Article $article, Request $request){

        $form = $this->createFormBuilder()->getForm();

        if($request->getMethod()== 'POST'){
            $form->handleRequest($request);
            if($form->isValid()){
                $em = $this->getDoctrine()->getManager();
                $em->remove( $article);
                $em->flush();

                $this->get('session')->getFlashBag()->add('info', 'Article bien supprimé');

                return $this->redirect($this->generateUrl('bureau_homepage'));
            }
        }
        return $this->render('BureauBundle:tes:suprim.html.twig',
            array(
                'article' => $article,
                'form'    => $form->createView()
            ));


    }
    public function modifiAction( Article $article, Request $request){
        $form = $this->createForm( new ArticleType(), $article);
        if( $request->getMethod() == 'POST'){
            $form->handleRequest($request);
            if( $form->isValid()){
                $em = $this->getDoctrine()->getManager();
                $em->persist( $article);
                $em->flush();
                $this->get('session')->getFlashBag()->add('info', 'Article bien Modifier');

                return $this->redirect($this->generateUrl('bureau_homepage'));

            }

        }
        return $this->render('BureauBundle:tes:modif.html.twig',
            array(
                'article' => $article,
                'form'    => $form->createView()
            ));

    }
    public  function SecratArtAction (  $str){

        $query = $this->getDoctrine()->getManager()->getRepository('BureauBundle:Article');
        $listarticle = $query->findBy(array('Secretariat'=> $str), array('date' => 'Desc'));;
            return $listarticle;

    }
    public function showarticleAction ( $id){
        $query = $this->getDoctrine()->getManager()->getRepository('BureauBundle:Article');
        $query->find($id);

        $resultat = $query;
        return $resultat;
    }


}
