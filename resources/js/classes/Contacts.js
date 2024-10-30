import AirDatepicker from "air-datepicker";
import "air-datepicker/air-datepicker.css";
import localeEn from "air-datepicker/locale/en";
import moment from "moment";
import axios from "axios";

class Contacts {
    dateElement = null;

    constructor() {
        addEventListener("load", this.init.bind(this));
    }

    init() {
        this.dateElement = document.querySelector('input[name="date"]');

        this.initDatePicker();
        this.loadState();
        this.events();
    }

    initDatePicker() {
        let currentDate = moment().format("YYYY-MM-DD");

        new AirDatepicker('input[name="date"]', {
            startDate: currentDate,
            locale: localeEn,
            dateFormat: "yyyy-MM-dd",
            onSelect: ({ date, formattedDate, datepicker }) => {
                this.initAvailableTimes(formattedDate);
            },
            autoClose: true,
        });
    }

    loadState() {
        let location = document.querySelector("#location").value;

        if (location === "office") {
            this.removeActiveClassFromWhereCheckbox();

            document.querySelector(".office").classList.add("active");
        }

        let date = this.dateElement.value;

        if (date) {
            this.initAvailableTimes(date);

            let time = document.querySelector("#time").value;

            if (time) {
                setTimeout(() => {
                    document
                        .querySelector("#time-" + time.replace(":", "-"))
                        ?.classList.add("active");
                }, 1000);
            }
        } else {
            this.hideTimeErrors();
        }
    }

    events() {
        let date = this.dateElement;

        date.addEventListener("paste", (event) => {
            setTimeout(() => {
                this.initAvailableTimes(event.target.value);
            }, 300);
        });

        date.addEventListener("keydown", (event) => {
            setTimeout(() => {
                this.initAvailableTimes(event.target.value);
            }, 300);
        });

        this.timesEvents();
        this.whereCheckboxEvents();
    }

    removeActiveClassFromWhereCheckbox() {
        document.querySelector(".where.active")?.classList.remove("active");
    }

    timesEvents() {
        let times = document.querySelectorAll(".time");

        times.forEach((time) => {
            time.addEventListener("click", (event) => {
                let clickedTime = event.target;

                if (clickedTime.classList.contains("taken")) {
                    // don't do anything if time is not available
                    return;
                }

                // remove active class from previously selected times
                document
                    .querySelector(".time.active")
                    ?.classList.remove("active");

                let dataTime = clickedTime.getAttribute("data-time");

                // activate current time
                clickedTime.classList.add("active");

                // fill the hidden time input with the selected time
                document.querySelector("#time").value = dataTime;

                // hide time errors
                this.hideTimeErrors();
            });
        });
    }

    whereCheckboxEvents() {
        let whereElements = document.querySelectorAll(".where");

        whereElements.forEach((where) => {
            where.addEventListener(
                "click",
                (event) => {
                    if (where !== event.target) {
                        return;
                    }

                    let whereItem = event.target;

                    let locationInputElement =
                        document.querySelector("#location");

                    // remove active from previously selected
                    this.removeActiveClassFromWhereCheckbox();

                    // active currently selected check
                    whereItem.classList.add("active");

                    if (where.classList.contains("office")) {
                        locationInputElement.value = "office";
                    } else {
                        locationInputElement.value = "online";
                    }
                },
                false
            );
        });
    }

    initAvailableTimes(date) {
        this.showLoadingAnimation();

        axios
            .post("/api/appointments/available-times", { date })
            .then((response) => {
                this.updateAvailableTimes(response.data);

                this.hideLoadingAnimation();
            })
            .catch((error) => {
                this.hideLoadingAnimation();
                console.log(error);
            });
    }

    showLoadingAnimation() {
        let loadingElement = document.querySelector("#loading");

        loadingElement.classList.remove("hidden");
    }

    hideLoadingAnimation() {
        let loadingElement = document.querySelector("#loading");

        loadingElement.classList.add("hidden");
    }

    hideTimeErrors() {
        document.querySelector("#time-errors").style.display = "none";
    }

    updateAvailableTimes(times) {
        let availableTimesElement = document.querySelector("#available-times");

        document
            .querySelectorAll(".time.active")
            ?.forEach((time) => time.classList.remove("active"));

        for (let i = 0; i < times.length; i++) {
            let time = times[i];
            let timeString = time.time;
            let timeWithoutColon = timeString.replace(":", "-");
            let timeElementId = "#time-" + timeWithoutColon;

            let timeElement = document.querySelector(timeElementId);

            if (time.taken) {
                timeElement.classList.add("taken");
            } else {
                timeElement.classList.remove("taken");
            }
        }

        availableTimesElement.classList.remove("hidden");
    }
}

new Contacts();
