const btn = document.getElementById("submit");
btn.addEventListener("click", validate);

function validate() {
    console.log("validating");
    const name = document.getElementById("name").value;
    const surname = document.getElementById("surname").value;
    const email = document.getElementById("mail").value;
    const tel = document.getElementById("tel").value;
    const address = document.getElementById("address").value;
    const town = document.getElementById("town").value;
    const message = document.getElementById("message").value;

    const alertOk = document.getElementById("alert-ok");
    const alertBad = document.getElementById("alert-bad");
    const alertBadText = document.getElementById("alert-bad-text")

    if (name == "" || surname == "" || email == "" || tel == "" || address == "" || town == "") {
        makeAlert("Please fill out all the fields.");
    }
    else if(email.includes("@") == false || email.includes(".") == false) {
        makeAlert("Please fill out the e-mail address properly.");
    }
    else if(tel.length != 11) {
        makeAlert("Please fill out the telephone number properly.");
    }
    else if(!/\d/.test(address)) {
        makeAlert("Please fill out the address properly");
    }
    else if(message.length > 255) {
        makeAlert("Maximum length of 255 exceeded in message.");
    }
    else {
        makeAlert("")
    }
}

function makeAlert(message){
    alertBadText.innerText = message;
    alertBad.classList.add("alert-active");
    setTimeout(function() {
        alertBad.classList.remove("alert-active");
    }, 5000);
}