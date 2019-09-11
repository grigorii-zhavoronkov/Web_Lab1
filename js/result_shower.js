let counter = 3;

function showResult() {
    document.getElementById("result").classList.remove("hidden");
}

function validateCounter(valid_counter) {
    counter = valid_counter;
}

function resizeIframe() {
    let iFrame = document.getElementById("iframe");
    iFrame.height = counter * 25;
    counter++;
}