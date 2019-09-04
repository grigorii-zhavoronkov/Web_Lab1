let validX, validY, validR = false;

let gl_x = 0;
let gl_y = 0;
let ord = 0;

let validInputs = ["0", "1", "2", "3", "4", "5", "6", "7", "8", "9", ".", ","];

function cl() {
    document.getElementById("Y_input").value = "";
}

function chooseX(x) {
    let buttons = document.getElementById("x_buttons").getElementsByTagName("button");
    for (let o of buttons) {
        o.classList.remove("chosen")
    }

    let button = document.getElementById("x" + x);
    button.classList.add("chosen");
    validX = true;

    let field = document.getElementById("X_input");
    field.value = x;
    gl_x = x;

    enable_button()
}

function chooseR(r) {
    let buttons = document.getElementById("r_buttons").getElementsByTagName("button");
    for (let o of buttons) {
        o.classList.remove("chosen")
    }

    let button = document.getElementById("r" + r);
    button.classList.add("chosen");
    validR = true;

    let field = document.getElementById("R_input");
    field.value = r;
    ord = 120 / r;

    enable_button()
}

function validateY() {
    let input_field = document.getElementById("Y_input");

    let text = input_field.value;

    let match = text.match(/(^-[1-4]{1}[,]{1}\d{1,})|(^-[1-4]{1}$)|(^[0-2]{1}[,]{1}\d{1,})|(^[0-2]{1}$)/m);

    if (match == null) {
        validY = false;
        input_field.classList.remove("valid_field");
        input_field.classList.add("invalid_field");
    } else {
        validY = true;
        input_field.classList.remove("invalid_field");
        input_field.classList.add("valid_field");
        gl_y = parseFloat(text.replace(",", "."));
    }

    enable_button();
}

function enable_button() {
    if (validX && validY && validR) {
        document.getElementById("submit").disabled = false;
    } else {
        document.getElementById("submit").disabled = true;
    }
}

/*
add hidden x and z fields and .value = button on chooseX or chooseZ
name = x
name = z
 */