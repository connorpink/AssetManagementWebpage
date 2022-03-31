// Refresh page on 3 min inactivity
let time = new Date().getTime();
const setActivityTime = (e) => {
  time = new Date().getTime();
}
document.body.addEventListener("mousemove", setActivityTime);
document.body.addEventListener("keypress", setActivityTime);

const refresh = () => {
  if (new Date().getTime() - time >= 180000) {
    window.location.reload(true);
  } else {
    setTimeout(refresh, 10000);
  }
}

setTimeout(refresh, 10000);

// Make buttons change value in the textbox
  function AddRemoveAmount(amount,itemName) {
    idnameNumber = 'numberBox'+itemName;
    currentValue = Number(document.getElementById(idnameNumber).value);
    amount = amount + currentValue;
    Number(document.getElementById(idnameNumber).value = amount);
  }

  // Remove form resubmission data on refresh

  if ( window.history.replaceState ) {
      window.history.replaceState( null, null, window.location.href );
  }