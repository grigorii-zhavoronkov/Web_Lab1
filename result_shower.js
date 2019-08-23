let counter = 2;

function showResult() {
    document.getElementById("result").classList.remove("hidden");
}

function resizeIframe() {
    let iFrame = document.getElementById("iframe");
    counter++;
    iFrame.height = counter * 25;
}