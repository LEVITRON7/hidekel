$( document ).ready(function() {
          
    $('.carousel').carousel({
      interval: 4000, //changes the speed
      pause: 'none',
    })   
         
    if($('.button-share').length){
        $(this).on('click','.button-share', function() {     
            console.log('sharing...' + $(this).val())
            bootbox.dialog({
                title: "Copie el enlace para compartir contenido",
                message: '<input value="'+$(this).val()+'" class="form-control">',
                buttons: {
                    success: {
                        label: "OK",
                        className: "btn-primary",
                        callback: function () {
                            
                        }
                    },

                }
            })
        })
    }
    /* Datetime**/
    if($('#datetimestart').length){
        $('#datetimestart').datetimepicker({
            locale: 'es',
            format: 'dddd, D [de] MMMM [de] YYYY, hh:mma'
        })
    }

    if($('#datetimeend').length){
        $('#datetimeend').datetimepicker({
            locale: 'es',
            format: 'dddd, D [de] MMMM [de] YYYY, hh:mma'
        })
    }
    if($('#burndate').length){
        $('#burndate').datetimepicker({
            locale: 'es',
            format: 'D [de] MMMM [de] YYYY',
        })
    }
    $('#createevent').submit(function(){
            $('#datetime_start').val($('#datetimestart').data('DateTimePicker').date()._d)
            $('#datetime_end').val($('#datetimeend').data('DateTimePicker').date()._d)
     })

    $('#createmember').submit(function(){
            $('#burn').val($('#burndate').data('DateTimePicker').date()._d)
     })

    $("#datetimestart").on("dp.change",function (e) {
        $('#datetimeend').data("DateTimePicker").minDate(e.date)
    })
 
    /*Se inicializa el bootbox para idioma en español*/
    bootbox.setDefaults({
        locale:'es'
    })
    /*Mensaje para el mapa*
    $('#setlocation').on('click',function () {
        bootbox.dialog({
            message: '<div><i class="fa fa-smile-o fa-3x"></i></div><h3>¡Navegue en el mapa y mueva el globo en la posición correcta!'+'</h3>',
            buttons: {
                success: {
                    label: "Ya entendi",
                    className: "btn-primary",
                    callback: function () {

                    }
                }
            }
        })
    })*/
    /*Function para parsear el objecto preview a la vista*/
    function getInitialPreview(n,input){
        var a = input;
        if(( a != 'null') && ( a != undefined ) && ( a != '' )){
            if (n == 0){
                return JSON.parse(a).initialPreview;
            }else{
                return JSON.parse(a).initialPreviewConfig;  
            }
            
        }else{
            return 0;
        }
    }
/**********************************Inputs Files para imagenes y archivos ************************************/
    if($("#input-files").length){
        $("#input-files").fileinput({
            uploadUrl:      "/admin/uploadfiles", // server upload action
            uploadAsync:    false,
            minFileCount:   1,
            maxFileCount:   20,
            maxFileSize:        3072,
            initialPreview: getInitialPreview(0, $('#preview').val()),
            initialPreviewConfig: getInitialPreview(1,$('#preview').val()),
            uploadExtraData: function() {
                return {
                    eventid: $("#event-id").val()   
                };
            }
        })
    }
    if($("#input-file-new").length){
        $("#input-file-new").fileinput({
            minFileCount:   1,
            maxFileCount:   1,
            showUpload: false,
            allowedFileExtensions: ['txt', 'pdf', 'text','doc','docx','pptx','pps','pub','xls','xlsx','mp3'],
        })
    }
    if($("#input-file").length){
        $("#input-file").fileinput({
            minFileCount:   0,
            maxFileCount:   1,
            showUpload: false,
            allowedFileExtensions: ['txt', 'pdf', 'text','doc','docx','pptx','pps','pub','xls','xlsx','mp3'],
            initialPreview: getInitialPreview(0,$('#preview').val()),
            initialPreviewConfig: getInitialPreview(1,$('#preview').val()),
        })
    }
    if($("#input-image-new").length){
        $("#input-image-new").fileinput({
            minFileCount:   1,
            maxFileCount:   1,
            maxFileSize:   3072,
            showUpload: false,
            allowedFileExtensions: ['png','jpeg','jpg','gif','bmp','raw'],
        })
    }
    if($("#input-image").length){
        $("#input-image").fileinput({
            minFileCount:   0,
            maxFileCount:   1,
            maxFileSize:     3072,
            showUpload: false,
            allowedFileExtensions: ['png','jpeg','jpg','gif','bmp','raw'],
            initialPreview: getInitialPreview(0,$('#preview-img').val()),
            initialPreviewConfig: getInitialPreview(1,$('#preview-img').val()),
        })
    }
/**********************************Inputs Files para imagenes y archivos ************************************/
    /*Para proteccion CSFR TOKEN, para el envio de formularios */
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })
/******************************** Evento para agregar un video **************************************/
    $('#submit-video').on('click', function (e){
        var data = $('#input-video').val()
        var event_id = $('#event-id').val()
        var title = $('#input-video-title').val()

        //console.log(data)
        if(ValidURL(data) && title != (null||'')){
            $.ajax({
                type: 'POST',
                url: '/admin/uploadvideos/',
                data: {file:data, event_id: event_id, title:title},
                success: function (data) {
                    console.log(data)
                    var url = data.video.file.replace("watch?v=", "v/")
                    var video = '<tr>' +                
                                  '<th scope="row" id='+ data.video.id +' >'+ data.video.id+'</th>' +                  
                                  '<td>' +
                                    '<iframe width="180" height="120" src="'+ url +'"frameborder="0" allowfullscreenframeborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>' +
                                  '</td>'+
                                  '<td>' +
                                    data.video.title +                                 
                                  '</td>'+
                                  '<td><button class="btn btn-danger delete-video" value='+data.video.id+'>Eliminar</button>'+
                                  '</td>'+
                                '</tr>';
                    $('#preview-videos').append(video)
                }
            })
        }else{
            bootbox.dialog({
                message: '<div><i class="fa fa-frown-o fa-3x"></i></div><h3>Sólo se permiten URL de www.youtube.com, El campo Título no puede estar vacio'+'</h3>',
                buttons: {
                    success: {
                        label: "Ya entendi",
                        className: "btn-primary",
                        callback: function () {
                            $('#input-video').val()
                        }
                    }
                }
            })        
        }    
    })
