<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="css-files/registration-page.css">
    <link rel="stylesheet" href="css-files/font-import.css">
    <link rel="icon" type="image/x-icon" href="Resources/hfscco-logo-title.ico">

</head>
<style>
    .modal-body
    {
        padding: 22px;
    }
    
</style>
<body>
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog col-12">
            <div class="modal-content">
                <div class="modal-header d-flex justify-content-center align-items-center mb-2 w-100">
                    <img src="Resources/logo.png" alt="Logo" id="hfscco-logo" class="me-3" style = "margin-left: -15%;"> 
                    <div class="text-center" id="header-title">
                        <h1 class="modal-title fs-3" id="staticBackdropLabel">Privacy Policy</h1>
                        <small class="sub-header" style = "margin-left: -3%!important;">Data Privacy Act of 2012</small>
                    </div>
                </div>
                
                <div class="modal-body lh-lg" style="text-align: justify;">
                    Holy Family Savings and Credit Cooperative (HFSCCO) is committed to respecting your privacy and recognizes 
                    the importance of protecting the information collected about you. 
                    Personal information that you provided in this form shall only be processed in relation to its legal purpose. <br><br>
                    By filling out this form, you agree that 
                    all personal information you submit in relation to this survey shall be protected with reasonable and appropriate 
                    measures, and shall only be retained as long as necessary. <br><br>Rest assured that any information exchanged or that comes 
                    into possession of HFSCCO and shall be maintained in strict confidence and secrecy and shall not be disclosed to 
                    any third party, except for the purposes abovementioned, shall be protected in accordance with the RA 10173, 
                    Data Privacy Act of 2012.
                </div>
                <div class="modal-footer d-flex justify-content-between w-100">
                    <div class="form-check">
                        <input class="form-check-input border border-dark-subtle" type="checkbox" value="" id="understood">
                        <label class="form-check-label" for="understood">
                            I understand.
                        </label>
                    </div>
                    <div>
                        <button type="button" id="next-button" class="btn btn-primary" disabled>Next</button>
                    </div>
                </div>
    
                <script>
                    const checkbox = document.getElementById('understood');
                    const nextButton = document.getElementById('next-button');
    
                    // Enable the button when the checkbox is checked
                    checkbox.addEventListener('change', function() {
                        nextButton.disabled = !this.checked;
                    });
    
                    // Close the modal when the Next button is clicked
                    nextButton.addEventListener('click', function() {
                        const modal = document.getElementById('staticBackdrop');
                        const bootstrapModal = bootstrap.Modal.getInstance(modal) || new bootstrap.Modal(modal);
                        bootstrapModal.hide(); // Close the modal
                        // Optionally, perform any additional actions here
                    });
                </script>
            </div>
        </div>
    </div>
    
    

    <div class="container d-flex justify-content-center align-items-center">
        <form class="w-100" action="functions-php/register-account.php" method="post">
            <div id="page-content">
                <div class="col-12 d-flex justify-content-center align-items-center mb-2" id="registration-header">
                    <div>
                        <img src="Resources/logo.png" alt="Logo" id="hfscco-logo" class="me-3">
                    </div>
                    
                    <div class = "text-center" id = "header-text">
                        <h2>E-Membership Form</h2>
                        <small id = "sub-text">Please fill in this form to create an account</small>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 mt-3" id = "registration-input-header">
                        <h5>Personal Information</h5>
                    </div>
                </div>
                
                <div class="row mt-4">
                    <div class="col-12 col-md-6 col-lg-3 mb-2">
                        <label class="form-label">Last Name<span id = "required">*</span></label>
                        <input type="text" name="LastName" class="form-control border border-dark-subtle" required>
                    </div>
                    <div class="col-12 col-md-6 col-lg-3 mb-2">
                        <label class="form-label">First Name<span id = "required">*</span></label>
                        <input type="text" name="FirstName" class="form-control border border-dark-subtle" required>
                    </div>
                    <div class="col-12 col-md-6 col-lg-3 mb-2">
                        <label class="form-label">Middle Name</label>
                        <input type="text" name="MiddleName" class="form-control border border-dark-subtle">
                    </div>
                    <div class="col-12 col-md-6 col-lg-3 mb-2">
                        <label class="form-label">Suffix</label>
                        <input type="text" name="SuffixName" class="form-control border border-dark-subtle">
                    </div>
                </div>
                
                <div class="row mt-4">
                    <div class="col-12 col-md-8 mb-2">
                        <label class="form-label">Address<span id = "required">*</span></label>
                        <input type="text" name="address" class="form-control border border-dark-subtle" required>
                    </div>
                    <div class="col-12 col-md-4">
                        <label class="form-label">Contact Number<span id = "required">*</span></label>
                        <input type="text" name="ContactNum" id = "contact-Num" inputmode="numeric" maxlength="11" class="form-control border border-dark-subtle" oninput = "validateInput()" required>
                        <script>
                            function validateInput() {
                                const contactNumInput = document.getElementById("contact-Num");
                                const hasLetters = /[A-Za-z]/; // Regular expression to check for any alphabetical characters

                                if (hasLetters.test(contactNumInput.value)) {
                                    // If there are alphabetical characters, apply the invalid styles
                                    contactNumInput.classList.remove('border-dark-subtle');
                                    contactNumInput.classList.add('is-invalid', 'border-danger');
                                } else {
                                    // If input is valid (no letters), apply the subtle border style
                                    contactNumInput.classList.remove('is-invalid', 'border-danger');
                                    contactNumInput.classList.add('border-dark-subtle');
                                }
                            }
                        </script>
                    </div>
                </div>

                <div class="row mt-4">
                    
                    <div class="col-12 col-md-3 mt-1 mb-4">
                        <p>Date of Birth<span id = "required">*</span></p>
                        <input type="date" name="DateOfBirth" class="form-control border border-dark-subtle" id="birthdate" required>
                    </div>

                    <div class="col-12 col-md-5 mt-1 mb-4">
                        <p>Place of Birth<span id = "required">*</span></p>
                        <input type="text" name="PlaceOfBirth" class="form-control border border-dark-subtle" id="place-of-birth" required>
                    </div>

                    <div class="col-12 col-md-4 mt-1 mb-4">
                        <p>Sex<span id = "required">*</span></p>
                        <div class="form-check form-check-inline" style = "margin-left: 5px; margin-top: 5px;">
                            <input class="form-check-input border border-dark-subtle" type="radio" name="gender" id="inlineRadio1" value="Male" required>
                            <label class="form-check-label" for="inlineRadio1">Male</label>
                        </div>
                        <div class="form-check form-check-inline" style="margin-left: 20px;">
                            <input class="form-check-input border border-dark-subtle" type="radio" name="gender" id="inlineRadio2" value="Female" required>
                            <label class="form-check-label" for="inlineRadio2">Female</label>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-12 col-md-3 mt-1 mb-4">
                        <label class="form-label">Civil Status<span id = "required">*</span></label>
                        <select class="form-select" name="Civil-Status" id = "civil-status" required>
                            <option selected></option>
                            <option name="Civil-Status" value="Single">Single</option>
                            <option name="Civil-Status" value="Married">Married</option>
                            <option name="Civil-Status" value="Widowed">Widowed</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-5 mt-1 mb-4">
                        <label class="form-label">Occupation<span id = "required">*</span></label>
                        <input type="text" name="occupation" class="form-control border border-dark-subtle" required>
                    </div>
                    <div class="col-12 col-md-4 mt-1 mb-4">
                        <label class="form-label">Educational Attainment<span id = "required">*</span></label>
                        <select class="form-select" name="educational-attainment" id = "educ-attainment" style = "width: 245px;" required>
                            <option selected></option>
                            <option name="educational-attainment" value="Elementary">Elementary</option>
                            <option name="educational-attainment" value="High_School">High School</option>
                            <option name="educational-attainment" value="Senior_High_School">Senior High School</option>
                            <option name="educational-attainment" value="College">College</option>
                            <option name="educational-attainment" value="Masters">Master's</option>
                            <option name="educational-attainment" value="Doctorate">Doctorate</option>
                        </select>
                    </div>
                </div>
                

                <div class = "row mt-5" id = "account-information-header">
                    <h5>Account Information</h5>
                </div>
                
                <div class="mt-3" style = "padding-left: 2%;" id = "account-information">
                    <div class="col-12 col-md-6">
                        <label class="form-label">Email Address<span id = "required">*</span></label>
                        <input type="text" name="Email_add" class="form-control custom-width border border-dark-subtle" required>
                    </div>
            
                    <div class="col-12 col-md-6 mt-4">
                        <label class="form-label">Password<span id = "required">*</span></label>
                        <input type="password" name="Password" id="PasswordText" class="form-control custom-width border border-dark-subtle" required>
                        <div id="validationPasswordFeedback" class="invalid-feedback">
                            Password do not match.
                        </div>
                    </div>
            
                    <div class="col-12 col-md-6 mt-4 mb-5">
                        <label class="form-label">Re-Enter Password<span id = "required">*</span></label>
                        <input type="password" id = "CPasswordText" class="form-control custom-width border border-dark-subtle" oninput="PasswordConfirmation()" required>
                        <div id="validationC-PasswordFeedback" class="invalid-feedback">
                            Password do not match.
                        </div>

                        <div class="form-check mt-3">
                            <input class="form-check-input border border-dark-subtle" type="checkbox" value="" onclick = "togglePassword()" id="showPassword">
                            <label class="form-check-label" for="showPassword">
                              Show password
                            </label>
                        </div>
                    </div>
                </div>
                

                <div id="form-control-buttons" class="mt-4">
                    <div class="d-flex justify-content-between mt-4">
                        <a href="login-page.php" class="btn me-auto" id = "cancel-btn"><i class="bi bi-chevron-left"></i>Cancel</a>
                        <input type="submit" class="btn btn-primary" id = "Register" name = "register-btn" value="Register">
                    </div>
                </div>         

            </div>

        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        window.onload = function() {
            var myModal = new bootstrap.Modal(document.getElementById('staticBackdrop'), {
                keyboard: false
            });
            myModal.show();
        };

        function togglePassword() {
            var checkbox = document.getElementById("showPassword");
            var passwordInput = document.getElementById("PasswordText");
            var confirmPasswordInput = document.getElementById("CPasswordText");
    
            if (checkbox.checked) {
                passwordInput.type = "text";
                confirmPasswordInput.type = "text";
            } else {
                passwordInput.type = "password";
                confirmPasswordInput.type = "password";
            }
        }

        function PasswordConfirmation() {
            var password = document.getElementById("PasswordText").value;
            var confirmPassword = document.getElementById("CPasswordText").value;
            const registerBtn = document.getElementById("Register");
        
            const passwordInput = document.getElementById("PasswordText");
            const confirmPasswordInput = document.getElementById("CPasswordText");
        
            // Get the feedback elements
            const validationPasswordFeedbackText = document.getElementById("validationPasswordFeedback");
            const validationConfirmPasswordFeedbackText = document.getElementById("validationC-PasswordFeedback");
        
            // Reset feedback visibility
            validationPasswordFeedbackText.style.display = 'none';
            validationConfirmPasswordFeedbackText.style.display = 'none';
        
            if (confirmPassword === password) {
                // If passwords match, remove error classes and add the subtle border
                passwordInput.classList.remove('is-invalid', 'border-danger');
                passwordInput.classList.add('border-dark-subtle');
        
                confirmPasswordInput.classList.remove('is-invalid', 'border-danger');
                confirmPasswordInput.classList.add('border-dark-subtle');
                registerBtn.disabled = false;
            } else {
                // If passwords do not match, add error classes
                passwordInput.classList.remove('border-dark-subtle');
                confirmPasswordInput.classList.remove('border-dark-subtle');

                passwordInput.classList.add('is-invalid', 'border-danger');
                confirmPasswordInput.classList.add('is-invalid', 'border-danger');
        
                // Show feedback if passwords don't match
                validationPasswordFeedbackText.style.display = 'block';
                validationConfirmPasswordFeedbackText.style.display = 'block';
                registerBtn.disabled = true;
            }
        }
    
        document.addEventListener("DOMContentLoaded", function() {
            const form = document.querySelector('form');
            const registerBtn = document.querySelector('input[name="register-btn"]');
    
            registerBtn.addEventListener('click', function(event) {
                event.preventDefault();
    
                const inputs = form.querySelectorAll('input[required]');
                const selects = form.querySelectorAll('select[required]');
                let allFilled = true;
    
                // Check required inputs excluding radio buttons
                inputs.forEach(input => {
                    if (input.value.trim() === '' && input.type !== 'radio') {
                        allFilled = false;
                        input.classList.remove('border-dark-subtle');
                        input.classList.add('is-invalid', 'border-danger');
                    } else {
                        input.classList.remove('is-invalid', 'border-danger');
                    }
                });
    
                // Check required selects
                selects.forEach(select => {
                    if (select.value.trim() === '') {
                        allFilled = false;
                        select.classList.add('is-invalid', 'border-danger');
                    } else {
                        select.classList.remove('is-invalid', 'border-danger');
                    }
                });
    
                // Check if at least one gender radio button is selected
                const genderRadios = form.querySelectorAll('input[name="gender"]');  // Select only gender radio buttons
                const isGenderChecked = Array.from(genderRadios).some(radio => radio.checked);
    
                if (!isGenderChecked) {
                    allFilled = false;
                    genderRadios.forEach(radio => {
                        radio.classList.remove('border-dark-subtle');
                        radio.classList.add('border-danger');
                    });
                } else {
                    genderRadios.forEach(radio => {
                        radio.classList.remove('border-danger');
                        radio.classList.add('border-dark-subtle');
                    });
                }
    
                // Password validation logic
                const passwordInput = document.getElementById("PasswordText");
                const confirmPasswordInput = document.getElementById("CPasswordText");
                const passwordFeedback = document.getElementById("validationPasswordFeedback");
                const CpasswordFeedback = document.getElementById("validationC-PasswordFeedback");
    
                // Reset feedback visibility
                passwordFeedback.style.display = 'none';
                CpasswordFeedback.style.display = 'none';
    
                if (passwordInput.value.trim() === '' || confirmPasswordInput.value.trim() === '') {
                    passwordInput.classList.add('is-invalid');
                    confirmPasswordInput.classList.add('is-invalid');
                }
                else {
                    passwordInput.classList.remove('is-invalid');
                    confirmPasswordInput.classList.remove('is-invalid');
                }
    
                // Submit the form if all fields are valid
                if (allFilled) {
                    form.submit();
                }
            });
        });
    </script>
                
</body>
</html>
