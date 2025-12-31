document.oncontextmenu = () => {
    return false;
}
document.onkeydown = e => {
    if (e.ctrlKey && e.key == "u") {
        return false;
    }
}
// document.addEventListener("keydown", function(event) {
//     if (event.key === "F12" || event.keyCode === 123) {
//         event.preventDefault();
//         alert("Developer tools have been disabled.");
//     }
// });