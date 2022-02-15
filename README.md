## Города и Регионы - плагин для WordPress

После установки доступен глобальная переменная (объект) `$city`

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

echo $subName; // moskva если текущий url страницы http(s)://moskva.example.com
```
