let per_tap = document.getElementById("per_tap"),
    com_tap = document.getElementById("com_tap");
let personal_form = document.getElementById("personal"),
    company_form = document.getElementById("company");
let current = localStorage.getItem("current");
const company = () => {

    com_tap?.classList.add("active");
    per_tap?.classList.remove("active");

    personal_form?.classList.add("d-none");
    personal_form?.classList.remove("d-flex");

    company_form?.classList.add("d-flex");
    company_form?.classList.remove("d-none");
}
const personal = () => {
    per_tap?.classList.add("active");
    com_tap?.classList.remove("active");

    personal_form?.classList.add("d-flex");
    personal_form?.classList.remove("d-none");

    company_form?.classList.add("d-none");
    company_form?.classList.remove("d-flex");
}
per_tap?.addEventListener("click", () => {
    current = localStorage.setItem("current", "personal");
    personal();
});
com_tap?.addEventListener("click", () => {
    current = localStorage.setItem("current", "company");
    company();
});
if (current === "personal") {
    personal();
}
if (current === "company") {
    company();
}

//
async function getData(url) {
    const response = await fetch(url, {
        method: "GET", // *GET, POST, PUT, DELETE, etc.
        mode: "cors", // no-cors, *cors, same-origin
        cache: "no-cache", // *default, no-cache, reload, force-cache, only-if-cached
        credentials: "same-origin", // include, *same-origin, omit
        headers: {
            "Content-Type": "application/json",
        },
        redirect: "follow", // manual, *follow, error
        referrerPolicy: "no-referrer", // no-referrer, *no-referrer-when-downgrade, origin, origin-when-cross-origin, same-origin, strict-origin, strict-origin-when-cross-origin, unsafe-url
    });
    return response.json(); // parses JSON response into native JavaScript objects
}

let areas = [];
let areaEle = document.getElementById("areas");
if (areaEle) {
    getData("/api/areas").then((data) => {
        areas = data;
    });
}

let govs = [];
let govEle = document.getElementById("govs"),
    levelEle = document.getElementById("level");
if (govEle) {
    let levels = [
        "الأول",
        "الثاني",
        "الثالث",
        "الرابع",
        "الخامس",
        "السادس",
        "السابع",
        "الثامن",
        "التاسع",
        "العاشر",
        "الحادي عشر",
        "الثاني عشر",
    ];
    let selected = localStorage.getItem("select_gov")
    let selectedArea = localStorage.getItem("select_area");
    getData("/api/govs").then((data) => {
        govEle.innerHTML =
            `
                    <option value="" disabled selected>المحافظة</option>
        `;

        data.forEach(ele => {
            if (!govEle.classList.contains('no-local')) {


                govEle.innerHTML += `
            <option value='${ele.id}' ${selected == ele.id ? "selected" : " "}>${ele.gov}</option>
        `;
            } else {

                govEle.innerHTML += `
            <option value='${ele.id}'>${ele.gov}</option>
        `;
            }
        });
    }).then(() => {
        setTimeout(() => {
            if (selected) {
                const filteredItems = areas.filter(item => item.government_id == selected);
                filteredItems.forEach(item => {
                    if (!areaEle.classList.contains('no-local')) {
                        areaEle.innerHTML += `
            <option value='${item.area}' class="dropdown-item" ${item.area === selectedArea ? "selected" : " "} >${item.area}</option>`
                    } else {
                        areaEle.innerHTML += `
            <option value='${item.area}' class="dropdown-item" >${item.area}</option>`

                    }
                });
            }
        }, 1000);
    });


    govEle.addEventListener("change", (e) => {
        localStorage.setItem("select_gov", e.target.value);
        areaEle.innerHTML = "";
        if (areas.length > 0) {
            const filteredItems = areas.filter(item => item.government_id == e.target.value);
            filteredItems.forEach(item => {
                areaEle.innerHTML += `
            <option value='${item.area}' class="dropdown-item">${item.area}</option>`
            });
        }
    })

    areaEle.addEventListener("change", (e) => {
        localStorage.setItem("select_area", e.target.value);
    })

    let level = localStorage.getItem("select_level")
    levels.forEach(ele => {
        levelEle ? levelEle.innerHTML += `
            <option value='${ele}' ${level == ele ? "selected" : " "}>${ele}</option>
        ` : null;
    });
    levelEle?.addEventListener("change", (e) => {
        localStorage.setItem("select_level", e.target.value);
    })
}

let presenter = document.getElementById("presenter"),
    payment = document.getElementById("payment"),
    price = document.getElementById("price");
const showPresenter = () => {
    var selectedOption = payment?.options[payment.selectedIndex];

    var selectedValue = selectedOption?.value;
    if (selectedValue === "قسط") {
        presenter?.classList.add("d-flex");
        presenter?.classList.remove("d-none");

        price?.classList.remove("d-flex");
        price?.classList.add("d-none");
    } else if (selectedValue === "كاش") {
        presenter?.classList.remove("d-flex");
        presenter?.classList.add("d-none");

        price?.classList.add("d-flex");
        price?.classList.remove("d-none");
    } else {
        presenter?.classList.remove("d-flex");
        presenter?.classList.add("d-none");
        price?.classList.remove("d-flex");
        price?.classList.add("d-none");
    }
}
payment?.addEventListener("change", (e) => {
    showPresenter()
})
showPresenter()

