<?php
	
	// Ruhum
	// 22.12.2017
	
?>
<!DOCTYPE html>
<html>
<head>
	<title>Twitter Profile Information</title>
	<link rel="stylesheet" type="text/css" href="Style.css" />
</head>
<body>

<?php
	
	if(isset($_POST['TwitterProfileUrl'])){

?>
	<center><h2>Twitter Profile Information</h2></center>

	<div class="Duzen">
		
		<div class="GenelBilgiler">
			<div class="Bilgiler Bold" style="width: 40px;">Count</div>
			<div class="Bilgiler Bold KanalAdi">Twitter Name</div>
			<div class="Bilgiler Bold">Tweets</div>
			<div class="Bilgiler Bold">Following</div>
			<div class="Bilgiler Bold SonDiv">Followers</div>
			<div class="Temizle"></div>
		</div>
							
<?php

		$ProfilBaglantilari = $_POST['TwitterProfileUrl'];
		$ProfilBaglantilari = explode("\n", $ProfilBaglantilari);
		$ProfilBaglantilari = array_map('trim', $ProfilBaglantilari);
		foreach ($ProfilBaglantilari as $Key => $Baglanti) {

			$Kaynaklar = file_get_contents($Baglanti);
			preg_match_all('@class="ProfileNav-value"(.*?)data-count=([0-9]+) @', $Kaynaklar, $Kaynak);
			$KullaniciAdi = preg_match('@<title>(.*?)</title>@', $Kaynaklar, $KullaniciAdi)?end($KullaniciAdi):false;
			$KullaniciAdi = str_replace(' | Twitter', '', $KullaniciAdi);
			$Twitler = number_format($Kaynak[2][0]);
			$TakipEdilen = number_format($Kaynak[2][1]);
			$Takipciler = number_format($Kaynak[2][2]);

?>

			<div class="GenelBilgiler" <?=$Key%2?'':'style="background-color: #eff7ff;"'?>>
				<div class="Bilgiler" style="width: 40px;"><?=($Key+1)?></div>
				<div class="Bilgiler KanalAdi"><a href="<?=$Baglanti?>" target="_blank"><?=$KullaniciAdi?></a></div>
				<div class="Bilgiler"><?=$Twitler?></div>
				<div class="Bilgiler"><?=$TakipEdilen?></div>
				<div class="Bilgiler SonDiv"><?=$Takipciler?></div>
				<div class="Temizle"></div>
			</div>


<?php

		}

?>

	</div>

<?php

	}

?>
	<center><h2>Twitter Profile Links</h2></center>
	<div class="Duzen">
		
		<form action="" method="post">
			<label style="margin-left: 10px; margin-top: 5px; font-weight: bold; color: #474747; float: left;">Twitter Profile Links</label>
			<textarea placeholder="Examples:&#10;https://twitter.com/twitter&#10;https://twitter.com/google&#10;https://twitter.com/youtube" name="TwitterProfileUrl" id="TwitterProfileUrl"></textarea>
			<input type="submit" value="Check" id="KontrolEt">
		</form>
		<div class="Temizle"></div>

	</div>

</body>
</html>