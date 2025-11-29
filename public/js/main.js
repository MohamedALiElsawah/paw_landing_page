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
    scrollableBanner: document.getElementById("scrollable-banner"),
    heroBanner: document.getElementById("hero-banner"),
    header: document.getElementById("header"),
    contactForm: document.getElementById("contact-form"),
    partnersTrack: document.querySelector(".partners-track"),
    langButtons: document.querySelectorAll(".lang-btn"),
    animateElements: document.querySelectorAll(".animate"),
    clinicsMap: document.getElementById("clinics-map"),
};

// State
let currentBannerIndex = 0;
let bannerInterval;

// Initialize the application
function init() {
    setupEventListeners();
    setupIntersectionObserver();
    initScrollableBanner();
    initHeroBanner();
    initBannerCarousel();
    initClinicsMap();
    duplicatePartnersForSeamlessLoop();
    initStoreStatuses();
}

// Set up all event listeners
function setupEventListeners() {
    // Language Switch
    if (elements.langButtons.length > 0) {
        elements.langButtons.forEach((button) => {
            button.addEventListener("click", handleLanguageSwitch);
        });
    }

    // Hamburger Menu - Only if elements exist
    if (elements.hamburger) {
        elements.hamburger.addEventListener("click", toggleSidebar);
    }
    if (elements.overlay) {
        elements.overlay.addEventListener("click", closeSidebar);
    }

    // SOP Modal - Only if elements exist
    if (elements.sopBtn) {
        elements.sopBtn.addEventListener("click", openSopModal);
    }
    if (elements.closeSop) {
        elements.closeSop.addEventListener("click", closeSopModal);
    }
    if (elements.sopModal) {
        elements.sopModal.addEventListener("click", (e) => {
            if (e.target === elements.sopModal) closeSopModal();
        });
    }

    // Header Scroll Effect
    if (elements.header) {
        window.addEventListener("scroll", handleHeaderScroll);
    }

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
    if (elements.sidebar) {
        elements.sidebar.classList.toggle("active");
    }
    if (elements.overlay) {
        elements.overlay.classList.toggle("active");
    }
    if (elements.hamburger) {
        elements.hamburger.classList.toggle("active");
    }
}

// Close sidebar menu
function closeSidebar() {
    if (elements.sidebar) {
        elements.sidebar.classList.remove("active");
    }
    if (elements.overlay) {
        elements.overlay.classList.remove("active");
    }
    if (elements.hamburger) {
        elements.hamburger.classList.remove("active");
    }
}

// Open SOP modal
function openSopModal() {
    if (elements.sopModal) {
        elements.sopModal.style.display = "flex";
    }
}

// Close SOP modal
function closeSopModal() {
    if (elements.sopModal) {
        elements.sopModal.style.display = "none";
    }
}

