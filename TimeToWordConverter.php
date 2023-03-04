<?php

require_once 'TimeToWordConvertingInterface.php';

/**
 * Напишите алгоритм для конвертации цифрового представления времени в словесное.
 * Входные данные - два целых числа, первое обозначает час (от 1 до 12), второе количество минут (от 0 до 59).
 * Выходные данные - строка с описанием времени соответствующая следующему шаблону:
 *
 * 7:00 - Семь часов.
 * 7:01 - Одна минута после семи.
 * 7:03 - Три минуты после семи.
 * 7:12 - Двенадцать минут после семи.
 * 7:15 - Четверть восьмого.
 * 7:22 - Двадцать две минуты после семи.
 * 7:30 - Половина восьмого.
 * 7:35 - Двадцать пять минут до восьми.
 * 7:41 - Девятнадцать минут до восьми.
 * 7:56 - Четыре минуты до восьми.
 * 7:59 - Одна минута до восьми.
 *
 * Используйте PHP версии 7.4.
 */

/**
 * Class TimeToWordConverter.
 * Класс, который реализует интерфейс TimeToWordConvertingInterface и предоставляет функционал перевода
 * времени из числового формата в словесный вид на русском языке.
 */
class TimeToWordConverter implements TimeToWordConvertingInterface
{
    const ENDING_TYPE_MINUTE = 1;
    const ENDING_TYPE_HOUR = 2;

    /**
     * Метод, который принимает на вход два параметра - $hours и $minutes,
     * соответствующие количеству часов и минут, и возвращает строку, содержащую словесное описание времени.
     *
     * @param int $hours - Количество часов в диапазоне от 1 до 12.
     * @param int $minutes - Количество минут в диапазоне от 0 до 59.
     *
     * @return string - Текстовое представление времени
     */
    function convert(int $hours, int $minutes): string
    {
        assert($hours <= 12, 'Некорректный ввод времени.');
        assert($hours >= 1, 'Некорректный ввод времени.');

        assert($minutes <= 59, 'Некорректный ввод времени.');
        assert($minutes >= 0, 'Некорректный ввод времени.');


        if ($hours < 1 || $hours > 12 || $minutes < 0 || $minutes > 59) {
            return 'Некорректный ввод времени.';
        }

        $nextHour = ($hours == 12) ? 1 : $hours + 1;
        $nextHourWord = $this->numberToWords($nextHour, "extra");
        $hourWord = ($minutes == 59) ? $nextHourWord : $this->numberToWords($hours, "genitive");

        $minuteWord = $this->numberToWords($minutes, "extraNominative");
        $minuteEnding = $this->getMinuteAndHourEnding($minutes, $this::ENDING_TYPE_MINUTE);

        if ($minutes == 0) {
            $hourEnding = $this->getMinuteAndHourEnding($hours, $this::ENDING_TYPE_HOUR);
            return sprintf("%s час%s", $this->numberToWords($hours, "nominative"), $hourEnding);
        }

        if ($minutes == 15) {
            return sprintf("четверть %s", $nextHourWord);
        }

        if ($minutes == 30) {
            return sprintf("половина %s", $nextHourWord);
        }

        if ($minutes == 45) {
            return sprintf("без пятнадцати %s", $this->numberToWords($nextHour, "nominative"));
        }

        if ($minutes == 1 || $minutes == 59) {
            $format = ($minutes == 1) ? "одна минута после %s" : "одна минута до %s";
            return sprintf($format, ($minutes == 1) ? $hourWord : $this->numberToWords($nextHour, "genitive"));
        }

        if ($minutes > 30) {
            $hourWord = $this->numberToWords($nextHour, "genitive");
            $minutesUntil = 60 - $minutes;
            $minuteWord = $this->numberToWords($minutesUntil, "extraNominative");
            $minuteEnding = $this->getMinuteAndHourEnding($minutesUntil, $this::ENDING_TYPE_MINUTE);
            return sprintf("%s минут%s до %s", $minuteWord, $minuteEnding, $hourWord);
        }

        return sprintf("%s минут%s после %s", $minuteWord, $minuteEnding, $hourWord);
    }


