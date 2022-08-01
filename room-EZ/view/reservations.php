<?php
$title = "Reserve this property";
ob_start();?>

<!-- create an array of all reservations start and end date -->
<?php 
        ?> <script> const reservedList = []; </script> <?php
        foreach ($reservations as $reservation) {

            ?> <script> 
                reservedList.push(["<?=($reservation['start_date']);?>", "<?=($reservation['end_date']);?>"])
            </script>    
        <?php }
    ?>


<section class="creditCardForm">
    <div class="heading">
        <h1>Reservation Payment</h1>
    </div>
    <div class="payment">
        <form id="paymentForm" action="index.php" method="post">
            
            <div class="topContainer">
                <p id="available">How long do you wish to stay?</p><br>
                <div class="stayingDuration">
                    <div class="checkIn">
                        <span>Check In</span>
                        <span id="selectedCheckInDate"></span> 
                    </div>
                    <div class="checkOut">
                        <span>Check Out</span>
                        <span id="selectedCheckOutDate"></span>
                    </div>
                </div>
                <div class="hiddenContainer">Select your dates</div>
            </div>
            
            <div class="calendarContainer">
                <input id="datepicker" class="datepicker" placeholder="Select your dates"/>

                <!-- CALENDAR JS -->
                <script>
                const DateTime = easepick.DateTime;

                const bookedDates = reservedList.map(d => {
                    if (d instanceof Array) {
                        const start = new DateTime(d[0], 'YYYY-MM-DD');
                        const end = new DateTime(d[1], 'YYYY-MM-DD');

                        return [start, end];
                    }
                    
                    return new DateTime(d, 'YYYY-MM-DD');
                });

                const picker = new easepick.create({
                    element: document.getElementById('datepicker'),
                    css: [
                        'public/style/bookingCalendar.css',
                    ],
                    plugins: ['RangePlugin', 'LockPlugin'],
                    RangePlugin: {
                    tooltipNumber(num) {
                        return num - 1;
                    },
                    locale: {
                        one: 'night',
                        other: 'nights',
                    },
                    },
                    LockPlugin: {
                    minDate: new Date(),
                    minDays: 2,
                    inseparable: true,
                    filter(date, picked) {
                        if (picked.length === 1) {
                        const incl = date.isBefore(picked[0]) ? '[)' : '(]';
                        return !picked[0].isSame(date, 'day') && date.inArray(bookedDates, incl);
                        }

                        let selectedRange = document.getElementById("datepicker").value.split(" - ")
                        if (document.getElementById("datepicker").value) {
                            document.getElementById("startDate").value = selectedRange[0];
                            document.getElementById("endDate").value = selectedRange[1];
                            dateDiff();
                        }

                        // to display dates inside check in & check out
                        let selectedCheckInDate = document.querySelector('#selectedCheckInDate');
                        let selectedCheckOutDate = document.querySelector('#selectedCheckOutDate');
                        let checkInDate = selectedRange[0];
                        let checkOutDate = selectedRange[1];
                        selectedCheckInDate.textContent = checkInDate;
                        selectedCheckOutDate.textContent = checkOutDate;
                        

                        return date.inArray(bookedDates, '[)');
                    },
                    }
                });
                </script>
                <!-- CALENDAR JS -->
                <input type="hidden" id="startDate" name="startDate"  value="<?php echo date('m-d-Y'); ?>">
                <input type="hidden" id="endDate" name="endDate"  value="<?php echo date('m-d-Y'); ?>">
            </div>

            <div id=dateBtn>Select dates to see prices</div><br>
            <div class="creditCards">
                <img id="creditCards"src="public/images/capture.JPG" alt="creditCards">
            </div>
            <label>
                <span>Cardholder</span>
                <input type="text" class="form-control" id="owner" name="owner" placeholder="Enter your name as shown on your credit card" pattern="^(?![\s.]+$)[A-Z\-a-z\s.]{2,}" required >
                <div class="nameError"><em>Please enter your name</em></div>
            </label>
            <label>
                <span>Card #</span>
                <input type="text" class="form-control" onkeyup="formatCreditCard()" id="cardNumber" name="cardNumber" placeholder="Enter a valid credit card number" required>
                <div class="numError"><em>Please enter a correct card number</em></div>
            </label>            
            <label for="cvv">
                <span>CVV</span>
                <input type="text" class="form-control" id="cvv" name="cvv" placeholder="Enter the 3 or 4 digit code on the back of your card" pattern="^[0-9]{3,4}" required>
                <div class="cvvError"><em>3 or 4 numbers only</em></div>
            </label>
            <label class="expiry">
                <span>Expiry</span>
                <select name="month" id="month" required>
                    <option value="" selected disabled hidden>Select month</option>
                    <option value="01">January</option>
                    <option value="02">February </option>
                    <option value="03">March</option>
                    <option value="04">April</option>
                    <option value="05">May</option>
                    <option value="06">June</option>
                    <option value="07">July</option>
                    <option value="08">August</option>
                    <option value="09">September</option>
                    <option value="10">October</option>
                    <option value="11">November</option>
                    <option value="12">December</option>
                </select>
                <select name="year" id="year" required>
                    <option value="" selected disabled hidden>Select year</option>
                    <option value="22"> 2022</option>
                    <option value="23"> 2023</option>
                    <option value="24"> 2024</option>
                    <option value="25"> 2025</option>
                    <option value="26"> 2026</option>
                    <option value="27"> 2027</option>
                </select>
            </div>
                <div class="buttons">
                    <!-- <img src="public/images/Credit-Card-Icons.jpg" id="visa"> -->
                    <button type="submit" class="btn btn-default" id="confirm-purchase">Confirm Payment</button>
                    <input type="hidden" value="addReservationInfo" name="action">
                    <button id="reset" type="reset">Reset the form</button>
                    <input type="hidden" name="propId" value="<?=$_REQUEST['propId']?>">
                    <input type="hidden" name="price" value="<?=$_REQUEST['price']?>">
            
                </div>

            </form>
    </div>
</section>
<script src="public/js/reservations.js"></script>

<?php
$content = ob_get_clean();
include('template.php');
?>

