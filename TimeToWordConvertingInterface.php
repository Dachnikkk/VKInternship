<?php

/**
   Алгоритм оформите в виде класса TimeToWordConverter реализующего интерфейс:
   interface TimeToWordConvertingInterface
   {
   public function convert(int $hours, int $minutes): string;
   }
 */

/**
 * Интерфейс для конвертации времени в текстовое представление.
 */
interface TimeToWordConvertingInterface
{
    /**
     * Метод, который принимает на вход два параметра - $hours и $minutes,
     * соответствующие количеству часов и минут, и возвращает строку, содержащую словесное описание времени.
     *
     * @param int $hours - Количество часов в диапазоне от 1 до 12.
     * @param int $minutes - Количество минут в диапазоне от 0 до 59.
     *
     * @return string - Текстовое представление времени
     */
    public function convert(int $hours, int $minutes): string;
}