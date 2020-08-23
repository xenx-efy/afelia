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
window.requestData = (url, proxy = "") => {

    const statusOk = 200;

    return new Promise((resolve, reject) => {

        const xhr = new XMLHttpRequest();

        xhr.open(
            "GET",
            proxy + url,
            true
        );
        xhr.withCredentials = true;
        xhr.responseType = "json";

        xhr.send();

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
    document.addEventListener("keydown", (e) => {

        // eslint-disable-next-line no-param-reassign
        e = e || window.event;

        if (e.keyCode === 27) {

            hide();

        }

    });

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

window.message = (param = "") => {

    const parent = document.querySelector(".errors-list");

    if (!parent) {

        return false;

    }

    const createMessage = () => {

        const html = param.text;
        const message = document.createElement("div");
        const extraClasses = param.class || "";

        message.className = `bottom-message hide ${extraClasses}`;
        message.insertAdjacentHTML("afterbegin", html);
        parent.appendChild(message);
        // eslint-disable-next-line no-unused-expressions
        // message.clientWidth;

        return message;

    };
    const $message = createMessage();

    // eslint-disable-next-line no-unused-expressions
    $message.offsetTop;

    const hide = () => {

        if (!$message.classList.contains("hide")) {
  
            $message.classList.add("hide");
  
        }
  
    };

    const destroy = () => {

        $message.removeEventListener("click", hide);

        if (!$message.classList.contains("hide")) {
  
            $message.classList.add("hide");

            setTimeout(() => {

                $message.remove();

            }, 400);

            return;
  
        }

        $message.remove();
  
    };

    setTimeout(destroy, 5000);

    $message.addEventListener("click", hide);

    return {

        "show": () => {

            if ($message.classList.contains("hide")) {

                $message.classList.remove("hide");

            }

        },
        hide

    };

};
