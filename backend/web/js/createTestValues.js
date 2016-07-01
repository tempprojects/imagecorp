jQuery( document ).ready(function(){
    var form=$(".form_section").first().clone();
    $("#add_new").click(function(e){
        
        //changes classes
        form.find("div[class^='field-testvalues'], div[class*='field-testvalues']").each(function(){
            $(this).prop('class', function(index, id) {
                  return id.replace(/(field-testvalues.*)\d\d?(.*)/g,"$1" +formCnt+ "$2");
            });
        });
        
        //changes ids
        form.find("input[id^='testvalues-'], textarea[id^='testvalues-']").each(function(){
            $(this).prop('id', function(index, id) {
                return id.replace(/(testvalues-.*)\d\d?(.*)/g,"$1" +formCnt+ "$2");
            });
        });
        
        //changes fors
        form.find("label[for^='testvalues-']").each(function(){
            $(this).prop('for', function(index, id) {
                return id.replace(/(testvalues-.*)\d\d?(.*)/g,"$1" +formCnt+ "$2");
            });
        });
        
        //changes names
        form.find("input[name^='TestValues'], textarea[name^='TestValues']").each(function(){
            $(this).prop('name', function(index, id) {
                return id.replace(/(TestValues.*)\d\d?(.*)/g,"$1" +formCnt+ "$2");
            });
        });
       

       $("#new_section").before(form);
       form= $(".form_section").last().clone();
       
       $(".form_section").last().find('.has-success').each(function(){
           $(this).removeClass('has-success');
       });
       $(".form_section").last().find('.row div input').each(function(){
           $(this).val("");
       });
       $(".form_section").last().find('.row div textarea').each(function(){
           $(this).html("");
       });
       
       $(".form_section").last().find('.help-block').each(function(){
           $(this).html("");
       });
       $(".form_section").last().attr('data-testvalue', "");
       formCnt++;
    });

    $('body').delegate(".delete_button", 'click', function(e){
        e.preventDefault();
        var testvalue  = $(this).parents('.form_section').data('testvalue'),
        this_click=this;
        if(testvalue){
            console.log(testvalue);
            $ajax= $.ajax({
                method: "POST",
                url: $(this).attr('href'),
            });
            $ajax.done(function( html ) {
                          $(this_click).parents('.form_section').remove();
                      });
        }
        else{
            $(this_click).parents('.form_section').remove();
        }
    });
});