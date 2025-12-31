
function showInterestRate() {
    
    var loanType = document.getElementById("loanType").value;
    const loanTypeInput = document.getElementById("loanType");
    const interestRateDisplay = document.getElementById("interest_rate_text");
    const RequiredInterestRate = document.getElementById("requiredInterestRate");
    const loanAmountInput = document.getElementById("loanAmount");
    const loanTermInput = document.getElementById("loanTerm");
    var errorElement = document.getElementById("error");
    const calculateBtn = document.getElementById("calculate-btn");

    const RequiredLoanType = document.getElementById("requiredLoanType");

    if (loanType === "")
    {
        interestRateDisplay.value = "";
        loanAmountInput.placeholder = "ex. ₱50,000 = ₱50000";
        loanTermInput.placeholder = "ex. 1 to 36 months";
        errorElement.style.display = 'none'
        calculateBtn.disabled = true;
    }
    else if (loanType === "(VL)Vendors Loan") {
        RequiredLoanType.style.display = "none";
        RequiredInterestRate.style.display = "none";
        loanTypeInput.classList.remove('border-danger');
        loanTypeInput.classList.add('border-dark-subtle');
        interestRateDisplay.classList.remove('border-danger');
        interestRateDisplay.classList.add('border-dark-subtle');
        interestRateDisplay.value = "24%";
        loanAmountInput.placeholder = "min ₱5,000.00; max ₱9,999.99";
        loanTermInput.placeholder = "3 to 6 months";
        errorElement.style.display = 'none';
        calculateBtn.disabled = false;
        loanTermInput.style.border = '1px solid #767676'
        
    } else if (loanType === "(MEL)Micro Enterprise Loan") {
        RequiredLoanType.style.display = "none";
        loanTypeInput.classList.remove('border-danger');
        loanTypeInput.classList.add('border-dark-subtle');
        interestRateDisplay.classList.remove('border-danger');
        interestRateDisplay.classList.add('border-dark-subtle');
        interestRateDisplay.value = "24%";
        loanAmountInput.placeholder = "min ₱10,000.00; max ₱100,000.00";
        loanTermInput.placeholder = "1 to 18 months";
        errorElement.style.display = 'none';
        calculateBtn.disabled = false;
        loanTermInput.style.border = '1px solid #767676'
    } else if (loanType === "(SEL)Small Enterprise Loan") {
        RequiredLoanType.style.display = "none";
        loanTypeInput.classList.remove('border-danger');
        loanTypeInput.classList.add('border-dark-subtle');
        interestRateDisplay.classList.remove('border-danger');
        interestRateDisplay.classList.add('border-dark-subtle');
        interestRateDisplay.value = "22%";
        loanAmountInput.placeholder = "min ₱100,000.00; max ₱200,000.00";
        loanTermInput.placeholder = "12 to 24 months";
        errorElement.style.display = 'none';
        calculateBtn.disabled = false;
        loanTermInput.style.border = '1px solid #767676'
    } else if (loanType === "(BL)Business Loan") {
        RequiredLoanType.style.display = "none";
        loanTypeInput.classList.remove('border-danger');
        loanTypeInput.classList.add('border-dark-subtle');
        interestRateDisplay.classList.remove('border-danger');
        interestRateDisplay.classList.add('border-dark-subtle');
        interestRateDisplay.value = "20%";
        loanAmountInput.placeholder = "min ₱20,000.00; max ₱500,000.00";
        loanTermInput.placeholder = "12 to 36 months";
        errorElement.style.display = 'none';
        calculateBtn.disabled = false;
        loanTermInput.style.border = '1px solid #767676'
    } else if (loanType === "(CL)Commercial Loan") {
        RequiredLoanType.style.display = "none";
        loanTypeInput.classList.remove('border-danger');
        loanTypeInput.classList.add('border-dark-subtle');
        interestRateDisplay.classList.remove('border-danger');
        interestRateDisplay.classList.add('border-dark-subtle');
        interestRateDisplay.value = "18%";
        loanAmountInput.placeholder = "min ₱500,000.00; max ₱5,000,000.00";
        loanTermInput.placeholder = "12 months to Depends on the age";
        errorElement.style.display = 'none';
        calculateBtn.disabled = false;
        loanTermInput.style.border = '1px solid #767676'
    } else if (loanType === "(IL)Infrastructure Loan") {
        RequiredLoanType.style.display = "none";
        loanTypeInput.classList.remove('border-danger');
        loanTypeInput.classList.add('border-dark-subtle');
        interestRateDisplay.classList.remove('border-danger');
        interestRateDisplay.classList.add('border-dark-subtle');
        interestRateDisplay.value = "18%";
        loanAmountInput.placeholder = "min ₱500,000.00; max ₱5,000,000.00";
        loanTermInput.placeholder = "12 months to Depends on the age";
        errorElement.style.display = 'none';
        calculateBtn.disabled = false;
        loanTermInput.style.border = '1px solid #767676'
    } else if (loanType === "(CRL-PROD)Check Rediscounting (Productive)") {
        RequiredLoanType.style.display = "none";
        loanTypeInput.classList.remove('border-danger');
        loanTypeInput.classList.add('border-dark-subtle');
        interestRateDisplay.classList.remove('border-danger');
        interestRateDisplay.classList.add('border-dark-subtle');
        interestRateDisplay.value = "24%";
        loanAmountInput.placeholder = "min ₱30,000.00; max ₱300,000.00";
        loanTermInput.placeholder = "1 month only";
        errorElement.style.display = 'none';
        calculateBtn.disabled = false;
        loanTermInput.style.border = '1px solid #767676'
    } else if (loanType === "(LAD-PROD)Loan Against Deposit (Productive)") {
        RequiredLoanType.style.display = "none";
        loanTypeInput.classList.remove('border-danger');
        loanTypeInput.classList.add('border-dark-subtle');
        interestRateDisplay.classList.remove('border-danger');
        interestRateDisplay.classList.add('border-dark-subtle');
        interestRateDisplay.value = "18%";
        loanAmountInput.placeholder = "90% of Deposit";
        loanTermInput.placeholder = "1 month to depends on the age";
        errorElement.style.display = 'none';
        calculateBtn.disabled = false;
        loanTermInput.style.border = '1px solid #767676'
    } else if (loanType === "(FLL-PROD)Fast Lane Loan (Productive)") {
        RequiredLoanType.style.display = "none";
        loanTypeInput.classList.remove('border-danger');
        loanTypeInput.classList.add('border-dark-subtle');
        interestRateDisplay.classList.remove('border-danger');
        interestRateDisplay.classList.add('border-dark-subtle');
        interestRateDisplay.value = "20%";
        loanAmountInput.placeholder = "min ₱10,000.00; max ₱200,000.00";
        loanTermInput.placeholder = "1 to 24 months";
        errorElement.style.display = 'none';
        calculateBtn.disabled = false;
        loanTermInput.style.border = '1px solid #767676'
    } else if (loanType === "(CRL-PROV)Check Rediscounting (Providential)") {
        RequiredLoanType.style.display = "none";
        loanTypeInput.classList.remove('border-danger');
        loanTypeInput.classList.add('border-dark-subtle');
        interestRateDisplay.classList.remove('border-danger');
        interestRateDisplay.classList.add('border-dark-subtle');
        interestRateDisplay.value = "26%";
        loanAmountInput.placeholder = "min ₱30,000.00; max ₱300,000.00";
        loanTermInput.placeholder = "1 month only";
        errorElement.style.display = 'none';
        calculateBtn.disabled = false;
        loanTermInput.style.border = '1px solid #767676'
    } else if (loanType === "(LAD-PROV)Loan Against Deposit (Providential)") {
        RequiredLoanType.style.display = "none";
        loanTypeInput.classList.remove('border-danger');
        loanTypeInput.classList.add('border-dark-subtle');
        interestRateDisplay.classList.remove('border-danger');
        interestRateDisplay.classList.add('border-dark-subtle');
        interestRateDisplay.value = "16%";
        loanAmountInput.placeholder = "90% of Deposit";
        loanTermInput.placeholder = "1 term; depends on the age";
        errorElement.style.display = 'none';
        calculateBtn.disabled = false;
        loanTermInput.style.border = '1px solid #767676'
    } else if (loanType === "(FLL-PROV)Fast Lane Loan (Providential)") {
        RequiredLoanType.style.display = "none";
        loanTypeInput.classList.remove('border-danger');
        loanTypeInput.classList.add('border-dark-subtle');
        interestRateDisplay.classList.remove('border-danger');
        interestRateDisplay.classList.add('border-dark-subtle');
        interestRateDisplay.value = "16%";
        loanAmountInput.placeholder = "min ₱10,000.00; max ₱200,000.00";
        loanTermInput.placeholder = "1 to 24 months";
        errorElement.style.display = 'none';
        calculateBtn.disabled = false;
        loanTermInput.style.border = '1px solid #767676'
    } else if (loanType === "(EL)Educational Loan") {
        RequiredLoanType.style.display = "none";
        loanTypeInput.classList.remove('border-danger');
        loanTypeInput.classList.add('border-dark-subtle');
        interestRateDisplay.classList.remove('border-danger');
        interestRateDisplay.classList.add('border-dark-subtle');
        interestRateDisplay.value = "16%";
        loanAmountInput.placeholder = "min ₱10,000.00; max ₱100,000.00";
        loanTermInput.placeholder = "1 to 10 months";
        errorElement.style.display = 'none';
        calculateBtn.disabled = false;
        loanTermInput.style.border = '1px solid #767676'
    } else if (loanType === "(INVL)Investment Loan") {
        RequiredLoanType.style.display = "none";
        loanTypeInput.classList.remove('border-danger');
        loanTypeInput.classList.add('border-dark-subtle');
        interestRateDisplay.classList.remove('border-danger');
        interestRateDisplay.classList.add('border-dark-subtle');
        interestRateDisplay.value = "18%";
        loanAmountInput.placeholder = "min ₱200,000.00; max ₱5,000,000.00";
        loanTermInput.placeholder = "min: 12 months";
        errorElement.style.display = 'none'
        calculateBtn.disabled = false;
        loanTermInput.style.border = '1px solid #767676'
    } else if (loanType === "(MAL)Medical Assistance Loan") {
        RequiredLoanType.style.display = "none";
        loanTypeInput.classList.remove('border-danger');
        loanTypeInput.classList.add('border-dark-subtle');
        interestRateDisplay.classList.remove('border-danger');
        interestRateDisplay.classList.add('border-dark-subtle');
        interestRateDisplay.value = "16%";
        loanAmountInput.placeholder = "min ₱10,000.00; max ₱100,000.00";
        loanTermInput.placeholder = "1 to 12 months";
        errorElement.style.display = 'none'
        calculateBtn.disabled = false;
        loanTermInput.style.border = '1px solid #767676'
    } else if (loanType === "(PL)Personal Loan") {
        RequiredLoanType.style.display = "none";
        loanTypeInput.classList.remove('border-danger');
        loanTypeInput.classList.add('border-dark-subtle');
        interestRateDisplay.classList.remove('border-danger');
        interestRateDisplay.classList.add('border-dark-subtle');
        interestRateDisplay.value = "22%";
        loanAmountInput.placeholder = "min ₱5,000.00; max ₱200,000.00";
        loanTermInput.placeholder = "1 to 24 months";
        errorElement.style.display = 'none'
        calculateBtn.disabled = false;
        loanTermInput.style.border = '1px solid #767676'
    } else if (loanType === "(TL)Travel Loan") {
        RequiredLoanType.style.display = "none";
        loanTypeInput.classList.remove('border-danger');
        loanTypeInput.classList.add('border-dark-subtle');
        interestRateDisplay.classList.remove('border-danger');
        interestRateDisplay.classList.add('border-dark-subtle');
        interestRateDisplay.value = "22%";
        loanAmountInput.placeholder = "min ₱10,000.00; max ₱100,000.00";
        loanTermInput.placeholder = "1 to 18 months";
        errorElement.style.display = 'none'
        calculateBtn.disabled = false;
        loanTermInput.style.border = '1px solid #767676'
    } else if (loanType === "(UTL)Utilities Assistance Loan") {
        RequiredLoanType.style.display = "none";
        loanTypeInput.classList.remove('border-danger');
        loanTypeInput.classList.add('border-dark-subtle');
        interestRateDisplay.classList.remove('border-danger');
        interestRateDisplay.classList.add('border-dark-subtle');
        interestRateDisplay.value = "16%";
        loanAmountInput.placeholder = "min, max ₱15,000.00";
        loanTermInput.placeholder = "1 to 6 months";
        errorElement.style.display = 'none'
        calculateBtn.disabled = false;
        loanTermInput.style.border = '1px solid #767676'
    } else if (loanType === "(LEL)Life Events Loan") {
        RequiredLoanType.style.display = "none";
        loanTypeInput.classList.remove('border-danger');
        loanTypeInput.classList.add('border-dark-subtle');
        interestRateDisplay.classList.remove('border-danger');
        interestRateDisplay.classList.add('border-dark-subtle');
        interestRateDisplay.value = "22%";
        loanAmountInput.placeholder = "min ₱10,000.00; max ₱100,000.00";
        loanTermInput.placeholder = "1 to 24 months";
        errorElement.style.display = 'none'
        calculateBtn.disabled = false;
        loanTermInput.style.border = '1px solid #767676'
    } else if (loanType === "(GAFL)Gadget-Appliance-Furniture Loan") {
        RequiredLoanType.style.display = "none";
        loanTypeInput.classList.remove('border-danger');
        loanTypeInput.classList.add('border-dark-subtle');
        interestRateDisplay.classList.remove('border-danger');
        interestRateDisplay.classList.add('border-dark-subtle');
        interestRateDisplay.value = "22%";
        loanAmountInput.placeholder = "min, max ₱50,000.00";
        loanTermInput.placeholder = "3 to 12 months";
        errorElement.style.display = 'none'
        calculateBtn.disabled = false;
        loanTermInput.style.border = '1px solid #767676'
    } else if (loanType === "(EML)Emergency Loan") {
        RequiredLoanType.style.display = "none";
        loanTypeInput.classList.remove('border-danger');
        loanTypeInput.classList.add('border-dark-subtle');
        interestRateDisplay.classList.remove('border-danger');
        interestRateDisplay.classList.add('border-dark-subtle');
        interestRateDisplay.value = "18%";
        loanAmountInput.placeholder = "min, max ₱30,000.00";
        loanTermInput.placeholder = "1 to 12 months";
        errorElement.style.display = 'none'
        calculateBtn.disabled = false;
        loanTermInput.style.border = '1px solid #767676'
    }
    else {
        interestRateDisplay.value = ""; // Clear the text if no loan type is selected
    }
}

