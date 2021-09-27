<br>
<br>
<br><br><br><br><br><br>
<div class="container">
	<div class="row">

		<div class="col-sm-12" style="background-color:#072401; margin-top: 20px; margin-bottom: 20px;">
			<h4 style="color: cornsilk;">Program Dashboard</h4></div>
		<div class="col-lg-8 col-lg-offset-2">
			<div class="row">
				</br>
				</br>
				</br>
				<div class="col-md-4">
					<br>
<br>
<br><br>
					<div class="hexagon" style="text-align: center;"><span style="font-size:30px; color: white;">52</span></div>
				</div>
				<div class="col-md-8">
					<?php//  var_dump($row) ?>
					<ul class="list-group list-group-flush">
						<ul class="list-group">

							<?php  foreach ($row as $data) {
								# code...
							?>
							<li class="list-group-item"> <a class="text-white btn-floating btn-fb btn-sm " style="background-color: #072401;border-radius:10px;"><span style=" color: white;">52</span></a> &nbsp;<?= $data['pro_name']?>&nbsp;<?= $data['user_name']?>&nbsp;<?= $data['contact_no']?>  <img alt="Qries" src="<?= base_url('assets/upload/users/'.$data['profile_image']) ?>" height="20px; width:10px"> </li>
						<?php } ?>
						</ul>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
<style>
.hexagon {
	width: 100px;
	height: 55px;
	position: relative;
}

.hexagon,
.hexagon:before,
.hexagon:after {
	background: #072401;
	box-shadow: 0 0 10px rgba(0, 0, 0, 0.8);
}

.hexagon:before,
.hexagon:after {
	content: "";
	position: absolute;
	left: 22px;
	width: 57px;
	height: 57px;
	transform: rotate(145deg) skew(22.5deg);
}

.hexagon:before {
	top: -29px;
}

.hexagon:after {
	top: 27px;
}

.hexagon span {
	position: absolute;
	top: 0;
	left: 0;
	width: 100px;
	height: 55px;
	background: #072401;
	z-index: 1;
}
</style>
