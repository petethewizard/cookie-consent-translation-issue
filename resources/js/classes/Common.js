import anime from "animejs";

class Common {
    MOBILE_NAV_ANIMATION_DURATION = 175;

    mobileNavHeight = null;
    mobileNavElement = null;
    viewportHeight = null;
    mobileNavVisible = false;

    constructor() {
        addEventListener("load", this.init.bind(this));
    }

    init() {
        this.mobileNavElement = document.querySelector("#mobile-nav");
        this.setMobileNavHeight();
        this.setViewportHeight();

        window.onresize = this.onResize.bind(this);

        this.setMobileNavHeightTopPosition();
        this.mobileNavElement.classList.remove("opacity-0");

        this.mobileNavigation();
    }

    onResize() {
        this.setMobileNavHeight();
        this.setViewportHeight();
        this.setMobileNavHeightTopPosition();

        if (homepageResize) {
            homepageResize();
        }
    }

    mobileNavFullHeightOrAuto(top) {
        if (top === 0) {
            this.mobileNavElement.classList.add("h-full");
        } else {
            this.mobileNavElement.classList.remove("h-full");
        }
    }

    calculateMobileNavHeightTopPosition() {
        let top =
            this.viewportHeight - this.mobileNavHeight > 0
                ? this.viewportHeight - this.mobileNavHeight
                : 0;

        return top;
    }

    /**
     * Adjust mobile nav position in case of orientation change
     * or viewport height/width change.
     */
    setMobileNavHeightTopPosition() {
        if (this.mobileNavVisible) {
            let top = this.calculateMobileNavHeightTopPosition();

            this.mobileNavFullHeightOrAuto(top);

            this.mobileNavElement.style.top = top + "px";
        } else {
            this.mobileNavElement.style.top = `${this.viewportHeight}px`;
        }
    }

    setMobileNavHeight() {
        this.mobileNavHeight = this.mobileNavElement.offsetHeight;
    }

    setViewportHeight() {
        this.viewportHeight = Math.max(
            document.documentElement.clientHeight || 0,
            window.innerHeight || 0
        );
    }

    mobileNavigation() {
        let hamburger = document.querySelector("#hamburger");
        let mobileClose = document.querySelector("#mobile-close");

        let hideMobileNav = () => {
            anime({
                targets: this.mobileNavElement,
                top: `${this.viewportHeight}px`,
                easing: "linear",
                duration: this.MOBILE_NAV_ANIMATION_DURATION,
            });
            this.mobileNavVisible = false;

            setTimeout(() => {
                this.mobileNavElement.classList.remove("h-full");
                this.mobileNavElement.classList.remove("active");
            }, this.MOBILE_NAV_ANIMATION_DURATION);
        };

        mobileClose.addEventListener("click", () => {
            hideMobileNav();
        });

        hamburger.addEventListener("click", (event) => {
            if (this.mobileNavElement.classList.contains("active")) {
                hideMobileNav();
            } else {
                let top = this.calculateMobileNavHeightTopPosition();

                this.mobileNavFullHeightOrAuto(top);

                anime({
                    targets: this.mobileNavElement,
                    top: top + "px",
                    easing: "linear",
                    duration: this.MOBILE_NAV_ANIMATION_DURATION,
                });

                this.mobileNavElement.classList.add("active");

                this.mobileNavVisible = true;
            }
        });
    }
}

new Common();
