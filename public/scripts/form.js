import { appendMessage } from "./utilities/appendMessage.js";

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
export function validateAge(age) {
    if (age >= 18 && age <= 120) {
        return {
            success: true,
        };
    } else {
        return {
            success: false,
            error: "Age must be between 18 and 120."
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

export function validateInput(input) {
    let error = "";
    let lengthCheck = checkLength(input.value);
    error += lengthCheck.error ?? "";
    let inputValid = lengthCheck.success;
    let validate = undefined;
    switch (input.type) {
        case "email":
            validate = validateEmail(input.value);
            break;
        case "tel":
            validate = validatePhone(input.value);
            break;
        case "password":
            validate = validatePassword(input.value);
            break;
        case "number":
            inputValid = true;
            error = "";
            if (input.name == "age" ||  input.dataset.name == "age") validate = validateAge(input.value);
            else validate = { success: true };
            break;
        case "text":
            if (input.name == "address" ||  input.dataset.name == "address") validate = validateAddress(input.value);
            else validate = { success: true };
            break;
        default:
            inputValid = true;
            error = "";
            validate = { success: true };
            break;
    }
    if (error != "") error += "\n";
    error += validate.error ?? "";
    inputValid = inputValid && validate.success;
    return { success: inputValid, error: error };
}

export function markError(el) {
    el.classList.remove("input-success");
    el.classList.add("input-error");
}
export function markSuccess(el) {
    el.classList.remove("input-error");
    el.classList.add("input-success");
}

export function validateForm(form) {
    let valid = true;
    let error = "";
    const inputs = form.querySelectorAll("input");
    for (const input of inputs) {
        if (input.classList.contains("novalidate")) continue;
        let validate = validateInput(input);
        if (!validate.success) appendMessage(input, validate.error, true);
        valid = valid && validate.success;
        if (!valid) break;
    }
    return valid;
    /*let email = form.querySelector("#email");
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
    return valid;*/
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

    if (passwordInput && valueLengthSpan) passwordInput.addEventListener("input", (e) => valueLengthSpan.textContent = e.target.value.length);
    if (togglePasswordCheckbox) togglePasswordCheckbox.addEventListener("change", () => togglePassword(passwordInput));
}

let formsToValidate = document.querySelectorAll("form.validateForm");
for (const form of formsToValidate) form.addEventListener("submit", (e) => {
    if (!validateForm(e.target)) e.preventDefault();
});