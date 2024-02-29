function dropDown() {
    const myAnchor = document.getElementById("myAnchor");
    const myButton = document.querySelector("body > nav > div > button");
    const myArea = document.querySelector("#navbarNav");

    myAnchor.addEventListener("click", function() {
        myButton.className = "navbar-toggler";
        myButton.setAttribute("aria-expanded", true);
        myArea.classList.add("show");
        // console.log("working");
    });

}
dropDown();