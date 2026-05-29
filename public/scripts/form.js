export function togglePassword(input) {
    if (input.type === "text") input.type = "password";
    else if (input.type === "password") input.type = "text";
}
export function checkLength(input) {
    if (input.length > 100 || input.length < 3) {
        return {
            success: false,
            error: "Length must be between 3 and 100 characters."
        };
    } else {
        return {
            success: true,
            
        };
    }
}
export function validateEmail(email) {
    let regex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/; /*chaînes ayant lettres chiffres caractès spéciaux avec le domaine après l'arobase avec . et des caractères ensuite*/
    if (regex.test(email)) {
        return {
            success: true,
            
        };
    } else {
        return {
            success: false,
            error: "Please enter a valid email address."
        };
    }
}
export function validateAddress(address) {
    let regex = /^[0-9]+ ?[A-Za-zÀ-ÿ' \-]+$/; /*chaînes commençant par un entier strictement positif, suivies éventuellement d’un espace, puis d’un texte alphabétique (avec accents, espaces, tirets, apostrophes)*/
    if (regex.test(address)) {
        return {
            success: true,
        };
    } else {
        return {
            success: false,
            error: "Please enter a valid address."
        };
    }
}
export function validatePhone(phone) {
    let regex = /^0[0-9]{9}$/; /*0 obligatoire en début de numéro, puis 9 chiffres*/
    if (regex.test(phone)) {
        return {
            success: true,
        };
    } else {
        return {
            success: false,
            error: "Phone number must contain 10 digits and start with 0."
        };
    }
}
export function validatePassword(password) {
    let regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{5,}$/    /*au moins 1 majuscule, 1 chiffre, et 5 caractères min*/
    if (regex.test(password)) {
        return {
            success: true,
        };
    } else {
        return {
            success: false,
            error: "Password must contain at least 5 characters, one uppercase letter and one number."
        };
    };
}

export function markError(el) {
    el.classList.remove("input-success");
    el.classList.add("input-error");
}
export function markSuccess(el) {
    el.classList.remove("input-error");
    el.classList.add("input-success");
}
export function checkLogin(){
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
export function CharLength() {
    let input = document.getElementById("password");
    let length = input.value.length;
    document.getElementById("compteur").textContent = length;
    if (length > 100) {
        input.classList.add("input-error");
        input.classList.remove("input-success");
    } else {
        input.classList.add("input-success");
        input.classList.remove("input-error");
    }
}

export function validateForm(form) {
    let email = form.querySelector("#email");
    let password = form.querySelector("#password");
    let name = form.querySelector("#name");
    let firstname = form.querySelector("#firstname");
    let age = form.querySelector("#age");
    let phone = form.querySelector("#phone");
    let address = form.querySelector("#address");
    let errorBox = form.querySelector(".error-message");
    if (!errorBox) {
        errorBox = form.createElement("p");
        errorBox.className = "error-message";
        form.appendChild(errorBox);
    }
    errorBox.textContent = "";
    let errors = [];
    let valid = true;
    let fields = [email, password, name, firstname, age, phone, address];
    for (let i = 0; i < fields.length; i++) {
        if (fields[i]) {
            fields[i].classList.remove("input-error");
            fields[i].classList.remove("input-success");
        }
    }
    if (name && !checkLength(name.value).success) {
        markError(name);
        errors.push("Nom trop long");
        valid = false;
    } else if (name) {
        markSuccess(name);
    }
    if (firstname && !checkLength(firstname.value).success) {
        markError(firstname);
        errors.push("Prénom trop long");
        valid = false;
    } else if (firstname) {
        markSuccess(firstname);
    }
    if (age && (age.value < 18 || age.value > 120)) {
        markError(age);
        errors.push("Âge invalide (18-120)");
        valid = false;
    } else if (age) {
        markSuccess(age);
    }
    if (!email || !validateEmail(email.value).success) {
        markError(email);
        errors.push("Email invalide");
        valid = false;
    } else {
        markSuccess(email);
    }
    if (!password || !validatePassword(password.value).success) {
        markError(password);
        errors.push("Mot de passe = 10 chiffres uniquement");
        valid = false;
    } else {
        markSuccess(password);
    }
    if (phone && !validatePhone(phone.value).success) {
        markError(phone);
        errors.push("Téléphone invalide (10 chiffres, commence par 0)");
        valid = false;
    } else if (phone) {
        markSuccess(phone);
    }
    if (address && !validateAddress(address.value).success) {
        markError(address);
        errors.push("Adresse invalide");
        valid = false;
    } else if (address) {
        markSuccess(address);
    }
    if (!valid) {
        errorBox.textContent = errors.join(" | ");
    }
    return valid;
}
export function updateCounter(input, counterId) {
    let max = input.maxLength;
    let current = input.value.length;
    let counter = document.getElementById(counterId);
    counter.textContent = current + " / " + max;
}

let formatInputs = document.querySelectorAll("input.autoformat");
for (const formatInput of formatInputs) formatInput.addEventListener("input", (e) => {
    let value = e.target.value.toLowerCase();
    e.target.value = value.charAt(0).toUpperCase()+value.slice(1);
});

let passwordFields = document.querySelectorAll("div.password-field");
for (const passwordField of passwordFields) {
    const passwordInput = passwordField.querySelector("input[type=\"password\"]");
    const togglePasswordCheckbox = passwordField.querySelector("input[type=\"checkbox\"][name=\"togglePassword\"]");
    const valueLengthSpan = passwordField.querySelector("span.valueLength span");

    passwordInput.addEventListener("input", (e) => valueLengthSpan.textContent = e.target.value.length);
    togglePasswordCheckbox.addEventListener("change", () => togglePassword(passwordInput));
}

let formsToValidate = document.querySelectorAll("form.validateForm");
for (const form of formsToValidate) form.addEventListener("submit", (e) => {
    if (!validateForm(e.target)) e.preventDefault();
});