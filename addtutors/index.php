<?php
$categary = "Tutor App";
$pagename = isset($_GET['edit']) ? "Edit Tutor" : "Add Tutor";
$save = isset($_GET['edit']) ? "Save Changes" : "Save";

$id = isset($_GET['edit']) ? base64_decode($_GET['edit']) : "";
include "../include/header.php";

$cheftagId = 0;
$gender = "";
//EDIT DETAIL
if (isset($_GET['edit'])) {
	$editUser = mysqli_fetch_array(mysqli_query($connection, "select * from `chef` where `chefId` = '$id'"));
	$cheftagId = $editUser['experienceType'];
	$gender = 	$editUser['gender'];
	$jsoncuisineId = $editUser['cuisineId'];
	$timestamp = strtotime($editUser['dateOfBirth']);
	$dob = date('Y-m-d', $timestamp);
	// echo $editUser['dateOfBirth'];
	// exit;
}

//ADD AND EDIT DETAIL
if (isset($_POST['save'])) {
	$flag = 1;

	$fullName = ucfirst(trim($_POST['fullName']));
	$email = trim($_POST['email']);
	$number = trim($_POST['number']);
	$dob = $_POST['dateOfBirth'];
	$country = ucfirst(trim($_POST['country']));
	$state = ucfirst(trim($_POST['state']));
	$rating = $_POST['rating'];
	$experience = $_POST['experience'];
	// $languages = $_POST['languages'];
	$cheftagId = $_POST['cheftagId'];
	$cuisineId = $_POST['cuisineId'];
	// print_r($cuisineId);
	// exit;
	$gender = $_POST['gender'];
	$rocPerMinute = $_POST['rocPerMinute'];
	$incomeratio = $_POST['incomeratio'];
	$mediumError = "";
	$emailError = "";
	$numberError = "";
	$jsoncuisineId = json_encode($cuisineId);
	// PHP VALIDATION
	if ($fullName == "") {
		$mediumError = "<div class='error'>FullName Required</div>";
		$flag = 0;
	}
	if ($email == "") {
		$emailError = "<div class='error'>Email Required</div>";
		$flag = 0;
	} else if (mysqli_num_rows(mysqli_query($connection, "select * from `chef` where `email` = '$email' and `delete` = '0'")) > 0) {
		if (!isset($_GET['edit'])) {
			$emailError = "<div class='error'>Email Exists</div>";
			$flag = 0;
		} else if ($editUser['email'] != $email) {
			$emailError = "<div class='error'>Email Exists</div>";
			$flag = 0;
		}
	}
	if ($number == "") {
		$numberError = "<div class='error'>Mobile Number Required</div>";
		$flag = 0;
	}

	if ($dob == "") {

		$flag = 0;
	} else {
		$newDob = date("Y-m-d", strtotime($dob));
	}

	if ($country == "") {
		$countryError = "<div class='error'>Country Required</div>";
		$flag = 0;
	}
	if ($state == "") {
		$cityError = "<div class='error'>State Required</div>";
		$flag = 0;
	}
	if ($gender == "") {
		$genderError = "<div class='error'>Gender Required</div>";
		$flag = 0;
	}
	if ($rocPerMinute == "") {
		$rocPerMinuteError = "<div class='error'>ROC Required</div>";
		$flag = 0;
	}
	if ($rating == "") {
		$rating = 0;
	}


	if ($flag == 1) {
		if (isset($_GET['edit'])) {
			mysqli_query($connection, "UPDATE `chef` SET `fullName` = '$fullName',
				`email` = '$email', 
				`mobileNumber` = '$number',
				`dateOfBirth`='$newDob' ,
				`experienceType`='$cheftagId', 
				`country`='$country' ,
				`state`= '$state',
				`experienceYear`='$experience',
				`rating`='$rating',
				`gender`='$gender', 
				`rocPerMinute` = '$rocPerMinute' ,
				`incomeRatio`='$incomeratio', 
				`cuisineId`= '$jsoncuisineId'
				WHERE `chefId` = '" . $id . "'") or die(mysqli_error($connection));

			$editSuccess = 1;
		} else {
			mysqli_query($connection, "INSERT INTO `chef` SET 
				`fullName` = '$fullName',
				`email` = '$email', 
				`mobileNumber` = '$number',
				`dateOfBirth`='$newDob',
				`experienceType`='$cheftagId', 
				`country`='$country' ,
				`state`= '$state',
				`experienceYear`='$experience',
				`rating`='$rating',
				`gender`='$gender', 
				`rocPerMinute` = '$rocPerMinute',
				`incomeRatio`='$incomeratio',
				`cuisineId`= '$jsoncuisineId'
				") or die(mysqli_error($connection));
			$success = 1;
		}
	}
}

?>
<style>
	.error {
		color: red;
	}

	.myclass {
		color: red;
		font-size: 12px;
	}

	i {
		font-size: 1.25rem;
		color: #ffe400;
	}
</style>
<link href="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">
<link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	<!-- begin::Subheader -->
	<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
		<div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
			<!--begin::Details-->
			<div class="d-flex align-items-center flex-wrap mr-2">
				<!--begin::Title-->
				<h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5"><?php echo $categary; ?></h5>
				<!--end::Title-->
				<!--begin::Separator-->
				<div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-5 bg-gray-200"></div>
				<!--end::Separator-->
				<!--begin::Search Form-->
				<div class="d-flex align-items-center" id="kt_subheader_search">
					<span class="text-dark-50 font-weight-bold" id="kt_subheader_total"><?php echo $pagename; ?></span>
				</div>
				<!--end::Search Form-->
			</div>
			<!--end::Details-->

		</div>
	</div>
	<!--end::Subheader-->
	<!--begin::Entry-->
	<div class="d-flex flex-column-fluid">
		<!--begin::Container-->
		<div class="container">

			<!--begin::Card-->
			<div class="card card-custom ">
				<div class="card-header">
					<h3 class="card-title"><?php echo $pagename; ?></h3>
				</div>
				<!--begin::Form-->
				<form class="form" method="post" id="myForm" enctype="multipart/form-data">
					<div class="card-body">
						<div class="form-group row">
							<div class="col-lg-2"></div>
							<label class="col-lg-2" style="margin-top: 10px;"><span style="color:red;font-size:15px;">*</span><strong>Full Name</strong> </label>
							<div class="col-lg-4">
								<input type="text" class="form-control" value="<?php if (isset($fullName)) {
																					echo $fullName;
																				} else if (isset($_GET['edit'])) {
																					echo $editUser['fullName'];
																				} ?>" name="fullName" placeholder="Enter User Name" />
								<?php if (isset($mediumError)) {
									echo $mediumError;
								} ?>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-lg-2"></div>
							<label class="col-lg-2" style="margin-top: 10px;"><span style="color:red;font-size:15px;">*</span><strong>Email</strong> </label>
							<div class="col-lg-4">
								<input type="text" class="form-control" value="<?php if (isset($email)) {
																					echo $email;
																				} else if (isset($_GET['edit'])) {
																					echo $editUser['email'];
																				} ?>" name="email" placeholder="Enter Email" />
								<?php if (isset($emailError)) {
									echo $emailError;
								} ?>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-lg-2"></div>
							<label class="col-lg-2" style="margin-top: 10px;"><span style="color:red;font-size:15px;">*</span><strong>Mobile Number</strong> </label>
							<div class="col-lg-4">
								<input type="text" class="form-control" value="<?php if (isset($number)) {
																					echo $number;
																				} else if (isset($_GET['edit'])) {
																					echo $editUser['mobileNumber'];
																				} ?>" name="number" placeholder="Enter Mobile Number" />
								<?php if (isset($numberError)) {
									echo $numberError;
								} ?>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-lg-2"></div>
							<label class="col-lg-2" style="margin-top: 10px;"><span style="color:red;font-size:15px;">*</span><strong>Date Of Birth</strong> </label>
							<div class="col-lg-4">
								<input type="date" class="form-control" value="<?php if (isset($dob)) {
																					echo $dob;
																				} else if (isset($_GET['edit'])) {
																					echo $dob;
																				} ?>" name="dateOfBirth" max="<?php $time = new DateTime('now');
																												echo $time->modify('-18 year')->format('Y-m-d'); ?>" min="<?php $time = new DateTime('now');
																																											echo $time->modify('-110 year')->format('Y-m-d'); ?>" />
								<?php if (isset($dobError)) {
									echo $dobError;
								} ?>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-lg-2"></div>
							<label class="col-lg-2" style="margin-top: 10px;"><span style="color:red;font-size:15px;">*</span><strong>Country</strong> </label>
							<div class="col-lg-4">
								<input type="text" class="form-control" value="<?php if (isset($country)) {
																					echo $country;
																				} else if (isset($_GET['edit'])) {
																					echo $editUser['country'];
																				} ?>" name="country" placeholder="Enter Country" />
								<?php if (isset($countryError)) {
									echo $countryError;
								} ?>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-lg-2"></div>
							<label class="col-lg-2" style="margin-top: 10px;"><span style="color:red;font-size:15px;">*</span><strong>State</strong> </label>
							<div class="col-lg-4">
								<input type="text" class="form-control" value="<?php if (isset($state)) {
																					echo $state;
																				} else if (isset($_GET['edit'])) {
																					echo $editUser['state'];
																				} ?>" name="state" placeholder="Enter State" />
								<?php if (isset($cityError)) {
									echo $cityError;
								} ?>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-lg-2"></div>
							<label class="col-lg-2" style="margin-top: 10px;"><span style="color:red;font-size:15px;">*</span><strong>experience</strong> </label>
							<div class="col-lg-4">
								<div class="input-group">
									<input type="text" class="form-control" value="<?php if (isset($experience)) {
																						echo $experience;
																					} else if (isset($_GET['edit'])) {
																						echo $editUser['experienceYear'];
																					} ?>" name="experience" placeholder="Enter Experience" />

									<div class="input-group-append"><span class="input-group-text">Year</span></div>

								</div>
								<span id="experienceError"></span>
								<?php if (isset($experienceError)) {
									echo $experienceError;
								} ?>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-lg-2"></div>
							<label class="col-lg-2" style="margin-top: 10px;"><span style="color:red;font-size:15px;">*</span><strong>Chef Tag</strong> </label>

							<div class="col-lg-4">

								<select name="cheftagId" id="cheftag" class="form-control">
									<option value='' selected>Select Chef Tag</option>

									<option value='Professional Chef' <?php if (isset($cheftagId)) {
																			if ($cheftagId == "Professional Chef") {
																				echo "selected";
																			}
																		} ?>>Professional Chef</option>
									<option value='Homecooking' <?php if (isset($cheftagId)) {
																	if ($cheftagId == "Homecooking") {
																		echo "selected";
																	}
																} ?>>Homemaker (Homemaker)</option>
									<option value='iiHM Student' <?php if (isset($cheftagId)) {
																		if ($cheftagId == "iiHM Student") {
																			echo "selected";
																		}
																	} ?>>iiHM Student</option>
									<option value='user level' <?php if (isset($cheftagId)) {
																	if ($cheftagId == "user level") {
																		echo "selected";
																	}
																} ?>>user level</option>
									<option value='Bakery' <?php if (isset($cheftagId)) {
																if ($cheftagId == "Bakery") {
																	echo "selected";
																}
															} ?>>Bakery</option>
									<option value='Dessert' <?php if (isset($cheftagId)) {
																if ($cheftagId == "Dessert") {
																	echo "selected";
																}
															} ?>>Dessert</option>


								</select>
								<?php if (isset($cuisinesError)) {
									echo $cuisinesError;
								} ?>
							</div>
						</div>
						<!-- <div class="form-group row">
                        <div class="col-lg-2"></div>
                        <label class="col-lg-2" style="margin-top: 10px;"><span style="color:red;font-size:15px;">*</span><strong>Chef Tag</strong> </label>
                        
                        <div class="col-lg-4">
                                
                            <select name="cheftagId" id="cheftag" class="form-control">
							<option value='' selected>Select Chef Tag</option>
                                 <?php

									$result = mysqli_query($connection, "select * from `cheftag` where `delete` = 0");
									while ($row = mysqli_fetch_assoc($result)) {
										if ($row['cheftagId'] == $cheftagId) {
											echo "<option value='$row[cheftagId]' selected>$row[chefTagName]</option>";
										} else {
											echo "<option value='$row[cheftagId]'>$row[chefTagName]</option>";
										}
									}
									?>  -->
						<!-- <option value='Professional Chef' <?php if ($cheftagId == "Professional Chef") {
																	echo "selected";
																} ?> >Professional Chef</option>
								<option value='Homecooking' <?php if ($cheftagId == "Homecooking") {
																echo "selected";
															} ?>>Homemaker (Homemaker)</option>
								<option value='iiHM Student'<?php if ($cheftagId == "iiHM Student") {
																echo "selected";
															} ?>>iiHM Student</option>
								<option value='user level'<?php if ($cheftagId == "user level") {
																echo "selected";
															} ?>>user level</option> -->
						<!--                                 
                            </select>
                            <?php if (isset($cuisinesError)) {
								echo $cuisinesError;
							} ?>
                        </div>
                    </div> -->

						<div class="form-group row">
							<div class="col-lg-2"></div>
							<label class="col-lg-2" style="margin-top: 10px;"><span style="color:red;font-size:15px;">*</span><strong>Rating</strong> </label>
							<div class="col-lg-4">
								<input type="text" class="form-control" value="<?php if (isset($rating)) {
																					echo $rating;
																				} else if (isset($_GET['edit'])) {
																					echo $editUser['rating'];
																				} ?>" name="rating" placeholder="Enter Rating" />
								<?php if (isset($ratingError)) {
									echo $ratingError;
								} ?>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-lg-2"></div>
							<label class="col-lg-2" style="margin-top: 10px;"><span style="color:red;font-size:15px;">*</span><strong>Gender</strong> </label>
							<div class="col-lg-4">

								<select name="gender" id="gender" class="form-control">
									<option value="">Select Gender</option>
									<option value="Male" <?php if ($gender == "Male") {
																echo "selected";
															} ?>>Male</option>
									<option value="Female" <?php if ($gender == "Female") {
																echo "selected";
															} ?>>Female</option>
									<option value="Other" <?php if ($gender == "Other") {
																echo "selected";
															} ?>>Other</option>
								</select>

								<?php if (isset($genderError)) {
									echo $genderError;
								} ?>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-lg-2"></div>
							<label class="col-lg-2" style="margin-top: 10px;"><span style="color:red;font-size:15px;">*</span><strong>ROC Per Minute</strong> </label>
							<div class="col-lg-4">
								<div class="input-group">

									<input type="text" class="form-control" value="<?php if (isset($rocPerMinute)) {
																						echo $rocPerMinute;
																					} else if (isset($_GET['edit'])) {
																						echo $editUser['rocPerMinute'];
																					} ?>" name="rocPerMinute" placeholder="ROC PerMinute" />
									<div class="input-group-append"><span class="input-group-text">Coin</span></div>
								</div>
								<span id="rocPerMinuteError"></span>
								<?php if (isset($rocPerMinuteError)) {
									echo $rocPerMinuteError;
								} ?>
							</div>
						</div>

						<div id="adding">
							<?php if (isset($_GET['edit'])) {
								if (!$editUser['cuisineId'] == null) {
									$cuisineId = json_decode($jsoncuisineId);

									$i = 1;
									foreach ($cuisineId as $duisId) {

										$id = "cuis" . $i;

							?>

										<div class="form-group row" id="<?php echo $id; ?>">
											<div class="col-lg-2"></div>
											<?php if ($i == 1) { ?>

												<label class="col-lg-2" style="margin-top: 10px;"><span style="color:red;font-size:15px;">*</span><strong>Category</strong> </label>

											<?php } else { ?>

												<label class="col-lg-2" style="margin-top: 10px;"><span style="color:red;font-size:15px;"></span><strong></strong> </label>

											<?php } ?>

											<div class="col-lg-4">

												<select name="cuisineId[]" id="category" class="form-control">
													<option value='' selected>Select Category</option>
													<?php

													$result = mysqli_query($connection, "select * from `cuisines` where `delete` = 0");
													while ($row = mysqli_fetch_assoc($result)) {
														if ($row['cuisineId'] == $duisId) {
															echo "<option value='$row[cuisineId]' selected>$row[cuisineName]</option>";
														} else {
															echo "<option value='$row[cuisineId]'>$row[cuisineName]</option>";
														}
													}
													?>

												</select>
												<?php if (isset($cuisinesError)) {
													echo $cuisinesError;
												} ?>
											</div>
											<?php if ($i == 1) { ?>

												<div class="row">
													<div class="col-md-10"></div>
													<div class="col-md-1">
														<button type="button" class="btn btn-success" onclick="new_row()">+</button>
													</div>
												</div>

											<?php } else { ?>

												<div id="remove" class="col-md-4"><a onclick="remove_ui_ux('<?php echo $id; ?>')" class="btn btn-sm font-weight-bolder btn-light-danger"><i class="la la-trash-o"></i>Delete</a></div>

											<?php } ?>

										</div>


									<?php $i++;
									}
								} else { ?>
									<div class="form-group row">
										<div class="col-lg-2"></div>
										<label class="col-lg-2" style="margin-top: 10px;"><span style="color:red;font-size:15px;">*</span><strong>Category</strong> </label>

										<div class="col-lg-4">

											<select name="cuisineId[]" id="category" class="form-control">
												<option value='' selected>Select Category</option>
												<?php

												$result = mysqli_query($connection, "select * from `cuisines` where `delete` = 0");
												while ($row = mysqli_fetch_assoc($result)) {
													if ($row['cuisineId'] == $cuisineId) {
														echo "<option value='$row[cuisineId]' selected>$row[cuisineName]</option>";
													} else {
														echo "<option value='$row[cuisineId]'>$row[cuisineName]</option>";
													}
												}
												?>

											</select>
											<?php if (isset($cuisinesError)) {
												echo $cuisinesError;
											} ?>
										</div>
										<div class="row">
											<div class="col-md-10"></div>
											<div class="col-md-1">
												<button type="button" class="btn btn-success" onclick="new_row()">+</button>
											</div>
										</div>
									</div>
								<?php }
							} else { ?>

								<div class="form-group row">
									<div class="col-lg-2"></div>
									<label class="col-lg-2" style="margin-top: 10px;"><span style="color:red;font-size:15px;">*</span><strong>Category</strong> </label>

									<div class="col-lg-4">

										<select name="cuisineId[]" id="category" class="form-control">
											<option value='' selected>Select Category</option>
											<?php

											$result = mysqli_query($connection, "select * from `cuisines` where `delete` = 0");
											while ($row = mysqli_fetch_assoc($result)) {
												if ($row['cuisineId'] == $cuisineId) {
													echo "<option value='$row[cuisineId]' selected>$row[cuisineName]</option>";
												} else {
													echo "<option value='$row[cuisineId]'>$row[cuisineName]</option>";
												}
											}
											?>

										</select>
										<?php if (isset($cuisinesError)) {
											echo $cuisinesError;
										} ?>
									</div>
									<div class="row">
										<div class="col-md-10"></div>
										<div class="col-md-1">
											<button type="button" class="btn btn-success" onclick="new_row()">+</button>
										</div>
									</div>
								</div>

							<?php } ?>
						</div>
						<div class="form-group row">
							<div class="col-lg-2"></div>
							<label class="col-lg-2" style="margin-top: 10px;"><strong>Income Ratio(% of income to be provided to tutor)</strong> </label>
							<div class="col-lg-4">
								<div class="input-group">

									<input type="text" class="form-control" value="<?php if (isset($incomeratio)) {
																						echo $incomeratio;
																					} else if (isset($_GET['edit'])) {
																						echo $editUser['incomeRatio'];
																					} ?>" name="incomeratio" placeholder="Income Ratio" />

								</div>
								<span id="incomeratioError"></span>
								<?php if (isset($incomeratioError)) {
									echo $incomeratioError;
								} ?>
							</div>
						</div>

						<div class="form-group row">
							<div class="col-lg-2"></div>
							<label class="col-lg-2" style="margin-top: 10px;"><strong>Tutor Ratings</strong> </label>




							<div class="col-lg-4">
								<div class="input-group">
									<div class="star-rating">



										<input type="number" name="rating" id="rating-empty-clearable" class="rating" value="<?php if(isset($editUser["rating"])){
											echo $editUser["rating"];
											}?>" data-clearable />
									</div>

								</div>
							</div>
						</div>


						<div class="card-footer">
							<div class="row">
								<div class="col-lg-12" style="text-align: center;">

									<button onClick="window.location.href='../tutors/';" type="button" class="btn btn-secondary">Cancel</button>
									<button type="submit" name="save" class="btn btn-primary cebutton mr-2"><?php echo $save; ?></button>
								</div>
							</div>
						</div>


				</form>
				<!--end::Form-->
			</div>
			<!--end::Card-->
		</div>
		<!--end::Container-->
	</div>
	<!--end::Entry-->
