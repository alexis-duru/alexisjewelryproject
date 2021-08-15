<?php $page = 'Products'; ?>
<?php require 'inc/header.php' ?>
<?php 

$sqlJewelry = "SELECT j.*, c.categories_name FROM jewelry AS j LEFT JOIN categories AS c ON j.category = c.id";
// $sqlRentals = "SELECT r.*, u.username, c.categories_name FROM rentals AS r LEFT JOIN users AS u ON r.author = u.id LEFT JOIN categories AS c ON r.rental_category = c.categories_id";
// $sqlJewelry = "SELECT j.*, c.name FROM jewelry AS j LEFT JOIN categories AS c ON j.category = c.id";
$jewelrys = $connect->query($sqlJewelry)->fetchAll(PDO::FETCH_ASSOC);
?>

<section class="shop">
    <div class="all">
        <?php 
        foreach ($jewelrys as $jewelry) {
        ?>
        <div class="one">
            <?php if (is_null($jewelry['image']) || empty($jewelry['image'])) {
                        echo "<img src='./public/uploads/noImg.png' alt='jewelry_image' width='200'/> ";
                    } else {
                    ?>
                        <img src="./public/uploads/<?php echo $jewelry['image']; ?>" alt='<?php echo $jewelry['name']; ?>' width='200' />
                    <?php
                    }
                    ?>
                <div>
                    <h3><?php echo $jewelry['name']; ?></h3>
                    <!-- <p><?php echo $jewelry['description']; ?></p> -->
                    <p><?php echo $jewelry['categories_name']; ?></p>
                    <div class="price">
                        <p class="amount"><?php echo $jewelry['price']; ?>$</p>
                    </div>
                    <div>
                        <!-- <p><a href="jewelry-details.php?id=<?php echo $jewelry['id']; ?>" >details</a></p> -->
                    </div>
                </div>
        </div>
        <?php
        }
        ?>
    </div>
</section>