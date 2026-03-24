<?php
$carouselTags = [
    1 => "Today's special",
    2 => "Customer favorite",
    3 => "Best seller"
];

// Load JSON
$json = file_get_contents('../../private/data/meals.json');
$data = json_decode($json, true);

if ($data && isset($data['meals'])) {

    // Loop over all meals
    foreach ($data['meals'] as $meal) {

        $carouselNumber = intval($meal['carousel']);

        // Only include meals with carousel > 0
        if ($carouselNumber > 0) {

            $tag = $carouselTags[$carouselNumber] ?? "Recommanded";
            $id = htmlspecialchars($meal['id']);
            $title = htmlspecialchars($meal['title']);
            $desc = htmlspecialchars($meal['description']);
            $image = htmlspecialchars($meal['image']);

            echo "
            <article class='Meal modernNeonBoxGlass'>
                <a href='menu.php#$id' class='imageLink'>
                    <img draggable='false' src='$image' alt='$title Image'>
                </a>
                <ul>
                    <li><h3>$tag</h3></li>
                    <li>$title</li>
                    <li>$desc</li>
                    <li><a href='menu.php#$id'><button>Order</button></a></li>
                </ul>
            </article>
            ";
        }
    }

} else {
    echo "<p>Error loading meals.</p>";
}
?>
