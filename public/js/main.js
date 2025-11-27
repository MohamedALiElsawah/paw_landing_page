// main.js - Enhanced JavaScript for PawApp

// Backend Note: This file contains all JavaScript functionality
// Backend developers can extend or modify these functions as needed

// DOM Elements
const elements = {
    hamburger: document.getElementById("hamburger"),
    sidebar: document.getElementById("sidebar"),
    overlay: document.getElementById("overlay"),
    sopBtn: document.getElementById("sop-btn"),
    sopModal: document.getElementById("sop-modal"),
    closeSop: document.getElementById("close-sop"),
    bannerText: document.getElementById("banner-text"),
    header: document.getElementById("header"),
    contactForm: document.getElementById("contact-form"),
    partnersTrack: document.querySelector(".partners-track"),
    langButtons: document.querySelectorAll(".lang-btn"),
    animateElements: document.querySelectorAll(".animate"),
};

// State
let currentBannerIndex = 0;

// Banner Content - Backend Note: This can be dynamically populated
const banners = [
    "New pet profiles feature now available",
    "Welcome our new partner clinic: Happy Vet",
    "25% OFF PawApp Store products this week",
];

// Initialize the application
function init() {
    setupEventListeners();
    setupIntersectionObserver();
    startBannerRotation();
    duplicatePartnersForSeamlessLoop();
}

// Set up all event listeners
function setupEventListeners() {
    // Language Switch
    elements.langButtons.forEach((button) => {
        button.addEventListener("click", handleLanguageSwitch);
    });

    // Hamburger Menu
    elements.hamburger.addEventListener("click", toggleSidebar);
    elements.overlay.addEventListener("click", closeSidebar);

    // SOP Modal
    elements.sopBtn.addEventListener("click", openSopModal);
    elements.closeSop.addEventListener("click", closeSopModal);
    elements.sopModal.addEventListener("click", (e) => {
        if (e.target === elements.sopModal) closeSopModal();
    });

    // Header Scroll Effect
    window.addEventListener("scroll", handleHeaderScroll);

    // Form Submission
    if (elements.contactForm) {
        elements.contactForm.addEventListener("submit", handleFormSubmit);
    }

    // Action handlers for data-action attributes
    document.addEventListener("click", handleActionEvents);
}

// Handle language switching
function handleLanguageSwitch(e) {
    const lang = e.target.dataset.lang;

    // Update document attributes
    document.documentElement.lang = lang;
    document.documentElement.dir = lang === "ar" ? "rtl" : "ltr";

    // Update active state
    elements.langButtons.forEach((btn) => btn.classList.remove("active"));
    e.target.classList.add("active");

    // Reset partner slider animation for correct direction
    resetPartnerSlider();

    // Backend Note: Additional language-specific logic can be added here
    console.log(`Language switched to: ${lang}`);
}

// Toggle sidebar menu
function toggleSidebar() {
    elements.sidebar.classList.toggle("active");
    elements.overlay.classList.toggle("active");
    elements.hamburger.classList.toggle("active");
}

// Close sidebar menu
function closeSidebar() {
    elements.sidebar.classList.remove("active");
    elements.overlay.classList.remove("active");
    elements.hamburger.classList.remove("active");
}

// Open SOP modal
function openSopModal() {
    elements.sopModal.style.display = "flex";
}

// Close SOP modal
function closeSopModal() {
    elements.sopModal.style.display = "none";
}

// Handle header scroll effect
function handleHeaderScroll() {
    elements.header.classList.toggle("scrolled", window.scrollY > 50);
}

// Handle form submission
function handleFormSubmit(e) {
    e.preventDefault();

    // Backend Note: Form data can be processed here
    const formData = new FormData(e.target);
    const data = Object.fromEntries(formData);

    console.log("Form submitted:", data);

    // Show success message (can be enhanced with backend integration)
    alert("Thank you for your message! We will get back to you soon.");
    e.target.reset();
}

// Handle action events based on data-action attributes
function handleActionEvents(e) {
    const action = e.target.dataset.action;

    if (!action) return;

    switch (action) {
        case "scroll-to-section":
            e.preventDefault();
            const targetId = e.target.getAttribute("href").substring(1);
            scrollToSection(targetId);
            break;

        case "scroll-to-services":
            e.preventDefault();
            scrollToSection("services");
            break;

        case "download-app":
            // Backend Note: Track download events here
            console.log("Download app clicked");
            break;

        case "visit-store":
            // Backend Note: Track store visit events here
            console.log("Visit store clicked");
            break;

        case "find-clinic":
            // Backend Note: Track clinic finder events here
            console.log("Find clinic clicked");
            break;

        case "talk-to-drbo":
            // Backend Note: Track Dr. Bo interaction events here
            console.log("Talk to Dr. Bo clicked");
            break;

        case "access-emergency":
            // Backend Note: Track emergency services access events here
            console.log("Access emergency services clicked");
            break;

        case "close-sidebar":
            closeSidebar();
            break;

        case "open-sop-modal":
            openSopModal();
            break;

        case "close-sop-modal":
            closeSopModal();
            break;

        case "submit-form":
            // This is handled by the form's submit event
            break;
    }
}

// Scroll to section smoothly
function scrollToSection(sectionId) {
    const section = document.getElementById(sectionId);
    if (section) {
        section.scrollIntoView({ behavior: "smooth" });
    }
}

// Set up intersection observer for scroll animations
function setupIntersectionObserver() {
    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add("visible");
                }
            });
        },
        { threshold: 0.15 }
    );

    elements.animateElements.forEach((el) => observer.observe(el));
}

// Rotate banner text
function startBannerRotation() {
    setInterval(() => {
        elements.bannerText.classList.remove("active");

        setTimeout(() => {
            currentBannerIndex = (currentBannerIndex + 1) % banners.length;
            elements.bannerText.textContent = banners[currentBannerIndex];
            elements.bannerText.classList.add("active");
        }, 300);
    }, 5000);
}

// Duplicate partners for seamless loop
function duplicatePartnersForSeamlessLoop() {
    if (elements.partnersTrack) {
        // Clear any existing duplicates first
        const originalContent = elements.partnersTrack.innerHTML;
        elements.partnersTrack.innerHTML = originalContent + originalContent;
    }
}

// Reset partner slider animation when language changes
function resetPartnerSlider() {
    if (elements.partnersTrack) {
        // Remove animation temporarily to reset
        elements.partnersTrack.style.animation = "none";

        // Force reflow
        void elements.partnersTrack.offsetWidth;

        // Re-apply animation with correct direction
        const isRTL = document.documentElement.dir === "rtl";
        elements.partnersTrack.style.animation = isRTL
            ? "scroll-rtl 25s linear infinite"
            : "scroll 25s linear infinite";
    }
}

// Initialize the app when DOM is loaded
document.addEventListener("DOMContentLoaded", init);

// Backend Note: Export functions if needed for module system
if (typeof module !== "undefined" && module.exports) {
    module.exports = {
        init,
        handleLanguageSwitch,
        toggleSidebar,
        openSopModal,
        closeSopModal,
        handleFormSubmit,
    };
}
