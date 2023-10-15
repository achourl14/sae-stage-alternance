function submitValue(value) {
    document.getElementById('stage').value = value;
}
document.addEventListener("DOMContentLoaded", function() {
    var boutonStage = document.getElementById("buttonStage");
    var boutonAlternance = document.getElementById("buttonAlternance");

    boutonStage.addEventListener("click", function() {
        boutonStage.style.backgroundColor = "red";
        boutonStage.style.color = "black";
        boutonAlternance.style.backgroundColor = "white";
        boutonAlternance.style.color = "black";
    });

    boutonAlternance.addEventListener("click", function() {
        boutonAlternance.style.backgroundColor = "black";
        boutonAlternance.style.color = "white";
        boutonStage.style.backgroundColor = "white";
        boutonStage.style.color = "red";
    });
});