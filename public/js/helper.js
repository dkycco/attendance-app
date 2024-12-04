"use strict";

const CSRF_TOKEN = $('meta[name="csrf-token"]').attr("content");
const globalHeaders = {
    Accept: "application/json, text-plain, */*",
    "X-CSRF-TOKEN": CSRF_TOKEN,
};

// Feather
function _loadFeather() {
    if (feather) {
        feather.replace({
            width: 14,
            height: 14,
        });
    }
}

// get month name
function getMonth(index) {
    const months = {
        1: "Januari",
        2: "Februari",
        3: "Maret",
        4: "April",
        5: "Mei",
        6: "Juni",
        7: "Juli",
        8: "Agustus",
        9: "September",
        10: "Oktober",
        11: "November",
        12: "Desember",
    };

    return months[index] ?? null;
}

function convertDate(date, separator = "-") {
    date = date.split(separator);

    var newDate = [];
    for (let i = 2; i >= 0; i--) {
        newDate.push(date[i]);
    }

    return newDate.join(separator);
}

function convertUTCDate(date) {
    var day = ("0" + date.getDate()).slice(-2),
        month = ("0" + (date.getMonth() + 1)).slice(-2),
        year = date.getFullYear();

    return day + "-" + month + "-" + year;
}

// Format number
function numberFormat(num, precision = 0) {
    let number = num.toString().replace(/[^0-9|^.]/g, "");
    if (
        number.substr(0, 1) == 0 &&
        number.length > 1 &&
        number.indexOf(".") == -1
    ) {
        number = number.substr(1);
    }
    let parts = number.toString().split(".");

    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    return parts.splice(0, 2).join(".");
}

function removeFormatNumber(formatted_number, separator = ",") {
    let replaced = formatted_number.replaceAll(separator, "");
    if (separator == ".") replaced = replaced.replaceAll(",", ".");
    return replaced;
}

// Show hide bootstrap modal
function bsModal(className = "modal-primer") {
    const modal = $("." + className);

    function show(element) {
        modal.html(element).modal("show");
    }

    function hide() {
        modal.html("").modal("hide");
    }

    return {
        show,
        hide,
    };
}

// Bootstrap datepicker
function bsDatePicker(className = "datepicker") {
    let datePickerElement = $("." + className);
    let defaultOptions = {
        format: "dd-mm-yyyy",
        autoclose: true,
        todayHighlight: true,
        zIndexOffset: 999999,
    };

    function setOptions(options) {
        if (typeof options === "object") {
            for (const [key, value] of Object.entries(options)) {
                defaultOptions[key] = value;
            }
        }

        return this;
    }

    function init() {
        return datePickerElement.datepicker(defaultOptions);
    }

    return {
        setOptions,
        init,
    };
}

// Datatable
function dataTable(id) {
    const datatable = window.LaravelDataTables[id];

    function reload(url = null) {
        if (url) {
            datatable.ajax.url(url).load();
            return;
        }

        datatable.ajax.reload();
    }

    function onDraw(callback) {
        if (typeof callback === "function") {
            $("#" + id).on("draw.dt", callback);
        }
    }

    return {
        reload,
        onDraw,
    };
}

// Show and hide button submit loader inside a form
function submitLoader(formId) {
    const button = $("#" + formId).find('button[type="submit"]');

    function show() {
        button
            .addClass("btn-load")
            .attr("disabled", true)
            .html(
                `<span class="d-flex align-items-center"><span class="spinner-border flex-shrink-0"></span><span class="flex-grow-1 ms-2"> Memproses...</span></span>`
            );
    }

    function hide(text = "Simpan") {
        if (button.data("idle-text")) {
            text = button.data("idle-text");
        }

        button.removeClass("btn-load").removeAttr("disabled").text(text);
    }

    return {
        show,
        hide,
    };
}

