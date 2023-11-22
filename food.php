<?php include('partials-front/menu.php'); ?>

<?php
// Check whether food id is set or not
if (isset($_GET['food_id'])) {
    $food_id = $_GET['food_id'];

    // Get the details of the selected Food
    $sql = "SELECT * FROM tbl_food WHERE id=$food_id";
    // Execute the Query
    $res = mysqli_query($conn, $sql);
    // Count the rows
    $count = mysqli_num_rows($res);
    // Check whether the data is available or not
    if ($count == 1) {
        // We have data
        // Get the data from the Database
        $row = mysqli_fetch_assoc($res);

        $id = $row['id'];
        $title = $row['title'];
        $price = $row['price'];
        $description = $row['description'];
        $image_name = $row['image_name'];
        ?>
        <div class="food-menu-img">
            <?php
            // Check whether image is available or not
            if ($image_name == "") {
                // Image not available
                echo "<div class='error'>Image not available.</div>";
            } else {
                // Image available
                ?>
                <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza"
                    class="img-responsive img-curve">
                <?php
            }
            ?>

        </div>

        <div class="food-menu-desc">
            <h4>
                <?php echo $title; ?>
            </h4>
            <p class="food-price">Rs.
                <?php echo $price; ?>
            </p>
            <p class="food-detail">
                <?php echo $description; ?>
            </p>
            <br>

            <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
        </div>
        <?php
    } else {
        // Food not available
        // Redirect to Home Page
        header('location:' . SITEURL);
    }

    // Make API call to get recommended items
    $api_url = 'http://127.0.0.1:5000/recommendations';
    $post_data = array('food_id' => $food_id, 'description' => $description);
    $ch = curl_init($api_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post_data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    $api_response = curl_exec($ch);
    curl_close($ch);

    // Process and display recommended items
    if ($api_response) {
        $reccomended_items = json_decode($api_response, true);
        array_shift($reccomended_items);

        ?>
        <div>
            <h1>Recommended Items</h1>
            <ul>
                <?php foreach ($reccomended_items as $item): ?>
                    <?php
                    $sql = "SELECT * FROM tbl_food WHERE id=$item";
                    $res = mysqli_query($conn, $sql);
                    $count = mysqli_num_rows($res);
                    if ($count == 1) {
                        $row = mysqli_fetch_assoc($res);
                        $id = $row['id'];
                        $title = $row['title'];
                        $price = $row['price'];
                        $description = $row['description'];
                        $image_name = $row['image_name'];
                        ?>
                        <a href="<?php echo SITEURL; ?>food.php?food_id=<?php echo $id; ?>">
                            <div class="food-menu-box">
                                <div class="food-menu-img">
                                    <?php
                                    //Check whether image available or not
                                    if ($image_name == "") {
                                        //Image not Available
                                        echo "<div class='error'>Image not available.</div>";
                                    } else {
                                        //Image Available
                                        ?>
                                        <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza"
                                            class="img-responsive img-curve">
                                        <?php
                                    }
                                    ?>

                                </div>

                                <div class="food-menu-desc">
                                    <h4>
                                        <?php echo $title; ?>
                                    </h4>
                                    <p class="food-price">Rs.
                                        <?php echo $price; ?>
                                    </p>
                                    <p class="food-detail">
                                        <?php echo $description; ?>
                                    </p>
                                    <br>
                                </div>
                            </div>
                        </a>
                        <?php
                    } else {
                        echo 'Error: Unable to fetch recommended items from the API';
                    }
                    ?>
                <?php endforeach; ?>
            </ul>
        </div>
        <?php
    } else {
        // Redirect to homepage
        header('location:' . SITEURL);
    }
}
?>