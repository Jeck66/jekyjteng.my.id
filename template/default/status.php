<!DOCTYPE html>
<html>
<head>
    <title>STATUS</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="theme-color" content="#3B5998" />
    <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;" />
    <link rel="icon" type="image" href="assets/images/favicon.png" sizes="32x32">
    <link rel="stylesheet" href="assets/css/style.css">
    <style> .frame img {width: 100%;height: auto;}</style>
</head>
<body>
    <!-- App Header -->
    <div class="appHeader">
        <div class="left">
            <a href="#">
            </a>
        </div>
        <div class="pageTitle">
            Status
        </div>
        <div class="right">
            <a href="#" class="headerButton" data-bs-toggle="modal" data-bs-target="#Notif">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"  width="24" height="24" viewBox="0 0 24 24">
				<path fill="#6236FF" d="M10 21H14C14 22.1 13.1 23 12 23S10 22.1 10 21M21 19V20H3V19L5 17V11C5 7.9 7 5.2 10 4.3V4C10 2.9 10.9 2 12 2S14 2.9 14 4V4.3C17 5.2 19 7.9 19 11V17L21 19M17 11C17 8.2 14.8 6 12 6S7 8.2 7 11V18H17V11Z" />
				</svg>
                <span class="badge badge-danger">1</span>
            </a>
        </div>
    </div>
    <!-- * App Header -->

    <!-- Logout -->
<form action="http://10.10.10.1:3990/logoff" name="logout" onSubmit="return openLogout()">
    <div class="modal fade dialogbox" id="Logout" data-bs-backdrop="static" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Logout</h5>
                </div>
                <div class="modal-body">
                    Anda Yakin?
                </div>
                    <div class="btn-inline">
                        <a href="#" class="btn btn-text-primary" data-bs-dismiss="modal">BATAL</a>
                        <button type="submit" class="btn btn-text-danger">LOGOUT</button>
                </div>
            </div>
        </div>
    </div>
</form>
    <!-- * Logout -->

	<!-- Notifikasi -->
        <div class="modal fade dialogbox" id="Notif" data-bs-backdrop="static" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-icon">
						<div class="avatar-section">
							<a href="#">
								<img src="assets/img/favicon.png" alt="avatar" class="imaged w100 rounded">
								<span class="button btn-success">
									<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"  width="24" height="24" viewBox="0 0 24 24">
									<path fill="#ffffff" d="M10,17L6,13L7.41,11.59L10,14.17L16.59,7.58L18,9M12,1L3,5V11C3,16.55 6.84,21.74 12,23C17.16,21.74 21,16.55 21,11V5L12,1Z" />
									</svg>
								</span>
							</a>
						</div>
                    </div>
                    <div class="modal-header">
                        <h5 class="modal-title"><script src="assets/config/namawifi.js"></script></h5>
                    </div>
                    <div class="modal-body">
                        <br>Gunakan Internet Dengan Bijak!!!</br><script src="assets/config/informasi.js"></script>
                    </div>
                    <div class="modal-footer">
                        <div class="btn-inline">
                            <a href="#" class="btn btn-text-primary" data-bs-dismiss="modal">TUTUP</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <!-- * Notifikasi -->

    <!-- App Capsule -->
    <div id="appCapsule">

        <div class="section mt-3 text-center">
            <div class="avatar-section">
                <a href="#">
                    <img src="assets/img/favicon.png" alt="avatar" class="imaged w100 rounded">
                    <span class="button btn-success">
						<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"  width="24" height="24" viewBox="0 0 24 24">
						<path fill="#ffffff" d="M10,17L6,13L7.41,11.59L10,14.17L16.59,7.58L18,9M12,1L3,5V11C3,16.55 6.84,21.74 12,23C17.16,21.74 21,16.55 21,11V5L12,1Z" />
						</svg>
                    </span>
                </a>
            </div>
        </div>

        <div class="listview-title mt-1">Pengaturan</div>
        <ul class="listview image-listview text inset">
            <li>
                <div class="item">
                    <div class="in">
                        <div>
                            Dark Mode
                        </div>
                        <div class="form-check form-switch  ms-2">
                            <input class="form-check-input dark-mode-switch" type="checkbox" id="darkmodeSwitch">
                            <label class="form-check-label" for="darkmodeSwitch"></label>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    <!-- App Capsule -->
