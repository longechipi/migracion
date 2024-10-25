$(function(){
    $(document).bind("contextmenu",function(e){
        return false;
    });
});

onkeydown = e => {
    const tecla = e.code;
    if (e.ctrlKey) {
      if (tecla === 'KeyU' || tecla === 'KeyS') {
        e.preventDefault();
        e.stopPropagation();
      }
    }
};