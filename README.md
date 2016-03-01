Проверка стиля кодирования ArtSkills на основе PHP Mess Detector
================================================================

Установка
---------
Заходим в корень ветки и запускаем:
`php install.php`

Настройка PhpStorm
------------------

* Languages & Frameworks -> PHP - настраиваем PHP Interpreter (локальный)
* Languages & Frameworks -> PHP -> Mess Detector -> Configuration "Local" - указываем путь к phpdm: "vendor/bin/phpmd"
* Editor -> Inspections -> PHP Mess Detector Validation - активируем, снимаем все галки и подключаем custom rulesets: "src/rules.xml"
