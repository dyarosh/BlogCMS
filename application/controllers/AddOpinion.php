<?php
/**
 * Created by JetBrains PhpStorm.
 * User: dmitriy
 * Date: 05.04.12
 * Time: 23:46
 * To change this template use File | Settings | File Templates.
 */
namespace application\controllers;
Class AddOpinion extends \library\PageController
{
    private $error = array();
    private $message = array();
    private $view = "AddOpinion.phtml";
    private $data = array();

    function process()
    {
        try {
            $request = $this->getRequest();
            if(!is_null($request->getProperty('submitted'))&&$request->getProperty('submitted')=='yes')
            {
                $data['title'] = $request->getProperty('title');
                if(empty($_POST['title'])) {
                    $this->error[] = "Введіть заголовок";
                }
                $data['author'] = $request->getProperty('author');
                if(empty($_POST['author'])) {
                    $this->error[] = "Введіть Ваше ім’я";
                }
                $data['email'] = $request->getProperty('email');
                if(empty($_POST['email'])) {
                    $this->error[] = "Введіть адрес електроної пошти";
                }
                $data['text'] = $request->getProperty('text');
                if(empty($_POST['text'])) {
                    $this->error[] = "Введіть текст думки";
                }
                $data['type'] = $request->getProperty('type');

                if(count($this->error) == 0)
                {
                    $opinion = new \application\model\Opinion();
                    if($opinion->add_opinion($data['title'], $data['author'], $data['email'], $data['text'], $data['type'])) {
                        $this->message[] = ("Ваша думка успішно отримана, та буде опублікована після перевірки модератором");
                        $this->view = 'ListOpinion.phtml';
                    } else {
                        $this->error[] = "Помилка запису. Попробуйте ще раз!";
                    }
                }
            }
        } catch (\Exception $e) {
            $this->error[] = "Помилка запису. Попробуйте ще раз!";
            echo $e;
        }
        return array('message' => $this->message, 'error' => $this->error, 'view' => $this->view);
    }
}