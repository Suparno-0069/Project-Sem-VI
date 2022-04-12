document.onscroll = () =>{
    if(window.scrollY > 80){
        document.querySelector('.navbar').classList.add('actual');
    }else{
        document.querySelector('.navbar').classList.remove('actual');
    }
};