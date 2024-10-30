import { tns } from "tiny-slider";

class Gallery {
    constructor() {
        addEventListener("load", this.init.bind(this));
    }

    init() {
        let galleries = document.querySelectorAll(".gallery");

        galleries.forEach((gallery) => {
            tns({
                container: gallery,
                "items": 1,
                "navContainer": "#thumbnails",
                "navAsThumbnails": true,
                "swipeAngle": false,
                "prevButton": '#left-arrow',
                "nextButton": '#right-arrow',
            });
        }); 

        this.events();
        this.lazyLoad();
    }

    events() {
        let video = document.querySelectorAll('video');

        video.forEach(function(item) {
            item.addEventListener('click', () => {
                item.play();
            });
        });

        //video.play();
    }

    lazyLoad() {
        new LazyLoad({});
    }
}

new Gallery;