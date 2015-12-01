<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>
    <?/*?><pre>
        <?print_r($arResult);?>
    </pre>

    <div class="main-menu">
        <div class="container row">
            <ul class="menu horizontal-multilevel-menu col">
                <li class="menu-item parent"><a class="menu-link" href="#">строительство и ремонт</a>
                    <ul class="submenu level-2 parent-box">
                    <li class="submenu-item active parent"><a class="submenu-link" href="#">Инструменты</a>
                        <ul class="submenu level-3 parent-box">
                            <li class="submenu-item parent"><a class="submenu-link" href="#">Электроинструменты</a>
                                <ul class="submenu level-4">
                                    <li class="submenu-item"><a class="submenu-link" href="#">Гайковерты</a></li>
                                    <li class="submenu-item"><a class="submenu-link" href="#">Дрели</a></li>
                                    <li class="submenu-item"><a class="submenu-link" href="#">Лобзики</a></li>
                                    <li class="submenu-item"><a class="submenu-link" href="#">Молотки отбойные</a></li>
                                    <li class="submenu-item"><a class="submenu-link" href="#">Перфораторы</a></li>
                                    <li class="submenu-item"><a class="submenu-link" href="#">Электропилы</a></li>
                                    <li class="submenu-item"><a class="submenu-link" href="#">Пылесосы</a></li>
                                    <li class="submenu-item"><a class="submenu-link" href="#">Резаки</a></li>
                                    <li class="submenu-item"><a class="submenu-link" href="#">Рубанки</a></li>
                                    <li class="submenu-item"><a class="submenu-link" href="#">Фрезеры</a></li>
                                    <li class="submenu-item"><a class="submenu-link" href="#">Ножницы</a></li>
                                    <li class="submenu-item"><a class="submenu-link" href="#">Штроборезы</a></li>
                                    <li class="submenu-item"><a class="submenu-link" href="#">Шуроповерты</a></li>
                                    <li class="submenu-item"><a class="submenu-link" href="#">Шлифовальные машины</a></li>
                                    <li class="submenu-item"><a class="submenu-link" href="#">Термовоздуховки</a></li>
                                    <li class="submenu-item"><a class="submenu-link" href="#">Граверы</a></li>
                                    <li class="submenu-item"><a class="submenu-link" href="#">Клеевые пистолеты</a></li>
                                    <li class="submenu-item"><a class="submenu-link" href="#">Мультиинструменты</a></li>
                                    <li class="submenu-item"><a class="submenu-link" href="#">Миксеры</a></li>
                                    <li class="submenu-item"><a class="submenu-link" href="#">Станки</a></li>
                                    <li class="submenu-item"><a class="submenu-link" href="#">Плиткорезы</a></li>
                                    <li class="submenu-item"><a class="submenu-link" href="#">Заточные машины</a></li>
                                </ul>
                            </li>
                            <li class="submenu-item parent"><a class="submenu-link" href="#">Ручные инструменты</a>
                                <ul class="submenu level-4">
                                    <li class="submenu-item"><a class="submenu-link" href="#">Бокорезы (кусачки)</a></li>
                                    <li class="submenu-item"><a class="submenu-link" href="#">Болторезы</a></li>
                                    <li class="submenu-item"><a class="submenu-link" href="#">Клещи</a></li>
                                    <li class="submenu-item"><a class="submenu-link" href="#">Пассатижи (плоскогубцы)</a></li>
                                    <li class="submenu-item"><a class="submenu-link" href="#">Щипцы и зажимы</a></li>
                                    <li class="submenu-item"><a class="submenu-link" href="#">Тонконосы, круглогубцы</a></li>
                                    <li class="submenu-item"><a class="submenu-link" href="#">Заклепочники</a></li>
                                    <li class="submenu-item"><a class="submenu-link" href="#">Механические степлеры</a></li>
                                    <li class="submenu-item"><a class="submenu-link" href="#">Ножи и лезвия</a></li>
                                    <li class="submenu-item"><a class="submenu-link" href="#">Труборезы</a></li>
                                    <li class="submenu-item"><a class="submenu-link" href="#">Стеклорезы</a></li>
                                    <li class="submenu-item"><a class="submenu-link" href="#">Рубанки</a></li>
                                    <li class="submenu-item"><a class="submenu-link" href="#">Плиткорезы</a></li>
                                    <li class="submenu-item"><a class="submenu-link" href="#">Ножницы</a></li>
                                    <li class="submenu-item"><a class="submenu-link" href="#">Метчки и плашки, клуппы</a></li>
                                    <li class="submenu-item"><a class="submenu-link" href="#">Гвоздодёры, ломы, монтировки</a></li>
                                    <li class="submenu-item"><a class="submenu-link" href="#">Долота, долота-стамески</a></li>
                                    <li class="submenu-item"><a class="submenu-link" href="#">Зубила</a></li>
                                    <li class="submenu-item"><a class="submenu-link" href="#">Киянки</a></li>
                                    <li class="submenu-item"><a class="submenu-link" href="#">Топоры, колуны</a></li>
                                    <li class="submenu-item"><a class="submenu-link" href="#">Лобзики</a></li>
                                    <li class="submenu-item"><a class="submenu-link" href="#">Молотки и кувалды</a></li>
                                    <li class="submenu-item"><a class="submenu-link" href="#">Напильники, надфили, рашпили</a></li>
                                    <li class="submenu-item"><a class="submenu-link" href="#">Ножовки</a></li>
                                    <li class="submenu-item"><a class="submenu-link" href="#">Отвертки</a></li>
                                    <li class="submenu-item"><a class="submenu-link" href="#">Стамески</a></li>
                                    <li class="submenu-item"><a class="submenu-link" href="#">Струбцины</a></li>
                                    <li class="submenu-item"><a class="submenu-link" href="#">Стусла и полотно для стусел</a></li>
                                    <li class="submenu-item"><a class="submenu-link" href="#">Тиски</a></li>
                                    <li class="submenu-item"><a class="submenu-link" href="#">Пистолеты для пены и герметика</a></li>
                                    <li class="submenu-item"><a class="submenu-link" href="#">Наборы инструментов</a></li>
                                    <li class="submenu-item"><a class="submenu-link" href="#">Кирки</a></li>
                                </ul>
                            </li>
                            <li class="submenu-item parent"><a class="submenu-link" href="#">Измерительные инструменты</a>
                                <ul class="submenu level-4">
                                    <li class="submenu-item"><a class="submenu-link" href="#">Линейки</a></li>
                                    <li class="submenu-item"><a class="submenu-link" href="#">Микрометры</a></li>
                                    <li class="submenu-item"><a class="submenu-link" href="#">Мультимеры</a></li>
                                    <li class="submenu-item"><a class="submenu-link" href="#">Рулетки</a></li>
                                    <li class="submenu-item"><a class="submenu-link" href="#">Угольники</a></li>
                                    <li class="submenu-item"><a class="submenu-link" href="#">Уровни</a></li>
                                    <li class="submenu-item"><a class="submenu-link" href="#">Штангенциркули</a></li>
                                    <li class="submenu-item"><a class="submenu-link" href="#">Дальномеры</a></li>
                                    <li class="submenu-item"><a class="submenu-link" href="#">Лазеры</a></li>
                                    <li class="submenu-item"><a class="submenu-link" href="#">Камеры</a></li>
                                    <li class="submenu-item"><a class="submenu-link" href="#">Детекторы</a></li>
                                    <li class="submenu-item"><a class="submenu-link" href="#">Нивелиры</a></li>
                                    <li class="submenu-item"><a class="submenu-link" href="#">Направлющие рейки</a></li>
                                    <li class="submenu-item"><a class="submenu-link" href="#">Приемники</a></li>
                                    <li class="submenu-item"><a class="submenu-link" href="#">Термодетекторы</a></li>
                                    <li class="submenu-item"><a class="submenu-link" href="#">Угломеры</a></li>
                                    <li class="submenu-item"><a class="submenu-link" href="#">Уклономеры</a></li>
                                    <li class="submenu-item"><a class="submenu-link" href="#">Уровни</a></li>
                                    <li class="submenu-item"><a class="submenu-link" href="#">Пирометры</a></li>
                                    <li class="submenu-item"><a class="submenu-link" href="#">Влагометры</a></li>
                                    <li class="submenu-item"><a class="submenu-link" href="#">Толщиномер</a></li>
                                    <li class="submenu-item"><a class="submenu-link" href="#">Аксессуары</a></li>
                                </ul>
                            </li>
                            <li class="submenu-item parent"><a class="submenu-link" href="#">Малярные инструменты</a>
                                <ul class="submenu level-4">
                                    <li class="submenu-item"><a class="submenu-link" href="#">Валики</a></li>
                                    <li class="submenu-item"><a class="submenu-link" href="#">Ванночки малярные</a></li>
                                    <li class="submenu-item"><a class="submenu-link" href="#">Малярный инструмент</a></li>
                                    <li class="submenu-item"><a class="submenu-link" href="#">Кисти малярные</a></li>
                                </ul>
                            </li>
                            <li class="submenu-item"><a class="submenu-link" href="#">Системы хранения</a></li>
                            <li class="submenu-item parent"><a class="submenu-link" href="#">Расходные материалы к инструментам</a>
                                <ul class="submenu level-4">
                                    <li class="submenu-item"><a class="submenu-link" href="#">Круги и диски</a></li>
                                    <li class="submenu-item"><a class="submenu-link" href="#">Для шлифования</a></li>
                                    <li class="submenu-item"><a class="submenu-link" href="#">Биты, наборы бит</a></li>
                                    <li class="submenu-item"><a class="submenu-link" href="#">Буры</a></li>
                                    <li class="submenu-item"><a class="submenu-link" href="#">Зубила</a></li>
                                    <li class="submenu-item"><a class="submenu-link" href="#">Коронки</a></li>
                                    <li class="submenu-item"><a class="submenu-link" href="#">Комплектующие к инструменту</a></li>
                                    <li class="submenu-item"><a class="submenu-link" href="#">Наборы фрез, фрезы</a></li>
                                    <li class="submenu-item"><a class="submenu-link" href="#">Ножи для рубанков</a></li>
                                    <li class="submenu-item"><a class="submenu-link" href="#">Оснастка для мультиинструмента</a></li>
                                    <li class="submenu-item"><a class="submenu-link" href="#">Полотна для пил, ножовок</a></li>
                                    <li class="submenu-item"><a class="submenu-link" href="#">Патроны для дрелей и перфораторов</a></li>
                                    <li class="submenu-item"><a class="submenu-link" href="#">Пилки для лобзиков</a></li>
                                    <li class="submenu-item"><a class="submenu-link" href="#">Сверла</a></li>
                                    <li class="submenu-item"><a class="submenu-link" href="#">Стержни для клей-пистолетов</a></li>
                                    <li class="submenu-item"><a class="submenu-link" href="#">Насадки</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="submenu-item parent"><a class="submenu-link" href="#">Силовая и строительная техника</a>
                        <ul class="submenu level-3">
                            <li class="submenu-item"><a class="submenu-link" href="#">Бетоносмесители</a></li>
                            <li class="submenu-item"><a class="submenu-link" href="#">Вибраторы для бетона</a></li>
                            <li class="submenu-item"><a class="submenu-link" href="#">Виброплиты</a></li>
                            <li class="submenu-item"><a class="submenu-link" href="#">Вибротрамбовщики</a></li>
                            <li class="submenu-item"><a class="submenu-link" href="#">Бензорезы</a></li>
                            <li class="submenu-item"><a class="submenu-link" href="#">Стабилизаторы напряжения</a></li>
                            <li class="submenu-item"><a class="submenu-link" href="#">Электростанции</a></li>
                            <li class="submenu-item"><a class="submenu-link" href="#">Резчики швов</a></li>
                            <li class="submenu-item"><a class="submenu-link" href="#">Абразивоструйные аппараты</a></li>
                        </ul>
                    </li>
                    <li class="submenu-item parent"><a class="submenu-link" href="#">Сварочное оборудование</a>
                        <ul class="submenu level-3">
                            <li class="submenu-item"><a class="submenu-link" href="#">Плазморезы</a></li>
                            <li class="submenu-item"><a class="submenu-link" href="#">Инверторы сварочные</a></li>
                            <li class="submenu-item"><a class="submenu-link" href="#">Сварочные полуавтоматы</a></li>
                            <li class="submenu-item"><a class="submenu-link" href="#">Сварочные аппараты для пластиковых труб</a></li>
                            <li class="submenu-item"><a class="submenu-link" href="#">Паяльники</a></li>
                            <li class="submenu-item"><a class="submenu-link" href="#">Сварочные принадлежности и аксессуары</a>
                                <ul class="submenu level-4">
                                    <li class="submenu-item"><a class="submenu-link" href="#">Электродержатели</a></li>
                                    <li class="submenu-item"><a class="submenu-link" href="#">Зажимы для заземления</a></li>
                                    <li class="submenu-item"><a class="submenu-link" href="#">Баллоны газовые</a></li>
                                    <li class="submenu-item"><a class="submenu-link" href="#">Электроды</a></li>
                                    <li class="submenu-item"><a class="submenu-link" href="#">Припои</a></li>
                                    <li class="submenu-item"><a class="submenu-link" href="#">Рукава</a></li>
                                    <li class="submenu-item"><a class="submenu-link" href="#">Редуктор кислородный</a></li>
                                </ul>
                            </li>
                            <li class="submenu-item"><a class="submenu-link" href="#">Маски сварщика</a></li>
                        </ul>
                    </li>
                    <li class="submenu-item parent"><a class="submenu-link" href="#">Пневматика</a>
                        <ul class="submenu level-3">
                            <li class="submenu-item"><a class="submenu-link" href="#">Компрессоры</a></li>
                            <li class="submenu-item"><a class="submenu-link" href="#">Краскораспылители</a></li>
                            <li class="submenu-item"><a class="submenu-link" href="#">Пневмогайковерты</a></li>
                            <li class="submenu-item"><a class="submenu-link" href="#">Пневмошлифмашины</a></li>
                            <li class="submenu-item"><a class="submenu-link" href="#">Пневмодрели</a></li>
                            <li class="submenu-item"><a class="submenu-link" href="#">Пневмопистолеты</a></li>
                            <li class="submenu-item"><a class="submenu-link" href="#">Пневмодолото</a></li>
                            <li class="submenu-item"><a class="submenu-link" href="#">Пневмогравер</a></li>
                            <li class="submenu-item"><a class="submenu-link" href="#">Наборы пневмоинструмента</a></li>
                            <li class="submenu-item"><a class="submenu-link" href="#">Нейлеры</a></li>
                            <li class="submenu-item"><a class="submenu-link" href="#">Пневмостеплеры</a></li>
                        </ul>
                    </li>
                    <li class="submenu-item parent"><a class="submenu-link" href="#">Лестницы и стремянки</a>
                        <ul class="submenu level-3">
                            <li class="submenu-item"><a class="submenu-link" href="#">Лестницы</a></li>
                            <li class="submenu-item"><a class="submenu-link" href="#">Стремянки</a></li>
                            <li class="submenu-item"><a class="submenu-link" href="#">Вышка туры и леса рамные</a></li>
                        </ul>
                    </li>
                    <li class="submenu-item parent"><a class="submenu-link" href="#">Промышленная химия</a>
                        <ul class="submenu level-3">
                            <li class="submenu-item"><a class="submenu-link" href="#">Герметики</a></li>
                            <li class="submenu-item"><a class="submenu-link" href="#">Клея</a></li>
                            <li class="submenu-item"><a class="submenu-link" href="#">Очистители и смазки</a></li>
                            <li class="submenu-item"><a class="submenu-link" href="#">Воск</a></li>
                            <li class="submenu-item"><a class="submenu-link" href="#">Антисептики</a></li>
                            <li class="submenu-item"><a class="submenu-link" href="#">Грунтовки</a></li>
                            <li class="submenu-item"><a class="submenu-link" href="#">Лаки</a></li>
                            <li class="submenu-item"><a class="submenu-link" href="#">Растворители</a></li>
                            <li class="submenu-item"><a class="submenu-link" href="#">Эмали</a></li>
                            <li class="submenu-item"><a class="submenu-link" href="#">Пена монтажная</a></li>
                            <li class="submenu-item"><a class="submenu-link" href="#">Известь</a></li>
                            <li class="submenu-item"><a class="submenu-link" href="#">Добавки в раствор</a></li>
                        </ul>
                    </li>
                    <li class="submenu-item parent"><a class="submenu-link" href="#">Расходные материалы и оснастка</a>
                        <ul class="submenu level-3">
                            <li class="submenu-item"><a class="submenu-link" href="#">Зажимы и электродержатели</a></li>
                            <li class="submenu-item"><a class="submenu-link" href="#">Горелки и резаки</a></li>
                            <li class="submenu-item"><a class="submenu-link" href="#">Удлинители</a></li>
                            <li class="submenu-item"><a class="submenu-link" href="#">Светильники ручные</a></li>
                            <li class="submenu-item"><a class="submenu-link" href="#">Аккумуляторы</a></li>
                            <li class="submenu-item"><a class="submenu-link" href="#">Мешки для пылесосов</a></li>
                            <li class="submenu-item"><a class="submenu-link" href="#">Лезвия для ножей</a></li>
                            <li class="submenu-item"><a class="submenu-link" href="#">Ленты клеящие и изоляционные</a></li>
                            <li class="submenu-item"><a class="submenu-link" href="#">Шлифовка и затирка</a>
                                <ul class="submenu level-4">
                                    <li class="submenu-item"><a class="submenu-link" href="#">Бруски</a></li>
                                    <li class="submenu-item"><a class="submenu-link" href="#">Шлифлисты</a></li>
                                    <li class="submenu-item"><a class="submenu-link" href="#">Шлифшкурки</a></li>
                                    <li class="submenu-item"><a class="submenu-link" href="#">Щетки</a></li>
                                </ul>
                            </li>
                            <li class="submenu-item"><a class="submenu-link" href="#">Скобы и степлеры</a></li>
                        </ul>
                    </li>
                    </ul>
                </li>
                <li class="menu-item parent"><a class="menu-link" href="#">сад и огород</a>
                    <ul class="submenu level-2 parent-box">
                        <li class="submenu-item active parent"><a class="submenu-link active" href="#">Садовая техника</a>
                            <ul class="submenu level-3">
                                <li class="submenu-item"><a class="submenu-link" href="#">Бензопилы</a></li>
                                <li class="submenu-item"><a class="submenu-link" href="#">Электропилы</a></li>
                                <li class="submenu-item"><a class="submenu-link" href="#">Бензорубы</a></li>
                                <li class="submenu-item"><a class="submenu-link" href="#">Газонокосилки</a></li>
                                <li class="submenu-item"><a class="submenu-link" href="#">Измельчители</a></li>
                                <li class="submenu-item"><a class="submenu-link" href="#">Культиваторы</a></li>
                                <li class="submenu-item"><a class="submenu-link" href="#">Кусторезы</a></li>
                                <li class="submenu-item"><a class="submenu-link" href="#">Секаторы, ножницы</a></li>
                                <li class="submenu-item"><a class="submenu-link" href="#">Мотоблоки</a></li>
                                <li class="submenu-item"><a class="submenu-link" href="#">Пылесосы садовые</a></li>
                                <li class="submenu-item"><a class="submenu-link" href="#">Снегоуборочные машины</a></li>
                                <li class="submenu-item"><a class="submenu-link" href="#">Триммеры</a></li>
                                <li class="submenu-item"><a class="submenu-link" href="#">Мойки высокого давления</a></li>
                                <li class="submenu-item"><a class="submenu-link" href="#">Насосы и насосное обрудование</a></li>
                            </ul>
                        </li>
                        <li class="submenu-item parent"><a class="submenu-link" href="#">Садовый инструмент</a>
                            <ul class="submenu level-3">
                                <li class="submenu-item"><a class="submenu-link" href="#">Вилы, грабли, плоскорезы</a></li>
                                <li class="submenu-item"><a class="submenu-link" href="#">Косы и серпы</a></li>
                                <li class="submenu-item"><a class="submenu-link" href="#">Буры садовые</a></li>
                                <li class="submenu-item"><a class="submenu-link" href="#">Культиваторы ручные</a></li>
                                <li class="submenu-item"><a class="submenu-link" href="#">Лопаты и черенки</a></li>
                                <li class="submenu-item"><a class="submenu-link" href="#">Ножницы и ножи садовые</a></li>
                                <li class="submenu-item"><a class="submenu-link" href="#">Секаторы, сучкорезы, кусторезы</a></li>
                                <li class="submenu-item"><a class="submenu-link" href="#">Другой садовый инструмент</a></li>
                                <li class="submenu-item"><a class="submenu-link" href="#">Топоры садовые</a></li>
                                <li class="submenu-item"><a class="submenu-link" href="#">Картофелеокучник</a></li>
                                <li class="submenu-item"><a class="submenu-link" href="#">Наколенники</a></li>
                            </ul>
                        </li>
                        <li class="submenu-item parent"><a class="submenu-link" href="#">Полив и орошение</a>
                            <ul class="submenu level-3">
                                <li class="submenu-item"><a class="submenu-link" href="#">Лейки</a></li>
                                <li class="submenu-item"><a class="submenu-link" href="#">Опрыскиватели садов</a></li>
                                <li class="submenu-item"><a class="submenu-link" href="#">Шланги для полива</a></li>
                                <li class="submenu-item"><a class="submenu-link" href="#">Соединители и катушки для шлангов</a></li>
                                <li class="submenu-item"><a class="submenu-link" href="#">Ёмкости для воды</a></li>
                                <li class="submenu-item"><a class="submenu-link" href="#">Автоматический полив</a></li>
                            </ul>
                        </li>
                        <li class="submenu-item parent"><a class="submenu-link" href="#">Хозтовары</a>
                            <ul class="submenu level-3">
                                <li class="submenu-item"><a class="submenu-link" href="#">Сборники плодов</a></li>
                                <li class="submenu-item"><a class="submenu-link" href="#">Ёмкости для воды</a></li>
                                <li class="submenu-item"><a class="submenu-link" href="#">Метла и щетки</a></li>
                                <li class="submenu-item"><a class="submenu-link" href="#">Тачки</a></li>
                                <li class="submenu-item"><a class="submenu-link" href="#">Мебель садовая</a></li>
                                <li class="submenu-item"><a class="submenu-link" href="#">Пресса</a></li>
                                <li class="submenu-item"><a class="submenu-link" href="#">Сетки и решетки</a></li>
                                <li class="submenu-item"><a class="submenu-link" href="#">Удлинители</a></li>
                            </ul>
                        </li>
                        <li class="submenu-item parent"><a class="submenu-link" href="#">Парники и теплицы</a>
                            <ul class="submenu level-3">
                                <li class="submenu-item"><a class="submenu-link" href="#">Укрывной материал</a></li>
                                <li class="submenu-item"><a class="submenu-link" href="#">Поликабонат</a></li>
                                <li class="submenu-item"><a class="submenu-link" href="#">Пленка полиэтиленовая</a></li>
                                <li class="submenu-item"><a class="submenu-link" href="#">Парники</a></li>
                                <li class="submenu-item"><a class="submenu-link" href="#">Теплицы</a></li>
                            </ul>
                        </li>
                        <li class="submenu-item parent"><a class="submenu-link" href="#">Дизайн и интерьер</a>
                            <ul class="submenu level-3">
                                <li class="submenu-item"><a class="submenu-link" href="#">Кашпо</a></li>
                                <li class="submenu-item"><a class="submenu-link" href="#">Корзины, сундуки</a></li>
                                <li class="submenu-item"><a class="submenu-link" href="#">Пруды</a></li>
                                <li class="submenu-item"><a class="submenu-link" href="#">Фигурки садовые</a></li>
                                <li class="submenu-item"><a class="submenu-link" href="#">Бордюры и дорожки садовые</a></li>
                                <li class="submenu-item"><a class="submenu-link" href="#">Заборчики и ограждения</a></li>
                                <li class="submenu-item"><a class="submenu-link" href="#">Арки</a></li>
                                <li class="submenu-item"><a class="submenu-link" href="#">Светильники садовые</a></li>
                                <li class="submenu-item"><a class="submenu-link" href="#">Сетки садовые</a></li>
                            </ul>
                        </li>
                        <li class="submenu-item parent"><a class="submenu-link" href="#">Климатическое и тепловое оборудование</a>
                            <ul class="submenu level-3">
                                <li class="submenu-item"><a class="submenu-link" href="#">Вентиляторы</a></li>
                                <li class="submenu-item"><a class="submenu-link" href="#">Кондиционеры</a></li>
                                <li class="submenu-item"><a class="submenu-link" href="#">Увлажнители воздуха</a></li>
                                <li class="submenu-item"><a class="submenu-link" href="#">Завесы тепловые</a></li>
                                <li class="submenu-item"><a class="submenu-link" href="#">Конвекторы</a></li>
                                <li class="submenu-item"><a class="submenu-link" href="#">Масляные радиаторы</a></li>
                                <li class="submenu-item"><a class="submenu-link" href="#">Обогреватели инфракрасные</a></li>
                                <li class="submenu-item"><a class="submenu-link" href="#">Пушки тепловые</a></li>
                                <li class="submenu-item"><a class="submenu-link" href="#">Солярогазовые</a></li>
                                <li class="submenu-item"><a class="submenu-link" href="#">Тепловентиляторы</a></li>
                                <li class="submenu-item"><a class="submenu-link" href="#">Электрокамины</a></li>
                            </ul>
                        </li>
                        <li class="submenu-item parent"><a class="submenu-link" href="#">Товары для бани</a>
                            <ul class="submenu level-3">
                                <li class="submenu-item"><a class="submenu-link" href="#">Веники</a></li>
                                <li class="submenu-item"><a class="submenu-link" href="#">Коврики для бани и сауны</a></li>
                                <li class="submenu-item"><a class="submenu-link" href="#">Рукавицы</a></li>
                                <li class="submenu-item"><a class="submenu-link" href="#">Шапки для бани и сауны</a></li>
                                <li class="submenu-item"><a class="submenu-link" href="#">Аксессуары для бани</a></li>
                            </ul>
                        </li>
                        <li class="submenu-item parent"><a class="submenu-link" href="#">Семена и удобрения</a>
                            <ul class="submenu level-3">
                                <li class="submenu-item"><a class="submenu-link" href="#">Грунты, дренаж</a></li>
                                <li class="submenu-item"><a class="submenu-link" href="#">Семена овощей и зелени</a></li>
                                <li class="submenu-item"><a class="submenu-link" href="#">Средства от грызунов и насекомых</a></li>
                                <li class="submenu-item"><a class="submenu-link" href="#">Удобрения</a></li>
                                <li class="submenu-item"><a class="submenu-link" href="#">Цветы</a></li>
                            </ul>
                        </li>
                        <li class="submenu-item parent"><a class="submenu-link" href="#">Товары для дома</a>
                            <ul class="submenu level-3">
                                <li class="submenu-item"><a class="submenu-link" href="#">Водонагреватели</a></li>
                                <li class="submenu-item"><a class="submenu-link" href="#">Все для кухни</a></li>
                                <li class="submenu-item"><a class="submenu-link" href="#">Коврики</a></li>
                                <li class="submenu-item"><a class="submenu-link" href="#">Лампы паяльные</a></li>
                                <li class="submenu-item"><a class="submenu-link" href="#">Мухобойка</a></li>
                                <li class="submenu-item"><a class="submenu-link" href="#">Плащи-дождевики</a></li>
                                <li class="submenu-item"><a class="submenu-link" href="#">Прищепки</a></li>
                                <li class="submenu-item"><a class="submenu-link" href="#">Салфетки, тряпки</a></li>
                                <li class="submenu-item"><a class="submenu-link" href="#">Свечи</a></li>
                                <li class="submenu-item"><a class="submenu-link" href="#">Термометры</a></li>
                                <li class="submenu-item"><a class="submenu-link" href="#">Шпагаты</a></li>
                                <li class="submenu-item"><a class="submenu-link" href="#">Электротовары</a></li>
                                <li class="submenu-item"><a class="submenu-link" href="#">Ящики почтовые</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
				
                <li class="menu-item parent"><a class="menu-link" href="#">отдых и туризм</a>
                    <ul class="submenu level-2 parent-box">
                        <li class="submenu-item active parent"><a class="submenu-link active" href="#">Лодки и лодочные моторы</a>
                            <ul class="submenu level-3">
                                <li class="submenu-item"><a class="submenu-link" href="#">Лодки</a></li>
                                <li class="submenu-item"><a class="submenu-link" href="#">Весла</a></li>
                                <li class="submenu-item"><a class="submenu-link" href="#">Моторы лодочные</a></li>
                                <li class="submenu-item"><a class="submenu-link" href="#">Насосы лодочные</a></li>
                                <li class="submenu-item"><a class="submenu-link" href="#">Якоря для лодок</a></li>
                                <li class="submenu-item"><a class="submenu-link" href="#">Спасательные средства</a></li>
                            </ul>
                        </li>
                        <li class="submenu-item parent"><a class="submenu-link" href="#">Туристическое снаряжение</a>
                            <ul class="submenu level-3">
                                <li class="submenu-item"><a class="submenu-link" href="#">Лопаты туристические</a></li>
                                <li class="submenu-item"><a class="submenu-link" href="#">Приспособления для разведения огня</a></li>
                                <li class="submenu-item"><a class="submenu-link" href="#">Топоры и пилы туристические</a></li>
                                <li class="submenu-item"><a class="submenu-link" href="#">Фонари</a></li>
                                <li class="submenu-item"><a class="submenu-link" href="#">Ножи</a></li>
                                <li class="submenu-item"><a class="submenu-link" href="#">Бинокли и компасы</a></li>
                                <li class="submenu-item"><a class="submenu-link" href="#">Рюкзаки и сумки</a></li>
                            </ul>
                        </li>
                        <li class="submenu-item parent"><a class="submenu-link" href="#">Товары для пикника и кемпинга</a>
                            <ul class="submenu level-3">
                                <li class="submenu-item"><a class="submenu-link" href="#">Оборудование газовое</a></li>
                                <li class="submenu-item"><a class="submenu-link" href="#">Палатки и тенты</a></li>
                                <li class="submenu-item"><a class="submenu-link" href="#">Посуда туристическая</a></li>
                                <li class="submenu-item"><a class="submenu-link" href="#">Средства защиты от насекомых</a></li>
                                <li class="submenu-item"><a class="submenu-link" href="#">Жаровни и грили</a></li>
                                <li class="submenu-item"><a class="submenu-link" href="#">Коптильни</a></li>
                                <li class="submenu-item"><a class="submenu-link" href="#">Мангалы</a></li>
                                <li class="submenu-item"><a class="submenu-link" href="#">Уголь и средства для розжига</a></li>
                                <li class="submenu-item"><a class="submenu-link" href="#">Сумки-холодильники</a></li>
                                <li class="submenu-item"><a class="submenu-link" href="#">Шампуры</a></li>
                            </ul>
                        </li>
                        <li class="submenu-item parent"><a class="submenu-link" href="#">Товары для отдыха на природе</a>
                            <ul class="submenu level-3">
                                <li class="submenu-item"><a class="submenu-link" href="#">Бассейны</a></li>
                                <li class="submenu-item"><a class="submenu-link" href="#">Принадлежности пляжные</a></li>
                                <li class="submenu-item"><a class="submenu-link" href="#">Душ и походная баня</a></li>
                                <li class="submenu-item"><a class="submenu-link" href="#">Коврики туристические</a></li>
                                <li class="submenu-item"><a class="submenu-link" href="#">Матрасы</a></li>
                                <li class="submenu-item"><a class="submenu-link" href="#">Мешки спальные</a></li>
                                <li class="submenu-item"><a class="submenu-link" href="#">Пледы и одеяла</a></li>
                                <li class="submenu-item"><a class="submenu-link" href="#">Ящики зимние</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="menu-item parent"><a class="menu-link" href="#">спецодежда</a>
                    <ul class="submenu level-2">
                        <li class="submenu-item"><a class="submenu-link" href="#">Рабочая одежда летняя</a></li>
                        <li class="submenu-item"><a class="submenu-link" href="#">Рабочая одежда зимняя</a></li>
                        <li class="submenu-item"><a class="submenu-link" href="#">Одежда для официантов</a></li>
                        <li class="submenu-item"><a class="submenu-link" href="#">Одежда для поваров</a></li>
                        <li class="submenu-item"><a class="submenu-link" href="#">Одежда для горничных и уборщиц</a></li>
                        <li class="submenu-item"><a class="submenu-link" href="#">Одежда для обслуживающего персонала</a></li>
                        <li class="submenu-item"><a class="submenu-link" href="#">Одежда для охранных структур</a></li>
                        <li class="submenu-item"><a class="submenu-link" href="#">Непромокаемая одежда</a></li>
                        <li class="submenu-item"><a class="submenu-link" href="#">Одежда от повышенных температур</a></li>
                        <li class="submenu-item"><a class="submenu-link" href="#">Средства индивидуальной защиты</a></li>
                    </ul>
                </li>
                <li class="menu-item"><a class="menu-link" href="/promo/">акции</a></li>
            </ul>
        </div>
    </div>
<?*/?>

    <div class="main-menu">
        <div class="container row">
            <ul class="menu horizontal-multilevel-menu col">

    <?
    $previousLevel = 0;
    foreach($arResult as $arItem):?>

    <?if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel):?>
        <?=str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]));?>
    <?endif?>

    <?if ($arItem["IS_PARENT"]):?>

		<?if ($arItem["DEPTH_LEVEL"] == 1):?>
					<li class="menu-item parent">
						<a class="menu-link" href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a>
						<ul class="submenu level-2 <?if($arItem['HAVE_CHILD'] == 'Y'):?>parent-box<?endif;?>">
		<?else:?>
					<li class="submenu-item  parent"><a class="submenu-link" href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a>
						<ul class="submenu level-<?=$arItem["DEPTH_LEVEL"]+1?> parent-box">
		<?endif?>

    <?else:?>

            <?if ($arItem["PERMISSION"] > "D"):?>

                <?if ($arItem["DEPTH_LEVEL"] == 1):?>
                    <li class="menu-item parent"><a class="menu-link" href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
                <?else:?>
                    <li class="submenu-item"><a class="submenu-link" href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
                <?endif?>

            <?else:?>

                <?if ($arItem["DEPTH_LEVEL"] == 1):?>
                    <li class="submenu-item"><a class="submenu-link" href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
                <?else:?>
                    <li class="submenu-item"><a class="submenu-link" href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
                <?endif?>

            <?endif?>

        <?endif?>

        <?$previousLevel = $arItem["DEPTH_LEVEL"];?>

        <?endforeach?>

        <?if ($previousLevel > 1)://close last item tags?>
            <?=str_repeat("</ul></li>", ($previousLevel-1) );?>
        <?endif?>
            </ul>
        </div>
    </div>


<?endif?>