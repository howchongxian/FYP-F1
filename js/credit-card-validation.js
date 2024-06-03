function validateCard() {
  var cardInput = document.getElementById('card-number');
  var isValid = cardnumber(cardInput); 

  if (isValid) {
    alert('Validation Success');
    return true;
  } else {
    alert('Invalid card number. Please try again.');
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
