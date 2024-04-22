
function doc (el) {
    return document.querySelectorAll(el);
}

function get_scroll(a) {
    var d = document,
        b = d.body,
        e = d.documentElement,
        c = "client" + a;
        a = "scroll" + a;
    return /CSS/.test(d.compatMode)? (e[c]< e[a]) : (b[c]< b[a])
};

const instances = doc('.instance');
// const appeals = doc('.courts__right .appeal');
const appealsMobile = doc('.appeal.mobile');
const appeals = document.querySelectorAll('.courts__right > .appeal');
const allAppeals = doc('.appeal');
const courtsRight = doc('.courts__right');
const closingArrow = doc('.closing__arrow');
const prohibitions = doc('.prohibitions');

function checkScrollForArrows() {
    closingArrow.forEach(arrow => {
        var appealsArray = Array.from(allAppeals);

        if(appealsArray.every(hasNone) && !arrow.classList.contains('mobile')){
            if(!arrow.classList.contains('none')){
                arrow.classList.add('none');
            }
        }else {
            arrow.classList.remove('none');
        }

        // if(arrow.classList.contains('none') && !arrow.classList.contains('mobile')) {
        //     arrow.classList.remove('none')
        // } else {
        //     arrow.classList.add('none')
        // }
    })
}

function hasNone(appeal){
    return appeal.classList.contains('none');
}


instances.forEach((instance, index) => {
    instance.addEventListener('click', (e) => {
        if(document.documentElement.clientWidth < 1050) {
            if(instance.classList.contains('gray__block')) {
                instance.classList.remove('gray__block');
                instance.nextElementSibling.classList.add('none')
            } else {
                instance.classList.add('gray__block')
                instance.nextElementSibling.classList.remove('none')
            }
        } else {
            console.log('asd');
            if(instance.classList.contains('gray__block')) {
                instance.classList.remove('gray__block');
                appeals[index].classList.add('none')
            } else {
                instance.classList.add('gray__block')
                appeals[index].classList.remove('none')
            }
        }
        checkScrollForArrows();
    })
})

prohibitions.forEach(prohibition => {
    prohibition.addEventListener('click', (e) => {
        if(prohibition.classList.contains('active')) {
            prohibition.classList.remove('active')
            prohibition.nextElementSibling.classList.add('none')
        } else {
            prohibition.classList.add('active')
            prohibition.nextElementSibling.classList.remove('none')
        }
        checkScrollForArrows();
    })
})

closingArrow.forEach(arrow => {
    // checkScrollForArrows();
    arrow.addEventListener('click', (e) => {
        window.scrollTo({top: 0, behavior: "smooth"})
    })
})