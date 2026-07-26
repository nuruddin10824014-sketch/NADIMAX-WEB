/* ==========================================================
   NADIMAX ADMIN
   Dashboard V2
========================================================== */

document.addEventListener("DOMContentLoaded", () => {

    initializeClock();

    initializeDate();

    simulateHeartRate();

    simulateDeviceStatus();

    simulateActivity();

});

/* ==========================================================
   DATE
========================================================== */

function initializeDate() {

    const target = document.getElementById("dashboardDate");

    if (!target) return;

    const option = {

        weekday: "long",

        year: "numeric",

        month: "long",

        day: "numeric"

    };

    target.innerHTML = new Date().toLocaleDateString("id-ID", option);

}

/* ==========================================================
   CLOCK
========================================================== */

function initializeClock() {

    const clock = document.getElementById("currentTime");

    if (!clock) return;

    setInterval(() => {

        const now = new Date();

        clock.innerHTML = now.toLocaleTimeString("id-ID");

    }, 1000);

}

/* ==========================================================
   HEART RATE
========================================================== */

function simulateHeartRate() {

    const bpmText = document.querySelector(".bpm");

    const cardValue = document.querySelectorAll(".stats-card h2")[2];

    if (!bpmText) return;

    setInterval(() => {

        const bpm = randomNumber(68, 95);

        bpmText.innerHTML = bpm + " BPM";

        if (cardValue) {

            cardValue.innerHTML = bpm + " BPM";

        }

        if (bpm < 75) {

            bpmText.style.color = "#22c55e";

        }

        else if (bpm < 90) {

            bpmText.style.color = "#f59e0b";

        }

        else {

            bpmText.style.color = "#ef4444";

        }

    }, 3000);

}

/* ==========================================================
   DEVICE STATUS
========================================================== */

function simulateDeviceStatus() {

    const status = document.querySelector(".online");

    if (!status) return;

    const battery = document.querySelectorAll(".device-info strong")[1];

    const wifi = document.querySelectorAll(".device-info strong")[2];

    const sync = document.querySelectorAll(".device-info strong")[3];

    setInterval(() => {

        battery.innerHTML = randomNumber(85, 100) + "%";

        const wifiLevel = [

            "Excellent",

            "Good",

            "Stable"

        ];

        wifi.innerHTML = wifiLevel[randomNumber(0, 2)];

        sync.innerHTML = randomNumber(1, 5) + " sec ago";

        status.innerHTML = "Online";

        status.className = "online";

    }, 5000);

}

/* ==========================================================
   ACTIVITY
========================================================== */

function simulateActivity() {

    const list = document.querySelector(".activity-list");

    if (!list) return;

    const activities = [

        "Heart Rate berhasil diperbarui.",

        "ESP32 mengirim data terbaru.",

        "Sinkronisasi database berhasil.",

        "Perangkat tetap dalam kondisi online.",

        "Monitoring berjalan normal.",

        "Data sensor diterima.",

        "Dashboard berhasil diperbarui."

    ];

    setInterval(() => {

        const item = document.createElement("li");

        item.innerHTML = `

            <i class="fa-solid fa-circle-check text-success"></i>

            ${activities[randomNumber(0, activities.length - 1)]}

        `;

        list.prepend(item);

        if (list.children.length > 6) {

            list.removeChild(list.lastElementChild);

        }

    }, 6000);

}

/* ==========================================================
   RANDOM NUMBER
========================================================== */

function randomNumber(min, max) {

    return Math.floor(Math.random() * (max - min + 1)) + min;

}