let fileInput = document.getElementById("propertyImages");
let filenamesContainer = document.getElementById("imageFilenames");

fileInput?.addEventListener("change", function (event) {
    filenamesContainer.innerHTML = "";

    let selectedFiles = event.target.files;

    for (let i = 0; i < selectedFiles.length; i++) {
        let card = document.createElement("div");
        card.classList.add("d-flex");
        card.classList.add("flex-column");
        card.classList.add("gap-2");
        let file = selectedFiles[i];
        let imageElement = document.createElement("img");
        imageElement.src = URL.createObjectURL(file);
        imageElement.width = 100;

        let filename = selectedFiles[i].name;
        let filenameElement = document.createElement("div");
        filenameElement.textContent = filename;


        card.appendChild(imageElement);
        card.appendChild(filenameElement);
        filenamesContainer.appendChild(card);
        // filenamesContainer.appendChild(filenameElement);
    }
});


let slideIndex = 1;
showSlides(slideIndex);

// Next/previous controls
function plusSlides(n) {
    showSlides(slideIndex += n);
}

// Thumbnail image controls
function currentSlide(n) {
    showSlides(slideIndex = n);
}

function showSlides(n) {
    let i;
    let slides = document.getElementsByClassName("mySlides");
    let dots = document.getElementsByClassName("demo");
    let captionText = document.getElementById("caption");
    if (n > slides.length) {
        slideIndex = 1
    }
    if (n < 1) {
        slideIndex = slides.length
    }
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
    }
    if (slides[slideIndex - 1]) {
        slides[slideIndex - 1].style.display = "block";
    }
    if (dots[slideIndex - 1]) {
        dots[slideIndex - 1].className += "active";
        captionText.innerHTML = dots[slideIndex - 1].alt;
    }
}

// Drop Down

/* When the user clicks on the button,
toggle between hiding and showing the dropdown content */
function myFunction() {
    document.getElementById("myDropdown")?.classList.toggle("show");
}

function filterFunction() {
    var input, filter, ul, li, a, i;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    div = document.getElementById("myDropdown");
    a = div.getElementsByTagName("a");
    for (i = 0; i < a.length; i++) {
        txtValue = a[i].textContent || a[i].innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            a[i].style.display = "";
        } else {
            a[i].style.display = "none";
        }
    }
}


let purpose = document.getElementById("purpose");
let title_payment = document.getElementById("title_payment");
if (purpose)
    purpose.onchange = (e) => {
        if (e.target.value === "شراء") {
            payment.classList.add("d-none")
            title_payment.classList.add("d-none")
            presenter?.classList.add("d-none");
            price?.classList.add("d-none");
        } else if (e.target.value === "ايجار") {
            payment.classList.add("d-none")
            title_payment.classList.add("d-none")
            presenter?.classList.add("d-none");
            price?.classList.remove("d-none");
            price?.classList.add("d-flex");
        } else {
            payment.classList.add("d-flex")
            title_payment.classList.add("d-flex")

            payment.classList.remove("d-none")
            title_payment.classList.remove("d-none")

            price?.classList.add("d-none");
            price?.classList.remove("d-flex");
        }
    }

let type = document.getElementById("type")
let level_title = document.getElementById("level_title")
let rooms_title = document.getElementById("rooms_title")
let rooms = document.getElementById("rooms")
if (type) type.addEventListener("change", (e) => {
    let value = e.target.value
    switch (value) {
        case "روف" || "اراضى":
            if (levelEle) {
                levelEle.classList.add("d-none");
                level_title.classList.add("d-none");
            }

            rooms.classList.add("d-none");
            rooms_title.classList.add("d-none");

            break;
        case "اراضى":
            if (levelEle) {
                levelEle.classList.add("d-none");
                level_title.classList.add("d-none");
            }

            rooms.classList.add("d-none");
            rooms_title.classList.add("d-none");

            break;

        case "محلات":
            if (levelEle) {
                levelEle.classList.add("d-none");
                level_title.classList.add("d-none");
            }

            rooms.classList.add("d-none");
            rooms_title.classList.add("d-none");

            break;
        case "فيلا":
            if (levelEle) {
                levelEle.classList.add("d-none");
                level_title.classList.add("d-none");
            }

            rooms.classList.remove("d-none");
            rooms_title.classList.remove("d-none");
            break;

        case "ارضي بجنينة":
            if (levelEle) {
                levelEle.classList.add("d-none");
                level_title.classList.add("d-none");
            }

            rooms.classList.remove("d-none");
            rooms_title.classList.remove("d-none");
            break;
        case "مبانى":
            if (levelEle) {
                levelEle.classList.add("d-none");
                level_title.classList.add("d-none");
            }
            break;
        default:
            if (levelEle) {
                levelEle.classList.remove("d-none");
                level_title.classList.remove("d-none");
            }

            rooms.classList.remove("d-none");
            rooms_title.classList.remove("d-none");
            break;
    }
})
let pass_icon = document.querySelectorAll(".pass-icon");


if (pass_icon)
    pass_icon.forEach(function (icon) {
        icon.addEventListener('click', function () {
            let passwordInput = icon.closest('.pass-con').querySelector('input');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
            } else {
                passwordInput.type = 'password';
            }
        });
    });
