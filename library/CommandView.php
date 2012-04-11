<?php
/**
 * Статистика сервиса онлайн-заказов
 * @category utr.ua
 * @author Ярошевич Д.А. <yaroshevich@utr.ua>
 * @copyright "ЮникТрейд" 1994-2012
 */

/**
 * @namespace
 */
namespace library;
/**
 * Класс представления отчета
 *
 * @uses \library\Template
  * @category utr.ua
 * @package library
 */
class CommandView extends Template
{
    function __construct($view) {
        $this->setPath('../application/views/');
        $this->setName($view);
    }

    function assign($array) {
        foreach($array as $key=>$value) {
            $this->addVar($key, $value);
        }
        return true;
    }
}
