
<main>
  <nav class="nav">
    <ul class="nav__list container">
      <li class="nav__item">
        <a href="all-lots.html">Доски и лыжи</a>
      </li>
      <li class="nav__item">
        <a href="all-lots.html">Крепления</a>
      </li>
      <li class="nav__item">
        <a href="all-lots.html">Ботинки</a>
      </li>
      <li class="nav__item">
        <a href="all-lots.html">Одежда</a>
      </li>
      <li class="nav__item">
        <a href="all-lots.html">Инструменты</a>
      </li>
      <li class="nav__item">
        <a href="all-lots.html">Разное</a>
      </li>
    </ul>
  </nav>
<form class="form form--add-lot container form--invalid" action="add.php" method="post"enctype="multipart/form-data"> <!-- form--invalid -->
  <?php if(isset($errors)): ?>
  <div class = "form__errors">
  <p>Исправьте ошибки</p>
  </div>
  <?php endif; ?>
  <?php
  $name = $_POST[$add_lots['name']] ?? '';
   ?>
    <h2>Добавление лота</h2>
    <div class="form__container-two">
      <div class="form__item form__item--invalid"> <!-- form__item--invalid -->
        <label for="lot-name">Наименование</label>
        <input id="lot-name" type="text" name="name" placeholder="Введите наименование лота" value="<?= isset($add_lots['name'])? $add_lots['name'] : ''; ?>">
         <span class="form__error"><?=isset($errors['name'])? $errors['name'] : "";?></span>
      </div>
      <div class="form__item">
        <label for="category">Категория</label>
        <select id="category" name="category" >
          <option value = "">Выберите категорию</option>
       <?php 
       foreach($my_array as $key) : ?>
        <option name = "category" value="<?=$key; ?>"><?=$key;?></option>
        <?php endforeach; ?>
        </select>
        <span class="form__error2"><?=isset($errors['category'])? $errors['category'] : "";?></span>
        <span class="form__error">Выберите категорию</span>
      </div>
    </div>
    <div class="form__item form__item--wide">
      <label for="message">Описание</label>
      <textarea id="message" name="description" placeholder="Напишите описание лота" ><?= isset($add_lots['description'])? $add_lots['description'] : ''; ?></textarea>
      <span class="form__error2"><?=isset($errors['description'])? $errors['description'] : "";?></span>
    </div>
    <div class="form__item form__item--file"> <!-- form__item--uploaded -->
      <label>Изображение</label>
      <div class="preview">
        <button class="preview__remove" type="button">x</button>
        <div class="preview__img">
          <img src="img/avatar.jpg" width="113" height="113" alt="Изображение лота">
        </div>
      </div>
      <div class="form__input-file">
        <input class="visually-hidden" type="file" id="photo2" value="" name = "img">
        <label for="photo2">
          <span>+ Добавить</span>
        </label>
      </div>
      <span class="form__error2"><?=isset($errors['img'])? $errors['img'] : "";?></span>
    </div>
    <div class="form__container-three">
      <div class="form__item form__item--small">
        <label for="lot-rate">Начальная цена</label>
        <input id="lot-rate" type="number" name="price" placeholder="0" value = "<?= isset($add_lots['price']) ? $add_lots['price'] : ''; ?>" >
        <span class="form__error2"><?=isset($errors['price'])? $errors['price'] : "";?></span>
      </div>
      <div class="form__item form__item--small">
        <label for="lot-step">Шаг ставки</label>
        <input id="lot-step" type="number" name="lot-step" placeholder="0" value = "<?= isset($add_lots['lot-step']) ? $add_lots['lot-step'] : ''; ?>">
        <span class="form__error2"><?=isset($errors['lot-step'])? $errors['lot-step'] : "";?></span>
      </div>
      <div class="form__item">
        <label for="lot-date">Дата окончания торгов</label>
        <input class="form__input-date" id="lot-date" type="date" name="end_date" value = "<?=isset($gif['end_date'])? $gif['end_date'] : '';?>">
        <span class="form__error2"><?=isset($errors['end_date'])? $errors['end_date'] : "";?></span>
      </div>
    </div>
    <span class="form__error form__error--bottom">Пожалуйста, исправьте ошибки в форме.</span>
    <button type="submit" class="button">Добавить лот</button>
  </form>
</main>

