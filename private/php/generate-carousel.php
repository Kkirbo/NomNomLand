<?php
function generateCarousel()
{
    $carouselTags = [
        1 => "Today's special",
        2 => "Customer favorite",
        3 => "Best seller"
    ];
    $json = file_get_contents('../../private/data/dishes.json');
    $data = json_decode($json, true);

    if ($data && isset($data['dishes'])) {

        foreach ($data['dishes'] as $meal) {
            $carouselNumber = intval($meal['carousel']);
            if ($carouselNumber > 0) {
                $tag = $carouselTags[$carouselNumber] ?? "Recommanded";
                $id = htmlspecialchars($meal['id']);
                $title = htmlspecialchars($meal['title']);
                $desc = htmlspecialchars($meal['version']);
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
        echo "<p>Error loading dishes.</p>";
    }
}
?>
