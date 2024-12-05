btn = document.getElementById("submit");
btn.addEventListener("click", validate);

function validate() {
    console.log("validating");
    name = document.getElementById("name").value;
    surname = document.getElementById("surname").value;
    email = document.getElementById("mail").value;
    tel = document.getElementById("tel").value;
    address = document.getElementById("address").value;
    town = document.getElementById("town").value;
    message = document.getElementById("message").value;

    alertOk = document.getElementById("alert-ok");
    alertBad = document.getElementById("alert-bad");
    alertBadText = document.getElementById("alert-bad-text")

    if (name == "" || surname == "" || email == "" || tel == "" || address == "" || town == "") {
        alertBadText.innerText = "Please fill out all the fields."
        alertBad.classList.add("alert-active");
        setTimeout(function() {
            alertBad.classList.remove("alert-active");
        }, 5000);
    }
    else if(email.includes("@") == false || email.includes(".") == false) {
        alertBadText.innerText = "Please fill out the e-mail address properly."
        alertBad.classList.add("alert-active");
        setTimeout(function() {
            alertBad.classList.remove("alert-active");
        }, 5000);
    }
    else if(tel.length != 11) {
        alertBadText.innerText = "Please fill out the telephone number properly."
        alertBad.classList.add("alert-active");
        setTimeout(function() {
            alertBad.classList.remove("alert-active");
        }, 5000);
    }
    else if(!/\d/.test(address)) {
        alertBadText.innerText = "Please fill out the address properly"
        alertBad.classList.add("alert-active");
        setTimeout(function() {
            alertBad.classList.remove("alert-active");
        }, 5000);
    }
    else if(message.length > 255) {
        alertBadText.innerText = "Maximum length of 255 exceeded in message."
        alertBad.classList.add("alert-active");
        setTimeout(function() {
            alertBad.classList.remove("alert-active");
        }, 5000);
    }
    else {
        alertOk.classList.add("alert-active");
        setTimeout(function() {
            alertOk.classList.remove("alert-active");
        }, 5000);
    }
}