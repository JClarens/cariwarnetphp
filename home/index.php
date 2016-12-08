<?php
include("../options/myLib.php");

$isLogin = !empty($sessionUsername);

include("home.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Home</title>
<?php
include("../options/initial.php");
?>
	<link type="text/css" rel="stylesheet" href="<?=$prefix?>css/page.init.css" />
	<script>
		$(function(){
			function init() {
				window.addEventListener('scroll', function(e){
					var distanceY = window.pageYOffset || document.documentElement.scrollTop,
						shrinkOn = 100;

					if (distanceY > shrinkOn) {
						$("header:not(.smaller)").addClass("smaller");
						$("img.profile-img:not(.small-pic)").addClass("small-pic");
					} else {
						$("header.smaller").removeClass("smaller");
						$("img.profile-img.small-pic").removeClass("small-pic");
					}
				});

				$("img.profile").parent().parent().on({
					mouseenter: function () {
						$("img.profile:not(z-depth-1)").addClass("z-depth-1");
					},
					mouseleave: function () {
						$("img.profile.z-depth-1").removeClass("z-depth-1");
					}
				});
			}
			
			window.onload = init();
			
            var par = getParameterByName("success");
            if (par) {
                if (par == "0" || par == "1") $("#modalSuccess").openModal();
                window.history.pushState("", document.title, "<?=$prefix?>home");
            }
            
			$(".button-collapse").sideNav({
					closeOnClick: true // Closes side-nav on <a> clicks, useful for Angular/Meteor
				}
			);
						
			$('.dropdown-button').dropdown({
					gutter: 0, // Spacing from edge
					belowOrigin: true, // Displays dropdown below the button
					alignment: 'left' // Displays dropdown with edge aligned to the left of button
				}
			);
		});
		
	</script>
</head>
<body id="main-page" class="blue-grey lighten-5">
	<header>
		<nav class="teal lighten-2">
			<div class="container">
				<div class="nav-wrapper">
					<a href="<?=$prefix?>home" class="brand-logo">CariWarnet</a>
					<a href="#" data-activates="mobile-demo" class="button-collapse right"><i class="material-icons">menu</i></a>
					<ul class="right hide-on-med-and-down">
						<li>
							<form name="search_1" method="get" action="<?=$prefix?>home">
								<div class="input-field">
									<input id="search1" type="search" name="search" placeholder="Pencarian" value="<?php echo $par ?>">
									<label for="search1"><i class="material-icons">search</i></label>
									<i class="material-icons">close</i>
								</div>
							</form>
						</li>
						<li <?php if ($isLogin) echo "class=\"hide\""; ?>>
							<a href="<?=$prefix?>login" class="waves-effect waves-light">Login</a>
						</li>
						<li <?php if ($isLogin) echo "class=\"hide\""; ?>>
							<a href="<?=$prefix?>register" class="waves-effect waves-light">Daftar</a>
						</li>
						<li <?php if (!$isLogin) echo "class=\"hide\""; ?>>
							<a href="#" class="waves-effect waves-light dropdown-button" data-activates="dropdownUser1">
                                <img src="<?= $prefix . "profile/display.php?id=" .$sessionId?>" alt="profile image" class="circle responsive-img profile profile-img">
								<?php echo $sessionName; ?>
							</a>
							<ul id="dropdownUser1" class='dropdown-content'>
								<li><a href="<?=$prefix?>home" class="waves-effect">Home</a></li>
								<li><a href="<?=$prefix?>profile?id=<?=$sessionId?>" class="waves-effect">Profile</a></li>
								<li><a href="<?=$prefix?>warnet" class="waves-effect">Warnet</a></li>
								<li class="divider"></li>
								<li><a href="<?=$prefix?>login/logout.php" class="waves-effect">Logout</a></li>
							</ul>
						</li>
					</ul>
					<ul class="side-nav" id="mobile-demo">
						<li>
							<form name="search_2" method="get" action="<?=$prefix?>home">
								<div class="input-field">
									<input id="search2" type="search" name="search" placeholder="Pencarian" value="<?php echo $par ?>">
									<label for="search2"><i class="material-icons">search</i></label>
									<i class="material-icons">close</i>
								</div>
							</form>
						</li>
						<li <?php if ($isLogin) echo "class=\"hide\""; ?>><a href="<?=$prefix?>login" class="waves-effect waves-light">Login</a></li>
						<li <?php if ($isLogin) echo "class=\"hide\""; ?>><a href="<?=$prefix?>register" class="waves-effect waves-light">Daftar</a></li>
						<li class="no-padding<?php if (!$isLogin) echo " hide"; ?>">
							<ul class="collapsible collapsible-accordion">
								<li>
									<a href="#" class="waves-effect waves-light collapsible-header">
                                        <img src="<?= $prefix . "profile/display.php?id=" .$sessionId?>" alt="profile image" class="circle responsive-img profile profile-img">
										<?php echo $sessionName; ?>
									</a>
									<div class="collapsible-body">
										<ul>
											<li><a href="<?=$prefix?>home" class="waves-effect">Home</a></li>
											<li><a href="<?=$prefix?>profile?id=<?=$sessionId?>" class="waves-effect">Profile</a></li>
											<li><a href="<?=$prefix?>warnet" class="waves-effect">Warnet</a></li>
											<li class="divider"></li>
											<li><a href="<?=$prefix?>login/logout.php" class="waves-effect">Logout</a></li>
										</ul>
									</div>
								<li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</nav>
	</header>
	<main>
		<div class="container">
			<div class="row">
				<div class="col s3">
                    <div class="card-panel">
                        <div class="row">
                            <div class="col s12">
                                <h5>New Warnet Release</h5>
                                <ul class="collapsible" data-collapsible="accordion">
                                    <?php
                                    $counter = 0;
                                    if ($jlhNew > 0)
                                    {
                                        while($dataNew=mysql_fetch_array($hasilNew)) {
                                            $active = "";
                                            if ($counter == 0) {
                                                $active = " active";
                                                $counter++;
                                            }
                                    ?>
                                    <li>
                                        <div class="collapsible-header<?=$active?>">
                                            <a href="<?=$prefix?>warnet?id=<?=$dataNew['wrnet_id']?>"><?=$dataNew['wrnet_name']?></a>
                                        </div>
                                        <div class="collapsible-body">
                                            <p>
                                                Dibuka di kota <?=$dataNew['wrnet_kota']?> (<?=$dataNew['wrnet_alamat']?>)
                                            </p>
                                        </div>
                                    </li>
                                    <?php
                                        }
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s12">
                                <h5>Top 5 Warnet</h5>
                                <div class="collection">
                                    <?php
                                    if ($jlhTop > 0)
                                    {
                                        while($dataTop=mysql_fetch_array($hasilTop)) {
                                    ?>
                                    <a href="<?=$prefix?>warnet?id=<?=$dataTop['wrnet_id']?>" class="collection-item"><?=$dataTop['wrnet_name']?></a>
                                    <?php
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
				<div class="col s9">
					<?php
                    if($isParExists) {
                        ?>
                        <div class="card teal lighten-5">
                            <div class="card-content">
                                <?php
                                    $kata = "Menampilkan <b>$jumlah</b> data";
                                    if ($jumlah == 0) $kata = "Tidak ada data yang ditemukan";
                                    echo "$kata berdasarkan kata kunci <b>\"$par\"</b>."
                                ?>
                                <i class="material-icons right use-pointer tooltipped" data-tooltip="Hapus Pencarian" onclick="document.location = '<?=$prefix?>home'">close</i>
                            </div>
                        </div>
                        <?php
                    }
                    
					$tes = 1;
					while ($data=mysql_fetch_array($hasil))
					{
					?>
					<div class="card small">
						<div class="card-image">
							<img src="<?=$prefix?>warnet/display.php?id=<?=$data["wrnet_id"]?>" width="36px" alt="">
							<span class="card-title strokeme"><?=$data["wrnet_name"]?></span>
						</div>
						<div class="card-content">
                            <small class="grey-text text-lighten-1">- Dipublikasikan oleh "<i><?=$data["wrnet_owner_nm"]?>"</i></small>
							<p><?=$data["wrnet_alamat"]?></p>
						</div>
						<div class="card-action" style="text-align: right">
							<a href="<?=$prefix?>warnet?id=<?=$data["wrnet_id"]?>" class="waves-effect waves-light btn white-text">Baca lebih lanjut</a>
						</div>
					</div>
					<?php
						$tes++;
						if ($tes == 4) $tes = 1;
					}
					?>
				</div>
			</div>
		</div>
	</main>
	<footer class="page-footer teal lighten-2 main">
		<div class="footer-copyright">
			<div class="container">© 2015 Copyright Text<div>
		</div>
	</footer>
    
    <div id="modalSuccess" class="modal">
		<div class="modal-content">
			<h4>Pemberitahuan</h4>
			<p>
				<?php
					if (!empty($_GET["success"])) {
                        if ($_GET["success"] == "1") echo "Selamat Datang, \"$sessionName\""; 
                        else echo "Logout berhasil";                         
                    }
                    else echo "Logout berhasil";
				?>
			</p>
		</div>
		<div class="modal-footer">
			<a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Tutup</a>
		</div>
	</div> 
</body>
</html>