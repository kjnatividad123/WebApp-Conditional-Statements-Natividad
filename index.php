<?php
    if($_SERVER["REQUEST_METHOD"] === "POST") {
        echo "<h2>Order Summary</h2>";

        $coffee_prices = [
            "espresso" => 500,
            "latte" => 600,
            "cappucino" => 700,
            "americano" => 800,
            "mocha" => 900,
        ];

        $size_prices = [
            "small" => 0.00,
            "medium" => 50.0,
            "large" => 80.0,
        ];

        $extras_prices = [
            "sugar" => 5.00,
            "cream" => 10.00,
        ];

        $coffee_type = $_POST["coffee"];
        $size = $_POST["size"];

        if(isset($_POST["extras"])) {
            $extras = $_POST["extras"];
        } else {
            $extras = [];
        };

        $total_price = $coffee_prices[$coffee_type] + $size_prices[$size];

        foreach($extras as $extra) {
            $total_price = $total_price + $extras_prices[$extra];
        }

        echo $total_price;
        }
        
?>