<?php
if (isset($_GET['mac'])) {
    $servername = "127.0.0.1";
    $username = "radius";
    $password = "radius";
    $dbname = "radius";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Koneksi database gagal: " . $conn->connect_error);
    }

    $mac_address = $conn->real_escape_string($_GET['mac']);
    
    $query = "SELECT acctinputoctets, acctoutputoctets, framedipaddress, callingstationid
              FROM radacct
              WHERE callingstationid = '$mac_address'
                AND acctstoptime IS NULL
              ORDER BY acctstarttime DESC
              LIMIT 1;";
    
    $result = $conn->query($query);

    $data = array();

    $sqlUser = "SELECT username FROM radacct
    WHERE callingstationid = '$mac_address'
                AND acctstoptime IS NULL
              ORDER BY acctstarttime DESC
              LIMIT 1;";
              
    $resultUser = mysqli_fetch_assoc(mysqli_query($conn, $sqlUser));
    $user = $resultUser['username'];
    
    $sqlSession = "SELECT acctsessiontime FROM radacct
    WHERE username = '$user'
                AND acctstoptime IS NULL
              ORDER BY acctstarttime DESC
              LIMIT 1;";
              
    $resultSession = mysqli_fetch_assoc(mysqli_query($conn, $sqlSession));
    $Session = $resultSession['acctsessiontime'];
    
    $sqlTerpakai = "SELECT username, 
           SUM(acctsessiontime) AS total_acctsessiontime
    FROM radacct WHERE username = '$user';";
    
    $resultTerpakai = mysqli_fetch_assoc(mysqli_query($conn, $sqlTerpakai));
    $Terpakai = $resultTerpakai['total_acctsessiontime'];
    
    $sqlTotalSession = "SELECT ug.username, rc.value AS max_all_session
    FROM radusergroup ug
    JOIN radgroupcheck rc ON ug.groupname = rc.groupname
    WHERE ug.username = '$user'
    AND rc.attribute = 'Max-All-Session';";
              
    $resultTotalSession = mysqli_fetch_assoc(mysqli_query($conn, $sqlTotalSession));
    if (is_array($resultTotalSession) && isset($resultTotalSession['max_all_session'])) {
        $totalSession = $resultTotalSession['max_all_session'];
    } else {
        $totalSession = 0;
    }
    
    $sqlTotalKuota = "SELECT VALUE AS total_kuota
    FROM radgroupreply
    WHERE ATTRIBUTE = 'ChilliSpot-Max-Total-Octets'
      AND GROUPNAME = (
        SELECT GROUPNAME
        FROM radusergroup
        WHERE USERNAME = '$user'
      )";

    $resultTotalKuota = mysqli_fetch_assoc(mysqli_query($conn, $sqlTotalKuota));
    if (is_array($resultTotalKuota) && isset($resultTotalKuota['total_kuota'])) {
        $totalKuota = $resultTotalKuota['total_kuota'];
    } else {
        $totalKuota = 0;
    }
            
    $sqlKuotaDigunakan = "SELECT SUM(acctinputoctets + acctoutputoctets) as kuota_terpakai FROM radacct WHERE username = '$user';";
    $resultKuotaDigunakan = mysqli_fetch_assoc(mysqli_query($conn, $sqlKuotaDigunakan));
    $KuotaDigunakan = $resultKuotaDigunakan['kuota_terpakai'];
    
    $expiryTime = $totalSession - $Terpakai;

    $sisaKuota = $totalKuota - $KuotaDigunakan;
    
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $username = $user;
            $userUpload = toxbyte($row['acctinputoctets']);
            $userDownload = toxbyte($row['acctoutputoctets']);
            $userTraffic = toxbyte($row['acctoutputoctets'] + $row['acctinputoctets']);
            $userKuota = toxbyte($sisaKuota);
            $userOnlineTime = time2str($Session);
            echo "<script>var initialSessionTime = $Session;</script>";
            $userExpired = sisa($expiryTime);
            $userIPAddress = $row['framedipaddress'];
            $userMacAddress = $row['callingstationid'];
            
            $data[] = array(
                'username' => $username,
                'userIPAddress' => $userIPAddress,
                'userMacAddress' => $userMacAddress,
                'userDownload' => $userDownload,
                'userUpload' => $userUpload,
                'userTraffic' => $userTraffic,
                'userKuota' => $userKuota,
                'userOnlineTime' => $userOnlineTime,
                'userExpired' => $userExpired,
            );
        }
    }

    $conn->close();
           
            foreach ($data as $row) {
                    echo '<div class="listview-title mt-1">Akun</div>';
                    echo '<ul class="listview image-listview text inset">';
                    echo '<li><div class="item">Username<div class="in"></div><div>' . $row['username'] . '</div></li>';
                    echo '<li><div class="item">IP Address <div class="in"></div><div>' . $row['userIPAddress'] . '</div></li>';
                    echo '<li><div class="item">MAC Address <div class="in"></div><div>' . $row['userMacAddress'] . '</div></li>';
                    echo '</ul>';
                    echo '<div class="listview-title mt-1">Penggunaan</div>';
                    echo '<ul class="listview image-listview text inset">';
                    echo '<li><div class="item">Upload <div class="in"></div><div id="upload">' . $row['userUpload'] . '</div></li>';
                    echo '<li><div class="item">Download <div class="in"></div><div id="download">' . $row['userDownload'] . '</div></li>';
                    echo '<li><div class="item">Total Traffic <div class="in"></div><div id="traffic">' . $row['userTraffic'] . '</div></li>';
                    echo '<li><div class="item">Terkoneksi <div class="in"></div><div id="aktif">' .$row['userOnlineTime']. '</div></li>';
if ($totalSession >= 1) {
                    echo '<li><div class="item">Sisa Waktu <div class="in"></div><div id="expired">' . $row['userExpired'] . '</div></li>';
}
if ($totalKuota >= 1) {
                    echo '<li><div class="item">Sisa Kuota <div class="in"></div><div id="kuota">' . $row['userKuota'] . '</div></li>';
}
                    echo '</ul>';
                }
        }


    function toxbyte($size)
	{
        // Gigabytes
        if ( $size > 1073741824 )
        {
                $ret = $size / 1073741824;
                $ret = round($ret,2)." GB";
                return $ret;
        }

        // Megabytes
        if ( $size > 1048576 )
        {
                $ret = $size / 1048576;
                $ret = round($ret,2)." MB";
                return $ret;
        }

        // Kilobytes
        if ($size > 1024 )
        {
                $ret = $size / 1024;
                $ret = round($ret,2)." KB";
                return $ret;
        }

        // Bytes
        if ( ($size != "") && ($size <= 1024 ) )
        {
                $ret = $size." B";
                return $ret;
        }
	}
	
	function time2str($time) {

	$str = "";
	$time = floor($time);
	if (!$time)
		return "0 Detik";
	$d = $time/86400;
	$d = floor($d);
	if ($d){
		$str .= "$d Hari, ";
		$time = $time % 86400;
	}
	$h = $time/3600;
	$h = floor($h);
	if ($h){
		$str .= "$h Jam, ";
		$time = $time % 3600;
	}
	$m = $time/60;
	$m = floor($m);
	if ($m){
		$str .= "$m Menit, ";
		$time = $time % 60;
	}
	if ($time)
		$str .= "$time Detik, ";
	$str = preg_replace("/, $/",'',$str);
	return $str;

}

	function sisa($time) {

	$str = "";
	$time = floor($time);
	if (!$time)
		return "Unlimited";
	$d = $time/86400;
	$d = floor($d);
	if ($d){
		$str .= "$d Hari ";
		$time = $time % 86400;
	}
	$h = $time/3600;
	$h = floor($h);
	if ($h){
		$str .= "$h Jam ";
		$time = $time % 3600;
	}
	$m = $time/60;
	$m = floor($m);
	if ($m){
		$str .= "$m Menit ";
		$time = $time % 60;
	}
	if ($time)
	$str = preg_replace("/, $/",'',$str);
	return $str;

}
?>


    <!-- * App Capsule -->         <!-- ==== WhatsApp ====  -->
        <div class="listview-title mt-1">Lainnya</div>
        <ul class="listview image-listview text mb-2 inset">
            <li>
                <script src="assets/config/whatsapp.js"></script>
                    <div class="in">
                        <div>WhatsApp</div>
                        <span class="text-primary"></span>
                    </div>
					<div>
						<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"  width="36" height="36" viewBox="0 0 24 24">
						<path fill="#A9ABAD" d="M8.59,16.58L13.17,12L8.59,7.41L10,6L16,12L10,18L8.59,16.58Z" />
						</svg>
					</div>
                </a>
            </li>
            <li>
                <a href="pembayaranstatus.html" class="item">
                    <div class="in">
                        <div>
							Pembayaran
						</div>
						<div>
							<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"  width="36" height="36" viewBox="0 0 24 24">
							<path fill="#A9ABAD" d="M8.59,16.58L13.17,12L8.59,7.41L10,6L16,12L10,18L8.59,16.58Z" />
							</svg>
						</div>
					</div>
                </a>
            </li>
            <li>
                <a href="javascript:;" class="item" data-bs-toggle="modal" data-bs-target="#Logout">
                    <div class="in">
                        <div>
							Logout
						</div>
						<div>
							<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"  width="36" height="36" viewBox="0 0 24 24">
							<path fill="#A9ABAD" d="M8.59,16.58L13.17,12L8.59,7.41L10,6L16,12L10,18L8.59,16.58Z" />
							</svg>
						</div>
					</div>
                </a>
            </li>
        </ul>

    </div>
    <!-- * App Capsule -->

    <!-- App Bottom Menu -->
    <div class="appBottomMenu">
        <a href="#" class="item active">
            <div class="col">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"  width="24" height="24" viewBox="0 0 24 24">
				<path fill="#6236FF" d="M17 14H19V17H22V19H19V22H17V19H14V17H17V14M5 20V12H2L12 3L22 12H17V10.19L12 5.69L7 10.19V18H12C12 18.7 12.12 19.37 12.34 20H5Z" />
				</svg>
				<strong>Status</strong>
            </div>
        </a>
		<a href="javascript:;" class="item" data-bs-toggle="modal" data-bs-target="#Logout">
            <div class="col">
                <div class="action-button large">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"  width="24" height="24" viewBox="0 0 24 24">
				   <path fill="#ffffff" d="M16.56,5.44L15.11,6.89C16.84,7.94 18,9.83 18,12A6,6 0 0,1 12,18A6,6 0 0,1 6,12C6,9.83 7.16,7.94 8.88,6.88L7.44,5.44C5.36,6.88 4,9.28 4,12A8,8 0 0,0 12,20A8,8 0 0,0 20,12C20,9.28 18.64,6.88 16.56,5.44M13,3H11V13H13" />
				</svg>
                </div>
            </div>
        </a>
        <a href="bantuanstatus.html" class="item">
            <div class="col">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"  width="24" height="24" viewBox="0 0 24 24">
				<path fill="#6236FF" d="M13,8A4,4 0 0,1 9,12A4,4 0 0,1 5,8A4,4 0 0,1 9,4A4,4 0 0,1 13,8M17,18V20H1V18C1,15.79 4.58,14 9,14C13.42,14 17,15.79 17,18M20.5,14.5V16H19V14.5H20.5M18.5,9.5H17V9A3,3 0 0,1 20,6A3,3 0 0,1 23,9C23,9.97 22.5,10.88 21.71,11.41L21.41,11.6C20.84,12 20.5,12.61 20.5,13.3V13.5H19V13.3C19,12.11 19.6,11 20.59,10.35L20.88,10.16C21.27,9.9 21.5,9.47 21.5,9A1.5,1.5 0 0,0 20,7.5A1.5,1.5 0 0,0 18.5,9V9.5Z" />
				</svg>	
				<strong>Bantuan</strong>
            </div>
        </a>
    </div>
    <!-- App Bottom Menu -->

    <!-- ========= JS Files =========  -->
    <!-- Bootstrap -->
    <script src="assets/js/lib/bootstrap.bundle.min.js"></script>
    <!-- Base Js File -->
    <script src="assets/js/base.js"></script>