// Alert using sweetalert
function alert() {
    let swalOptions = {
        confirmButtonText: "OK",
        buttonsStyling: !1,
        customClass: {
            confirmButton: "btn btn-primary w-xs me-2 mt-2",
            cancelButton: "btn btn-danger w-xs mt-2",
            input: "form-control",
        },
    };

    function error(message) {
        swalOptions["html"] = `<div class="mt-3">
        <lord-icon src="https://cdn.lordicon.com/tdrtiskw.json" trigger="loop" colors="primary:#f06548,secondary:#f7b84b" style="width:120px;height:120px"></lord-icon>
        <div class="mt-4 pt-2 fs-15">
            <h4>Oops...! Terjadi Kesalahan !</h4>
            <p class="text-muted mx-4 mb-0">${
                message ?? "Silahkan hubungi IT"
            }</p>
        </div></div>`;

        Swal.fire(swalOptions);
    }

    function success(message) {
        swalOptions["title"] = "Berhasil";
        swalOptions["text"] = message ?? "Berhasil disimpan";
        swalOptions["icon"] = "success";

        Swal.fire(swalOptions);
    }

    function confirmation(url, options = {}) {
        if (typeof swalOptions["cancelButtonText"] === "undefined") {
            swalOptions["showCancelButton"] = true;
            swalOptions["cancelButtonText"] = "Batal";
        }

        if (typeof swalOptions["icon"] === "undefined") {
            swalOptions["icon"] = "warning";
        }

        if (typeof swalOptions["preConfirm"] === "undefined") {
            swalOptions["preConfirm"] = () => {
                let method = "post";
                if (typeof options.method !== "undefined") {
                    method = options.method;
                }

                let data = {};
                if (typeof options.setData === "function") {
                    options.setData(data);
                }

                if (typeof options.setData === "object") {
                    for (const [key, value] of Object.entries(
                        options.setData
                    )) {
                        data[key] = value;
                    }
                }

                return fetchData(
                    url,
                    {
                        method: method,
                        body: JSON.stringify(data),
                    },
                    {
                        onError: (error) => Swal.showValidationMessage(error),
                    }
                );
            };
        }

        Swal.fire(swalOptions).then((response) => {
            if (response.isConfirmed) {
                if (typeof options.onConfirm === "function") {
                    options.onConfirm(response);
                }
            }

            if (response.isDismissed) {
                if (typeof options.onDismiss === "function") {
                    options.onDismiss(response);
                }
            }

            if (response.isDenied) {
                if (typeof options.onDenied === "function") {
                    options.onDenied(response);
                }
            }
        });
    }

    function options(options) {
        if (typeof options === "object") {
            for (const [key, value] of Object.entries(options)) {
                swalOptions[key] = value;
            }
        }

        return this;
    }

    function fire() {
        return Swal.fire(swalOptions);
    }

    return {
        error,
        success,
        options,
        confirmation,
        fire,
    };
}

// Loader
function loader(show = true) {
    const preloader = $("#preloader");

    if (show) {
        preloader.css({
            opacity: 1,
            visibility: "visible",
        });
    } else {
        preloader.css({
            opacity: 0,
            visibility: "hidden",
        });
    }
}

// Toast
function toastInit(status, message) {
    iziToast.show({
        title: status == "success" ? "Sukses!" : "Gagal!",
        titleColor: "#fff",
        icon: status == "success" ? "fa fa-check" : "exclamation",
        color: status == "success" ? "#67b173" : "#f17171",
        position: "topRight",
        message: message ?? "Terjadi kesalahan",
        messageColor: "#fff",
    });
}

function select(className = "select2") {
    let selectElement = $("." + className);
    let selectOptions = {
        allowClear: true,
    };

    function options(options) {
        if (typeof options == "object") {
            for (const [key, value] of Object.entries(options)) {
                selectOptions[key] = value;
            }
        }

        return this;
    }

    function init() {
        selectElement.each(function (key, element) {
            selectOptions["dropdownParent"] = $(element).parent();
            $(element).select2(selectOptions);
        });
    }

    return {
        options,
        init,
    };
}

