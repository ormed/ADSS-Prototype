<?php
echo "OUT";
if (!empty($_POST["keyword"])) {
    echo "IN";
    $query = "SELECT * FROM notification WHERE title LIKE '" . $_POST["keyword"] . "%' ORDER BY title LIMIT 0,6";
    $db = new Database();
    $result = $db->createQuery($query);
    if (!empty($result)) {
        ?>
        <ul id="country-list">
            <?php
            foreach ($result as $country) {
                ?>
                <li onClick="selectCountry('<?php echo $country["title"]; ?>');"><?php echo $country["title"]; ?></li>
            <?php } ?>
        </ul>
    <?php }
} ?>