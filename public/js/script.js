
    document.addEventListener("DOMContentLoaded", function(event) {

        const showNavbar = (toggleId, navId, bodyId, headerId) => {
            const toggle = document.getElementById(toggleId),
                nav = document.getElementById(navId),
                bodypd = document.getElementById(bodyId),
                headerpd = document.getElementById(headerId)

            // Validate that all variables exist
            if (toggle && nav && bodypd && headerpd) {
                toggle.addEventListener('click', () => {
                    // show navbar
                    nav.classList.toggle('show2')
                    // change icon
                    toggle.classList.toggle('fa-times')
                    // add padding to body
                    bodypd.classList.toggle('body-pd')
                    // add padding to header
                    headerpd.classList.toggle('body-pd')
                })
            }
        }
 
        showNavbar('header-toggle', 'nav-bar', 'body-pd', 'headercust')

        /*===== LINK ACTIVE =====*/
        const activePage = window.location.pathname;
        const navLinks = document.querySelectorAll('.nav_link').forEach(link => {
            if (link.href.includes(`${activePage}`)) {
                link.classList.add('active');
                console.log(link);
            }
        })

        // Your code to run since DOM is loaded and ready
    });
 
