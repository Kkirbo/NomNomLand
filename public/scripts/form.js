function TogglePassword() {
    let a = document.getElementById("password");
    if (a.type === "text") {
        a.type = "password";
    } else {
        a.type = "text";
    }
}
function checkLength(input) {
    if (input.length > 100) {
        return {
            success: false,
            error: "TOO_LONG"
        };
    } else {
        return {
            success: true,
            
        };
    }
}
function validateEmail(email) {
    let regex = /^[a-zA-Z0-9]+@(gmail|yahoo|email|outlook)\.(com|fr)$/; /*Une chaîne de caractère, suivi de l'@ forcé, et les domaines autorisés, avec ou .com, ou .fr à la fin */
    if (regex.test(email)) {
        return {
            success: true,
            
        };
    } else {
        return {
            success: false,
            error: "INVALID_EMAIL"
        };
    }
}
function validateAddress(address) {
    let regex = /^[0-9]+ ?[A-Za-zÀ-ÿ' \-]+$/; /*chaînes commençant par un entier strictement positif, suivies éventuellement d’un espace, puis d’un texte alphabétique (avec accents, espaces, tirets, apostrophes)*/
    if (regex.test(address)) {
        return {
            success: true,
        };
    } else {
        return {
            success: false,
            error: "INVALID_ADDRESS"
        };
    }
}
function validatePhone(phone) {
    let regex = /^0[0-9]{9}$/; /*0 obligatoire en début de numéro, puis 9 chiffres*/
    if (regex.test(phone)) {
        return {
            success: true,
        };
    } else {
        return {
            success: false,
            error: "INVALID_PHONE"
        };
    }
}
function validatePassword(password) {
    let regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{5,}$/    /*au moins 1 majuscule, 1 chiffre, et 5 caractères min*/
    if (regex.test(password)) {
        return {
            success: true,
        };
    } else {
        return {
            success: false,
            error: "INVALID_PASSWORD"
        };
    }
}
function markError(el) {
    el.classList.remove("input-success");
    el.classList.add("input-error");
}
function markSuccess(el) {
    el.classList.remove("input-error");
    el.classList.add("input-success");
}
function checkLogin(){
    let email = document.getElementById("email");
    let password = document.getElementById("password");
    let errors = [];
    let valid = true;
    let errorBox = document.querySelector(".error-message");
    if (!errorBox) {
    errorBox = document.createElement("p");
    errorBox.className = "error-message";
    document.querySelector("form fieldset").appendChild(errorBox);
}
    let fields = [email, password];
    for (let i = 0; i < fields.length; i++) {
        if (fields[i]) {
            fields[i].classList.remove("input-error");
            fields[i].classList.remove("input-success");
        }
    }
    if (!validateEmail(email.value).success) {
        markError(email);
        errors.push("INVALID_EMAIL");
        valid = false;
    } else {
        markSuccess(email);
    }
    if (!validatePassword(password.value).success) {
        markError(password);
        errors.push("INCORRECT_PASSWORD");
        valid = false;
    } else {
        markSuccess(password);
    }
    if (valid === false) {
        errorBox.textContent = errors.join(" | ");
    } else {
        errorBox.textContent = "";
    }
    return valid;
}

function validateForm() {
    let email = document.getElementById("email");
    let password = document.getElementById("password");
    let name = document.getElementById("name");
    let firstname = document.getElementById("firstname");
    let age = document.getElementById("age");
    let phone = document.getElementById("phone");
    let address = document.getElementById("address");
    let errorBox = document.querySelector(".error-message");
    if (!errorBox) {
        errorBox = document.createElement("p");
        errorBox.className = "error-message";
        document.querySelector("form fieldset").appendChild(errorBox);
    }
    let errors = [];
    let valid = true;
    let fields = [email, password, name, firstname, age, phone, address];
    for (let i = 0; i < fields.length; i++) {
        if (fields[i]) {
            fields[i].classList.remove("input-error");
            fields[i].classList.remove("input-success");
        }
    }
    if (!checkLength(name.value).success) {
        markError(name);
        errors.push("Nom trop long");
        valid = false;
    } else {
        markSuccess(name);
    }
    if (!checkLength(firstname.value).success) {
        markError(firstname);
        errors.push("Prénom trop long");
        valid = false;
    } else {
        markSuccess(firstname);
    }
    if (age.value < 18 || age.value > 120) {
        markError(age);
        errors.push("Âge invalide (18-120)");
        valid = false;
    } else {
        markSuccess(age);
    }
    if (!validateEmail(email.value).success) {
        markError(email);
        errors.push("Email invalide");
        valid = false;
    } else {
        markSuccess(email);
    }
    if (!validatePassword(password.value).success) {
        markError(password);
        errors.push("Mot de passe = 10 chiffres uniquement");
        valid = false;
    } else {
        markSuccess(password);
    }
    if (!validatePhone(phone.value).success) {
        markError(phone);
        errors.push("Téléphone invalide (10 chiffres, commence par 0)");
        valid = false;
    } else {
        markSuccess(phone);
    }
    if (address.value !== "") {
        if (!validateAddress(address.value).success) {
            markError(address);
            errors.push("Adresse invalide");
            valid = false;
        } else {
            markSuccess(address);
        }
    }
    if (valid === false) {
        errorBox.textContent = errors.join(" | ");
    } else {
        errorBox.textContent = "";
    }
    return valid;
}
function updateCounter(input, counterId) {
    let max = input.maxLength;
    let current = input.value.length;
    let counter = document.getElementById(counterId);
    counter.textContent = current + " / " + max;
}