<?php
include("../options/myLib.php");
$isLogin = !empty($sessionUsername);

include("warnet.php");
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
			
			function check(input) {
				if (input.value != document.getElementById('password').value) {
					input.setCustomValidity('Password Must be Matching.');
				} else {
					// input is valid -- reset the error message
					input.setCustomValidity('');
					input.validity.valid = checkValidity();
				}
			}
			
            var par = getParameterByName("success");
            if (par) {
                if (par == "1" || par == "4" || par == "6") $("#modalSuccess").openModal();
                else if (par == "2" || par == "3" || par == "5" || par == "7") $("#modalFail").openModal();
                if (par == "6" || par == "7") window.history.pushState("", document.title, "<?=$prefix?>warnet?id=<?=$netId?>");
                else window.history.pushState("", document.title, "<?=$prefix?>warnet");
            }
            
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    
                    reader.onload = function (e) {
                        $('#inputImg').attr('src', e.target.result);
                    }
                    
                    reader.readAsDataURL(input.files[0]);
                }
            }
            
            $("#uplImg").change(function(){
                readURL(this);
            });
            
            $("#uplImgBtn").click(function(){
                $("#uplImg").click();
            });
            
            $("#phone").keydown(function (e) {
                // Allow: backspace, delete, tab, escape, enter and .
                if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
                    // Allow: Ctrl+A
                    (e.keyCode == 65 && e.ctrlKey === true) ||
                    // Allow: Ctrl+C
                    (e.keyCode == 67 && e.ctrlKey === true) ||
                    // Allow: Ctrl+X
                    (e.keyCode == 88 && e.ctrlKey === true) ||
                    // Allow: home, end, left, right
                    (e.keyCode >= 35 && e.keyCode <= 39)) {
                        // let it happen, don't do anything
                        return;
                }
                // Ensure that it is a number and stop the keypress
                if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                    e.preventDefault();
                }
            });
            
            $(".detailW").hover(function() {
                var c = $(this).children(this.children.length);
                var s = $(this).siblings().children(this.children.length);
                for (var i = 0; i < s.children().length; i++) {
                    var x = s.children(i);
                    if (x.hasClass("hide")) x.addClass("hide")
                }
                c.children().toggleClass("hide");
                $(this).css( 'cursor', 'pointer' );
                return false;
            });
            $(".detailW").click(function() {
                var id = $(this).prop("id");
                if (id.length > 1) id = id.substr(1);
                if (id) window.location="<?=$prefix?>warnet?id=" + id; 
            });
            
            $("#lihatPc").click(function(){
                $("#modalPC").openModal();
            });
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
									<input id="search1" type="search" name="search" placeholder="Pencarian">
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
            <?php
            if ($isDetail) {
            ?>
			<form name="form_profile" method="post" action="<?=$_SERVER['PHP_SELF']?>" enctype="multipart/form-data">
				<div class="row">
					<div class="col s12 m9 push-m3">
                        <div class="row">
                            <div class="col m3">
                                <div class="card">
                                    <div class="card-image">
                                        <?php 
                                            if (!empty($netImageNm)) {
                                        ?>
                                        <img id="inputImg" src="<?= $prefix . "warnet/display.php?id=" .$curId?>" width="100%" alt="" class="materialboxed" data-caption="<?=$netName?>">
                                        <?php 
                                            } else {
                                        ?>
                                        <img id="inputImg" src="<?= $prefix . "img/empty_computer.jpg"; ?>" width="100%" alt="" class="materialboxed" data-caption="<?=$netName?>">
                                        <?php 
                                            }
                                        ?>
                                    </div>
                                    <div class="card-content <?php if (!$isEdit) echo "hide" ?>">
                                        <div class="file-field input-field tooltipped" data-tooltip="Upload Gambar Warnet">
                                            <div class="btn">
                                                <span><i id="uplImgBtn" class="material-icons">system_update_alt</i></span>
                                                <input type="hidden" name="MAX_FILE_SIZE" value="99999999" />
                                                <input type="file" name="gambar" id="uplImg">
                                            </div>
                                            <div class="file-path-wrapper">
                                                <input class="file-path validate" type="text">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col m9 s12">
                                <div class="row">
                                    <div class="col m12">
                                        <div class="input-field col s12" style="padding-left: 0;">
                                            <input id="id" type="hidden" name="id" value="<?=$curId?>">
                                            <input id="name" type="text" name="name" placeholder="Nama Warnet" value="<?=$netName?>" class="validate h3" autofocus <?php if (!$isEdit) echo "disabled" ?> tabindex="1">
                                        </div>
                                    </div>
                                    <div class="col s12">
                                        <span class="star-rating right">
                                            <input type="radio" name="rating" value="1" checked><i></i>
                                            <input type="radio" name="rating" value="2" ><i></i>
                                            <input type="radio" name="rating" value="3" ><i></i>
                                            <input type="radio" name="rating" value="4" ><i></i>
                                            <input type="radio" name="rating" value="5" ><i></i>
                                        </span>
                                        <button class="waves-effect waves-light btn white-text tooltipped right <?php if ($isEdit) echo "hide" ?>" type="button" name="lihatPc" id="lihatPc" data-tooltip="Lihat PC" tabindex="6" style="margin-left: 5px">
                                            <i class="material-icons">computer</i>
                                        </button>
                                        <a href="?id=<?= $netId ?>&edit=1" class="waves-effect waves-light btn white-text valign right tooltipped <?php if ($isEdit || !$allowEdit) echo "hide" ?>" data-tooltip="Edit" tabindex="1" style="margin-left: 5px"><i class="material-icons">toc</i></a>
                                        <button class="waves-effect waves-light btn white-text tooltipped right <?php if (!$isEdit) echo "hide" ?>" type="submit" name="simpan" data-tooltip="Simpan" tabindex="7" style="margin-left: 5px">
                                            <i class="material-icons">done</i>
                                        </button>
                                        <a href="<?php if (empty($netId)) echo $prefix . "warnet"; else echo $prefix . "warnet?id=$netId" ?>" class="waves-effect waves-light btn white-text tooltipped right <?php if (!$isEdit) echo "hide" ?>" data-tooltip="Batal" tabindex="8"><i class="material-icons">cancel</i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
						<div class="card">
							<div class="card-content">
                                <div class="row">
                                    <div class="col m12">
                                        <small class="grey-text text-lighten-1">- Dipublikasikan oleh : <?=$netOwnerName?></small>
                                    </div>
                                </div>
								<div class="row">
									<div class="input-field col m6">
										<input id="born" name="kota" placeholder="Kota" type="text" class="validate" value="<?=$netKota?>" <?php if (!$isEdit) echo "disabled" ?> tabindex="2">
										<label for="born">Kota</label>
									</div>
									<div class="input-field col m6">
										<input id="phone" name="phone" placeholder="Telepon" type="text" class="validate" value="<?=$netPhone?>" <?php if (!$isEdit) echo "disabled" ?> tabindex="3">
										<label for="phone">Telepon</label>
									</div>
                                    <div class="input-field col m12">
                                        <textarea id="alamat" name="alamat" placeholder="Alamat" class="materialize-textarea" length="200" <?php if (!$isEdit) echo "disabled" ?> tabindex="4"><?=$netAlamat?></textarea>
										<label for="alamat">Alamat</label>
									</div>
								</div>
                                <div class="row">
                                    <div class="col s10">
                                        <h4>Fasilitas</h4>
                                    </div>
                                    <div class="table">
                                        <table class="striped responsive-table">
                                            <thead>
                                                <tr>
                                                    <th>Nama Fasilitas</th>
                                                    <th>Ketersediaan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Printer & Scanner</td>
                                                    <td>
                                                        <div class="switch">
                                                            <label>
                                                                <input type="checkbox" name="printer" value="printer" <?php if($netPrinter) echo "checked=\"checked\"" ?> <?php if (!$isEdit) echo "disabled" ?>>
                                                                <span class="lever"></span>
                                                                Tersedia
                                                            </label>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Voucher Pulsa</td>
                                                    <td>
                                                        <div class="switch">
                                                            <label>
                                                                <input type="checkbox" name="pulsa" value="pulsa" <?php if($netPulsa) echo "checked=\"checked\"" ?> <?php if (!$isEdit) echo "disabled" ?>>
                                                                <span class="lever"></span>
                                                                Tersedia
                                                            </label>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Voucher Game</td>
                                                    <td>
                                                        <div class="switch">
                                                            <label>
                                                                <input type="checkbox" name="game" value="game" <?php if($netGame) echo "checked=\"checked\"" ?>  <?php if (!$isEdit) echo "disabled" ?>>
                                                                <span class="lever"></span>
                                                                Tersedia
                                                            </label>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Jasa Pengetikan / Terjemahan</td>
                                                    <td>
                                                        <div class="switch">
                                                            <label>
                                                                <input type="checkbox" name="ketik" value="ketik" <?php if($netKetik) echo "checked=\"checked\"" ?> <?php if (!$isEdit) echo "disabled" ?>>
                                                                <span class="lever"></span>
                                                                Tersedia
                                                            </label>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Aksesoris Gadget & Komputer</td>
                                                    <td>
                                                        <div class="switch">
                                                            <label>
                                                                <input type="checkbox" name="acc" value="acc" <?php if($netAcc) echo "checked=\"checked\"" ?> <?php if (!$isEdit) echo "disabled" ?>>
                                                                <span class="lever"></span>
                                                                Tersedia
                                                            </label>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Lainnya</td>
                                                    <td>
                                                        <div class="switch">
                                                            <label>
                                                                <input type="checkbox" name="otr" value="otr" <?php if($netOtr) echo "checked=\"checked\"" ?> <?php if (!$isEdit) echo "disabled" ?>>
                                                                <span class="lever"></span>
                                                                Tersedia
                                                            </label>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
							</div>
						</div>
					</div>
					<div class="col s12 m3 pull-m9">
						<div class="card hide">
							<div class="card-image">
							
							</div>
							<div class="card-content">
								<p>I am a very simple card. I am good at containing small bits of information.
								I am convenient because I require little markup to use effectively.</p>
							</div>
						</div>
					</div>
				</div>
			</form>
            <?php
                if (!$isEdit) {
                    $jlhCmt = 0;
                    if (!empty($hasilKomen)) $jlhCmt = mysql_num_rows($hasilKomen);
            ?>
            <div class="card">
                <div class="card-content">
                    <div class="row">
                        <div class="col s12">
                            <h4>
                                Komentar
                                <small></small>
                            </h4>
                        </div>
                    </div>                    
                    <div class="row">
                        <div class="col s12">
                            <ul class="collection">
                                <?php
                                if ($jlhCmt > 0) {
                                    while ($dataCmt = mysql_fetch_array($hasilKomen)) {
                                ?>
                                <li class="collection-item avatar">
                                    <img src="<?=$prefix?>profile/display.php?id=<?=$dataCmt['com_mbr_id']?>" alt="" width="24px" class="circle responsive-img comment-img" >
                                    <span class="title">
                                        <a href="<?=$prefix?>profile?id=<?=$dataCmt['com_mbr_id']?>">
                                            <?=$dataCmt['com_mbr_nm']?>
                                        </a>
                                    </span>
                                    <p><?=$dataCmt['com_desc']?></p>
                                    <span class="secondary-content">
                                        <span class="star-rating">
                                            <input type="radio" name="rating" value="1" <?php echo ($dataCmt['com_rate'] == 1) ? "checked=\"true\"" : "";?> disabled="true"><i></i>
                                            <input type="radio" name="rating" value="2" <?php echo ($dataCmt['com_rate'] == 2) ? "checked=\"true\"" : "";?> disabled="true"><i></i>
                                            <input type="radio" name="rating" value="3" <?php echo ($dataCmt['com_rate'] == 3) ? "checked=\"true\"" : "";?> disabled="true"><i></i>
                                            <input type="radio" name="rating" value="4" <?php echo ($dataCmt['com_rate'] == 4) ? "checked=\"true\"" : "";?> disabled="true"><i></i>
                                            <input type="radio" name="rating" value="5" <?php echo ($dataCmt['com_rate'] == 5) ? "checked=\"true\"" : "";?> disabled="true"><i></i>
                                        </span>
                                        <?=date_format(date_create($dataCmt['com_dt']), "d M Y H:i:s")?>
                                        </span>
                                </li>
                                <?php
                                    }
                                }
                                else {
                                ?>
                                <li>
                                    <div class="collapsible-header active">
                                        Belum ada Komentar.
                                        </div>
                                    <div class="collapsible-body">
                                        <p>Silahkan berikan komentar Anda melalui field yang tersedia.</p>
                                    </div>
                                </li>
                                <?php
                                }
                                ?>
                            </ul>               
                        </div>
                        <?php
                        if ($isLogin) {                    
                        ?>
                        <div class="col s12">
                            <form name="form_komentar" method="post" action="<?=$_SERVER['PHP_SELF']?>">
                                <div class="input-field col m6">
                                    <input id="netId" name="netId" type="hidden" value="<?=$netId?>">
                                    <input id="userK" name="userK" type="text" placeholder="Nickname" value="<?=$userK?>" disabled>
                                    <label for="userK">Anda berkomentar sebagai :</label>
                                </div>
                                <div class="col m6">
                                    <label style="display: inline-block; height:30px; margin-right:5px;">Rate</label>
                                    <span class="star-rating">
                                        <input type="radio" name="rating" value="1" checked><i></i>
                                        <input type="radio" name="rating" value="2" ><i></i>
                                        <input type="radio" name="rating" value="3" ><i></i>
                                        <input type="radio" name="rating" value="4" ><i></i>
                                        <input type="radio" name="rating" value="5" ><i></i>
                                    </span>
                                </div>
                                <div class="input-field col m12">
                                    <textarea id="komentar" name="komentar" placeholder="Komentar" class="materialize-textarea" length="200" tabindex="12"><?=$komentar?></textarea>
                                    <label for="komentar">Komentar</label>
                                </div>
                                <div class="col m12">
                                    <button class="btn waves-effect waves-light white-text right tooltipped" type="submit" name="post" data-tooltip="Post" tabindex="5">Post
                                        <i class="material-icons right">send</i>
                                    </button>
                                </div>
                            </form>
                        </div>
                        <?php
                        }                    
                        ?>
                    </div>
                </div>
            </div>
            <?php
                }
            }
            else {
            ?>
            <div class="card">
                <div class="card-content">
                    <div class="row">
                        <div class="col s8">
                            <a href="<?=$prefix?>warnet?add=1" class="waves-effect waves-light btn white-text tooltipped" data-tooltip="Tambah Warnet"><i class="material-icons">add</i></a>               
                        </div>
                        <div class="col s4">
                            <form name="form_cari_warnet" method="get" action="<?=$_SERVER['PHP_SELF']?>">
                                <input id="searchWarnet" name="cariWarnet" type="text" placeholder="Filter Warnet" >
                            </form>               
                        </div>
                    </div>
                    <?php
                        if ($isFilter) {
                    ?>
                    <div class="card-panel teal lighten-5">
                        Hasil pencarian berdasarkan kata kunci <b>"<?=$parCari?>"</b>
                        <i class="material-icons right use-pointer tooltipped" data-tooltip="Hapus Filter" onclick="document.location = '<?=$prefix?>warnet'">close</i>
                    </div>
                    <?php
                        }
                    ?>
                    <table class="warnet-lst striped responsive-table">
                        <thead>
                            <tr>
                                <th style="width: 100px">No.</th>
                                <th>Nama Warnet</th>
                                <th>Pemilik</th>
                                <th>Kota</th>
                                <th>&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        $noUrut = 1;
                        if ($hasil) {
                            
                            $jlh = mysql_num_rows($hasil);
                            if ($jlh > 0) {
                                while ($data=mysql_fetch_array($hasil)) {
                                    $idWrnet = $data["wrnet_id"];
                        ?>
                            <tr id="r<?=$idWrnet?>" class="detailW tooltipped" data-tooltip="Klik untuk melihat detail">
                                <td><?=$noUrut?></td>
                                <td><?=$data["wrnet_name"]?></td>
                                <td><?=$data["wrnet_owner_nm"]?></td>
                                <td><?=$data["wrnet_kota"]?></td>
                                <td>
                                    <a href="<?=$prefix?>warnet?id=<?=$idWrnet?>&edit=1" class="waves-effect waves-light btn white-text tooltipped hide" data-tooltip="Edit"><i class="material-icons">reorder</i></a>
                                    <a href="<?=$prefix?>warnet?id=<?=$idWrnet?>&del=1" class="waves-effect waves-light btn white-text tooltipped hide" data-tooltip="Hapus" onclick="return confirm('Yakin ingin menghapus Warnet <?=$data["wrnet_name"]?> ?')"><i class="material-icons">delete</i></a>
                                </td>
                            </tr>
                        <?php
                                    $noUrut++;
                                }
                            }
                            else {
                        ?>
                            <tr>
                                <td colspan="5" class="center-text">Tidak ada data untuk ditampilkan</td>
                            </tr>
                        <?php
                            }
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php
            }
            ?>
		</div>
	</main>
	<footer class="page-footer teal lighten-2 main">
		<div class="footer-copyright">
			<div class="container">© 2015 Copyright Text<div>
		</div>
	</footer>
	
	<!-- Modal Structure -->
	<div id="modalSuccess" class="modal">
		<div class="modal-content">
			<h4>Pemberitahuan</h4>
			<p>
				<?php
					if (!empty($_GET["success"])) {
                        if ($_GET["success"] == "1") echo "Data Berhasil Diupdate"; 
                        else if ($_GET["success"] == "4") echo "Data Berhasil Dihapus";                         
                        else if ($_GET["success"] == "6") echo "Komentar Berhasil Dipost";                         
                    } 
				?>
			</p>
		</div>
		<div class="modal-footer">
			<a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Tutup</a>
		</div>
	</div>
	
	<div id="modalFail" class="modal">
		<div class="modal-content">
			<h4>Pemberitahuan</h4>
			<p>
				<?php
					if (!empty($_GET["success"])) {
                        if ($_GET["success"] == "2") echo "Data Gagal Diupdate"; 
                        else if ($_GET["success"] == "3") { 
                            echo $_GET["errMsg"];
                        }
                        else if ($_GET["success"] == "5") echo "Data Gagal Dihapus";                         
                        else if ($_GET["success"] == "7") echo "Komentar Gagal Dipost";                         
                    } 
				?>
			</p>
		</div>
		<div class="modal-footer">
			<a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Tutup</a>
		</div>
	</div> 
    
    <div id="modalPC" class="modal">
		<div class="modal-content">
			<h4>Daftar PC <?=$netName?></h4>
			<div class="row">
                <?php
                if ($totalPC) {
                    $countTPC = 1;    
                    while($dataPC = mysql_fetch_array($hasilPC)) {
                ?>
                <div class="col m3">
                    <button class="waves-effect waves-light btn white-text <?php if (!$dataPC["pc_stat"]) echo "red"; ?>" type="submit" name="simpan" data-tooltip="Simpan" tabindex="7" style="margin-left: 5px; margin-bottom: 10px; width: 100%; height: 80px;">
                        PC <?=$countTPC?>
                        <i class="material-icons" style="display: block">computer</i>
                    </button>
                </div>
                <?php
                        $countTPC++;
                    }
                }
                ?>
            </div>
		</div>
		<div class="modal-footer">
			<a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Tutup</a>
		</div>
	</div>
</body>
</html>