/******************************** Evento para agregar un video **************************************/

    /*Funcion para eliminar elementos preview de video agregados dinamicamente*/
    $('#preview-videos').on('click','button',function (){
        var id = $(this).val()
        //console.log(id)
        //debugger;
            bootbox.dialog({
                message: '<h3>¿Desea eliminar el video? '+ $('#'+id).find('#id').text() +'</h3>',
                buttons: {
                    danger: {
                      label: "Eliminar",
                      className: "btn-danger",
                      callback: function() {
                        $.ajax({
                            type: 'DELETE',
                            url: '/admin/deletevideo/'+ id,
                            success: function (data) {
                                console.log(data)
                                $('#'+ data.video.id).closest('tr').remove()
                            }
                        })
                      }
                    },
                    success: {
                        label: "Cancelar",
                        className: "btn-default",
                        callback: function(){
                           
                        }
                    }
                }
            })
    })
/***************** Funcion para encontrar algun elemento de un array dentro de un string *****************/
function LocationContainString(string, contain){
    var a;
    contain.forEach(function(element){
        if(string.indexOf(element)!==-1){
            a = element;
        }
    })
    return a;
}
function MessageOfElement(element, id){
            switch(element) {                                        
                case 'club':
                    return '<div><h3> Se eliminarán todos los elementos relacionados al club '+$('#'+id).find('#id').text()+': clases, miembros, materiales, actividades, eventos, multimedia, slides, imágenes, etc, ¿Desea eliminar el club?</h3>';
                break;
                case  'member':
                    return '<div><h3> Se eliminará el miembro: '+$('#'+id).find('#id').text()+', ¿Desea eliminarlo?</h3>';
                break;
                case 'user':
                    return '<div><h3> Se eliminará el usuario: '+$('#'+id).find('#id').text()+', ¿Desea eliminarlo?</h3>';
                break;
                case 'event':
                    return '<div><h3> Se eliminarán los slides relacionados al evento: '+$('#'+id).find('#id').text()+', ¿Desea eliminarlos?</h3>';
                break;
                case 'activitie':
                    return '<div><h3> Se eliminará la multimedia y slides relacionados a la actividad: '+$('#'+id).find('#id').text()+', ¿Desea eliminarlos?</h3>';
                break;
                case 'material':
                    return '<div><h3> Se eliminará el material: '+$('#'+id).find('#id').text()+', ¿Desea eliminarlo?</h3>';
                break;
                case 'materials/type':
                    return '<div><h3> Se eliminarán los materiales relacionados al tipo de material: '+$('#'+id).find('#id').text()+', ¿Desea eliminarlos?</h3>';
                break;
                case 'materials/topic':
                    return '<div><h3> Se eliminarán los materiales relacionados al tópico de material: '+$('#'+id).find('#id').text()+', ¿Desea eliminarlos?</h3>';
                break;
                case 'slide':
                    return '<div><h3> Se eliminará el slide: '+$('#'+id).find('#id').text()+', ¿Desea eliminarlo?</h3>';
                break;
                case 'multimedia':
                    return '<div><h3> Se eliminará la multimedia: '+$('#'+id).find('#id').text()+', ¿Desea eliminarla?</h3>';
                break;
                case 'class':
                    return '<div><h3> Se eliminarán los miembros relacionados a la clase: '+$('#'+id).find('#id').text()+', ¿Desea eliminarlos?</h3>';
                break;
                case 'role':
                    return '<div><h3> Se eliminarán los miembros relacionados a rol: '+$('#'+id).find('#id').text()+', ¿Desea eliminarlos?</h3>';
                break;
                default:                    
                    return '<div><h3>¿Desea eliminar? '+$('#'+id).find('#id').text()+'</h3>';
                break;
            }
}
/*********** Funcion que atiende evento eliminar de todos los elementos asi como su mensaje ***********/
    $('.pagination-div').on('click','.btn-danger',function (e){        
        var id = $(this).val() 
        // e.preventDefault()
        var currentlocation = location.pathname;
        var elements = ['club', 
                        'member',
                        'user',
                        'event',
                        'activitie',
                        'material',
                        'materials/type',
                        'materials/topic',
                        'slide',
                        'multimedia',
                        'class',
                        'role',
                        'ideal']
        var element = LocationContainString(currentlocation,elements)
        var message = MessageOfElement(element, id)

            bootbox.dialog({
                message: message,
                buttons: {
                    danger: {
                      label: "Eliminar",
                      className: "btn-danger",
                      callback: function() {
                        $.ajax({
                            type: 'DELETE',
                            url: location.pathname +'/delete/'+ id,
                            success: function (data) {
                                console.log(data)
                                $('#'+ data.data.id).remove()
                            }
                        }) 
                      }
                    },
                    success: {
                        label: "Cancelar",
                        className: "btn-default",
                        callback: function(){
                           
                        }
                    }
                }
            })
    })
