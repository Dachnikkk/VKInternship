# VKInternship
Алгоритм для конвертации цифрового представления времени в словесное

Напишите алгоритм для конвертации цифрового представления времени в словесное.
Входные данные - два целых числа, первое обозначает час (от 1 до 12), второе количество минут (от 0 до 59).
Выходные данные - строка с описанием времени соответствующая следующему шаблону:

7:00 - Семь часов.<br>
7:01 - Одна минута после семи.<br>
7:03 - Три минуты после семи.<br>
7:12 - Двенадцать минут после семи.<br>
7:15 - Четверть восьмого.<br>
7:22 - Двадцать две минуты после семи.<br>
7:30 - Половина восьмого.<br>
7:35 - Двадцать пять минут до восьми.<br>
7:41 - Девятнадцать минут до восьми.<br>
7:56 - Четыре минуты до восьми.<br>
7:59 - Одна минута до восьми.<br>

Используйте PHP версии 7.4.<br>
Алгоритм оформите в виде класса TimeToWordConverter реализующего интерфейс:<br>
interface TimeToWordConvertingInterface<br>
{<br>
    public function convert(int $hours, int $minutes): string;<br>
}<br>

Загрузите решение в репозиторий на github/gitlab/bitbucket и приложите ссылку на него в ответ. Не забудьте разрешить доступ.
