// script.js
document.addEventListener("DOMContentLoaded", function() {
        const scrollButtons = document.querySelectorAll(".control-icons");
    const sections = document.querySelectorAll(".info-sections");
    const controlButtonsContainer =  document.querySelectorAll(".control-button-container");

    // Control Icons
    const controlDarkIcons =  document.querySelectorAll(".control-icons.dark");
    const controlWhiteIcons =document.querySelectorAll(".control-icons.white");

    // Section Icons
    const sectionDarkIcons =  document.querySelectorAll(".section-icon.dark");
    const sectionWhiteIcons =document.querySelectorAll(".section-icon.white");


    scrollButtons.forEach(button => {
        button.addEventListener("click", () => {
            const target = document.getElementById(button.dataset.target);
            if (target) {
                window.scrollTo({
                    top: target.offsetTop,
                    behavior: "smooth"
                });

                scrollButtons.forEach(btn => btn.classList.remove("active"));
                button.classList.add("active");
            }
        });
    });

    const toggleGroupVisible = (group, visible) => {
        const visibility = visible ? 'block' : 'none';
        group.forEach(element => {
            element.style.display = visible;
        });
    }

    const updateActiveSection = () => {
        sections.forEach(section => {
            const rect = section.getBoundingClientRect();

            if (rect.top <= 50 && rect.bottom >= 0) {
                sections.forEach(s => {
                    s.classList.remove("active");
                    const bottomElement = s.querySelector('.bottom-section');
                    bottomElement.classList.remove('active');
                });

                controlButtonsContainer.forEach(btnContainer => btnContainer.classList.remove("active"));

                // Section Icons visibility restart
                sectionDarkIcons.forEach(darkIcon => {
                    darkIcon.style.display = 'block';
                });

                sectionWhiteIcons.forEach(whiteIcon => {
                    whiteIcon.style.display = 'none';
                });

                // Section Icons
                let currentSectionIconWhite = document.getElementById(section.id + '-icon-white');
                let currentSectionIconDark = document.getElementById(section.id + '-icon-dark');
                currentSectionIconDark.style.display = 'none';
                currentSectionIconWhite.style.display = 'block';

                let buttonContainer = document.getElementById(section.id + '-control');
                buttonContainer.classList.add('active');
                section.classList.add("active");
                const bottomSection = section.querySelector('.bottom-section');
                bottomSection.classList.add('active');


                // Control Icons visibility restart
                controlDarkIcons.forEach(darkIcon => {
                    darkIcon.style.display = 'block';
                });

                controlWhiteIcons.forEach(whiteIcon => {
                    whiteIcon.style.display = 'none';
                });

                // Section Icons
                let currentControlIconDark = document.getElementById(section.id + '-control-icon-dark');
                let currentControlIconWhite = document.getElementById(section.id + '-control-icon-white');
                currentControlIconDark.style.display = 'none';
                currentControlIconWhite.style.display = 'block';
            }


        });
    };

    window.addEventListener("scroll", updateActiveSection);
    updateActiveSection();
});