/*********************************Verifica si la URL es de youtube *************************************/
    function ValidURL(str) {
        var pattern = new RegExp(/^(?:(?:https?|http?):\/\/)(?:\S+(?::\S*)?@)?(?:(?!10(?:\.\d{1,3}){3})(?!127(?:\.\d{1,3}){3})(?!169\.254(?:\.\d{1,3}){2})(?!192\.168(?:\.\d{1,3}){2})(?!172\.(?:1[6-9]|2\d|3[0-1])(?:\.\d{1,3}){2})(?:[1-9]\d?|1\d\d|2[01]\d|22[0-3])(?:\.(?:1?\d{1,2}|2[0-4]\d|25[0-5])){2}(?:\.(?:[1-9]\d?|1\d\d|2[0-4]\d|25[0-4]))|(?:(?:[a-z\u00a1-\uffff0-9]+-?)*[a-z\u00a1-\uffff0-9]+)(?:\.(?:[a-z\u00a1-\uffff0-9]+-?)*[a-z\u00a1-\uffff0-9]+)*(?:\.(?:[a-z\u00a1-\uffff]{2,})))(?::\d{2,5})?(?:\/[^\s]*)?$/i)
        if(pattern.test(str) && (str.indexOf("youtube") > -1)) {
            return true;
        } else {
            return false;
        }
    }

    $('#material_type').on('change', function() {
        if($('#material_type option:selected').text() == 'Video'){
            console.log('Selected Video')
            $(".file-input").hide()
            $("#input-video").show()
        }else if($('#material_type option:selected').text() == 'Especialidad'){
            console.log('Selected Especialidad')
             $("#logo-input").show()
             $(".file-input").show()
             $("#input-video").hide()
        }
        else{
            console.log('Selected File')
             $(".file-input").show()
             $("#input-video").hide()
             $("#logo-input").hide()
        }
    })
    if($('#material_type option:selected').length){
        console.log($('#material_type option:selected').text());
        
        if($('#material_type option:selected').text() == 'Especialidad'){
            console.log('Selected Especialidad')
            $("#logo-input").show()
        }
    }
    /*Para formulario agregando material, en caso de ser elegido video*/
