<!-- class ajout admin gateau-->
<div class="ajout_admin_gateau">
    <form method="post" enctype="multipart/form-data">
        <h1>Ajoutez votre gateau ici</h1>
        <div class="admin_form">
            <div class='admin_flex'>
                <label for="nom_gateau">Nom du Gateau</label>
                <input type="text" name="n_gateau" id="nom_gateau">
            </div>
            <div class="admin_flex">
                <label for="description_gateau">Description du Gateau</label>
                <textarea name="d_gateau" id="description_gateau" cols="20" rows="3"></textarea>
            </div>
            <div class="admin_flex">
                <label for="prix_gateau">Prix du Gateau (en euros)</label>
                <input type="text" name="p_gateau" id="prix_gateau">
            </div>
            <div class="admin_flex">
                <label for="image_gateau">Photo du gateau</label>
                <input type="file" name="photo" id="image_gateau">
            </div>
        </div>
        <div class="admin_flex_envoyer">
            <input type="submit" name="ajout_gateau" value="ajout_gateau">
        </div>
    </form>
</div>
