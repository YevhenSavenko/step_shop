let inputLeft = document.getElementById("input-left");
let inputRight = document.getElementById("input-right");

let thumbLeft = document.querySelector(".slider > .thumb.left");
let thumbRight = document.querySelector(".slider > .thumb.right");
let range = document.querySelector(".slider > .range");
const min_input = document.querySelector(".min_input");
const max_input = document.querySelector(".max_input");
let maxPrice = 0;

if(max_input){
    maxPrice = max_input.value;
}

function setLeftValue() {
	let _this = inputLeft,
		min = parseInt(_this.min),
		max = parseInt(_this.max);

	_this.value = Math.min(parseInt(_this.value), parseInt(inputRight.value) - 1);

	let percent = ((_this.value - min) / (max - min)) * 100;

    if(min_input){
        min_input.value = parseInt((maxPrice * percent) / 100);
    }

	thumbLeft.style.left = percent + "%";
	range.style.left = percent + "%";

    
}


function setRightValue() {
	let _this = inputRight,
		min = parseInt(_this.min),
		max = parseInt(_this.max);

	_this.value = Math.max(parseInt(_this.value), parseInt(inputLeft.value) + 1);

	let percent = ((_this.value - min) / (max - min)) * 100;

    if(max_input){
        if(percent === 100){
            max_input.value = maxPrice;
        } else {
            max_input.value = parseInt((maxPrice * percent) / 100);
        }
    }

	thumbRight.style.right = (100 - percent) + "%";
	range.style.right = (100 - percent) + "%";
}


function setMinValue(){
    if(min_input){
        // let value = min_input.value.replace(/[^0-9]/g, "");
        let value = min_input.value;

        if(parseFloat(value) > parseFloat(max_input.value)){
            value = parseFloat(max_input.value) - 1;
            min_input.value = value;
        }

        inputLeft.value = parseInt((100 * value) / maxPrice);
        thumbLeft.style.left = parseInt((100 * value) / maxPrice) + "%";
        range.style.left = parseInt((100 * value) / maxPrice) + "%";
    }
}

function setMaxValue(){
    if(max_input){
        // let value = max_input.value.replace(/[^0-9]/g, "");
        let value = max_input.value;

        if(max_input.value == ''){
            max_input.value = maxPrice;
            value = maxPrice;
        }


        if(parseFloat(value) > (parseInt(maxPrice * 100)) / 100 || parseFloat(value) < parseFloat(min_input.value)){
            value = maxPrice;
            max_input.value = parseInt(maxPrice * 100) / 100;

            inputRight.value = parseInt(100);
            thumbRight.style.right = parseInt(0) + "%";
            range.style.right = parseInt(0) + "%";

            return;
        }


        let percent = (100 * value) / maxPrice;

        console.log(percent);
        percent > 100 ? percent = 100 : '';
        console.log(percent);

        inputRight.value = parseInt(100 - percent);
        thumbRight.style.right = parseInt(100 - percent) + "%";
        range.style.right = parseInt(100 - percent) + "%";

        // console.log(inputRight.value);
        // console.log(value);
    }
}

if(inputLeft){
    setLeftValue();
    inputLeft.addEventListener("input", setLeftValue);
    inputLeft.addEventListener("mouseover", function() {
        thumbLeft.classList.add("hover");
    });
    inputLeft.addEventListener("mouseout", function() {
        thumbLeft.classList.remove("hover");
    });
    inputLeft.addEventListener("mousedown", function() {
        thumbLeft.classList.add("active");
    });
    inputLeft.addEventListener("mouseup", function() {
        thumbLeft.classList.remove("active");
    });
}

if(inputRight){

    inputRight.addEventListener("input", setRightValue);
    setRightValue();

    inputRight.addEventListener("mouseover", function() {
        thumbRight.classList.add("hover");
    });
    inputRight.addEventListener("mouseout", function() {
        thumbRight.classList.remove("hover");
    });
    inputRight.addEventListener("mousedown", function() {
        thumbRight.classList.add("active");
    });
    inputRight.addEventListener("mouseup", function() {
        thumbRight.classList.remove("active");
    });
}

if(min_input){
    min_input.addEventListener("input", () => {
        let value = min_input.value.replace(/[^0-9]/g, "");
        min_input.value = value;

        if(min_input.value[0] == 0 && min_input.value[1]){
            min_input.value = min_input.value[1];
        } 
    });
    min_input.addEventListener("blur", setMinValue);
}

if(max_input){
    max_input.addEventListener("input", () => {
        let value = max_input.value.replace(/[^0-9]/g, "");
        max_input.value = value;

        if(max_input.value[0] == 0 && max_input.value[1]){
            max_input.value = max_input.value[1];
        } 
    });
    max_input.addEventListener("blur", setMaxValue);
}

