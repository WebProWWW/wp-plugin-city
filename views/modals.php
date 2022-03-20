<?php

global $city;
/* @var $city plugins\city\models\City */

$regions = plugins\city\models\Region::all();

?>

<div style="padding: 15px">

<?php foreach ( $regions as $region ): ?>
    | **<?= $region->name ?>** | |<br>
    <?php $cities = $region->cities() ?>
    <?php foreach ( $cities as $iCity ): ?>

    | <?= $iCity->alias ?>.domain.name | <?= $iCity->name ?> |<br>

    <?php endforeach; ?>

<?php endforeach; ?>
</div>

<!-- ВАШ ГОРОД? -->
<div class="is-city" id="is-city-confirm" style="display: none">
    <p class="is-city-text">Ваш регион — <?= $city->name ?>?</p>
    <div class="is-city-actions">
        <button class="is-city-btn is-city-btn-accept" data-fancybox-close>Всё верно</button>
        <button class="is-city-btn is-city-btn-change" data-fancybox data-src="#cities">Выбрать другой</button>
    </div>
</div><!-- .modal -->
<!-- / ВАШ ГОРОД? -->

<?php if (!$city->isConfirmed): ?>
<script>
    Fancybox.show([{ src: "#is-city-confirm", type: "inline" }]);
</script>
<?php endif; ?>

<!-- СПИСОК ГОРОДОВ -->
<div class="search-city" id="cities" style="width: 100%; max-width: 900px; display: none">
    <label class="search-city-label">Быстрый поиск города</label>
    <div class="js-search-city">
        <input class="search-city-input js-search-city-input" type="text" placeholder="Введите название своего города">
        <div class="search-city-cities">
			<?php $letter = '' ?>
			<?php foreach ($city->all() as $itemCity): ?>
				<?php $cityLetter = mb_substr($itemCity->name, 0, 1, 'utf-8') ?>
				<?php if ($cityLetter !== $letter): ?>
					<?php $letter = $cityLetter ?>
                    <div class="js-search-city-hide">
                        <p class="search-city-letter"><?= $letter ?></p>
                    </div>
				<?php endif; ?>
                <div class="search-city-item js-search-city-item">
                    <a class="search-city-link js-search-city-data" href="<?= $itemCity->url() ?>">
						<?= $itemCity->name ?>
                    </a>
                </div>
			<?php endforeach; ?>
        </div><!-- .row -->
    </div><!-- .js-search -->
</div><!-- .modal -->
<!-- / СПИСОК ГОРОДОВ -->

<script>
    // Fancybox.show([{ src: "#cities", type: "inline" }]);
</script>

<script>
    Fancybox.bind('[data-src="#cities"]', {
        on: {
            init: function () {
                Fancybox.close();
            },
        },
    });
</script>

<!-- / СПИСОК ГОРОДОВ -->