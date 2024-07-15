let goFrom = document.querySelector("[name='goFrom']");
let goTo = document.querySelector("[name='goTo']");
let dateFrom = document.querySelector("[name='dateFrom']");
let dateTo = document.querySelector("[name='dateTo']");
let quan = document.querySelector("[name='quan']");
var time = new Date();
var localTimeStr = time.toLocaleString("en-US", {
    timeZone: "Africa/Cairo",
});
today = new Date(localTimeStr);
reqDay = new Date(today.setDate(today.getDate() + 2)).toISOString().split("T")[0];
document.forms[0].onsubmit = function (e) {
    let goFromValid = false;
    let goToValid = false;
    let dateFromValid = false;
    let dateToValid = false;
    let quanValid = false;
    if (goFrom.value !== "") {
        goFromValid = true;
    }
    if (goTo.value !== "") {
        goToValid = true;
    }
    if (dateFrom.value !== "" && dateFrom.value > reqDay) {
        dateFromValid = true;
    }
    if (dateTo.value !== "") {
        dateToValid = true;
    }
    if (quan.value !== "") {
        quanValid = true;
    }
    if (goFromValid === false || goToValid === false || dateToValid === false || quanValid === false || dateFromValid === false) {
        alert("برجاء التأكد من ملئ جميع البيانات");
        e.preventDefault();
    }
};
function myFunction() {
    var startDate = document.getElementById("dateFrom").value;
    var endDate = document.getElementById("dateTo").value;
    if (startDate < reqDay) {
        document.getElementById("dayAlert").innerHTML = "برجاء اختيار يوم قبل الموعد المُراد ب48 ساعة على الأقل ";
    }
    else if (endDate == '') {
        document.getElementById("dayAlert1").innerHTML = "";
        document.getElementById("dayAlert").innerHTML = "";
    }
    else if (endDate < startDate && startDate >= reqDay) {
        document.getElementById("dayAlert1").innerHTML = "برجاء اختيار تاريخ بعد تاريخ الذهاب";
        document.getElementById("dayAlert").innerHTML = "";

    }
    else {
        document.getElementById("dayAlert").innerHTML = "";
        document.getElementById("dayAlert1").innerHTML = "";
    }
}