function pesosign(){
    const pesoSign = document.getElementById("fixed-peso-sign");
    const loanAmountInput = document.getElementById("loanAmount");
    
    // Check if the input field has a value
    if (loanAmountInput.value !== "") {
        // Set the opacity of the peso sign to 1
        pesoSign.style.opacity = 1;
    } else {
        // Set the opacity of the peso sign to 0
        pesoSign.style.opacity = 0;
    }
};



function calculateLoan() {
    var myModal = new bootstrap.Modal(document.getElementById('disclaimer-notice'), {
        keyboard: false
    });
    myModal.show();

    var loanAmount = getLoanAmount();
    var loanType = document.getElementById("loanType").value;
    var loanTerm = parseInt(document.getElementById("loanTerm").value);
    var interestRate = 0;

    // Nested conditional statement to set the interest rate based on loan type
    if (loanType === "(VL)Vendors Loan") {
        interestRate = 0.24;
    } else if (loanType === "(MEL)Micro Enterprise Loan") {
        interestRate = 0.24;
    } else if (loanType === "(SEL)Small Enterprise Loan") {
        interestRate = 0.22;
    } else if (loanType === "(BL)Business Loan") {
        interestRate = 0.20;
    } else if (loanType === "(CL)Commercial Loan") {
        interestRate = 0.18;
    } else if (loanType === "(IL)Infrastructure Loan") {
        interestRate = 0.18;
    } else if (loanType === "(CRL-PROD)Check Rediscounting (Productive)") {
        interestRate = 0.24;
    } else if (loanType === "(LAD-PROD)Loan Against Deposit (Productive)") {
        interestRate = 0.18;
    } else if (loanType === "(FLL-PROD)Fast Lane Loan (Productive)") {
        interestRate = 0.20;
    } else if (loanType === "(CRL-PROV)Check Rediscounting (Providential)") {
        interestRate = 0.26;
    } else if (loanType === "(LAD-PROV)Loan Against Deposit (Providential)") {
        interestRate = 0.16;
    } else if (loanType === "(FLL-PROV)Fast Lane Loan (Providential)") {
        interestRate = 0.16;
    } else if (loanType === "(EL)Educational Loan") {
        interestRate = 0.16;
    } else if (loanType === "(INVL)Investment Loan") {
        interestRate = 0.18;
    } else if (loanType === "(MAL)Medical Assistance Loan") {
        interestRate = 0.16;
    } else if (loanType === "(PL)Personal Loan") {
        interestRate = 0.22;
    } else if (loanType === "(TL)Travel Loan") {
        interestRate = 0.22;
    } else if (loanType === "(UTL)Utilities Assistance Loan") {
        interestRate = 0.16;
    } else if (loanType === "(LEL)Life Events Loan") {
        interestRate = 0.22;
    } else if (loanType === "(GAFL)Gadget-Appliance-Furniture Loan") {
        interestRate = 0.22;
    } else if (loanType === "(EML)Emergency Loan") {
        interestRate= 0.18;
    } else {
        interestRate = parseFloat(document.getElementById("interest_rate_text").value) / 100;
    }

    document.getElementById('interestRateInput').value = interestRate * 100;
    var monthlyInterestRate = interestRate / 12;
    var monthlyPayment = loanAmount * (monthlyInterestRate / (1 - Math.pow(1 + monthlyInterestRate, -loanTerm)));

    if (!isNaN(monthlyPayment)) {
        var detailed_payments_table = "<h3 class = 'mt-2'>Detailed Payments per Terms:</h3>";

        // Calculate total loan payment and total interest
        var totalPayment = monthlyPayment * loanTerm;
        var totalInterest = totalPayment - loanAmount;

        // Display total loan payment and total interest above the table
        detailed_payments_table += "<div id='total_info' class='mt-3' style='text-align: right; margin-right: 10px;'>";
        detailed_payments_table += "<p class = 'mt-2' style='display: inline-block; margin-right: 10px;'><b>Total Loan Payment: </b>₱ " + totalPayment.toFixed(2) + "</p>";
        detailed_payments_table += "<p style='display: inline-block;'><b>Total Interest:</b> ₱ " + totalInterest.toFixed(2) + "</p>";
        detailed_payments_table += "</div>";

        // Wrap the table in a responsive div
        detailed_payments_table += "<div class='table-responsive-sm'>";
        detailed_payments_table += "<table class='table table-bordered table-hover table-md'>";
        detailed_payments_table += "<thead><tr><th style='text-align:center;'>Month</th><th style='text-align: center;'>Payment Date</th><th style='text-align: center;'>Beginning Balance</th><th style='text-align: center;'>Scheduled Payment</th><th style='text-align: center;'>Interest Paid</th><th style='text-align: center;'>Principal Paid</th><th style='text-align: center;'>Ending Balance</th></tr></thead><tbody>";
        var interestPaid, principalPaid;
        var currentDate = new Date(); // Start with the current date
        var beginningBalance = loanAmount;

        for (var i = 1; i <= loanTerm; i++) {
            // Calculate payment date for each month
            var paymentDate = new Date(currentDate.getFullYear(), currentDate.getMonth() + i, currentDate.getDate());
            // Format the payment date into mm/dd/yyyy format
            var paymentDateString = paymentDate.getFullYear() + '-' + (paymentDate.getMonth() + 1) + '-' + paymentDate.getDate();

            interestPaid = beginningBalance * monthlyInterestRate;
            principalPaid = monthlyPayment - interestPaid;
            var endingBalance = beginningBalance - principalPaid;

            detailed_payments_table += "<tr>" +
                "<td style='text-align:center;'><input type='hidden' name='months" + i + "' value='" + i + "'/> " + i + "</td>" +
                "<td style='text-align: center;'>" + "<input type='hidden' name='payment_date" + i + "' value='" + paymentDateString + "'/>" + paymentDateString + "</td>" +
                "<td style='text-align: right; padding-right: 2;'>₱ <input type='hidden' name='beginning_Balance" + i + "' value='" + beginningBalance.toFixed(2) + "'/>" + beginningBalance.toFixed(2) + "</td>" +
                "<td style='text-align: right; padding-right: 2;'>₱ <input type='hidden' name='monthly_payment" + i + "' value='" + monthlyPayment.toFixed(2) + "'/>" + monthlyPayment.toFixed(2) + "</td>" +
                "<td style='text-align: right; padding-right: 2;'>₱ <input type='hidden' name='interest_paid" + i + "' value='" + interestPaid.toFixed(2) + "'/>" + interestPaid.toFixed(2) + "</td>" +
                "<td style='text-align: right; padding-right: 2;'>₱ <input type='hidden' name='principal_paid" + i + "' value='" + principalPaid.toFixed(2) + "'/>" + principalPaid.toFixed(2) + "</td>" +
                "<td style='text-align: right; padding-right: 2;'>₱ <input type='hidden' name='ending_balance" + i + "' value='" + endingBalance.toFixed(2) + "'/>" + endingBalance.toFixed(2) + "</td>" +
                "</tr>";

            beginningBalance = endingBalance;

            const ApplicationBTN = document.getElementById('loanApplicationContainer');
            ApplicationBTN.style.display = 'block';
        }

        detailed_payments_table += "</tbody></table>";
        detailed_payments_table += "</div>"; // Close the table-responsive div
        document.getElementById("scheduled_payment_table").innerHTML = detailed_payments_table;
        document.getElementById("LoanAmountApplied").value = loanAmount;
        document.getElementById("LoanTermApplied").value = loanTerm;

    } else {
                
        const loanTypeInput = document.getElementById("loanType");
        const loanTermInput = document.getElementById("loanTerm");
        const loanAmountInput = document.getElementById("loanAmount");
        const interestRateInput = document.getElementById("interest_rate_text");

        const RequiredLoanType = document.getElementById("requiredLoanType");
        const RequiredLoanTerm = document.getElementById("requiredLoanTerm");
        const RequiredLoanAmount = document.getElementById("requiredLoanAmount");
        const RequiredInterestRate = document.getElementById("requiredInterestRate");
        
        alert("Please input a value first before calculating.")

        RequiredLoanType.style.display = "inline";
        RequiredLoanTerm.style.display = "inline";
        RequiredLoanAmount.style.display = "inline";
        RequiredInterestRate.style.display = "inline";

        loanTermInput.classList.remove('border-dark-subtle');
        loanTermInput.classList.add('border-danger');

        loanTypeInput.classList.remove('border-dark-subtle');
        loanTypeInput.classList.add('border-danger');

        loanAmountInput.classList.remove('border-dark-subtle');
        loanAmountInput.classList.add('border-danger');

        interestRateInput.classList.remove('border-dark-subtle');
        interestRateInput.classList.add('border-danger');
    }
}