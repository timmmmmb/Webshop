<section class="admin" xmlns="http://www.w3.org/1999/html">

    <h3><?=_ADMIN_PRODUCTLIST?></h3>

    <div class="h3__hr">
        <div class="h3__hr__line"></div>
        <div class="h3__hr__circle"></div>
        <div class="h3__hr__line"></div>
    </div>

    <ul class="admin__list">
        <?php foreach ($products as $product) : ?>
            <li><?= $product->{'Name_'.strtoupper($_SESSION['lang']['name'])}?></li>
        <?php endforeach; ?>
    </ul>

    <!-- Add form for product creation-->
    <form id="formRegister" method="POST" data-url="<?=_ROOT.$_SESSION['lang']['name']?>/admin/createProduct"  enctype="multipart/form-data">
        <div class="form__container__input">
            <input type="text"  placeholder="Name DE" name="name_de" required>
            <input type="text"  placeholder="Name EN" name="name_en" required>
            <textarea name="description_de" placeholder="Beschreibung DE" required></textarea>
            <textarea name="description_en" placeholder="Description EN" required></textarea></br>
            <input type="radio"  name="gender" value="Male">Male
            <input type="radio" name="gender" value="Female">Female
            <input type="text" placeholder="Preis" name="price" required>
            <input type="file" name="fileToUpload" id="fileToUpload">
        </div>
        <div class="form__container__error" hidden><?=_REGISTER_ERROR?></div>

        <span class="form__container__buttons">
            <button type="submit" class="form__container__buttons__submit">Erstellen</button>
        </span>
    </form>

    <!--<form data-url="<?=_ROOT.$_SESSION['lang']['name']?>/admin/createProduct" method="post" enctype="multipart/form-data">
        Select image to upload:
        <input type="file" name="fileToUpload" id="fileToUpload">
        <input type="submit" value="Upload Image" name="submit">
    </form>-->
        
    <a href="<?=_ROOT?>admin">
        <div class="admin__return">
            <i class="fa fa-angle-left" aria-hidden="true"></i>
        </div>
    </a>
   
</section>