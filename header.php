<header>
    <nav>
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
        <h1>Flight Schedule</h1>
        <p>Today: <?= date("F d, Y h:i A") ?></p>
    </section>
</header>