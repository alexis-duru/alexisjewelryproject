<?php $page = 'Addproduct'; ?>
<?php require 'inc/header.php' ?>

<?php
$sqlCategory = 'SELECT * FROM categories';
$categories = $connect->query($sqlCategory)->fetchAll();
$sqlColor = 'SELECT * FROM colors';
$colors = $connect->query($sqlColor)->fetchAll();


if (isset($_POST['submit']) && !empty($_POST['name']) && !empty($_POST['category']) && !empty($_POST['description']) && !empty($_POST['price']) && !empty($_POST['color'])) {

    $name = strip_tags($_POST['name']);
    $category = intval(strip_tags($_POST['category']));
    $description = strip_tags($_POST['description']);
    $price = intval(strip_tags($_POST['price']));
    $color = intval(strip_tags($_POST['color']));

    $user_id = $_SESSION['id'];

    $image = $_FILES['image'];

    var_dump($image);
    if ($image['size'] > 0) {
    if ($image['size'] <= 10000000) {
        $valid_ext = ['jpg', 'jpeg', 'png'];
        $check_ext = strtolower(substr(strrchr($image['name'], '.'), 1));
        if (in_array($check_ext, $valid_ext)) {
                var_dump('ok');
            $image_name = uniqid() . '_' . $image['name'];
            $upload_dir = "./public/uploads/";
            $upload_name = $upload_dir . $image_name;
            $upload_result = move_uploaded_file($image['tmp_name'], $upload_name);
            if ($upload_result) {
                if (is_int($price) && $price > 0) {
                    try {
                        $sth = $connect->prepare("INSERT INTO jewelry
                        (name, category , description, price, color, image)
                        VALUES
                        (:name, :category, :description, :price, :color, :image)");
                    
                            //? J'affecte chacun des paramètres nommés à leur valeur via un bindValue. Cette opération me protège des injections SQL (en + de l'assainissement des variables)
                        $sth->bindValue(':name', $name);
                        $sth->bindValue(':category', $category);
                        $sth->bindValue(':description', $description);
                        $sth->bindValue(':price', $price);
                        $sth->bindValue(':color', $color);
                        $sth->bindValue(':image', $image_name);
                        //? J'exécute ma requête SQL d'insertion avec execute()
                        $sth->execute();
                        echo "Votre article a bien été ajouté";
                        //? Je redirige vers la page des produits.
            
                        // header('Location: rental.php');
                    } catch (PDOException $error) {
                        echo 'Erreur: ' . $error->getMessage();
                    }
                }
            }
        }
    }
} else {
        if (is_int($price) && $price > 0) {
            try {
                $sth = $connect->prepare("INSERT INTO jewelry
                (name, category, description, price, color, image)
                VALUES
                (:name, :category, :description, :price, :color, :image)");
                    $sth->bindValue(':name', $name);
                    $sth->bindValue(':description', $description);
                    $sth->bindValue(':price', $price);
                    $sth->bindValue(':category', $category);
                    $sth->bindValue(':color', $color);
                    $sth->bindValue(':image', $image_name);
                $sth->execute();
                echo "Votre article a bien été ajouté";
                // header('Location: rental.php');
            } catch (PDOException $error) {
                echo 'Erreur: ' . $error->getMessage();
            }
        }
    }
}
?>
<section>
    <div class="window">
        <div class="window-in">
            <form action="#" method="post" enctype="multipart/form-data">
                <h3>name</h3>
                    <input class="input-form" type="text" name="name" value="" placeholder="Name of the product">
                <h3>image</h3>
                    <div class="input-form">
                        <input type="file" id='Inputimage' name='image' accept=".png, .jpg, .jpeg">
                    </div>
                <h3>category</h3>
                    <select class="input-form" name="category">
                <label class="input-form" for="category-select">Category of product</label>
                <option value="">--Please choose the category--</option>
                <?php
                foreach ($categories as $category) {
                ?>
                <option value="<?php echo $category['id']; ?>">
                    <?php echo $category['name']; ?>
                </option>
                <?php
                }
                ?>
                </select>
                <h3>description</h3>
                <textarea class="input-form" id="description" value="" placeholder="" name="description"></textarea>
                <h3>price</h3>
                <input class="input-form" type="text" name="price" value="" placeholder="Price (euros)" required>
                <h3>color</h3>
                    <select class="input-form" name="color">
                    <label class="input-form" for="color-select">Color of product</label> 
                    <option value="">--Please choose the color--</option>
                    <?php
                    foreach ($colors as $color) {
                    ?>
                    <option value="<?php echo $color['id']; ?>">
                        <?php echo $color['name']; ?>
                    </option>
                    <?php
                    }
                    ?>
                    </select>
                <div id="create-return">
                    <button name="submit" type="submit">ADD PRODUCT</button>
                    <a class="btn-return" href="profil.php">BACK HOME</a>
                </div>
            </form>
        <div>
    </div>
</section>