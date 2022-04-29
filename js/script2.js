document.onscroll = () =>{
    if(window.scrollY > 80){
        document.querySelector('.nav1').classList.add('actual');
    }else{
        document.querySelector('.nav1').classList.remove('actual');
    }
};