</div>
<!--end::Content-->


<?php
include "../include/footer.php";
?>

<style>
	.star-rating {
		line-height: 32px;
		font-size: 1.25em;
	}

	.star-rating .fa-star {
		color: yellow;
	}
</style>
<script>
	var $star_rating = $('.star-rating .fa');

	var SetRatingStar = function() {
		return $star_rating.each(function() {
			if (parseInt($star_rating.siblings('input.rating-value').val()) >= parseInt($(this).data('rating'))) {
				return $(this).removeClass('fa-star-o').addClass('fa-star');
			} else {
				return $(this).removeClass('fa-star').addClass('fa-star-o');
			}
		});
	};

	$star_rating.on('click', function() {
		$star_rating.siblings('input.rating-value').val($(this).data('rating'));
		return SetRatingStar();
	});

	SetRatingStar();
	$(document).ready(function() {

	});



	function new_row() {
		var date = new Date();
		var timestamp = date.getTime();

		$.ajax({

			url: "../ajax/newcategory.php",
			method: "post",
			data: {
				data: timestamp,
			},
			success: function(response) {


				$("#adding").append(response)

			}
		});
	}

	function remove_ui_ux(id) {
		$("#" + id).remove();
	}

	jQuery.validator.addMethod('email_rule', function(value, element) {
		if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(value)) {
			return true;
		} else {
			return false;
		};
	});
	jQuery.validator.addMethod('number_rule', function(value, element) {
		if (/^\(?([6-9]{1})\)?([0-9]{9})$/.test(value)) {
			return true;
		} else {
			return false;
		};
	});
	jQuery.validator.addMethod('rating_rule', function(value, element) {
		if (/^[0-5]\d*(\.\d+)?$/.test(value)) {
			if (value > 5) {
				return false;
			}
			return true;
		} else {
			return false;
		};
	});
	jQuery.validator.addMethod('name_rule', function(value, element) {
		if (/^[a-zA-Z]+$/.test(value)) {
			return true;
		} else {
			return false;
		};
	});
	jQuery.validator.addMethod('incomeratio_role', function(value, element) {
		if (value >= 20 && value <= 80 && value != "") {
			return true;
		} else {
			return false;
		};
	});

	$('#myForm').validate({
		rules: {
			fullName: {
				required: true,
			},
			email: {
				required: true,
				email_rule: true,
			},
			number: {
				required: true,
				number_rule: true,
			},
			dateOfBirth: {
				required: true,
			},
			country: {
				required: true,
				name_rule: true,
			},
			state: {
				required: true,
				name_rule: true,
			},
			experience: {
				required: true,
				number: true,
			},
			rating: {
				required: true,
				rating_rule: true,

			},
			gender: {
				required: true,
			},
			rocPerMinute: {
				required: true,
				number: true,
			},
			cheftagId: {
				required: true,
			},
			incomeratio: {
				number: true,
				incomeratio_role: true,
			}
		},
		messages: {
			fullName: {
				required: "Enter FullName",
			},
			email: {
				required: "Enter Email",
				email_rule: "Email is not valid",
			},
			number: {
				required: "Enter Number",
				number_rule: "not valid number",
			},
			dateOfBirth: {
				required: "Select Date",

			},
			country: {
				required: "Enter Country Name",
				name_rule: "not valid Country Name",
			},
			state: {
				required: "Enter State Name",
				name_rule: "not valid State Name",
			},
			experience: {
				required: "Enter Experience",
				number: "Enter valid Experience",
			},
			rating: {
				required: "Enter Rating",
				rating_rule: "Rating between 0-5",
			},
			gender: {
				required: "Select Gender",
			},
			rocPerMinute: {
				required: "Enter ROC",

			},
			cheftagId: {
				required: "Select Chef Tag",
			},
			incomeratio: {
				number: "Enter Number only",
				incomeratio_role: "between 20-80",
			}
		},
		errorPlacement: function(error, element) { // render error placement for each input type
			if (element.attr('name') == 'experience') {
				error.appendTo("#experienceError");
			} else if (element.attr('name') == 'rocPerMinute') {
				error.appendTo("#rocPerMinuteError");
			} else if (element.attr('name') == 'incomeratio') {
				error.appendTo("#incomeratioError");
			} else {
				error.insertAfter(element);
			}
		}


	})

	// display toastr on success
	<?php if (isset($_SESSION['success'])) { ?>

		toastr.success(" Added Successfully");

	<?php unset($_SESSION['success']);
	} ?>

	// set success session

	<?php if (isset($success)) {
		$_SESSION['success'] = 1; ?>

		window.location.href = '../addtutors/';

	<?php } else if (isset($editSuccess)) {
		$_SESSION['editSuccess'] = 1; ?>

		window.location.href = '../tutors/';

	<?php } ?>
</script>
<script src="../assets/js/bootstrap-rating-input.js"></script>