/*    if ($('#material_type').val()==1 && $('#input-video').val()==""){
        $(".file-input").hide()
        $("#input-video").show()
    }*/
    $(this).on('change','#select_filter_club', function() {        
        var val = $(this).val()
         console.log('#select_filter_club: ' + val)
        if (val==-2) {
            location.reload()
        }else if(val != ''){
            //$('#select_filter_type').val() = '-1';
            if ($("#form_filter_type").is(":visible")) {
                $('#select_filter_type').val(-1)
                $("#form_filter2").empty()
            }else{
                $("#form_filter_type").show()
            }
            
        }
    })

    $(this).on('change','#select_filter_type', function() {        
        console.log('video')
        var filter_type = $(this).val()
        var filter_club = $('#select_filter_club').val()
        //if (filter_type ==-1) {location.reload()}
        console.log('type: '+ filter_type +' club: '+ filter_club)
        message_searching()
        $.ajax({
            type: 'POST',
            data: {
                filter_type:    filter_type,
                filter_club:    filter_club
            },
            url: location.pathname + '/filter_type',
            success: function (data) {
                 //console.log(data)
                 //console.log(filter_type)
                 if(filter_type != 0){
                    $('#form_filter2').html(data)
                 }else{
                    show_results(data, '#results')
                    $("#form_filter2").empty()
                 }
                
            }
        })
    })

    $(this).on('change','#select_filter_search', function() {
        var filter_search = $(this).val()
        var filter_type =  $('#select_filter_type').val()
        var filter_club = $('#select_filter_club').val()
        console.log('search: '+filter_search +' type: '+filter_type +' club: '+filter_club)
        message_searching()
        $.ajax({
            type: 'POST',
            data: {
                filter_type     :   filter_type,
                filter_search   :   filter_search,
                filter_club     :   filter_club
            },
            url: location.pathname + '/filter_search',
            success: function (data) {
                //console.log(data)
                show_results(data, '#results')
            }
        })
    })

    if(LocationContainString(location.pathname,['/materials/all_of_type'])){
        window.history.pushState("", "Materiales",'/materials')
    };

    //console.log(location.pathname.substr(-1));
    function RemoveLastSlashFromUrl(str) {
        if(str.substr(-1) === '/') {
            window.history.pushState("", "",str.substr(0, str.length - 1))
            //return str.substr(0, str.length - 1);
        }else{
            window.history.pushState("", "",str)
        }        
    }
    RemoveLastSlashFromUrl(location.pathname);
