function validateCard() {
  var cardInput = document.getElementById('card-number');
  var isValidCard = cardnumber(cardInput); 
  var exMonth = document.getElementById("exMonth");
  var exYear = document.getElementById("exYear");
  var isValidExpiry = validateExpiryDate(exMonth.value, exYear.value);

  if (isValidCard && isValidExpiry) {
    alert('Validation Success');
    return true;
  } else {
    if (!isValidCard) {
      alert('Invalid card number. Please try again.');
    }
    if (!isValidExpiry) {
        alert("The expiry date is before today's date. Please select a valid expiry date");
    }
    return false;
  }
}

function validatePayment(event) {
  var cardInfo = document.getElementById('credit-card-info');
  var isValid = true;

  if (cardInfo.style.display !== 'none') {
    isValid = validateCard();
  }

  if (isValid) {
    document.getElementById('paymentForm').submit();
  } else {
    event.preventDefault(); // Prevent the form from being submitted if validation fails
  }
}

function cardnumber(inputtxt) {
  var cardno = /^(?:4[0-9]{12}(?:[0-9]{3})?)$/; // Visa
  var cardno2 = /^(?:5[1-5][0-9]{14})$/; // MasterCard
  if (inputtxt.value.match(cardno) || inputtxt.value.match(cardno2)) {
    return true;
  } else {
    return false;
  }
}

function validateExpiryDate(month, year) {
  var today, someday;
  today = new Date();
  someday = new Date();
  someday.setFullYear(year, month - 1, 1);

  if (someday < today) {
    alert("The expiry date is before today's date. Please select a valid expiry date");
    return false;
  }
  return true;
}