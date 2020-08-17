"use strict";

const minValueLength = 0,
    formField = document.querySelectorAll("form label");

formField.forEach((element) => {

    const field = element.querySelector("input"),
        label = element.querySelector(".placeholder");

    window.addEventListener("load", () => {

        if (field.value.length > minValueLength) {

            label.classList.add("active");

        }

    });

    field.onfocus = function onfocus () {

        label.classList.add("active");

    };

    field.onblur = function onblur () {

        if (field.value.length === minValueLength) {

            label.classList.remove("active");

        }

    };

});

/**
 * Get data from site.
 * @param {string} url Is request url
 * @param {string} proxy I don't know what it
 * @returns {Promise} Describe this pls
 */
// eslint-disable-next-line no-unused-vars,require-jsdoc
window.requestDate = (url, proxy = "") => {

    const statusOk = 200;

    return new Promise((resolve, reject) => {

        const xhr = new XMLHttpRequest();

        xhr.open(
            "GET",
            proxy + url,
            true
        );
        xhr.onload = function onload () {

            if (this.status === statusOk) {

                resolve(this);

            } else {

                const error = new Error(this.statusText);

                error.code = this.status;
                reject(error);

            }

        };
        xhr.onerror = function onerror () {

            reject(new Error("Network Error"));

        };
        xhr.send();

    });

};

window.modal = (param) => {

    const createModal = () => {

        let title = param.title || "";
        const {content} = param;

        if (title.length) {

            title = `
            <div class="modal-window_title">${title}</div>
            `;

        }

        const html = `<div class="modal-window">
            <button class="close-btn close"><img src="../image/close.svg"></button>
                <div class="modal-window_content">
                    ${title}
                    ${content}
                </div>
            </div>`;
        const modal = document.createElement("div"),
            extraClasses = param.class || "";

        modal.className = `modal hide ${extraClasses}`;
        modal.insertAdjacentHTML("afterbegin", html);
        document.body.appendChild(modal);

        return modal;

    };

    const $modal = createModal(),
        $modalClose = $modal.querySelector(".close");

    const hide = () => {

        if (!$modal.classList.contains("hide")) {

            $modal.classList.add("hide");

        }

    };

    const show = () => {

        if ($modal.classList.contains("hide")) {

            $modal.classList.remove("hide");

        }

    };

    $modalClose.addEventListener("click", hide);

    if (typeof param.onBuild === "function") {

        param.onBuild({
            show,
            hide
        });

    }

    return {
        show,
        hide
    };

};
