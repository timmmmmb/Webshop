<section class="admin">

    <h3><?=_ADMIN_PRODUCT_NEW?></h3>

    <div class="h3__hr">
        <div class="h3__hr__line"></div>
        <div class="h3__hr__circle"></div>
        <div class="h3__hr__line"></div>
    </div>

    <form action="<?=_ROOT.$_SESSION['lang']['name']?>/admin/createProduct" method="POST" enctype="multipart/form-data">
        <input type="text" name="name_de" class="admin__input" placeholder="Name DE" required>
        <input type="text" name="name_en" class="admin__input" placeholder="Name EN" required>
        <textarea name="description_de" class="admin__input" placeholder="Beschreibung" required></textarea>
        <textarea name="description_en" class="admin__input" placeholder="Description" required></textarea>
        <input type="text" name="price" class="admin__input" placeholder="Price" required>
        <div class="admin__radio">
            <input type="file" name="image">
            <input type="radio"  name="gender" value="Male" checked="checked">Male
            <input type="radio" name="gender" value="Female">Female
        </div>
        <button type="submit" class="admin__submit">Erstellen</button>
    </form>
        
    <a href="<?=_ROOT?>admin">
        <div class="admin__return">
            <i class="fa fa-angle-left" aria-hidden="true"></i>
        </div>
    </a>
   
</section>