<?php

namespace WBB\BarBundle\Form\Email\Handler;

use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * ShareNewsHandler
 */
class ShareNewsHandler
{
    protected $form;
    protected $request;
    protected $mailer;

    /**
     * __construct
     *
     * @param FormInterface   $form
     * @param Request         $request
     * @param TwigSwiftMailer $mailer
     */
    public function __construct(FormInterface $form, Request $request, $mailer)
    {
        $this->form = $form;
        $this->request = $request;
        $this->mailer = $mailer;
    }

    /**
     * process
     *
     * @param Question $question
     *
     * @return boolean
     */
    public function process($question)
    {
        $data  = array('question' => $question);
        $this->form->setData($data);

        if ('POST' === $this->request->getMethod()) {
            $this->form->bind($this->request);

            if ($this->form->isValid()) {
                $this->onSuccess($this->form->getData());

                return true;
            }
        }

        return false;
    }

    /**
     * onSuccess
     * @param array $data
     */
    protected function onSuccess(array $data)
    {
        $this->mailer->sendSharedEmailMessage($data);
    }
}
