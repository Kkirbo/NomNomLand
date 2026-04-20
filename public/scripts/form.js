
function TogglePassword(){
    let a=document.getElementById("password");
    a.getAttribute("type") == "text" ? a.setAttribute("type","password") : a.setAttribute("type","text");
}

function checkLength(input) {
    if (input.length > 100) {
        return {
            success: false,
            error: "TOO_LONG"
        };
    }
    return {
        success: true,
        error: null
    };
}
/*let result = checkLength("mon texte");
if (!result.success) {
    console.log(result.error);
}*/
function validateEmail(email) {
    const regex = /^[a-zA-Z0-9]+@(gmail|yahoo|email|outlook)\.(com|fr)$/;
    if (!regex.test(email)) {
        return {
            success: false,
            error: "INVALID_EMAIL"
        };
    }
    return {
        success: true,
        error: null
    };
}
function validateAddress(address) {
    const regex = /^[0-9]+ ?[A-Za-zÀ-ÿ' \-]+$/;

    if (!regex.test(address)) {
        return {
            success: false,
            error: "INVALID_ADDRESS"
        };
    }

    return {
        success: true,
        error: null
    };
}
function validateForm() {
    let email = document.getElementById("email");
    let password = document.getElementById("email-confirm");
    let name = document.getElementById("name");
    let valid = true;
    [email, password, name].forEach(el => el.classList.remove("input-error"));
    if (!checkLength(name.value).success) {
        name.classList.add("input-error");
        valid = false;
    }
    if (!checkLength(email.value).success) {
        email.classList.add("input-error");
        valid = false;
    }
    if (!checkLength(password.value).success) {
        password.classList.add("input-error");
        valid = false;
    }
    if (!validateEmail(email.value).success) {
        email.classList.add("input-error");
        valid = false;
    }
    if (address.value !== "" && !validateAddress(address.value).success) {
        address.classList.add("input-error");
        valid = false;
    }
    return valid;
}
