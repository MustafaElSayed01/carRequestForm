let carModel = document.querySelector("[name='carModel']");
let carNo = document.querySelector("[name='carNo']");
let quan = document.querySelector("[name='quan']");
document.forms[0].onsubmit = function (e) {
    let carModelValid = false;
    let carNoValid = false;
    let quanValid = false;
    if (carModel.value !== "") {
        carModelValid = true;
    }
    if (carNo.value !== "") {
        carNoValid = true;
    }
    if (quan.value !== "") {
        quanValid = true;
    }
    if (carModelValid === false || carNoValid === false || quanValid === false) {
        alert("برجاء التأكد من ملئ جميع البيانات");
        e.preventDefault();
    }
};

