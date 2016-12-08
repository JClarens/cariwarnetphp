<?php
include("../options/myLib.php");

include("profile.php");
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
                
                // setProfileSize();
			}
			
			window.onload = init();
			
            // function setProfileSize() {
            //     $(".profile-container").width($("#inputImg").parent().parent().parent().parent().width()
            //         - $("#inputImg").parent().parent().width() - 45);
            //     $(".profile-container").height($("#inputImg").parent().parent().parent().height());
            // }
            
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
			
			$(function() {
				var par = getParameterByName("success");
				if (par) {
					if (par == "1") $("#modalSuccess").openModal();
					else if (par == "2" || par == "3") $("#modalFail").openModal();
                    window.history.pushState("", document.title, "<?=$prefix?>profile");
				}	
			});
            
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    
                    reader.onload = function (e) {
                        $('#inputImg').attr('src', e.target.result);
                    }
                    
                    reader.readAsDataURL(input.files[0]);
                    // setProfileSize();
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
									<input id="search1" type="search" name="search" placeholder="Pencarian" required>
									<label for="search1"><i class="material-icons">search</i></label>
									<i class="material-icons">close</i>
								</div>
							</form>
						</li>
						<li <?php if ($isLogin) echo "class=\"hide\""; ?>>
							<a href="<?=$prefix?>login" class="waves-effect waves-light">Login</a>
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
									<input id="search2" type="search" name="search" placeholder="Pencarian" required>
									<label for="search2"><i class="material-icons">search</i></label>
									<i class="material-icons">close</i>
								</div>
							</form>
						</li>
						<li <?php if ($isLogin) echo "class=\"hide\""; ?>><a href="<?=$prefix?>login" class="waves-effect waves-light">Login</a></li>
						<li class="no-padding<?php if (!$isLogin) echo " hide"; ?>">
							<ul class="collapsible collapsible-accordion">
								<li>
									<a href="#" class="waves-effect waves-light collapsible-header">
										<img src="<?= $prefix . "profile/display.php?id=" .$sessionId?>" width="36px" alt="" class="circle responsive-img profile-img">
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
			<form name="form_profile" method="post" action="<?=$_SERVER['PHP_SELF']?>" enctype="multipart/form-data">
				<div class="row">
					<div class="col s12 m9 push-m3">
                        <div class="row">
                            <div class="col m3">
                                <div class="card">
                                    <div class="card-image">
                                        <?php 
                                            if (!empty($userImageName)) {
                                        ?>
                                        <img id="inputImg" src="<?= $prefix . "profile/display.php?id=" .$curId?>" width="100%" alt="">
                                        <?php 
                                            } else {
                                        ?>
                                        <img id="inputImg" src="<?= $prefix . "img/empty_profile.jpg"; ?>" width="100%" alt="">								
                                        <?php 
                                            }
                                        ?>
                                    </div>
                                    <div class="card-content <?php if (!$isEdit) echo "hide" ?>">
                                        <div class="file-field input-field tooltipped" data-tooltip="Upload Gambar Profile">
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
                                    <div class="col s12">
                                        <div class="input-field col s12" style="padding-left: 0;">
                                            <input id="id" type="hidden" name="id" value="<?=$curId?>">
                                            <input id="name" type="text" name="name" placeholder="Nama" value="<?=$userName?>" class="validate h3" autofocus <?php if (!$isEdit) echo "disabled" ?> tabindex="1">
                                        </div>
                                    </div>
                                    <div class="col s12 right <?php if ($curId != $sessionId || $isEdit) echo "hide" ?>">
                                        <a href="?id=<?= $sessionId ?>&edit=1" class="waves-effect waves-light btn white-text valign right tooltipped" data-tooltip="Edit" tabindex="1"><i class="material-icons">toc</i></a>
                                    </div>
                                    <div class="<?php if (!$isEdit) echo "hide" ?>">
                                        <button class="waves-effect waves-light btn white-text tooltipped right" type="submit" name="simpan" data-tooltip="Simpan" style="margin-left: 5px" tabindex="7">
                                            <i class="material-icons">done</i>
                                        </button>
                                        <a href="index.php?id=<?= $sessionId ?>" class="waves-effect waves-light btn white-text tooltipped right" data-tooltip="Batal" tabindex="8"><i class="material-icons">cancel</i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
						<div class="card">
							<div class="card-content">
								<div class="row">
									<div class="input-field col m6 s12">
										<input id="born" name="tempatLahir" placeholder="Tempat Lahir" type="text" class="validate" value="<?=$userTempatLahir?>" <?php if (!$isEdit) echo "disabled" ?> tabindex="2">
										<label for="born">Tempat Lahir</label>
									</div>
									<div class="col m6 s12 left-align">
										<label for="date">Tanggal Lahir</label>
										<input id="date" type="date" name="dateLahir" class="datepicker" style="height: 2.5rem !important" value="<?=$userTanggalLahir?>" required <?php if (!$isEdit) echo "disabled" ?> tabindex="3">
									</div>
									<div class="input-field col m6 s12">
										<input id="email" name="email" placeholder="E-mail" type="email" class="validate" value="<?=$userEmail?>" required <?php if (!$isEdit) echo "disabled" ?> tabindex="4">
										<label for="email">E-mail</label>
									</div>
									<div class="input-field col m6 s12">
										<input id="phone" name="phone" placeholder="Telepon" type="text" class="validate" value="<?=$userTelepon?>" <?php if (!$isEdit) echo "disabled" ?> tabindex="5">
										<label for="phone">Telepon</label>
									</div>
									<div class="input-field col m6 s12 hide">
										<select id="mode" name="mode" <?php if (!$isEdit) echo "disabled" ?> tabindex="6">
											<option value="" disabled <?php if (empty($userMode)) echo "selected" ?>>Pilih Mode Pengguna</option>
											<option value="1" <?php if (!empty($userMode) && $userMode == "1") echo "selected" ?>>Pengguna</option>
											<option value="2" <?php if (!empty($userMode) && $userMode == "2") echo "selected" ?>>Pemilik Warnet</option>
										</select>
										<label>Mode Pengguna</label>
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
		</div>
	</main>
	<footer class="page-footer teal lighten-2 main">
		<!--<div class="container">
			<div class="row">
				<div class="col l6 s12">
					<h5 class="white-text">Footer Content</h5>
					<p class="grey-text text-lighten-4">You can use rows and columns here to organize your footer content.</p>
				</div>
				<div class="col l4 offset-l2 s12">
					<h5 class="white-text">Links</h5>
					<ul>
						<li><a class="grey-text text-lighten-3" href="#!">Link 1</a></li>
						<li><a class="grey-text text-lighten-3" href="#!">Link 2</a></li>
						<li><a class="grey-text text-lighten-3" href="#!">Link 3</a></li>
						<li><a class="grey-text text-lighten-3" href="#!">Link 4</a></li>
					</ul>
				</div>
			</div>
		</div>-->
		<div class="footer-copyright">
			<div class="container">© 2015 Copyright Text<div>
		</div>
	</footer>
	
	<!-- Modal Structure -->
	<div id="modalSuccess" class="modal">
		<div class="modal-content">
			<h4>Pemberitahuan</h4>
			<p>Data Berhasil Diupdate</p>
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
					if (!empty($_GET["success"]) && $_GET["success"] == "3") echo "Input Tanggal Salah (harus \"yyyy-mm-dd\", y=tahun, m=bulan, d=tanggal)";
					else echo "Data Gagal Diupdate";
				?>
			</p>
		</div>
		<div class="modal-footer">
			<a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Tutup</a>
		</div>
	</div> 
</body>
</html>