<script type="text/javascript">
    document.getElementById('title').innerHTML = window.location.hostname + " > status";
</script>
<script src="assets/js/jquery-3.6.3.min.js"></script>
<script>
    $(document).ready(function () {
        setInterval(function(){
            $("#download").load(window.location.href + " #download");
            $("#upload").load(window.location.href + " #upload");
            $("#traffic").load(window.location.href + " #traffic");
            $("#expired").load(window.location.href + " #expired");
            $("#kuota").load(window.location.href + " #kuota");
        },1000);
    });
</script>
<script>
    function updateSessionTime(seconds) {
        var d = Math.floor(seconds / (3600*24));
        var h = Math.floor(seconds % (3600*24) / 3600);
        var m = Math.floor(seconds % 3600 / 60);
        var s = Math.floor(seconds % 60);

        var timeString = 
            (d > 0 ? d + " hari, " : "") +
            (h > 0 ? h + " jam, " : "") +
            (m > 0 ? m + " menit, " : "") +
            (s > 0 ? s + " detik" : "");

        return timeString;
    }

    function startTimer(initialTime) {
        var currentTime = initialTime;

        setInterval(function() {
            currentTime++;
            document.getElementById('aktif').innerText = updateSessionTime(currentTime);
        }, 1000);
    }

    // Start the timer with the initial session time from PHP
    startTimer(initialSessionTime);
</script>
</body>
</html>
