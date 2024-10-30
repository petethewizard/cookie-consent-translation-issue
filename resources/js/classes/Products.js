import { tns } from "tiny-slider";

class Products {
    constructor() {
        this.initSliders();
    }

    initSliders() {
        let sliders = document.querySelectorAll(".slider");

        sliders.forEach((slider) => {
            tns({
                container: slider,
                items: 1,
                slideBy: "page",
                autoplay: false,
                nav: true,
                dots: true,
                mouseDrag: true,
            });
        });
    }
}

window.products = new Products();
