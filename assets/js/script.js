function search() {
    const searchBox = document.querySelector('.item-search-bar').value.toLowerCase();
    const products = document.querySelector('#products');
    const product = document.querySelectorAll('.product');
    const productName = products.querySelectorAll('#product__detail-name');

    for (var i = 0; i < productName.length; i++) {
        let match = product[i].querySelectorAll('#product__detail-name')[0];
        if (match) {
            let textValue = match.textContent || match.innerHTML;
            if (textValue.toLowerCase().indexOf(searchBox) > -1) {
                product[i].style.display = '';
            } else {
                product[i].style.display = 'none';
            }
        }
    }
}

function switchMenu() {
    let dropdown = document.querySelector('.nav__menu-dropdown');
    let list = document.querySelector('.nav__items');
    dropdown.classList.toggle('active');
    if (list.style.display == 'block') {
        list.style.display = 'none';
    } else {
        list.style.display = 'block';
    }
    window.onclick = function(event) {
        // var dropdown = document.querySelector('.nav__menu-dropdown');
        // var list = document.querySelector('.nav__items');
        if (!event.target.matches('.nav__menu-dropdown')) {
            list.style.display = 'none';
            if (!dropdown.classList.toggle('active')) {
                dropdown.classList.toggle('active');
            }
        }
    }
}


// for slider
var index = 0;
var i = 0;
var slider = document.getElementsByClassName('slide');
var line = document.getElementsByClassName('line');
auto();

function show(n) {
    for (i = 0; i < slider.length; i++) {
        slider[i].style.display = 'none';
    }
    for (i = 0; i < slider.length; i++) {
        line[i].className = line[i].className.replace('active');
    }
    slider[n - 1].style.display = ("block");
    line[n - 1].className += " activeSlide"; //add space
}

function auto() {
    index++;
    if (index > slider.length) {
        index = 1;
    }
    show(index); //calling show
    setTimeout(auto, 5000); //next slider will show after 5 second
}

function plusSlide(n) {
    index += n; //n = 1 or n = -1
    if (index > slider.length) {
        index = 1;
    }
    if (index < 1) { //to remove from first to last 
        index = slider.length;
    }
    show(index);
}

function currentSlide(n) {
    index = n;
    show(index);

}