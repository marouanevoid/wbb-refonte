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
        $url  = null;
        $text = '';
        if ($type === 'bar') {
            $bar = $this->get('bar.repository')->findOneById($id);
            $url = $this->get('router')->generate('wbb_share_email_bar_send', array('id' => $id));
            $text = "I just discovered {$bar->getName()} in {$bar->getCity()} \nthanks to www.worldsbestbars.com – the ultimate resource for the best bars in the world.";
        } elseif ($type === 'news') {
            $news = $this->get('news.repository')->findOneById($id);
            $url = $this->get('router')->generate('wbb_share_email_news_send', array('id' => $id));
            $text = "I just read this on World’s Best Bars: {$news->getTitle()} - the ultimate resource for the best bars in the world ";
        } else {
            $bestof = $this->get('bestof.repository')->findOneById($id);
            $url = $this->get('router')->generate('wbb_share_email_bestof_send', array('id' => $id));

            if ($bestof->getCity()) {
                $text = "I just discovered the best {$bestof->getName()} bars in {$bestof->getCity()} thanks to www.worldsbestbars.com – the ultimate resource for the best bars in the world.";
            } else {
                $text = "I just discovered the best {$bestof->getName()} bars thanks to www.worldsbestbars.com – the ultimate resource for the best bars in the world.";
            }
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
        } else {
            return new JsonResponse(array('code' => 400, 'errors' => $this->validateForm($form)));
        }
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
        } else {
            return new JsonResponse(array('code' => 400, 'errors' => $this->validateForm($form)));
        }
    }

    public function shareBestofAction($id, Request $request)
    {
        $form = $this->createForm(new ShareFormType(), null, array('id' => $id));
        $form->submit($request);

        if ($form->isValid()) {
            $data = array(
                'fullName'  => $form["firstName"]->getData().' '.$form["lastName"]->getData(),
                'bestof'      => $this->get('bestof.repository')->findOneById($form["id"]->getData()),
                'email'     => $form["emailTo"]->getData(),
                'message'   => $form["content"]->getData()
            );

            $this->get('wbb_bar.share.mailer')->sendShareBestof($data);

            return $this->render('WBBBarBundle:Share:share_done.html.twig');
        } else {
            return new JsonResponse(array('code' => 400, 'errors' => $this->validateForm($form)));
        }
    }

    private function validateForm($form)
    {
        $formErrors = null;
        $formErrors = $this->container->get('validator')->validate($form, array('Default'));

        $fields = array();
        $messages = array();

        foreach ($formErrors as $formError) {
            $field = str_replace('data.', '', $formError->getPropertyPath());
            $field = str_replace('data[', '', $field);
            $field = str_replace('children[', '', $field);
            $field = str_replace(']', '', $field);
            $fields[] = $field;
            if ($formError->getMessage() == 'not.blank' && !in_array('Please complete all required fields', $messages)) {
                $messages[] = 'Please complete all required fields';
            } elseif ($formError->getMessage() == 'Please enter a valid email address' && !in_array($formError->getMessage(), $messages)) {
                $messages[] = $formError->getMessage();
            }
        }

        return array(
            'fields' => $fields,
            'messages' => $messages
        );
    }
}