// Handle header scroll effect
function handleHeaderScroll() {
    if (elements.header) {
        elements.header.classList.toggle("scrolled", window.scrollY > 50);
    }
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

// Initialize scrollable banner
function initScrollableBanner() {
    if (!elements.scrollableBanner) return;

    const bannerSlides = document.querySelectorAll(".banner-slide");
    const bannerIndicators = document.querySelectorAll(".banner-indicator");
    const prevBtn = document.querySelector(".banner-prev");
    const nextBtn = document.querySelector(".banner-next");

    // If no banners or only one banner, don't initialize slider
    if (bannerSlides.length <= 1) {
        if (prevBtn) prevBtn.style.display = "none";
        if (nextBtn) nextBtn.style.display = "none";
        return;
    }

    // Set up event listeners
    if (prevBtn) {
        prevBtn.addEventListener("click", () =>
            showBanner(currentBannerIndex - 1)
        );
    }

    if (nextBtn) {
        nextBtn.addEventListener("click", () =>
            showBanner(currentBannerIndex + 1)
        );
    }

    // Set up indicator clicks
    bannerIndicators.forEach((indicator, index) => {
        indicator.addEventListener("click", () => showBanner(index));
    });

    // Start auto-rotation
    startBannerAutoRotation();

    // Pause auto-rotation on hover
    elements.scrollableBanner.addEventListener(
        "mouseenter",
        pauseBannerRotation
    );
    elements.scrollableBanner.addEventListener(
        "mouseleave",
        resumeBannerRotation
    );
}

// Show specific banner
function showBanner(index) {
    const bannerSlides = document.querySelectorAll(".banner-slide");
    const bannerIndicators = document.querySelectorAll(".banner-indicator");

    if (bannerSlides.length === 0) return;

    // Handle index bounds
    if (index >= bannerSlides.length) index = 0;
    if (index < 0) index = bannerSlides.length - 1;

    // Update current index
    currentBannerIndex = index;

    // Update slides
    bannerSlides.forEach((slide, i) => {
        slide.classList.remove("active", "prev");
        if (i === index) {
            slide.classList.add("active");
        } else if (
            i ===
            (index - 1 + bannerSlides.length) % bannerSlides.length
        ) {
            slide.classList.add("prev");
        }
    });

    // Update indicators
    bannerIndicators.forEach((indicator, i) => {
        indicator.classList.toggle("active", i === index);
    });
}

// Start auto rotation of banners
function startBannerAutoRotation() {
    const bannerSlides = document.querySelectorAll(".banner-slide");
    if (bannerSlides.length <= 1) return;

    bannerInterval = setInterval(() => {
        showBanner(currentBannerIndex + 1);
    }, 5000); // Change banner every 5 seconds
}

// Pause banner rotation
function pauseBannerRotation() {
    if (bannerInterval) {
        clearInterval(bannerInterval);
        bannerInterval = null;
    }
}

// Resume banner rotation
function resumeBannerRotation() {
    if (!bannerInterval) {
        startBannerAutoRotation();
    }
}

// Initialize hero banner slider
function initHeroBanner() {
    if (!elements.heroBanner) return;

    const bannerSlides = document.querySelectorAll(".banner-slide");
    const bannerDots = document.querySelectorAll(".banner-dot");
    const prevBtn = document.querySelector(".banner-prev");
    const nextBtn = document.querySelector(".banner-next");

    // If no banners or only one banner, don't initialize slider
    if (bannerSlides.length <= 1) {
        if (prevBtn) prevBtn.style.display = "none";
        if (nextBtn) nextBtn.style.display = "none";
        return;
    }

    let currentSlide = 0;
    let heroBannerInterval;

    // Set up event listeners
    if (prevBtn) {
        prevBtn.addEventListener("click", () =>
            showHeroSlide(currentSlide - 1)
        );
    }

    if (nextBtn) {
        nextBtn.addEventListener("click", () =>
            showHeroSlide(currentSlide + 1)
        );
    }

    // Set up dot clicks
    bannerDots.forEach((dot, index) => {
        dot.addEventListener("click", () => showHeroSlide(index));
    });

    // Start auto-rotation
    startHeroBannerAutoRotation();

    // Pause auto-rotation on hover
    elements.heroBanner.addEventListener("mouseenter", pauseHeroBannerRotation);
    elements.heroBanner.addEventListener(
        "mouseleave",
        resumeHeroBannerRotation
    );

    function showHeroSlide(index) {
        // Handle index bounds
        if (index >= bannerSlides.length) index = 0;
        if (index < 0) index = bannerSlides.length - 1;

        // Update current slide
        currentSlide = index;

        // Update slides
        bannerSlides.forEach((slide, i) => {
            slide.classList.toggle("active", i === index);
        });

        // Update dots
        bannerDots.forEach((dot, i) => {
            dot.classList.toggle("active", i === index);
        });

        // Reset auto-rotation timer
        resetHeroBannerAutoRotation();
    }

    function startHeroBannerAutoRotation() {
        heroBannerInterval = setInterval(() => {
            showHeroSlide(currentSlide + 1);
        }, 5000); // Change slide every 5 seconds
    }

    function pauseHeroBannerRotation() {
        if (heroBannerInterval) {
            clearInterval(heroBannerInterval);
            heroBannerInterval = null;
        }
    }

    function resumeHeroBannerRotation() {
        if (!heroBannerInterval) {
            startHeroBannerAutoRotation();
        }
    }

    function resetHeroBannerAutoRotation() {
        pauseHeroBannerRotation();
        startHeroBannerAutoRotation();
    }
}

// Initialize clinics map with OpenStreetMap
function initClinicsMap() {
    if (!elements.clinicsMap) {
        console.warn("Clinics map container not found");
        return;
    }

    // Check if Leaflet is available
    if (typeof L === "undefined") {
        console.error("Leaflet library not loaded");
        return;
    }

    // Default center for Kuwait
    const kuwaitCenter = [29.3759, 47.9774];

    try {
        // Create map
        const map = L.map(elements.clinicsMap).setView(kuwaitCenter, 10);

        // Add OpenStreetMap tiles
        L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
            attribution:
                '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
            maxZoom: 18,
        }).addTo(map);

        // Get clinic cards
        const clinicCards = document.querySelectorAll(".clinic-card");
        const markers = [];

        clinicCards.forEach((card, index) => {
            const clinicId = card.dataset.clinicId;
            const lat = parseFloat(card.dataset.lat);
            const lng = parseFloat(card.dataset.lng);
            const clinicName = card.querySelector(".clinic-name").textContent;
            const clinicLocation = card.querySelector(
                ".clinic-info:nth-child(2)"
            ).textContent;
            const clinicPhone = card.querySelector(
                ".clinic-info:nth-child(3)"
            ).textContent;
            const clinicHours = card.querySelector(
                ".clinic-info:nth-child(4)"
            ).textContent;

            // Skip if no coordinates
            if (!lat || !lng) return;

            // Create custom icon
            const clinicIcon = L.divIcon({
                className: "clinic-marker",
                html: `
                    <div class="clinic-marker-icon">
                        <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="20" cy="20" r="18" fill="#002D72" stroke="#FFD43B" stroke-width="2"/>
                            <path d="M20 12L26 18V26H14V18L20 12Z" fill="#FFD43B"/>
                            <path d="M18 18H22V22H18V18Z" fill="#002D72"/>
                        </svg>
                    </div>
                `,
                iconSize: [40, 40],
                iconAnchor: [20, 40],
            });

            // Create marker
            const marker = L.marker([lat, lng], { icon: clinicIcon }).addTo(
                map
            );

            // Create popup content
            const popupContent = `
                <div class="clinic-popup">
                    <h4>${clinicName}</h4>
                    <p><i class="fas fa-map-marker-alt"></i> ${clinicLocation}</p>
                    <p><i class="fas fa-phone"></i> ${clinicPhone}</p>
                    <p><i class="fas fa-clock"></i> ${clinicHours}</p>
                    <a href="https://www.openstreetmap.org/?mlat=${lat}&mlon=${lng}#map=15/${lat}/${lng}"
                       target="_blank" class="browse-location-btn">
                        <i class="fas fa-external-link-alt"></i> Browse Location
                    </a>
                </div>
            `;

            // Bind popup to marker
            marker.bindPopup(popupContent, {
                className: "clinic-popup-container",
                maxWidth: 300,
            });

            // Add hover events to card
            card.addEventListener("mouseenter", () => {
                // Highlight marker
                marker.getElement().classList.add("highlighted");
                // Open popup
                marker.openPopup();
            });

            card.addEventListener("mouseleave", () => {
                // Remove highlight
                marker.getElement().classList.remove("highlighted");
                // Close popup
                marker.closePopup();
            });

            markers.push(marker);
        });

        // Fit map bounds to show all markers
        if (markers.length > 0) {
            const group = new L.featureGroup(markers);
            map.fitBounds(group.getBounds().pad(0.1));

            // Don't zoom too far out if there's only one marker
            if (markers.length === 1) {
                map.setZoom(13);
            }
        }
    } catch (error) {
        console.error("Error initializing clinics map:", error);
    }
}

