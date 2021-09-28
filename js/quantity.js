const counter = document.getElementById("quantity");
let counterValue = counter.value;

function handleCounterPlus(){  
    counter.value = ++counterValue;
}

function handleCounterMin(){
    if(counterValue <= 1){
        counterValue = 1;
    }
    else{
        counter.value = --counterValue;
    }
}