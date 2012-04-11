<?php
/**
 * Created by JetBrains PhpStorm.
 * User: dmitriy
 * Date: 11.04.12
 * Time: 1:30
 * To change this template use File | Settings | File Templates.
 */
namespace application\controllers;
class ListOpinion extends \library\PageController
{
    function process()
    {
        $opinion = new \application\model\Opinion();
        $list = $opinion->list_opinions();
        return array('opinions' => $list, 'view'=>'ListOpinion.phtml');
    }
}
