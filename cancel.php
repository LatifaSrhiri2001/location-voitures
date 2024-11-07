<?php

include 'components/navbar.php';

$message = "Le paiement a été annulé. Veuillez réessayer.";
?>


<div class="container mx-auto mt-10">
    <div class="max-w-md mx-auto bg-white shadow-md rounded-lg overflow-hidden">
        <div class="p-6 bg-yellow-100 text-yellow-800">
            <h2 class="text-xl font-semibold">Attention</h2>
            <p><?php echo $message; ?></p>
        </div>
    </div>
</div>
