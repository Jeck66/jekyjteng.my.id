<?php
/*
 
 */

if ($reply == 'Your maximum never usage time has been reached') {
echo "<center><div class='notice'>Voucher anda sudah kadaluarsa";
}
else if ($reply) {
echo "<center><div class='notice'>$reply";
}
else {
echo "<center><div class='notice'>$h1Failed";
}

echo "</div>";
echo "</div></div>";
