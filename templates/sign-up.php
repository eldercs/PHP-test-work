
  <form class="form container"  method="post" enctype="multipart/form-data"> <!-- form--invalid -->
    <h2>Регистрация нового аккаунта</h2>
    <div class="form__item"> <!-- form__item--invalid -->
      <label for="email">E-mail*</label>
      <input id="email" type="text" name="email" placeholder="Введите e-mail" value="<?= isset($gif['email'])? $gif['email'] : ''; ?>" >
      <span class="form__error2"><?=isset($errors['email'])? $errors['email'] : "";?></span>
    </div>
    <div class="form__item">
      <label for="password">Пароль*</label>
      <input id="password" type="password" name="password" placeholder="Введите пароль" >
      <span class="form__error2"><?=isset($errors['password'])? $errors['password'] : "";?></span>
    </div>
    <div class="form__item">
      <label for="name">Имя*</label>
      <input id="name" type="text" name="name" placeholder="Введите имя" value="<?= isset($gif['name'])? $gif['name'] : ''; ?>">
      <span class="form__error2"><?=isset($errors['name'])? $errors['name'] : "";?></span>
    </div>
    <div class="form__item">
      <label for="message">Контактные данные*</label>
      <textarea id="message" name="contacts" placeholder="Напишите как с вами связаться" value="<?= isset($gif['contacts'])? $gif['contacts'] : ''; ?>"></textarea>
      <span class="form__error2"><?=isset($errors['contacts'])? $errors['contacts'] : "";?></span>
    </div>
    <div class="form__item form__item--file form__item--last">
      <label>Аватар</label>
      <div class="preview">
        <button class="preview__remove" type="button">x</button>
        <div class="preview__img">
          <img src="<?=isset($gif['avatar'])? $gif['avatar'] : '';?>" width="113" height="113" alt="Ваш аватар">
        </div>
      </div>
      <div class="form__input-file">
        <input class="visually-hidden" type="file" id="photo2" name = "avatar" value="">
        <label for="photo2">
          <span>+ Добавить</span>
        </label>
      </div>
      <span class="form__error2"><?=isset($errors['avatar'])? $errors['avatar'] : "";?></span>
    </div>
    <span class="form__error form__error--bottom">Пожалуйста, исправьте ошибки в форме.</span>
    <button type="submit" class="button">Зарегистрироваться</button>
    <a class="text-link" href="/login.php">Уже есть аккаунт</a>
  </form>
</main>