/*    
    $(this).on('click','#submenu_material_type', function () {
        
        console.log('#submenu_material_type')
        //console.log('#submenu_material_type')        
        var material_type = this.children.item().value;     
        //console.log(material_type)
        window.history.pushState("", "Materiales",'/materials')
        $.ajax({
            type: 'POST',
            data: {
                id     :   material_type,
            },
            url: '/materials' + '/type',
            success: function (data) {
                    //console.log(data)
                    var newDoc = document.open("text/html", "replace");
                    newDoc.write(data);
                    newDoc.close();
            }
        })
    })*/

    function show_results(data, element){        
        $(element).empty()
        //$(element).append('<center><h2>Buscando...</h2><img src="/images/loading/loading-md-blue.gif"></center>')
        //$(element).slideUp(2000)
        //setTimeout(function() {
            $(element).html(data)
            $(element).hide()
            $(element).slideDown(0)
        //}, 1000)
    }
    function message_searching(element){
        $(element).empty()
        $(element).append('<center><h2>Buscando...</h2><img src="/images/loading/loading-md-blue.gif"></center>')
    }

    $('#select_club').on('change', function() {
        console.log('club')
        var val = $(this).val()        
        $.ajax({
            type: 'POST',
            data: {
                club_choise:    val
            },
            url: '/admin/members/choise_class_by_club',
            success: function (data) {
                //console.log(data)
                show_results(data, '#form_class')
            }
        })
    })

    $('#select_club_role').on('change', function() {
        console.log('club role')
        var textselect = $('#select_club_role option:selected').text()
        console.log('club role' + textselect)
        if((textselect != 'Capitán') & (textselect != 'Integrante')){
            $.ajax({
                type: 'POST',
                data: {
                    club_choise:    3
                },
                url: '/admin/members/choise_class_by_club',
                success: function (data) {
                    console.log(data)
                    show_results(data, '#form_class')
                }
            })
        }else{
            var club = $('#select_club option:selected').val()
            $.ajax({
                type: 'POST',
                data: {
                    club_choise:    club
                },
                url: '/admin/members/choise_class_by_club',
                success: function (data) {
                    console.log(data)
                    show_results(data, '#form_class')
                }
            })
        }
    })


    $(this).on('change','#select_filter_club_search', function() {
        var filter_club = $(this).val()
         console.log('#select_filter_club_search ' + filter_club)
        if (filter_club ==-2) {
            location.reload()
        }else if(filter_club != ''){
            message_searching()
            $.ajax({
                type: 'POST',
                data: {
                    filter_club   :     filter_club
                },
                url: location.pathname + '/filter_search',
                success: function (data) {
                    //console.log(data)
                    show_results(data, '#results')
                    $('div.CountDown').each(function() {    
                        var $this = $(this), finalDate = $(this).data('countdown')        
                        $this.countdown(finalDate).on('update.countdown', function(event) {
                            $this.html(event.strftime('En %D días %H:%M:%S' ))
                        }).on('finish.countdown',function(){
                            $this.html('Evento en curso...')
                        })
                     }) 
                }
            })
        }
    })

    $(this).on('click','.pagination a',function(e){        
        e.preventDefault()        
        var page = $(this).attr('href').split('page=')[1];    
        $.ajax({
            type: 'GET',
            url: location.pathname +'?page='+ page,
            success: function (data) {
                //console.log(data)                
                $('.pagination-div').html(data)
                location.hash = page;

            $('div.CountDown').each(function() {    
                var $this = $(this), finalDate = $(this).data('countdown')        
                $this.countdown(finalDate).on('update.countdown', function(event) {
                    $this.html(event.strftime('En %D días %H:%M:%S' ))
                }).on('finish.countdown',function(){
                    $this.html('Evento en curso...')
                })
             })             
            }
        })
    })    

    $('.img-max-show,.member-photo').hover(function(){ 
        var w = this.width - 107;
        var h = this.height - 34;
        $('#a-show-img').css('margin-top',(h/2)+'px')
        $('#a-show-img').css('margin-left',(w/2)+'px')
    })


/*      var videos = JSON.parse($('#json-videos').val())
        console.log(videos)
        var videos_gallery = [];
        $.each(videos, function() {
            videos_gallery.push({
                title: this.title,
                type:'text/html',
                youtube: this.file.replace('https://www.youtube.com/watch?v=',''), 
                poster: 'http://img.youtube.com/vi/'+this.file.replace('https://www.youtube.com/watch?v=','')+'/hqdefault.jpg'})
        })
    $('#video-gallery-button').on('click', function (event) {
        //event.preventDefault()
        var videos = JSON.parse($('#json-videos').val())
        console.log(videos)
        var videos_gallery = [];
        $.each(videos, function() { 
            videos_gallery.push({
                title: this.title,
                type:'text/html',
                youtube: this.file.replace('https://www.youtube.com/watch?v=',''), 
                poster: 'http://img.youtube.com/vi/'+this.file.replace('https://www.youtube.com/watch?v=','')+'/hqdefault.jpg'})
        })
        //console.log(videos_gallery)        
        blueimp.Gallery(videos_gallery,{container: '#blueimp-video-carousel',carousel:true})
    //})
    blueimp.Gallery(
    videos_gallery, {
        container: '#blueimp-video-carousel',
        carousel: true
    })
*/
    if ($('#json-videos').val() != undefined) {
        var videos = JSON.parse($('#json-videos').val())
        console.log(videos)
        var videos_gallery = [];
        $.each(videos, function() { 
            videos_gallery.push(
                '<div class="img-responsive" style="float:left;margin:10px;"> <h3 style="margin-top:5px;">'+this.title+'</h3><iframe class="video-youtube" width="320" height="240" src="https://www.youtube.com/embed/'+ this.file.replace('https://www.youtube.com/watch?v=','')+'"></iframe></div>'
                )
        })
        $('#frame-videos').html(videos_gallery)
    };

    $('div.CountDown').each(function() {    
        var $this = $(this), finalDate = $(this).data('countdown')        
        $this.countdown(finalDate).on('update.countdown', function(event) {
            $this.html(event.strftime('En %D días y %H:%M:%S'))
        }).on('finish.countdown',function(){
            $this.html('Evento en curso...')
        })
     })

    console.log('main.js is load')
})


