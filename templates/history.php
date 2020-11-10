<?php
foreach($table_array as $key => $val ): ?>
  <?php if(isset($_COOKIE[$key])): ?>
     <li class="lots__item lot">
        <div class="lot__image">
            <img src="<?= $val['image'];?>" width="350" height="260" alt="Сноуборд">
        </div>
        <div class="lot__info">
            <span class="lot__category"><?= $val['category'];?></span>
            <h3 class="lot__title"><a class="text-link" href="lot.php?key=<?=$val; ?>"><?= $val['title'];?></a></h3>
            <div class="lot__state">
                <div class="lot__rate">
                    <span class="lot__amount">Стартовая цена</span>
                    <span class="lot__cost"><?= sum_price($val['price']);?></span>
                </div>
                <div class="lot__timer timer">
                    <?=nowtotime();?>
                </div>
            </div>
        </div>
    </li>  
    <?php endif ?>
   <?php endforeach ?>