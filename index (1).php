<?php 
function displayOrderSummary(){
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

        $instruction = $_POST["instruction"];
        $name = $_POST["name"];

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
        };

        // $total_price = $coffee_prices[$coffee_type] + $size_prices[$size];
        $total_price = calculatePrice($coffee_prices, $size_prices, $extras_prices, $coffee_type, $size, $extras);

        echo $name;
        echo "<br />";
        echo $instruction;
        echo "<br />";
        echo $total_price;

        $receiptContent = generateReceipt($name, $coffee_type, $size, $total_price, $instruction);

        saveReceipt($receiptContent);
    }

        function calculatePrice($coffee_prices, $size_prices, $extras_prices, $coffee_type, $size, $extras){
            $total_price = $coffee_prices[$coffee_type] + $size_prices[$size];

            foreach($extras as $extra) {
                $total_price = $total_price + $extras_prices[$extra];
            }
            
            return $total_price;
        }

        function generateReceipt($name, $coffee_type, $size, $total_price, $instructions){
            $receiptContent = "Order Summary\n";
            $receiptContent .= "---------------\n";

            $receiptContent .= "Name: " . $name . "\n";
            $receiptContent .= "Coffee Type: " . $coffee_type . "\n";
            $receiptContent .= "Size: " . $size . "\n";
            $receiptContent .= "Total Price: " . $total_price  . "\n";
            $receiptContent .= "Instructions: " . $instructions . "\n";
            $receiptContent .= "Thank you for Ordering!";

            return $receiptContent;
        }
        
        function saveReceipt($receiptContent){
            $file = fopen("Order Summary.txt", "w") or die("Unable to open file");

            fwrite($file, $receiptContent);

            fclose($file);

            echo "Receipt saved.";

        }

         // calling the function
        displayOrderSummary();
        

?>