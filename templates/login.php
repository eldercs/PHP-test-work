

  <form class="form container" action="login.php" method="post" enctype="multipart/form-data"> <!-- form--invalid -->
  <?php if(isset($errors)):?>
  <?php endif; ?>
    <h2>Вход</h2>
    <div class="form__item"> <!-- form__item--invalid -->
      <label for="email">E-mail*</label>
      <input id="email" type="text" name="email" placeholder="Введите e-mail" value="<?= isset($gif['email'])? $gif['email'] : ''; ?>" >
      <span class="form__error2"><?=isset($errors['email'])? $errors['email'] : "";?></span>
    </div>
    <div class="form__item form__item--last">
      <label for="password">Пароль*</label>
      <input id="password" type="text" name="password" placeholder="Введите пароль">
      <span class="form__error2"><?=isset($errors['password'])? $errors['password'] : "";?></span>
    </div>
    <button type="submit" class="button">Войти</button>
  </form>