// Highlight clinic on hover
function highlightClinic(clinicId) {
    const card = document.querySelector(
        `.clinic-card[data-clinic-id="${clinicId}"]`
    );
    if (card) {
        card.style.transform = "translateY(-5px)";
        card.style.boxShadow = "0 8px 25px rgba(0, 0, 0, 0.15)";
        card.style.borderColor = "#002D72";
    }
}

// Unhighlight clinic on mouse out
function unhighlightClinic(clinicId) {
    const card = document.querySelector(
        `.clinic-card[data-clinic-id="${clinicId}"]`
    );
    if (card) {
        card.style.transform = "translateY(0)";
        card.style.boxShadow = "0 2px 10px rgba(0, 0, 0, 0.08)";
        card.style.borderColor = "#e0e0e0";
    }
}

// Initialize banner carousel
function initBannerCarousel() {
    const bannerCarousel = document.querySelector(".banner-carousel");
    if (!bannerCarousel) return;

    const bannerSlides = document.querySelectorAll(".banner-slide");
    const bannerImageSlides = document.querySelectorAll(".banner-image-slide");
    const bannerDots = document.querySelectorAll(".banner-dot");

    // If no banners or only one banner, don't initialize carousel
    if (bannerSlides.length <= 1) return;

    let currentSlide = 0;
    let bannerInterval;

    // Set up dot clicks
    bannerDots.forEach((dot, index) => {
        dot.addEventListener("click", () => showBannerSlide(index));
    });

    // Start auto-rotation
    startBannerAutoRotation();

    // Pause auto-rotation on hover
    bannerCarousel.addEventListener("mouseenter", pauseBannerAutoRotation);
    bannerCarousel.addEventListener("mouseleave", resumeBannerAutoRotation);

    function showBannerSlide(index) {
        // Handle index bounds
        if (index >= bannerSlides.length) index = 0;
        if (index < 0) index = bannerSlides.length - 1;

        // Update current slide
        currentSlide = index;

        // Update content slides
        bannerSlides.forEach((slide, i) => {
            slide.classList.toggle("active", i === index);
        });

        // Update image slides
        bannerImageSlides.forEach((slide, i) => {
            slide.classList.toggle("active", i === index);
        });

        // Update dots
        bannerDots.forEach((dot, i) => {
            dot.classList.toggle("active", i === index);
        });

        // Reset auto-rotation timer
        resetBannerAutoRotation();
    }

    function startBannerAutoRotation() {
        bannerInterval = setInterval(() => {
            showBannerSlide(currentSlide + 1);
        }, 5000); // Change slide every 5 seconds
    }

    function pauseBannerAutoRotation() {
        if (bannerInterval) {
            clearInterval(bannerInterval);
            bannerInterval = null;
        }
    }

    function resumeBannerAutoRotation() {
        if (!bannerInterval) {
            startBannerAutoRotation();
        }
    }

    function resetBannerAutoRotation() {
        pauseBannerAutoRotation();
        startBannerAutoRotation();
    }
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

// Store status functionality
function initStoreStatuses() {
    updateStoreStatuses();

    // Update status every minute
    setInterval(updateStoreStatuses, 60000);
}

function calculateStoreStatus(workingHours) {
    const now = new Date();
    const currentHour = now.getHours();
    const currentMinute = now.getMinutes();
    const currentTime = currentHour * 60 + currentMinute;

    console.log("Parsing working hours:", workingHours); // Debug log

    // Parse working hours
    if (workingHours.includes("24/7") || workingHours.includes("مفتوح 24/7")) {
        return { status: "open", text: "Open 24/7" };
    }

    // Parse time ranges like "9AM - 9PM" or "8AM - 11PM" or Arabic equivalents
    const timeMatch = workingHours.match(
        /(\d+)(AM|PM|صباحاً|مساءً)\s*-\s*(\d+)(AM|PM|صباحاً|مساءً)/i
    );
    if (timeMatch) {
        let openHour = parseInt(timeMatch[1]);
        const openPeriod = timeMatch[2].toUpperCase();
        let closeHour = parseInt(timeMatch[3]);
        const closePeriod = timeMatch[4].toUpperCase();

        console.log(
            "Time match found:",
            openHour,
            openPeriod,
            closeHour,
            closePeriod
        ); // Debug log

        // Convert to 24-hour format
        if (openPeriod === "PM" || openPeriod === "مساءً") {
            if (openHour !== 12) openHour += 12;
        } else if (openPeriod === "AM" || openPeriod === "صباحاً") {
            if (openHour === 12) openHour = 0;
        }

        if (closePeriod === "PM" || closePeriod === "مساءً") {
            if (closeHour !== 12) closeHour += 12;
        } else if (closePeriod === "AM" || closePeriod === "صباحاً") {
            if (closeHour === 12) closeHour = 0;
        }

        const openTime = openHour * 60;
        const closeTime = closeHour * 60;

        console.log("Converted times:", openTime, closeTime, currentTime); // Debug log

        if (currentTime >= openTime && currentTime <= closeTime) {
            return { status: "open", text: "Open Now" };
        } else {
            return { status: "closed", text: "Closed" };
        }
    }

    // Emergency hours
    if (workingHours.includes("Emergency") || workingHours.includes("طوارئ")) {
        return { status: "open", text: "Emergency" };
    }

    // If we can't parse, just show the working hours as-is
    return { status: "unknown", text: workingHours };
}

function updateStoreStatuses() {
    document.querySelectorAll(".store-status").forEach((statusElement) => {
        const workingHours = statusElement.getAttribute("data-working-hours");
        const status = calculateStoreStatus(workingHours);

        // Only show status text, not the working hours (they're already displayed)
        statusElement.textContent = ` • ${status.text}`;
        statusElement.className = `store-status status-${status.status}`;
    });
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
