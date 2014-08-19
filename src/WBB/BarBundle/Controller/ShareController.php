<?php

namespace WBB\BarBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use WBB\BarBundle\Form\Email\ShareFormType;

class ShareController extends Controller
{
    public function shareFormAction($id, $type)
    {
        $form = $this->createForm(new ShareFormType(), null, array('id' => $id));
        $url = null;
        $text = '';
        if($type==='bar'){
            $url = $this->get('router')->generate('wbb_share_email_bar_send', array('id' => $id));
            $bar = $this->get('bar.repository')->findOneById($id);
            $text = "I just discovered {$bar->getName()} in {$bar->getCity()} \nthanks to www.worldsbestbars.com – the ultimate resource for the best bars in the world.";
        }else{
            $url = $this->get('router')->generate('wbb_share_email_news_send', array('id' => $id));
            $news = $this->get('news.repository')->findOneById($id);
            $text = "I just read this on World’s Best Bars: {$news->getTitle()} - the ultimate resource for the best bars in the world ";
        }

        return $this->render('WBBBarBundle:Share:share_form.html.twig', array(
            'form'  => $form->createView(),
            'url'   => $url,
            'text'  => $text
        ));
    }

    public function shareBarAction($id, Request $request)
    {
        $form = $this->createForm(new ShareFormType(), null, array('id' => $id));
        $form->submit($request);

        if ($form->isValid()) {
            $data = array(
                'fullName'  => $form["firstName"]->getData().' '.$form["lastName"]->getData(),
                'bar'       => $this->get('bar.repository')->findOneById($form["id"]->getData()),
                'email'     => $form["emailTo"]->getData(),
                'message'   => $form["content"]->getData()
            );

            $this->get('wbb_bar.share.mailer')->sendShareBar($data);
            return $this->render('WBBBarBundle:Share:share_done.html.twig');
        }

        return $this->render('WBBBarBundle:Share:share_form.html.twig', array(
            'form'  => $form->createView(),
            'url'   => $this->get('router')->generate('wbb_share_email_bar_send', array('id' => $id))
        ));
    }

    public function shareNewsAction($id, Request $request)
    {
        $form = $this->createForm(new ShareFormType(), null, array('id' => $id));
        $form->submit($request);

        if ($form->isValid()) {
            $data = array(
                'fullName'  => $form["firstName"]->getData().' '.$form["lastName"]->getData(),
                'news'      => $this->get('news.repository')->findOneById($form["id"]->getData()),
                'email'     => $form["emailTo"]->getData(),
                'message'   => $form["content"]->getData()
            );

            $this->get('wbb_bar.share.mailer')->sendShareNews($data);
            return $this->render('WBBBarBundle:Share:share_done.html.twig');
        }

        return $this->render('WBBBarBundle:Share:share_form.html.twig', array(
            'form'  => $form->createView(),
            'url'   => $this->get('router')->generate('wbb_share_email_news_send', array('id' => $id))
        ));
    }
}
