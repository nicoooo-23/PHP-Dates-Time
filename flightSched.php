<!-- Rivera, Ella Nicole T. | WD-201 -->
<?php
    // as per instruction, 5 dom and 5 intl

    // Set base timezone
    date_default_timezone_set("Asia/Manila");

    $today = date("F d, Y H:i:s");

    // gonna use arrays for easy calling by index later using foreach

    // dom flights
    $domesticFlights = [
        ["Manila", "Cebu", "08:00 AM", "+1 hour 30 minutes", "https://a.travel-assets.com/findyours-php/viewfinder/images/res70/129000/129074-Cebu-Island.jpg"],
        ["Manila", "Davao", "10:00 AM", "+2 hours", "https://www.bria.com.ph/wp-content/uploads/2022/04/Davao-Ideal-place-to-live-in-1.jpg"],
        ["Cebu", "Iloilo", "01:00 PM", "+1 hour", "https://upload.wikimedia.org/wikipedia/commons/2/25/Villanueva_Building_%28Calle_Real%29_in_Iloilo_City_%28cropped%29.jpg"],
        ["Manila", "Bacolod", "03:00 PM", "+1 hour 15 minutes", "https://mediaim.expedia.com/destination/1/786072a371d3433948cf4efc4b9f6b0b.jpg"],
        ["Clark", "Puerto Princesa", "06:00 PM", "+1 hour 30 minutes", "https://undergroundriver.puertoprincesa.ph/wp-content/uploads/2025/12/558474052_804976885625154_3380762223189325356_n.jpg"]
    ];

    // intl flights
    $internationalFlights = [
        ["Manila", "Tokyo", "07:00 AM", "+5 hours", "https://media.cntraveller.com/photos/6343df288d5d266e2e66f082/16:9/w_2560%2Cc_limit/tokyoGettyImages-1031467664.jpeg"],
        ["Manila", "Seoul", "09:00 AM", "+4 hours 30 minutes", "https://www.agoda.com/wp-content/uploads/2024/08/Namsan-Tower-during-autumn-in-Seoul-South-Korea-1244x700.jpg"],
        ["Manila", "Singapore", "11:00 AM", "+3 hours 45 minutes", "https://images.trvl-media.com/place/6047873/15d3ae30-ef33-406e-971f-9520c03f1089.jpg"],
        ["Cebu", "Hong Kong", "04:00 PM", "+2 hours 30 minutes", "https://img.static-kl.com/transform/41181f1f-5ac2-4074-89f2-d99d3a1c88f6/"],
        ["Manila", "Dubai", "10:00 PM", "+8 hours", "https://www.dubai.it/en/wp-content/uploads/sites/142/dubai-marina-hd.jpg"]
    ];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flight Schedule</title>

    <link rel="stylesheet" href="styles.css" media="screen">
    <link rel="stylesheet" href="print.css" media="print">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>

<body>
<header>
    <nav>
        <!-- hamburger for mobile use -->
        <input type="checkbox" id="check">
        <label for="check" class="checkbtn">&#9776;</label>

        <ul class="menu">
            <li><a href="#home">Home</a></li>
            <li><a class="submenuTitle" href="#flights">Flights <i class="fa fa-caret-down"></i></a>
                <ul class="submenu">
                <li><a href="#domestic">Domestic</a></li>
                <li><a href="#international">International</a></li>
                </ul>
            </li>
            <li><a href="#timezones">Timezones</a></li>
            <li><a href="#contact">Contact</a></li>
            
        </ul>
    </nav>

    <section class="banner" id="home">
        <br>
        <h1>Flight Schedule</h1>
        <hr>
        <p>Date and Time Today:</p>
        <p><?php echo $today; ?></p>
    </section>
</header>

<main class="flights" id="flights">

    <!-- DOMESTIC FLIGHTS -->
    <h2 id="domestic">Domestic Flights</h2>
    <section class="domestic">
        
        <?php foreach ($domesticFlights as $flight): ?>
            <?php
                $departure = strtotime($flight[2]); // conv str to time format
                $arrival = strtotime($flight[3], $departure); // conv time to compute dept time
            ?>
            <article class="flight">
                <img src="<?php echo $flight[4]; ?>" alt="Domestic Flight">
                <h3><?php echo $flight[0] . " → " . $flight[1]; ?></h3>
                <p>Date: <?php echo $today; ?></p>
                <p>Departure: <?php echo date("h:i A", $departure); ?></p>
                <p>Arrival: <?php echo date("h:i A", $arrival); ?></p>
            </article>
        <?php endforeach; ?>
    </section>

    <!-- INTERNATIONAL FLIGHTS -->
    <h2 id="international">International Flights</h2>
    <section class="international">
        
        <?php foreach ($internationalFlights as $flight): ?>
            <?php
                $departure = strtotime($flight[2]);
                $arrival = strtotime($flight[3], $departure);
            ?>
            <article class="flight">
                <img src="<?php echo $flight[4]; ?>" alt="International Flight">
                <h3><?php echo $flight[0] . " → " . $flight[1]; ?></h3>
                <p>Date: <?php echo $today; ?></p>
                <p>Departure: <?php echo date("h:i A", $departure); ?></p>
                <p>Arrival: <?php echo date("h:i A", $arrival); ?></p>
            </article>
        <?php endforeach; ?>
    </section>
    

    <!-- OTHER TIME ZONES HERE -->

    <section id="timezones">
        <h2>Current Time in Other Time Zones</h2>

        <?php
            // set the timezones here per international country
            // echo the time after
            date_default_timezone_set("Asia/Tokyo");
            echo "<p>Tokyo, Japan: " . date("h:i A") . " </p>";

            date_default_timezone_set("Asia/Seoul");
            echo "<p>Seoul, South Korea: " . date("h:i A") . " </p>";

            date_default_timezone_set("Asia/Singapore");
            echo "<p>Singapore: " . date("h:i A") . " </p>";

            date_default_timezone_set("Asia/Hong_Kong");
            echo "<p>Hong Kong: " . date("h:i A") . " </p>";

            date_default_timezone_set("Asia/Dubai");
            echo "<p>Dubai, UAE: " . date("h:i A") . " </p>";

            // reset timezone back to Manila
            date_default_timezone_set("Asia/Manila");
        ?>
    </section>
   

</main>

<?php include "footer.php" ?>
</body>
</html>