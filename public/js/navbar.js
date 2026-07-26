document.addEventListener("DOMContentLoaded", () => {

    /* ==========================================
       REALTIME CLOCK
    ========================================== */

    const currentTime = document.getElementById("currentTime");

    function updateClock() {

        if (!currentTime) return;

        const now = new Date();

        currentTime.textContent = now.toLocaleTimeString("id-ID", {
            hour: "2-digit",
            minute: "2-digit",
            second: "2-digit"
        });

    }

    updateClock();

    setInterval(updateClock, 1000);

    /* ==========================================
       DROPDOWN
    ========================================== */

    const notificationBtn = document.getElementById("notificationBtn");
    const notificationMenu = document.getElementById("notificationMenu");

    const messageBtn = document.getElementById("messageBtn");
    const messageMenu = document.getElementById("messageMenu");

    const profileBtn = document.getElementById("profileBtn");
    const profileMenu = document.getElementById("profileMenu");

    function closeAllDropdown() {

        if (notificationMenu)
            notificationMenu.classList.remove("show");

        if (messageMenu)
            messageMenu.classList.remove("show");

        if (profileMenu)
            profileMenu.classList.remove("show");

    }

    if (notificationBtn && notificationMenu) {

        notificationBtn.addEventListener("click", function (e) {

            e.stopPropagation();

            const opened = notificationMenu.classList.contains("show");

            closeAllDropdown();

            if (!opened) {
                notificationMenu.classList.add("show");
            }

        });

    }

    if (messageBtn && messageMenu) {

        messageBtn.addEventListener("click", function (e) {

            e.stopPropagation();

            const opened = messageMenu.classList.contains("show");

            closeAllDropdown();

            if (!opened) {
                messageMenu.classList.add("show");
            }

        });

    }

    if (profileBtn && profileMenu) {

        profileBtn.addEventListener("click", function (e) {

            e.stopPropagation();

            const opened = profileMenu.classList.contains("show");

            closeAllDropdown();

            if (!opened) {
                profileMenu.classList.add("show");
            }

        });

    }

    document.addEventListener("click", function () {

        closeAllDropdown();

    });

});