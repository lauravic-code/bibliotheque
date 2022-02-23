let search_bar= document.querySelector('#input_search')

search_bar.addEventListener('focus',function(){
    this.value = "";
 });
 

search_bar.addEventListener('blur',function(){
   this.value = "Saisissez votre recherche.";
});

