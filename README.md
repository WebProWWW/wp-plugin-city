## Города и Регионы - плагин для WordPress

После установки доступна глобальная переменная (объект) `$city`

### Свойства

Название города `(string)`:
```php
$city->name
```

Алиас названии города `(string)`:
```php
$city->alias
```

### Методы

Возвращает ссылку на поддомен города `(string)`:
```php
$city->url()
```

Пример:

```php
<?php ... ?>

<a href="<?= $city->url() ?>">
    <?= $city->name ?>
</a>
```

Возвращает массив городов (массив объектов **$city**) `(City[])`:
```php
$city->all()
```

Пример:

```php
<?php foreach ($city->all() as $iCity): ?>

    <a href="<?= $iCity->url() ?>">
        <?= $iCity->name ?>
    </a>

<?php endforeach; ?>
```

Возвращает регион (объект) `(Region)`:
```php
$city->region()
```

Пример:

```php
<?php $region = $city->region(); ?>

<p>Название региона: <?= $region->name ?></p>

<p>Код региона: <?= $region->code ?></p>
```

### Статические методы

Возвращает ссылку на основной домен `(string)`:

```php
City::rootDomain()
```

Пример:

```php
use plugins\city\models\City;

$domain = City::rootDomain();

echo $domain; // http(s)://example.com
```

Возвращает название поддомена `(string)`:

```php
City::subDomainName()
```

Пример:

```php
use plugins\city\models\City;

$subName = City::subDomainName();

echo $subName;
// moskva если текущий url страницы http(s)://moskva.example.com
// или
// index если текущий url страницы http(s)://example.com
```

### Шаблон

Плагин подключает в шаблон библиотеки `jQuery` `Fancybox` и встраивает в подвал следующий `html` код:

```html
<!-- ВАШ ГОРОД? -->
<div class="is-city" id="is-city-confirm" style="display: none">
    <p class="is-city-text">Ваш регион — Москва?</p>
    <div class="is-city-actions">
        <button class="is-city-btn is-city-btn-accept" data-fancybox-close>Всё верно</button>
        <button class="is-city-btn is-city-btn-change" data-fancybox data-src="#cities">Выбрать другой</button>
    </div>
</div><!-- .modal -->
<!-- / ВАШ ГОРОД? -->

<!-- СПИСОК ГОРОДОВ -->
<div class="search-city" id="cities" style="width: 100%; max-width: 900px; display: none">
    <label class="search-city-label">Быстрый поиск города</label>
    <div class="js-search-city">
        <input class="search-city-input js-search-city-input" type="text" placeholder="Введите название своего города">
        <div class="search-city-cities">

            <div class="js-search-city-hide">
                <p class="search-city-letter">
                    А
                </p>
            </div>

            <div class="search-city-item js-search-city-item">
                <a class="search-city-link js-search-city-data" href="http(s)://abaza.example.com">
                    Абаза
                </a>
            </div>

            <div class="search-city-item js-search-city-item">
                <a class="search-city-link js-search-city-data" href="http(s)://abakan.example.com">
                    Абакан
                </a>
            </div>

            ...

            <div class="js-search-city-hide">
                <p class="search-city-letter">
                    Б
                </p>
            </div>

            <div class="search-city-item js-search-city-item">
                <a class="search-city-link js-search-city-data" href="http(s)://babaevo.example.com">
                    Бабаево </a>
            </div>

            <div class="search-city-item js-search-city-item">
                <a class="search-city-link js-search-city-data" href="http(s)://babushkin.example.com">
                    Бабушкин </a>
            </div>

            ...

        </div><!-- .search-city-cities -->
    </div><!-- .js-search -->
</div><!-- .modal -->
<!-- / СПИСОК ГОРОДОВ -->

<script>
    Fancybox.bind('[data-src="#cities"]', {
        on: {
            init: function () {
                Fancybox.close();
            },
        },
    });
</script>
```

Пример кнопки для открытия модального окна выбора/поиска города

```html
<button data-fancybox data-src="#cities">Выбрать город</button>

или

<a data-fancybox href="#cities">Выбрать город</a>
```