import anime from "animejs/lib/anime.es.js";

class Homepage {
    scrollLeftElement;
    scrollRightElement;
    clientsInnerElement;
    clientsWidth;
    clientsHeight;
    clientsScrollX;
    clientsCurrentScrollX = 0;
    animatingClients = false;
    animationDuration = 200;
    animationDurationWithOffset = 200 + 20;

    constructor() {
        this.clientsInnerElement = document.querySelector("#clients .inner");

        window.addEventListener("load", () => {
            this.events();
            this.setClientsElementWidthAndHeight();
            this.setClientsScroll();
            this.hideShowScrollButtons();
        });
    }

    events() {
        this.scrollLeftElement = document.querySelector(".scroll-left");

        this.scrollLeftElement.addEventListener(
            "click",
            this.handleLeftScroll.bind(this)
        );

        this.scrollRightElement = document.querySelector(".scroll-right");

        this.scrollRightElement.addEventListener(
            "click",
            this.handleRightScroll.bind(this)
        );

        this.clientsInnerElement.addEventListener(
            "scroll",
            this.onResize.bind(this)
        );

        window.homepageResize = this.onResize.bind(this);
    }

    hideShowScrollButtons() {
        if (this.clientsScrollX === this.clientsWidth) {
            this.hideScrollLeftButton();
            this.hideScrollRightButton();

            return;
        }

        if (
            this.clientsCurrentScrollX + this.clientsWidth >=
            this.clientsScrollX
        ) {
            this.hideScrollRightButton();

            return;
        }

        if (this.clientsCurrentScrollX === 0) {
            this.hideScrollLeftButton();
            this.showScrollRightButton();

            return;
        } else {
            this.showScrollLeftButton();
            this.showScrollRightButton();

            return;
        }
    }

    handleLeftScroll() {
        this.animateClientsScrollXLeftOrRight("left");
    }

    handleRightScroll() {
        this.animateClientsScrollXLeftOrRight();
    }

    calculateScroll(type) {
        if (this.clientsScrollX > 0) {
            if (type === "right") {
                this.showScrollLeftButton();

                let scrollRight =
                    this.clientsCurrentScrollX + this.clientsWidth;

                this.ifScrollIsMaxToTheRightHideRightButton();

                if (scrollRight >= this.clientsScrollX) {
                    return this.clientsScrollX;
                } else {
                    this.showScrollRightButton();

                    return scrollRight;
                }
            } else if (type === "left") {
                this.showScrollRightButton();

                let scrollLeft = this.clientsCurrentScrollX - this.clientsWidth;

                if (scrollLeft < 0) {
                    this.hideScrollLeftButton();

                    return 0;
                } else {
                    this.showScrollLeftButton();

                    return scrollLeft;
                }
            }
        }

        return 0;
    }

    hideScrollLeftButton() {
        this.scrollLeftElement.style.display = "none";
    }

    showScrollLeftButton() {
        this.scrollLeftElement.style.display = "block";
    }

    hideScrollRightButton() {
        this.scrollRightElement.style.display = "none";
    }

    showScrollRightButton() {
        this.scrollRightElement.style.display = "block";
    }

    animateClientsScrollXLeftOrRight(type = "right") {
        if (this.animatingClients) {
            return;
        }

        this.animatingClients = true;

        let scrollTo = this.calculateScroll(type);

        anime({
            targets: "#clients-inner",
            scrollLeft: scrollTo,
            duration: this.animationDuration,
            easing: "linear",
        });

        setTimeout(() => {
            this.animatingClients = false;
        }, this.animationDurationWithOffset);
    }

    setClientsElementWidthAndHeight() {
        let clients = document.querySelector("#clients");

        this.clientsWidth = clients.clientWidth;
        this.clientsHeight = clients.offsetHeight;
    }

    setClientsScroll() {
        this.clientsScrollX = this.clientsInnerElement.scrollWidth;
        this.clientsCurrentScrollX = Math.ceil(
            this.clientsInnerElement.scrollLeft
        );
    }

    /**
     * Doing this check in a timeout to make sure that animating has finished.
     */
    ifScrollIsMaxToTheRightHideRightButton() {
        setTimeout(() => {
            if (
                this.clientsCurrentScrollX + this.clientsWidth >=
                this.clientsScrollX
            ) {
                this.hideScrollRightButton();
            }
        }, this.animationDurationWithOffset);
    }

    onResize() {
        this.setClientsElementWidthAndHeight();
        this.setClientsScroll();
        this.hideShowScrollButtons();
    }
}

window.homepage = new Homepage();
