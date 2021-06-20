addHandlers();

function incrementNumber(num){
    return num+1;
}

function decrementNumber(num){
    if(num === 1 || num < 1){
        return num;
    }

    return num-1;
}

function addHandlers(){
    const wrappers = document.querySelectorAll('.cart__quantity-wrapper');

    if(wrappers != null){
        const inputs = document.querySelectorAll('.cart__info-quantity input');

        wrappers.forEach((item, index) => {
            item.addEventListener('click', (e) => {
                let number = inputs[index].value;
                number = parseInt(number);

                if(e.target.className === 'cart__plus'){
                    number = incrementNumber(number);
                    updateCart(index, number);
                }

                if(e.target.className === 'cart__minus'){
                    number = decrementNumber(number);
                    updateCart(index, number);
                    
                }

                inputs[index].value = number;
            });
        });
    }
}

function updateCart(id, qty){
      let flag = 'flag=update';
      id = 'id=' + encodeURIComponent(id);
      qty = 'qty=' + encodeURIComponent(qty);

      let request = new XMLHttpRequest();
      request.open('POST', window.location.href, true);
      
      request.addEventListener('readystatechange', function() {
        
        if ((request.readyState==4) && (request.status==200)) {
            location.reload();
        }
      });
      request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
      request.send(`${flag}&${id}&${qty}`);
}