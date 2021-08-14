<?php $page = 'Products'; ?>
<?php require 'inc/header.php' ?>
<?php 

$sqlJewelry = "SELECT j.*, c.name FROM jewelry AS j LEFT JOIN categories AS c ON j.category = c.id";
$jewelrys = $connect->query($sqlJewelry)->fetchAll(PDO::FETCH_ASSOC);
?>

<section>
    <div>
        <div>
            <?php 
            foreach ($jewelrys as $jewelry) {
            ?>
            <div>
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
                        <p><?php echo $jewelry['description']; ?></p>
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
        </div>
    </div>
</section>