let timeLeft = 30;
let total = 30;

async function fetchToken() {
    try {
        const res = await fetch("/token");
        const data = await res.json();
        document.getElementById("token").textContent = data.token || "------";
    } catch (e) {
        document.getElementById("token").textContent = "ERR";
    }
}

function updateCircle() {
    const progressCircle = document.getElementById("progress");
    const offset = 440 - (440 * (timeLeft / total));
    progressCircle.style.strokeDashoffset = offset;
}

function tick() {
    document.getElementById("seconds").textContent = timeLeft;
    updateCircle();

    if (timeLeft === total) fetchToken();

    timeLeft--;
    if (timeLeft < 0) timeLeft = total;

    setTimeout(tick, 1000);
}

fetchToken();
tick();
