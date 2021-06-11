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
      request.open('POST','/basket/list',true);
      
      request.addEventListener('readystatechange', function() {
        
        if ((request.readyState==4) && (request.status==200)) {
            location.reload();
        }
      });
      request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
      request.send(`${flag}&${id}&${qty}`);
}

// document.addEventListener("DOMContentLoaded",function() {
//     let btn = document.querySelector('#btn')
    
//     if(btn){
//     btn.addEventListener("click", function(){
//       let id = document.querySelector('.id').innerText;
//       id = 'id=' + encodeURIComponent(id);
//       let request = new XMLHttpRequest();
//       request.open('POST','http://localhost:8080/index/delete',true);
      
//       request.addEventListener('readystatechange', function() {
        
//         if ((request.readyState==4) && (request.status==200)) {
//           answer = JSON.parse(request.response);
          
//           const code = document.querySelector('.code');
//           const message = document.querySelector('.message');

//           code.innerText = answer.code;
//           message.innerText = answer.message;

//           if(answer.code === 200){
//               const content = document.querySelector('.content_info');
//               const notification = document.querySelector('.notification');

//               notification.classList.add('alert', 'alert-success');
//               notification.classList.remove('notification__none');
//               content.style.display = 'none';
//           }
//         }
//       });
//       request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
//       request.send(id);
//     });
//     }
// });