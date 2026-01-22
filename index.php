<?php
// Rivera, Ella Nicole T. | WD-201

// as per instruction, 5 dom and 5 intl

date_default_timezone_set("Asia/Manila");

/*
this stuff was specified in the instructions

had to alter my initial arrays

Flight fields:
flightNo, airline, origin, destination,
originTZ, destTZ, dep (Y-m-d H:i),
duration (minutes), image
*/

// DOMESTIC FLIGHTS
$domesticFlights = [
    ["PR 1001", "Philippine Airlines", "Manila", "Cebu", "Asia/Manila", "Asia/Manila", "2026-01-22 08:00", 90, "https://a.travel-assets.com/findyours-php/viewfinder/images/res70/129000/129074-Cebu-Island.jpg"],
    ["PR 2002", "Philippine Airlines", "Manila", "Davao", "Asia/Manila", "Asia/Manila", "2026-01-22 10:00", 120, "https://www.bria.com.ph/wp-content/uploads/2022/04/Davao-Ideal-place-to-live-in-1.jpg"],
    ["5J 3003", "Cebu Pacific", "Cebu", "Iloilo", "Asia/Manila", "Asia/Manila", "2026-01-22 13:00", 60, "https://upload.wikimedia.org/wikipedia/commons/2/25/Villanueva_Building_%28Calle_Real%29_in_Iloilo_City_%28cropped%29.jpg"],
    ["PR 4004", "Philippine Airlines", "Manila", "Bacolod", "Asia/Manila", "Asia/Manila", "2026-01-22 15:00", 75, "https://mediaim.expedia.com/destination/1/786072a371d3433948cf4efc4b9f6b0b.jpg"],
    ["5J 5005", "Cebu Pacific", "Clark", "Puerto Princesa", "Asia/Manila", "Asia/Manila", "2026-01-22 18:00", 90, "https://undergroundriver.puertoprincesa.ph/wp-content/uploads/2025/12/558474052_804976885625154_3380762223189325356_n.jpg"]
];

// INTERNATIONAL FLIGHTS
$internationalFlights = [
    ["PR 6001", "Philippine Airlines", "Manila", "Tokyo", "Asia/Manila", "Asia/Tokyo", "2026-01-22 07:00", 300, "https://media.cntraveller.com/photos/6343df288d5d266e2e66f082/16:9/w_2560%2Cc_limit/tokyoGettyImages-1031467664.jpeg"],
    ["PR 6002", "Philippine Airlines", "Manila", "Seoul", "Asia/Manila", "Asia/Seoul", "2026-01-22 09:00", 270, "https://www.agoda.com/wp-content/uploads/2024/08/Namsan-Tower-during-autumn-in-Seoul-South-Korea-1244x700.jpg"],
    ["5J 6003", "Cebu Pacific", "Manila", "Singapore", "Asia/Manila", "Asia/Singapore", "2026-01-22 11:00", 225, "https://images.trvl-media.com/place/6047873/15d3ae30-ef33-406e-971f-9520c03f1089.jpg"],
    ["PR 6004", "Philippine Airlines", "Cebu", "Hong Kong", "Asia/Manila", "Asia/Hong_Kong", "2026-01-22 16:00", 150, "https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fimage.cnbcfm.com%2Fapi%2Fv1%2Fimage%2F105594325-1543312152022gettyimages-500806746.jpeg%3Fv%3D1579189242&f=1&nofb=1&ipt=68beccd3f56b7e7f782b7b2acf041d10607b7404bb75667f356d751026bf62a5"],
    ["EK 6005", "Emirates", "Manila", "Dubai", "Asia/Manila", "Asia/Dubai", "2026-01-22 22:00", 480, "https://www.dubai.it/en/wp-content/uploads/sites/142/dubai-marina-hd.jpg"]
];

// turning this part into a function for decluttering the html part
function renderFlights($flights) {
    foreach ($flights as $f) {
        // assign dept and arr time using DateTime and DateTimeZone
        $dep = new DateTime($f[6], new DateTimeZone($f[4]));
        $arr = clone $dep;
        $arr->modify("+{$f[7]} minutes"); // add duration to departure time
        // modify timezone to arrival timezone
        $arr->setTimezone(new DateTimeZone($f[5])); // this'll set it to destination timezone

        $duration = $dep->diff($arr); // use diff to get duration object
        // I think this is a DateInterval object

        echo "
        <article class='flight'>
            <img src='{$f[8]}' alt='Flight Image'>
            <div class='flight-info'>
                <h3>{$f[0]} – {$f[1]}</h3>
                <p><strong>{$f[2]} → {$f[3]}</strong></p>
                <p>Departure: {$dep->format('M d, Y h:i A')}</p>
                <p>Arrival: {$arr->format('M d, Y h:i A')}</p>
                <p>Duration: {$duration->h}h {$duration->i}m</p>
                <p class='tz'>Timezone: {$f[4]} → {$f[5]}</p>
            </div>
        </article>";
    }
}
?>

<!-- html part starts here -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Flight Schedule</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>

<body>
<?php include "header.php" ?>

<main id="flights">
    <h2 id="domestic">Domestic Flights</h2>
    <section class="cards">
        <?php renderFlights($domesticFlights); ?>
    </section>

    <h2 id="international">International Flights</h2>
    <section class="cards">
        <?php renderFlights($internationalFlights); ?>
    </section>

    <section id="timezones">
        <h2>Other Timezones</h2>
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
