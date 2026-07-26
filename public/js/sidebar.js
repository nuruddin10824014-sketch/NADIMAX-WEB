/*
==========================================
NADIMAX ADMIN
Sidebar Javascript
==========================================
*/

document.addEventListener("DOMContentLoaded", () => {

    const sidebar = document.getElementById("sidebar");
    const toggleButton = document.getElementById("sidebarToggle");

    // ==========================
    // Collapse Sidebar
    // ==========================

    if (toggleButton && sidebar) {

        toggleButton.addEventListener("click", () => {

            sidebar.classList.toggle("collapsed");

            localStorage.setItem(
                "sidebar",
                sidebar.classList.contains("collapsed") ? "collapsed" : "expanded"
            );

        });

        // Load state
        if (localStorage.getItem("sidebar") === "collapsed") {

            sidebar.classList.add("collapsed");

        }

    }

    // ==========================
    // Active Menu Animation
    // ==========================

    const menuLinks = document.querySelectorAll(".sidebar-menu a");

    menuLinks.forEach(link => {

        link.addEventListener("click", () => {

            menuLinks.forEach(item => item.classList.remove("active"));

            link.classList.add("active");

        });

    });

    // ==========================
    // Ripple Effect
    // ==========================

    menuLinks.forEach(link => {

        link.addEventListener("mousedown", function (e) {

            const ripple = document.createElement("span");

            ripple.className = "ripple";

            const rect = this.getBoundingClientRect();

            ripple.style.left = (e.clientX - rect.left) + "px";
            ripple.style.top = (e.clientY - rect.top) + "px";

            this.appendChild(ripple);

            setTimeout(() => {

                ripple.remove();

            }, 600);

        });

    });

});