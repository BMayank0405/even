<form class="form-field" method="post" action="./career.php" validate enctype="multipart/form-data">
   <div class="input-field field-1">
		<i class="material-icons prefix">face</i>
		<input id="icon_prefix" autocomplete="given-name" name="first_name" type="text" class="validate" minlength="3" pattern="[a-zA-Z]+" required>
    
		<label for="icon_prefix" data-error="Enter First Name in correct format">First Name</label>
    <span class="error"><?php $first_name; ?></span>
   </div>
   <div class="input-field field-2">
		<i class="material-icons prefix">account_circle</i>
		<input id="icon_prefix" autocomplete="family-name" type="text" name="last_name" class="validate" minlength="3" required>
		<label for="icon_prefix" data-error="Enter Last Name in correct format">Last Name</label>
    <span><?php $last_error; ?></span>
   </div>
   <div class="input-field field-3">
		<i class="material-icons prefix">email</i>
		<input id="email" autocomplete = "email" type="email" name="email" class="validate" minlength="10" required>
		<label for="email" data-error="Enter Email in correct format">Email</label>
    <span><?php $email_error; ?></span>
   </div>
   <div class="input-field field-4">
		<i class="material-icons prefix">work</i>
		<input id="position" type="text" class="validate" name="position" required autocomplete="off">
		<label for="position" data-error="Enter Position correctly">Position</label>
    <span><?php $pos_error; ?></span>
   </div>
   <div class="file-field input-field field-5">
      <div class="btn field-btn">
        <span>Resume</span>
        <span><?php $file_error; ?></span>
        <input type="file" name="resume" accept=".pdf,application/pdf" title="Upload Resume in pdf format" required data-error="Enter File in pdf format" />
      </div>
      <div class="file-path-wrapper">
        <input class="file-path validate" type="text" placeholder="Resume in pdf format" />
      </div>
   </div>
   
