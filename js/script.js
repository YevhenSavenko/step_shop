function checkElements(){
    const modal = document.querySelector('.status__modal');

    if(modal !== null){
        const removeClass = 'modal__show';
        const addClass = 'modal__hide';

        hideModal(modal, removeClass, addClass);
    } 
}

function hideModal(tag, remove, add){
    setTimeout(() => {
        tag.classList.add(add);
        tag.classList.remove(remove);
    }, 2000);
}

checkElements();