// fetch
function fetchData(url, options = {}, callbacks = {}) {
    var fetchOptions = {
        method: "post",
        headers: {
            "X-CSRF-TOKEN": CSRF_TOKEN,
            "Content-Type": "application/json",
        },
    };

    if (typeof options === "object") {
        for (const [key, value] of Object.entries(options)) {
            fetchOptions[key] = value;
        }
    }

    return fetch(url, fetchOptions)
        .then((response, e) => {
            if (!response.ok && response.status != 422) {
                throw new Error(
                    response.status == 419
                        ? "CSRF TOKEN Mismatch"
                        : response.statusText
                );
            }
            return response.json();
        })
        .then((data) => {
            if (data.status == "error") {
                throw new Error(data.message);
            }
            return data;
        })
        .catch((error) => {
            if (typeof callbacks.onError === "function") {
                callbacks.onError(error);
            }
        })
        .then((response) => {
            if (response) {
                toastInit(response.status, response.message);
                if (
                    typeof callbacks.onSuccess === "function" &&
                    response.status == "success"
                ) {
                    callbacks.onSuccess(response);
                }

                if (typeof callbacks === "object") {
                    for (const [key, func] of Object.entries(callbacks)) {
                        if (key !== "onError" && key !== "onSuccess") {
                            func(response);
                        }
                    }
                }
            }
        });
}

// Handle Ajax Form
function handleFormSubmitAjax(formId) {
    function appendData(data) {
        if (typeof data === "object") {
            this.data = data;
        } else if (typeof data === "function") {
            this.appendDataFormData = data;
        }

        return this;
    }

    function setHeaders(headers) {
        this.headers = headers;
        return this;
    }

    function setBeforeSend(callback, runDefault = false) {
        this.beforeSendCallback = callback;
        this.runDefaultBeforeSendCallback = runDefault;
        return this;
    }

    function onSuccess(callback, runDefault = false) {
        this.successCallback = callback;
        this.runDefaultSuccessCallback = runDefault;
        return this;
    }

    function onError(callback, runDefault = false) {
        this.errorCallback = callback;
        this.runDefaultErrorCallback = runDefault;
        return this;
    }

    function setDataTableId(id) {
        this.dataTableId = id;
        return this;
    }

    function setAjaxOptions(options) {
        this.ajaxOptions = options;
        return this;
    }

    function init() {
        const form = $("#" + formId);
        const handler = this;

        form.on("submit", function (e) {
            e.preventDefault();
            let formData = new FormData(this);
            if (handler.data) {
                for (const [key, value] of Object.entries(handler.data)) {
                    formData.append(key, value);
                }
            } else {
                handler.appendDataFormData &&
                    handler.appendDataFormData(formData);
            }

            let ajaxOptions = {
                url: form.attr("action"),
                method: form.attr("method"),
                headers: handler.headers ?? globalHeaders,
                data: formData,
                processData: false,
                contentType: false,
                beforeSend: function () {
                    if (handler.beforeSendCallback) {
                        handler.beforeSendCallback();
                        if (handler.runDefaultBeforeSendCallback === false) {
                            return;
                        }
                    }

                    form.find(".is-invalid").removeClass("is-invalid");
                    form.find(".invalid-feedback").remove();

                    submitLoader(formId).show();
                },
                success: function (response) {
                    if (handler.successCallback) {
                        handler.successCallback(response);
                        if (handler.runDefaultSuccessCallback === false) {
                            return;
                        }
                    }

                    bsModal().hide();
                    toastInit(response.status, response.message);
                    handler.dataTableId &&
                        dataTable(handler.dataTableId).reload();
                },
                error: function (e) {
                    if (handler.errorCallback) {
                        handler.errorCallback(e);
                        if (handler.runDefaultErrorCallback === false) {
                            return;
                        }
                    }
                    toastInit("error", e.responseJSON?.message);
                    const errors = e.responseJSON?.errors;
                    if (errors) {
                        let i = 0;
                        for (const [key, message] of Object.entries(errors)) {
                            if (i == 0) {
                                $(`[name="${key}"]`).focus();
                            }
                            i++;
                            form.find(`[name^='${key}']`)
                                .addClass("is-invalid")
                                .parents(".form-group")
                                .append(
                                    `<div class="invalid-feedback">${message}</div>`
                                );
                        }
                    }
                },
                complete: function () {
                    submitLoader(formId).hide();
                },
            };

            if (handler.ajaxOptions) {
                for (const [key, value] of Object.entries(
                    handler.ajaxOptions
                )) {
                    ajaxOptions[key] = value;
                }
            }

            $.ajax(ajaxOptions);
        });
    }

    return {
        appendData,
        setDataTableId,
        setBeforeSend,
        setHeaders,
        setAjaxOptions,
        onSuccess,
        onError,
        init,
    };
}

