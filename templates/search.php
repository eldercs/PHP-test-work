
<section class="lots container">
    <div class="lots__header">
        <h2>Результаты поиска по запросу <?=$search;?></h2>
    </div>
    <?php if(count($lots)): ?>
        <?=shablon('all-lots', ['lots' => $lots]); ?>
    <?php else: ?>
        <div>По вашему запросу ничего не найдено</div>
    <?php endif; ?>
</section>