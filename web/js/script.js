class ScrollHandler {

    constructor()
    {
        this.navbarClasses = document.querySelector('.navbar').classList;
        this.logo = document.querySelector('.logo');
        this.colorItems = document.querySelectorAll('.nav-link');
    }

    OnScrollInput() {
        try {
            if (window.scrollY > 0) {
                navbarClasses.replace('bg-light', 'bg-dark');
                logo.setAttribute('style', 'filter: invert(0%);');
                colorItems.forEach(function (colorItem) {
                    colorItem.setAttribute("style", "color: #fff;");
                });
            } else {
                navbarClasses.replace('bg-dark', 'bg-light');
                logo.setAttribute('style', 'filter: invert(100%);');
                colorItems.forEach(function (colorItem) {
                    colorItem.setAttribute("style", "color: #000;");
                });
            }
        } catch (e) {
            try {
                console.log(e);
                this.navbarClasses = document.querySelector('.navbar').classList;
                this.logo = document.querySelector('.logo');
                this.colorItems = document.querySelectorAll('.nav-link');
            } catch (exception_in_exception) {
                console.log(exception_in_exception);
            }
        }
    }
}
$(function() {
let scrollHandler = new ScrollHandler();
$(window).on('scroll', scrollHandler.OnScrollInput);
})