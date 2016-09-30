<?php
namespace Zhukmax\Phoxie;

class SkeletonClass
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