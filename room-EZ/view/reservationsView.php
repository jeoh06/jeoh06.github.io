<?php if (count($reservations)) { ?>
    <div id="cancellationModal" class="modal">
        <!-- Modal content -->
        <div class="cancel-modal-content">
            <span class="close">&times;</span>
            <div class="cancellationContent">
                <h3 id="cancel">Do you wish to cancel this reservation?</h3>
                <div>
                    <button class="confirmButton">Yes</button>&nbsp;&nbsp;
                    <button class="closeButton">No</button>
                </div>
            </div>
        </div>
    </div>
    <div id="cancellation">
        <!-- <div>
            <div>Reservation Number</div>
            <div>Start Date</div>
            <div>End Date</div>
            <div>Total price</div>
        </div> -->
        <p>Confirmed Reservations:</p>
    <?php foreach($reservations as $reservation){?>
        <form action="index.php" method="post">
            <div id="reservationUpdate">
                <div class="reservationNum">
                    <p>Reservation Number: <?= $reservation['reservation_num']?></p>
                    <div><img src="./public/images/property_images/<?=$reservation['pi_id'].'/'.$reservation['pi_img'];?>" alt=""></div>
                    <p><a href="index.php?action=property&propId=<?=$reservation['property_id']?>"><?=$reservation['post_title']?></a></p>
                </div>
                <div>
                    <div>
                        <!-- <p>Address:</p> -->
                        <p><span>Address: </span><?="{$reservation['address1']}, {$reservation['address2']}"?></p>
                        <p><?="{$reservation['province_state']}, {$reservation['city']}, {$reservation['country']}"?></p>
                    </div>
                    <div>  
                        <p><span>Start Date: </span><?= str_replace('-', '/', $reservation['start_date'])?></p>
                        <p><span>End Date: </span><?= str_replace('-', '/', $reservation['end_date'])?></p>
                        <p><span>Total Payment: </span><?= number_format($reservation['total_payment_won'])?>₩</p>
                    </div>
                </div>
                <button id="cancelReservation">Cancel Reservation</button>
                <input name="reservation_num" type="hidden" value="<?= $reservation['reservation_num']?>">
                <input name="action" type="hidden" value="cancelReservation">
            </div>
        </form>
        <?php }?>
    </div>
    <script src="./public/js/cancellationModal.js"></script>
<?php }?>