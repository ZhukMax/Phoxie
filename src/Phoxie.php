<?php

namespace Zhukmax\Phoxie;

use Zhukmax\Phoxie\Exceptions\PhoxieException;

/**
 * Class Phoxie
 *
 * Основной класс работы с API
 *
 * @package Zhukmax\Phoxie
 */
class Phoxie
{

    /**
     * Создаём новый экземпляр шаблонного приложения
     */
    public function __construct()
    {
    }

    /**
     * Дружелюбное приветствие
     *
     * @param string $phrase Возвращаемая фраза
     *
     * @return string Возвращает переданную фразу
     */
    public function echoPhrase($phrase)
    {
        return $phrase. '<br>Тест прошел успешно!';
    }
}