function showErrorValidation(form, errors) {
    let i = 0;
    for (const [key, message] of Object.entries(errors)) {
        if (i == 0) {
            $(`[name="${key}"]`).focus();
        }
        i++;
        form.find(`[name^='${key}']`)
            .addClass("is-invalid")
            .parents(".form-group")
            .append(`<div class="invalid-feedback">${message}</div>`);
    }
}

// Handle Ajax
function handleAjax(url, method = "get") {
    function setData(data) {
        this.data = data;
        return this;
    }

    function setAjaxOptions(options) {
        this.ajaxOptions = options;
        return this;
    }

    function onSuccess(callback, runDefault = false) {
        this.successCallback = callback;
        this.runDefaultSuccessCallback = runDefault;
        return this;
    }

    function onError(callback, runDefault = false) {
        this.errorCallback = callback;
        this.runDefaultErrorCallback = runDefault;
        return this;
    }

    function execute(options = {}) {
        const handler = this;

        let ajaxOptions = {
            url,
            method,
            data: handler.data,
            headers: {
                "X-CSRF-TOKEN": CSRF_TOKEN,
            },
            beforeSend: function () {
                loader();
            },
            success: function (response, status, xhr) {
                if (handler.successCallback) {
                    handler.successCallback(response, xhr);
                    if (handler.runDefaultSuccessCallback === false) {
                        return;
                    }
                }

                toastInit(response.status, response.message);
            },
            error: function (e) {
                if (handler.errorCallback) {
                    handler.errorCallback(e);
                    if (handler.runDefaultErrorCallback === false) {
                        return;
                    }
                }

                toastInit("error", e.responseJSON?.message);
                const errors = e.responseJSON?.errors;
            },
            complete: function () {
                loader(false);
            },
        };

        for (const [key, value] of Object.entries(options)) {
            ajaxOptions[key] = value;
        }

        if (handler.ajaxOptions) {
            for (const [key, value] of Object.entries(handler.ajaxOptions)) {
                ajaxOptions[key] = value;
            }
        }

        $.ajax(ajaxOptions);
    }

    return {
        setData,
        setAjaxOptions,
        onSuccess,
        onError,
        execute,
    };
}

// Debounce
function debounce(callback, ms) {
    var timer = 0;
    return function () {
        var context = this,
            args = arguments;
        clearTimeout(timer);
        timer = setTimeout(function () {
            callback.apply(context, args);
        }, ms || 800);
    };
}

// search
function search(target, searchField = null) {
    searchField = searchField ?? '[name="search"]';

    $(searchField).on(
        "keyup",
        debounce(function () {
            handleAjax(this.dataset.url)
                .setData({ search: this.value })
                .onSuccess((response) => $(target).html(response))
                .execute();
        })
    );
}

// tooltip
function tooltip() {
    [].slice
        .call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        .map(function (e) {
            return new bootstrap.Tooltip(e);
        });
}