    /**
     *  Метод, который принимает на вход число и тип (род) слова и возвращает окончание для данного числа и типа слова.
     *
     * @param int $number - Число, для которого нужно получить окончание.
     * @param string $type - Тип слова (hour - для часов, minutes - для минут).
     *
     * @return string - Окончание для данного числа и типа слова.
     */
    private function getMinuteAndHourEnding(int $number, int $type): string
    {
        $lastDigit = $number % 10;
        $lastTwoDigits = $number % 100;

        if ($lastTwoDigits >= 11 && $lastTwoDigits <= 14) {
            return $type == $this::ENDING_TYPE_MINUTE ? 'ов' : '';
        } elseif ($lastDigit == 1) {
            return 'а';
        } elseif ($lastDigit >= 2 && $lastDigit <= 4) {
            return $type == $this::ENDING_TYPE_HOUR ? 'ов' : 'ы';
        } else {
            return $type == $this::ENDING_TYPE_HOUR ? 'ов' : '';
        }
    }

    /**
     * Метод, который принимает на вход число и тип (род) слова и возвращает слово-представление числа.
     *
     * @param int $num - Число, которое необходимо преобразовать в словесную форму.
     * @param string $caseName - Род слова (nominative - именительный, genitive - родительный, extra - дополнительный,
     * extraNominative - именительный родительный для чисел 1-19).
     *
     * @return string - Слово-представление числа в соответствующей форме.
     */
    private function numberToWords(int $num, string $caseName): string
    {
        $ones = [
            'nominative' => ['один', 'два', 'три', 'четыре', 'пять', 'шесть', 'семь', 'восемь', 'девять', "десять", 'одиннадцать', 'двенадцать', 'тринадцать', 'четырнадцать', 'пятнадцать', 'шестнадцать', 'семнадцать', 'восемнадцать', 'девятнадцать'],
            'genitive' => ['первого', 'двух', 'трех', 'четырех', 'пяти', 'шести', 'семи', 'восьми', 'девяти', "десяти", 'одиннадцати', 'двенадцати', 'тринадцати', 'четырнадцати', 'пятнадцати', 'шестнадцати', 'семнадцати', 'восемнадцати', 'девятнадцати'],
            'extra' => ['первого', 'второго', 'третьего', 'четвертого', 'пятого', 'шестого', 'седьмого', 'восьмого', 'девятого', "десятого", 'одиннадцатого', 'двенадцатого'],
            'extraNominative' => ['одна', 'две', 'три', 'четыре', 'пять', 'шесть', 'семь', 'восемь', 'девять', "десять", 'одиннадцать', 'двенадцать', 'тринадцать', 'четырнадцать', 'пятнадцать', 'шестнадцать', 'семнадцать', 'восемнадцать', 'девятнадцать'],
        ];
        $tens = [
            'nominative' => ['десять', 'двадцать', 'тридцать', 'сорок', 'пятьдесят', 'шестьдесят'],
            'genitive' => ['десяти', 'двадцати', 'тридцати', 'сорока', 'пятидесяти', 'шестидесяти'],
            'extra' => ['десятого'],
            'extraNominative' => ['десять', 'двадцать', 'тридцать', 'сорок', 'пятьдесят', 'шестьдесят'],
        ];

        if ($num < 1 || $num > 60) {
            return 'Число вне диапазона';
        }

        if ($num <= 9) {

            return $ones[$caseName][$num - 1];
        }

        $tensDigit = floor($num / 10) - 1;
        $onesDigit = $num % 10 - 1;

        if ($num >= 11 && $num <= 19) {
            return $ones[$caseName][$num - 1];
        } elseif ($num % 10 === 0) {
            return $tens[$caseName][$tensDigit];
        } else {
            return $tens[$caseName][$tensDigit] . ' ' . $ones[$caseName][$onesDigit];
        }
    }
}
