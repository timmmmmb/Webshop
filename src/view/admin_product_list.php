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

    <form action="<?=_ROOT.$_SESSION['lang']['name']?>/admin/createProduct" method="POST" enctype="multipart/form-data">
        <input type="text" name="name_de" placeholder="Name DE" required>
        <input type="text" name="name_en" placeholder="Name EN" required>
        <textarea name="description_de" placeholder="Beschreibung DE" required></textarea>
        <textarea name="description_en" placeholder="Description EN" required></textarea></br>
        <input type="radio"  name="gender" value="Male" checked="checked">Male
        <input type="radio" name="gender" value="Female">Female
        <input type="text" name="price" placeholder="Price" required>
        <input type="file" name="image">
        <button type="submit">Erstellen</button>
    </form>
        
    <a href="<?=_ROOT?>admin">
        <div class="admin__return">
            <i class="fa fa-angle-left" aria-hidden="true"></i>
        </div>
    </a>
   
</section>