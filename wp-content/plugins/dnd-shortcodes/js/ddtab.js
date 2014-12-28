jQuery(document).ready(function($) {
    "use strict";

    if(!$('body').hasClass('post-type-attachment')){

        var scrollbar_options = {
            theme:'dark-thin',
            scrollInertia: 500
        };

        var tinymce_options = {
            height: 300,
            menubar : false,
            element_format : "html",
            forced_root_block : false,
            toolbar: "bold italic underline fontsizeselect | alignleft aligncenter alignright alignjustify | bullist numlist indent outdent | subscript superscript strikethrough forecolor backcolor hr blockquote link unlink image table charmap | searchreplace | removeformat undo redo code",
            plugins: "paste code link hr image charmap searchreplace table textcolor",
            paste_as_text: true,
        };

        var $dd_classic_editor = $("#postdivrich");
        
        $("#content-html").before( '<a id="dnd_content-dd" class="wp-switch-editor switch-dd">'+dnd_from_WP.drag_and_drop+'</a>' );
        
        $dd_classic_editor.after('<div id="dnd_dragdrop"><div id="dnd_tools"></div></div>');

        var $dd_tab_content = $("#dnd_dragdrop");

        $dd_tab_content.before( '<div id="dd_classic_and_dnd_tabs"><a class="dd_switch_editor switch-dd">'+dnd_from_WP.drag_and_drop+'</a><a id="dnd_content-classic" class="dd_switch_editor switch-classic">'+dnd_from_WP.classis_editor+'</a></div>' );

        var layout_options_out = '';
        if(dnd_from_WP.saved_layouts!==null){
            var saved_layouts = dnd_from_WP.saved_layouts.split('|');
            layout_options_out ='<option value="">'+dnd_from_WP.layout_select_saved_first+'</option>';
            var index;
            if(saved_layouts!=''){
                for (index = 0; index < saved_layouts.length; ++index) {
                    layout_options_out += '<option value="'+saved_layouts[index]+'">'+saved_layouts[index]+'</option>';
                }
            }
        }

        $dd_tab_content.append('<div id="dnd_dragdrop_empty"><select name="dnd_load_layout" id="dnd_load_layout">'+layout_options_out+'</select><br>'+dnd_from_WP.layout_select_saved_second+'<br><a id="dnd_add_section_second">'+dnd_from_WP.add_section+'</a></div>');
        
        $("#wp-content-media-buttons").append('<a id="dnd_shortcode_button" class="button insert-shortcode" title="'+dnd_from_WP.add_edit_shortcode+'">'+dnd_from_WP.add_edit_shortcode+'</a>');

        var $dd_tab = $("#dnd_content-dd");
        var $dd_tab_tools = $("#dnd_tools");
        var $dd_shortcode_button = $("#dnd_shortcode_button");
        var $wp_content_editor = $("#postdivrich");
        var dom = tinymce.DOM;
        $dd_tab_content.hide();
        $dd_tab_tools.append('<input type="button" id="dnd_add_section" class="dnd_button" title="" value="'+dnd_from_WP.add_section+'">');
        $dd_tab_tools.append('<input type="button" id="dnd_layout_save" class="dnd_button" title="" value="'+dnd_from_WP.layout_save+'">');
        $dd_tab_tools.append('<input type="button" id="dnd_layout_delete" class="dnd_button" title="" value="'+dnd_from_WP.layout_delete+'">');
        $dd_tab_tools.append('<p id="dnd_temp" style="display:none;"></p>');
        $dd_tab_tools.append('<a id="dnd_add_section_bottom">'+dnd_from_WP.add_section+'</a>');
        $dd_tab_content.sortable({ 
            items: "> .dnd_content_section", 
            handle: ".dnd_section_handler", 
            revert: true, 
            axis: "y", 
            cursor: "move", 
            tolerance: "pointer",
            stop: function(){
                dnd_rebuild_widths();
                dnd_write_from_dnd_to_editor();
            },
            over: dnd_rebuild_widths
        });
        $dd_tab_content.disableSelection();


        if($.cookie('dnd_dd_activated') === 'activated'){
            dnd_activate_dd();
        }


        $dd_tab.click(function(e){
            e.preventDefault();
            tinymce.triggerSave();
            dnd_activate_dd();
        });


        $("#dnd_content-classic").click(function(e){
            e.preventDefault();
            $dd_tab_content.hide();
            $('#dd_classic_and_dnd_tabs').hide();
            $dd_shortcode_button.show();
            $dd_classic_editor.show();
            //scroll events fixes classic editor when initialized while display:none on it
            $(window).trigger('scroll');
            setTimeout(function(){
                $(window).trigger('scroll');
            },100);
            setTimeout(function(){
                $(window).trigger('scroll');
            },200);
            setTimeout(function(){
                $(window).trigger('scroll');
            },400);
            $.removeCookie('dnd_dd_activated', { path: '/' });
        });


        $dd_shortcode_button.click(function(e){
            e.preventDefault();
            var selected_content = '';
            if($('#wp-content-wrap').hasClass('tmce-active')){
                selected_content = tinyMCE.activeEditor.selection.getContent({format : 'html'});
            }
            else{
                var textComponent = document.getElementById('content');
                if (document.selection !== undefined){
                    textComponent.focus();
                    var sel = document.selection.createRange();
                    selected_content = sel.text;
                }
                else if (textComponent.selectionStart !== undefined){
                    var startPos = textComponent.selectionStart;
                    var endPos = textComponent.selectionEnd;
                    selected_content = textComponent.value.substring(startPos, endPos);
                }
            }
            selected_content = selected_content.replace(/(\r\n|\n|\r|\t)/gm,'').replace(/\s+/g,' ').replace(/<br \/> /g,'').replace(/\]\s\[/g,'][');

            var exploded = selected_content.split(' ');
            exploded = exploded[0].split(']');
            var shortcode = exploded[0].substring(1);
            selected_content = htmlspecialchars(selected_content,'ENT_QUOTES');
            selected_content = encodeURIComponent(selected_content);
            
            if(shortcode===''){
                var fancybox_href = dnd_from_WP.plugins_url + '/admin/shortcode_selector.php?editor=text';
            }
            else{
                var fancybox_href = dnd_from_WP.plugins_url + '/admin/shortcode_attributes.php?action=edit&shortcode='+shortcode+'&selected_content=' + selected_content;
            }
            $.fancybox({
                'width':'95%',
                'height':'100%',
                'scrolling':'no',
                'autoDimensions':false,
                'transitionIn':'none',
                'transitionOut':'none',
                'type':'ajax',
                'href':fancybox_href,
                'titleShow':false,
                'onComplete' : function(){
                    $('.attributes_scroll_div').mCustomScrollbar(scrollbar_options);
                    $('.dnd-colorpicker').wpColorPicker();
                    $('.textarea_tinymce').each(function(){
                        tinymce_options.selector = '#'+$(this).attr('id');
                        tinymce.init(tinymce_options);
                    });
                    $("#dnd_shortcodes_list .dnd_select_shortcode").filter(":even").addClass('even');
                    $('#dnd_shortcode_selector .clear_field').hide();
                    if($('#dnd_shortcodes_list').length>0){
                        $('#dnd_shortcodes_list').css('height', '-=40px').mCustomScrollbar(scrollbar_options);
                    }
                }
            });
        });


        $("#dnd_add_section, #dnd_add_section_second, #dnd_add_section_bottom").click(function(e){
            e.preventDefault();
            $("#dnd_dragdrop_empty").hide();
            $dd_tab_content.append('<div class="dnd_content_section" data-shortcode="[section_dd]"><span class="dnd_section_handler" title="'+dnd_from_WP.rearange_sections+'"></span><span class="dnd_section_delete" title="'+dnd_from_WP.delete_section+'"></span><span class="dnd_section_duplicate" title="'+dnd_from_WP.duplicate_section+'"></span><span class="dnd_section_edit" title="'+dnd_from_WP.edit_section+'"></span><span class="dnd_remove_column dnd_disabled" title="'+dnd_from_WP.remove_column+'"></span><span class="dnd_add_column" title="'+dnd_from_WP.add_column+'"></span><div class="dnd_column" data-shortcode="[column_dd span=\'12\']" data-span="12"><span class="dnd_add_element" title="'+dnd_from_WP.add_element+'"></span><span class="dnd_column_edit" title="'+dnd_from_WP.edit_column+'"></span><p>12/12</p></div></div>');
            dnd_make_elements_sortable();
            dnd_rebuild_widths();
            dnd_write_from_dnd_to_editor();
        });


        $("#dnd_layout_save").click(function(e){
            e.preventDefault();
            var name = prompt(dnd_from_WP.layout_name,"");
            if (name!=null && name!=''){
                var data = {
                    action: 'ABdevDND_save_layout',
                    name: name,
                    layout: $('#content').val()
                };
                $.post(ajaxurl, data, function(response) {
                    $('#dnd_load_layout').append('<option value="'+name+'">'+name+'</option>');
                    alert(response);
                });
            }
        });


        $("#dnd_layout_delete").click(function(e){
            e.preventDefault();
            var name = prompt(dnd_from_WP.layout_name_delete,"");
            if (name!=null && name!=''){
                var data = {
                    action: 'ABdevDND_delete_layout',
                    name: name,
                };
                $.post(ajaxurl, data, function(response) {
                    $('#dnd_load_layout option[value="'+name+'"]').remove();
                    alert(response);
                });
            }
        });


        $("#dnd_load_layout").change(function(){
            var $select = $(this);
            $(this).parent().append('<div class="dnd_loader"></div>');
            var selected_layout = $(this).val();
            if(selected_layout!=''){
                var data = {
                    action: 'ABdevDND_load_layout',
                    selected_layout: selected_layout,
                };
                $.post(ajaxurl, data, function(response) {
                    dnd_generate_dnd_from_content(response);
                    dnd_write_from_dnd_to_editor();
                    $select.find('option[value=""]').attr("selected",true);
                    $('.dnd_loader').remove();
                });
            }
        });


        $(document).on('click', '.dnd_add_column' , function(e) {
            e.preventDefault();
            if($(this).hasClass('dnd_disabled')){
                return;
            }
            var $parent = $(this).parent();
            $parent.append('<div class="dnd_column" data-shortcode="[column_dd span=\'1\']"><span class="dnd_add_element" title="'+dnd_from_WP.add_element+'"></span><span class="dnd_column_edit" title="'+dnd_from_WP.edit_column+'"></span></div>');
            var count = $parent.children('.dnd_column').length;
            if(count==12){
                $(this).addClass('dnd_disabled');
            }
            $parent.find('.dnd_remove_column').removeClass('dnd_disabled');
            var column_width = Math.floor($parent.width()/count);
            $parent.children('.dnd_column').each(function(){
                $(this).css("width", column_width+"px");
            });
            dnd_out_of_grid($parent);
            dnd_columns_spans($parent);
            var grid = Math.floor(dnd_total_width($parent)/12);
            $parent.children('.dnd_column.ui-resizable').resizable("option", {
                grid: [ grid, 10 ],
                minWidth: grid
            });
            dnd_make_elements_resizable();
            dnd_make_elements_sortable();
            dnd_rebuild_widths();
            dnd_write_from_dnd_to_editor();
        });


        $(document).on('click', '.dnd_remove_column' , function(e) {
            e.preventDefault();
            if($(this).hasClass('dnd_disabled')){
                return;
            }
            var $parent = $(this).parent();
            var $last_column = $parent.find('.dnd_column:last-child');
            $last_column.find('.dnd_element').each(function(){
                $(this).detach().appendTo($last_column.prev());
            });
            $last_column.remove();
            var count = $parent.children('.dnd_column').length;
            $parent.find('.dnd_add_column').removeClass('dnd_disabled');
            var column_width = Math.floor($parent.width()/count);
            $parent.children('.dnd_column').each(function(){
                $(this).css("width", column_width+"px");
            });
            if(count==1){
                $(this).addClass('dnd_disabled');
                $parent.children('.dnd_column').resizable("destroy");
            }
            else{
                $parent.children('.dnd_column:last-child').resizable("destroy");
            }
            dnd_out_of_grid($parent);
            dnd_columns_spans($parent);
            dnd_rebuild_widths();
            dnd_write_from_dnd_to_editor();
        });


        // delete section or element
        $(document).on('click', '.dnd_section_delete, .dnd_element_delete' , function(e) {
            e.preventDefault();
            var r = confirm(dnd_from_WP.are_you_sure);
            if (r === true){
                var $parent = $(this).parent();
                var is_section = $parent.hasClass('dnd_content_section');
                var no_of_sections = $parent.siblings(".dnd_content_section").length;
                $parent.animate({
                    height:"0px", 
                    minHeight:"0px", 
                    padding:"0px", 
                    marginTop:"0px", 
                    marginBottom:"0px", 
                    border:"0px", 
                    opacity:"0"
                }, 400, function(){
                    $parent.remove();
                    dnd_rebuild_widths();
                    dnd_write_from_dnd_to_editor();
                    if(no_of_sections === 0 && is_section){
                        $("#dnd_dragdrop_empty").show();
                    }
                });
            }
        });


        // duplicate element
        $(document).on('click', '.dnd_element_duplicate' , function(e) {
            e.preventDefault();
            var $parent = $(this).parent();
            $parent.clone().insertAfter($parent);
            dnd_rebuild_widths();
            dnd_write_from_dnd_to_editor();
        });


        // duplicate section
        $(document).on('click', '.dnd_section_duplicate' , function(e) {
            e.preventDefault();
            var $parent = $(this).parent();
            $parent.clone().insertAfter($parent);
            var $new_section = $parent.next();
            $new_section.find('.ui-resizable-handle').remove();
            dnd_out_of_grid($new_section);
            dnd_columns_spans($new_section);
            var grid = Math.floor(dnd_total_width($new_section)/12);
            dnd_make_elements_resizable();
            $new_section.children('.dnd_column.ui-resizable').resizable("option", {
                grid: [ grid, 10 ],
                minWidth: grid
            });
            dnd_make_elements_sortable();
            dnd_rebuild_widths();
            dnd_write_from_dnd_to_editor();
        });


        // add element
        $(document).on('click', '.dnd_add_element' , function(e) {
            e.preventDefault();
            $('.clicked_column').removeClass('clicked_column');
            var $column = $(this).parent();
            $column.addClass('clicked_column');
            $.fancybox({
                'width':'95%',
                'height':'100%',
                'scrolling':'no',
                'autoDimensions':false,
                'transitionIn':'none',
                'transitionOut':'none',
                'type':'ajax',
                'href': dnd_from_WP.plugins_url + '/admin/shortcode_selector.php?editor=dnd',
                'titleShow':false,
                'onComplete' : function(){
                    $('.attributes_scroll_div').mCustomScrollbar(scrollbar_options);
                    $('.dnd-colorpicker').wpColorPicker();
                    $('.textarea_tinymce').each(function(){
                        tinymce_options.selector = '#'+$(this).attr('id');
                        tinymce.init(tinymce_options);
                    });
                    $("#dnd_shortcodes_list .dnd_select_shortcode").filter(":even").addClass('even');
                    $('#dnd_shortcode_selector .clear_field').hide();
                    $('#dnd_shortcodes_list').css('height', '-=40px').mCustomScrollbar(scrollbar_options);
                }
            });
        });


        $(document).on('click', '.dnd_select_shortcode' , function(e) {
            e.preventDefault();
            $.fancybox.showActivity();
            $('.selected_shortcode').removeClass('selected_shortcode');
            $(this).addClass('selected_shortcode');
            var selected_shortcode = $(this).data('shortcode');
            var $dnd_shortcode_attributes_inner = $('#dnd_shortcode_attributes_inner');
            $dnd_shortcode_attributes_inner.empty();
            $.ajax({
              url: dnd_from_WP.plugins_url + '/admin/shortcode_attributes.php?action=new&shortcode=' + selected_shortcode,
            }).done(function( data ) {
                $dnd_shortcode_attributes_inner.html(data);
                $('.dnd-colorpicker').wpColorPicker();
                $('.textarea_tinymce').each(function(){
                    if($(this).css('display')!=='none'){
                        tinymce_options.selector = '#'+$(this).attr('id');
                        tinymce.init(tinymce_options);
                    }
                });
                $('.attributes_scroll_div').mCustomScrollbar("scrollTo","top");
                $.fancybox.hideActivity();
            });
        });



        // Add child
        $(document).on('click', '#dnd_shortcode_add_child', function(e) {
            e.preventDefault();
            var $last_child = $('.dnd_shortcode_child:last');
            $last_child.clone().insertAfter($last_child);
            var $new_child = $last_child.next();
            var $picker_field = $new_child.find('.wp-picker-container .wp-picker-input-wrap .dnd-colorpicker').clone();
            $new_child.find('.wp-picker-container').parent().empty().append($picker_field);
            var $inserted_title_number = $new_child.find('h4 span');
            $inserted_title_number.text(parseInt($inserted_title_number.text(), 10) + 1);
            $('.dnd-colorpicker').wpColorPicker();

            var $cloned_editor = $new_child.find(".mce-tinymce");
            var $textarea = $cloned_editor.next("textarea");
            var textarea_id = $textarea.attr('id')+'_'+parseInt($inserted_title_number.text(), 10) + 1;
            $textarea.insertBefore($cloned_editor).show().attr('id', textarea_id);
            $cloned_editor.remove();

            tinymce_options.selector = '#'+textarea_id;
            tinymce.init(tinymce_options);

            $('.attributes_scroll_div').mCustomScrollbar("scrollTo","bottom");
        });

        // Remove child
        $(document).on('click', '.dnd_child_remove_link', function(e) {
            e.preventDefault();
            var $parent = $(this).parents('.dnd_shortcode_child');
            if($parent.parent().children('.dnd_shortcode_child').length > 1){
                $parent.remove();
                $('.attributes_scroll_div').mCustomScrollbar("scrollTo","bottom");
            }
            else{
                $parent.find('input,textarea').val('');
            }
        });


        //filter shortcodes
        $(document).on( "keyup", '#dnd_shortcode_selector_filter', function() {
            var value = $(this).val().toLowerCase();
            if (value === ''){
                $('#dnd_shortcode_selector .clear_field').hide();
            }
            else{
                $('#dnd_shortcode_selector .clear_field').show();
            }
            var i = 0;
            $("#dnd_shortcodes_list .dnd_select_shortcode").each(function() {
                $(this).removeClass('even');
                var text = $(this).text().toLowerCase();
                if (text.search(value) > -1) {
                    $(this).show();
                    if(i++ % 2 === 0){
                        $(this).addClass('even');
                    }
                }
                else {
                    $(this).hide();
                }
            });
        });



        $(document).on( "click", '#dnd_shortcode_selector .clear_field', function(e) {
            e.preventDefault();
            $('#dnd_shortcode_selector_filter').val('').focus();
            $(this).hide();
            $("#dnd_shortcode_selector .dnd_select_shortcode").each(function() {
                $(this).show().removeClass('even');
            });
            $("#dnd_shortcode_selector .dnd_select_shortcode").filter(":even").addClass('even');
        });



        // ******************* add/edit element *******************
        $(document).on( "click", '.dnd_element_edit', function() {
            var $parent = $(this).parent();
            var selected_content = $parent.data('shortcode');
            selected_content = selected_content.replace('\r\n','');
            var exploded = selected_content.split(' ');
            exploded = exploded[0].split(']');
            var shortcode = exploded[0].substring(1);
            $('.editing_element').removeClass('editing_element');
            $parent.addClass('editing_element');
            selected_content = htmlspecialchars(selected_content,'ENT_QUOTES');
            selected_content = encodeURIComponent(selected_content);
            $.fancybox({
                'height':'100%',
                'width':'70%',
                'scrolling':'no',
                'autoDimensions':false,
                'transitionIn':'elastic',
                'transitionOut':'elastic',
                'titleShow':false,
                'orig': $parent,
                'type':'ajax',
                'ajax' : {
                    type    : "POST",
                    data    : 'selected_content='+selected_content
                },
                'href' : dnd_from_WP.plugins_url + '/admin/shortcode_attributes.php?action=edit&shortcode='+shortcode,
                'onComplete' : function(){
                    $('.attributes_scroll_div').mCustomScrollbar(scrollbar_options);
                    $('.dnd-colorpicker').wpColorPicker();
                    
                    $('.textarea_tinymce').each(function(){
                        tinymce_options.selector = '#'+$(this).attr('id');
                        tinymce.init(tinymce_options);
                    });

                }
            });
        });
        $(document).on('click', '#dnd_insert_shortcode, #dnd_save_changes', function(e) {
            e.preventDefault();
            tinymce.triggerSave();
            var action = $('#dnd_action').val();
            var selected_shortcode = $('#dnd_shortcode').val();
            var shortcode_title = $('#dnd_shortcodes_list').find('.selected_shortcode .item-title').text();
            var ABdevDND_3rd_party = dnd_from_WP.ABdevDND_3rd_party;
            ABdevDND_3rd_party = ABdevDND_3rd_party.split(',');
            var dnd_shortcode_child_name = $('#dnd_shortcode_child_name').val();
            var output = '[' + selected_shortcode;
            $('.dnd_shortcode_attributes .dnd_shortcode_attribute').each( function() {
                if( ( $(this).attr('type') == 'checkbox' && $(this).is(':checked') ) || ($(this).attr('type') !== 'checkbox' &&  $(this).val() !== '' )){
                    output += ' ' + $(this).attr('name') + "='" + $(this).val().replace(/'/g, '&rsquo;') + "'" ;
                }
            });
            output += ']';
            // children
            var count_children=0;
            var child_element_content = '';
            $('.dnd_shortcode_child').each(function() {
                output += '[' + dnd_shortcode_child_name;
                $(this).find('.dnd_shortcode_attribute').each(function() {
                    if( ( $(this).attr('type') == 'checkbox' && $(this).is(':checked') ) || ($(this).attr('type') !== 'checkbox' &&  $(this).val() !== '' )){
                        output += ' ' + $(this).attr('name') + "='" + $(this).val().replace(/'/g, '&rsquo;')  + "'" ;
                    }
                });
                output += ']';
                output += (($(this).find('.dnd_shortcode_child_content').val()!==undefined) ? $(this).find('.dnd_shortcode_child_content').val().replace(/'/g, '&rsquo;') : '') + '[/' + dnd_shortcode_child_name + ']';
                count_children++;


                child_element_content += ($(this).find('.dnd_shortcode_child_content').val()!==undefined) ? $(this).find('.dnd_shortcode_child_content').val()+' ' : '';

            });
            // content and wrap shortcode
            if (count_children === 0){
                output += (($('.dnd_shortcode_content').val()!==undefined) ? $('.dnd_shortcode_content').val().replace(/'/g, '&rsquo;') : '') + '[/' + selected_shortcode + ']';
            }
            else{
                output += '[/' + selected_shortcode + ']';
            }
            output=output.replace(/"/g, '*quot*');
            $.fancybox.close();
            if($dd_tab_content.is(':visible')){
                    var element_content = child_element_content + (($('.dnd_shortcode_content').val()!==undefined) ? $('.dnd_shortcode_content').val() : '');
                    element_content = $('<div>'+element_content.replace(/\[/g,' <').replace(/\]/g,'> ')+'</div>').text().replace(/[^\w\s]/g, '').substring(0, 200);
                if(action==='new'){
                    element_content = (element_content!=='') ? '<span class="element_excerpt"> - '+element_content+'...</span>' : '';
                    $('.clicked_column').find('.dnd_add_element').before('<div class="dnd_element" title="'+shortcode_title+'" data-shortcode="'+output+'"><span class="element_name">'+shortcode_title+element_content+'</span><span class="dnd_element_delete" title="'+dnd_from_WP.delete_element+'"></span><span class="dnd_element_duplicate" title="'+dnd_from_WP.duplicate_element+'"></span><span class="dnd_element_edit" title="'+dnd_from_WP.edit_element+'"></span></div>');
                    $('.clicked_column').removeClass('clicked_column');
                    dnd_rebuild_widths();
                }
                else if(action==='edit'){
                    element_content = (element_content!=='') ? ' - '+element_content+'...' : '';
                    $('.editing_element').find('.element_excerpt').html(element_content);
                    $('.editing_element').data('shortcode',output).removeClass('editing_element');
                }
                dnd_write_from_dnd_to_editor();
            }
            else{
                window.send_to_editor(output);
            }
        });
        // ******************* end add/edit element *******************






        // ******************* edit column *******************
        $(document).on('click', '.dnd_column_edit' , function(e) {
            e.preventDefault();
            var $column = $(this).parent();
            $('.editing_column').removeClass('editing_column');
            $column.addClass('editing_column');
            var selected_content = $column.data('shortcode');
            selected_content = selected_content.replace('\r\n','');
            var exploded = selected_content.split(' ');
            exploded = exploded[0].split(']');
            var shortcode = exploded[0].substring(1);
            selected_content = htmlspecialchars(selected_content,'ENT_QUOTES');
            selected_content = encodeURIComponent(selected_content);
            $.fancybox({
                'height':'70%',
                'width':'60%',
                'scrolling':'no',
                'autoDimensions':false,
                'transitionIn':'elastic',
                'transitionOut':'elastic',
                'titleShow':false,
                'orig': $column,
                'type':'ajax',
                'ajax' : {
                    type    : "POST",
                    data    : 'selected_content='+selected_content
                },
                'href' : dnd_from_WP.plugins_url + '/admin/shortcode_attributes.php?action=edit&type=column&shortcode='+shortcode,
                'onComplete' : function(){
                    $('.attributes_scroll_div').mCustomScrollbar(scrollbar_options);
                    $('.dnd-colorpicker').wpColorPicker();
                    
                    $('.textarea_tinymce').each(function(){
                        tinymce_options.selector = '#'+$(this).attr('id');
                        tinymce.init(tinymce_options);
                    });

                }
            });
        });
        $(document).on('click', '#dnd_save_column_settings' , function(e) {
            e.preventDefault();
            var $editing_column = $('.editing_column');
            var current_span = $editing_column.data('span');
            var column_shortcode_output = "[column_dd span='"+current_span+"'";
            $('.dnd_shortcode_attributes .dnd_shortcode_attribute').each( function() {
                if(($(this).attr('type')=='checkbox' && $(this).is(':checked')) || ($(this).attr('type')!=='checkbox' &&  $(this).val() !== '' )){
                    column_shortcode_output += ' ' + $(this).attr('name') + "='" + $(this).val().replace(/'/g, '&rsquo;') + "'" ;
                }
            });
            column_shortcode_output += ']';
            $editing_column.data('shortcode',column_shortcode_output).removeClass('editing_column');
            $.fancybox.close();
            dnd_write_from_dnd_to_editor();
        });
        // ******************* end edit column *******************



        // ******************* edit section *******************
        $(document).on('click', '.dnd_section_edit' , function(e) {
            e.preventDefault();
            var $section = $(this).parent();
            $('.editing_section').removeClass('editing_section');
            $section.addClass('editing_section');
            var selected_content = $section.data('shortcode');
            selected_content = selected_content.replace('\r\n','');
            var exploded = selected_content.split(' ');
            exploded = exploded[0].split(']');
            var shortcode = exploded[0].substring(1);
            selected_content = htmlspecialchars(selected_content,'ENT_QUOTES');
            selected_content = encodeURIComponent(selected_content);
            $.fancybox({
                'height':'70%',
                'width':'60%',
                'scrolling':'no',
                'autoDimensions':false,
                'transitionIn':'elastic',
                'transitionOut':'elastic',
                'titleShow':false,
                'orig': $section,
                'type':'ajax',
                'ajax' : {
                    type    : "POST",
                    data    : 'selected_content='+selected_content
                },
                'href' : dnd_from_WP.plugins_url + '/admin/shortcode_attributes.php?action=edit&type=section&shortcode='+shortcode,
                'onComplete' : function(){
                    $('.attributes_scroll_div').mCustomScrollbar(scrollbar_options);
                    $('.dnd-colorpicker').wpColorPicker();
                    
                    $('.textarea_tinymce').each(function(){
                        tinymce_options.selector = '#'+$(this).attr('id');
                        tinymce.init(tinymce_options);
                    });

                }
            });
        });
        $(document).on('click', '#dnd_save_section_settings' , function(e) {
            e.preventDefault();
            var $editing_section = $('.editing_section');
            var section_title = '';
            var section_shortcode_output = "[section_dd";
            $('.dnd_shortcode_attributes .dnd_shortcode_attribute').each( function() {
                if(($(this).attr('type')=='checkbox' && $(this).is(':checked')) || ($(this).attr('type')!=='checkbox' &&  $(this).val() !== '' )){
                    section_shortcode_output += ' ' + $(this).attr('name') + "='" + $(this).val().replace(/'/g, '&rsquo;') + "'" ;
                    if( $(this).attr('name')==='section_title'){
                        section_title = $(this).val().replace(/'/g, '&rsquo;');
                    }
                }
            });
            section_shortcode_output += ']';
            $editing_section.find('.dnd_section_title').html(section_title);
            $editing_section.data('shortcode',section_shortcode_output).removeClass('editing_section');

            $.fancybox.close();
            dnd_write_from_dnd_to_editor();
        });
        // ******************* end edit section *******************



        var custom_uploader;
        $(document).on('click', '.upload_image_button' , function(e) {
            e.preventDefault();
            var $input_field = $(this).prev();
            custom_uploader = wp.media.frames.file_frame = wp.media({
                title: dnd_from_WP.choose_image,
                button: {
                    text: dnd_from_WP.use_image
                },
                multiple: false
            });
            custom_uploader.on('select', function() {
                var attachment = custom_uploader.state().get('selection').first().toJSON();
                $input_field.val(attachment.url);
            });
            custom_uploader.open();
        });



        $(window).resize(function() {
            dnd_rebuild_widths();
        });
        
        $(window).load(function() {
            dnd_rebuild_widths();
        });

    }


    function dnd_activate_dd(){
        $dd_classic_editor.hide();
        $dd_shortcode_button.hide();
        $dd_tab_content.show();
        $.cookie('dnd_dd_activated', 'activated', { path: '/' });
        dnd_generate_dnd_from_content();
        $('#dd_classic_and_dnd_tabs').show();
    }


    function dnd_make_elements_sortable(){
        $( ".dnd_column" ).sortable({
            connectWith: ".dnd_column",
            items: "> .dnd_element",
            revert: true,
            tolerance: "pointer",
            placeholder: "dnd_element_placeholder",
            forcePlaceholderSize: true,
            stop: function(){
                dnd_rebuild_widths();
                dnd_write_from_dnd_to_editor();
            },
            over: dnd_rebuild_widths
        }).disableSelection();
    }


    function dnd_make_elements_resizable(){
        $('.dnd_column').not( ':last-child' ).resizable({
            handles: "e", 
            containment: "parent",
            start: function( event, ui ) {
                var maxWidth = ui.element.width() + ui.element.next().width()-10;
                ui.element.resizable({maxWidth: maxWidth});
                $('.dnd_column').each(function(){
                    var item_width = $(this).width();
                    $(this).data("initial_width", item_width);
                });
            },
            resize: function( event, ui ) {
                dnd_resize_others(ui.element, ui.originalSize.width - ui.size.width);
                dnd_columns_spans(ui.element.parent());
            },
            stop: function( event, ui ) {
                dnd_write_from_dnd_to_editor();
            }
        }).on('resize', function (e) {
            e.stopPropagation();
        });
    }


    function dnd_write_from_dnd_to_editor(){
        if($dd_tab_content.hasClass('syntax_error')){
            return;
        }
        var output="";
        var counter=0;
        //sections output
        $dd_tab_content.find('.dnd_content_section').each(function(){
            if(counter>0){
                output += "";
            }
            counter++;
            var sectionshortcode = $(this).data("shortcode").replace(/\*quot\*/g, '"');
            output += sectionshortcode+"";
            //output columns in section
            $(this).find(".dnd_column").each(function(){
                var columnshortcode = $(this).data("shortcode");
                var span = $(this).data("span");
                output += columnshortcode.replace(/\*quot\*/g, '"').replace(/span='(\d+)'/,"span='"+span+"'")+"";
                //output elements in column
                $(this).find(".dnd_element").each(function(){
                    output += $(this).data("shortcode").replace(/\*quot\*/g, '"').replace(/\*nl\*/g, " ")+"";
                });
                //end of output elements in column
                output += "[/column_dd]";
            });
            //end of output columns in section
            output += "[/section_dd]";
        });
        //end of sections output
        $('#content').val(output);
        output = output.replace(/\r\n|\r|\n/g, "");
        var editor = tinymce.get('content'); 
        if(editor!==undefined && editor!==null){
            editor.setContent(output);
        }
    }


    function dnd_generate_dnd_from_content(content){
        if(content == undefined){
            content = $('#content').val();
        }
        $('.dnd_content_section').remove();
        $("#dnd_dragdrop_empty").hide();
        var output = '';
        var current_section,section_content,section_data,current_column,column_content,column_data,element_name,current_element;
        var index,column_index,no_of_sections = 0;
        var all_elements = dnd_from_WP.ABdevDND_shortcode_names;

        
        /****** old versions content compatibility *****/
        var compatibility_changes = 0;
        if(content.indexOf('_DD')>0){
            // replace old version uppercase suffixes
            content = content.replace(/_DD/g, '_dd');
            compatibility_changes = 1;
            console.log('Old _DD suffixes detected, replaced with new _dd suffixes.');
        }
        if(content.indexOf('column_dd span="')>0){
            //if first character after span= is double quote it was generated with old version and quotes should be replaced
            content = content.replace(/"/g, '*singleq*').replace(/'/g, '"').replace(/\*singleq\*/g, "'");
            compatibility_changes = 1;
            console.log('Old version of content detected, double quotes replaced with single quotes and vice versa.');
        }
        /****** old versions content compatibility *****/


        //replace single quotes with double and vice versa (shortcode attributes must have double quotes for parser to work, html content single quotes, and wordpress saves html as double always)
        content = content.replace(/"/g, '*quot*').replace(/'/g, '"');

        var section_handler_icons = '<span class="dnd_section_handler" title="Rearange Sections"></span><span class="dnd_section_delete" title="'+dnd_from_WP.delete_section+'"></span><span class="dnd_section_duplicate" title="'+dnd_from_WP.duplicate_section+'"></span><span class="dnd_section_edit" title="'+dnd_from_WP.edit_section+'"></span><span class="dnd_remove_column" title="'+dnd_from_WP.remove_column+'"></span><span class="dnd_add_column" title="'+dnd_from_WP.add_column+'"></span>';
        var column_handler_icons= '<span class="dnd_add_element" title="'+dnd_from_WP.add_element+'"></span><span class="dnd_column_edit" title="'+dnd_from_WP.edit_column+'"></span>';
        var element_handler_icon = '<span class="dnd_element_delete" title="'+dnd_from_WP.delete_element+'"></span><span class="dnd_element_duplicate" title="'+dnd_from_WP.duplicate_element+'"></span><span class="dnd_element_edit" title="'+dnd_from_WP.edit_element+'"></span>';
        //if there is any content not wrapped properly in section/column structure, show it in first section
        var initial_content = wp.shortcode.replace( 'section_dd', content, function(){return ' ';} ).replace(/&nbsp;/g, ' ').replace(/<p> +<\/p>/g, ' ').trim();
        if(initial_content!==''){
            no_of_sections++;
            output += '<div class="dnd_content_section" data-shortcode="[section_dd]">'+section_handler_icons+'<div class="dnd_column" data-span="12" data-shortcode="[column_dd span=\'12\']">'+column_handler_icons+'<p>12/12</p><div class="dnd_element" title="Text / HTML" data-shortcode="[text_dd]'+initial_content+'[/text_dd]"><span class="element_name">Text / HTML</span>'+element_handler_icon+'</div></div></div>';
        }
        // ******* parse sections in content ******* 
        do{
            current_section = wp.shortcode.next( 'section_dd', content, index );
            if(current_section!==undefined){
                no_of_sections++;
                var section_title = '';
                var section_shortcode='[section_dd';
                $.each(current_section.shortcode.attrs.named, function(attribute, value) {
                    section_shortcode += ' ' + attribute + "='"+ value +"'";
                    if( attribute==='section_title'){
                        section_title = value.replace(/\*quot\*/g, '"');
                    }
                });
                section_shortcode=section_shortcode+']';
                output += '<div class="dnd_content_section" data-shortcode="'+section_shortcode+'">'+'<div class="dnd_section_title">'+section_title+'</div>'+section_handler_icons;
                section_content = current_section.shortcode.content;
                column_index = 0;
                //  ******* parse columns in current section ******* 
                do{
                    current_column = wp.shortcode.next( 'column_dd', section_content, column_index );
                    if(current_column!==undefined){
                        //get column atributes
                        var column_shortcode='[column_dd';
                        $.each(current_column.shortcode.attrs.named, function(attribute, value) {
                            column_shortcode += ' ' + attribute + "='"+ value +"'";
                        });
                        column_shortcode=column_shortcode+']';
                        output += '<div class="dnd_column" data-span="'+current_column.shortcode.attrs.named.span+'" data-shortcode="'+column_shortcode+'">';
                        // ******* parse elements in current column ******* 
                        column_content = current_column.shortcode.content+'[last_dnd_limit v=1]'; //last_dnd_limit is to add dummy last shortcode, to fix WordPress wp.shortcode.next method which has problem when there is only one shortcode in string
                        var loop_exit=0;
                        do{
                            loop_exit++;
                            var element_shortcode=column_content.substring(column_content.indexOf("[")+1,Math.min(column_content.indexOf(" ",column_content.indexOf("[")), column_content.indexOf("]",column_content.indexOf("["))));
                            if(element_shortcode!==''){
                                current_element = wp.shortcode.next( element_shortcode, column_content );
                                if(typeof current_element !== 'undefined'){
                                    var element_name = dnd_from_WP.ABdevDND_shortcode_names[current_element.shortcode.tag];
                                    if(element_name === undefined){
                                        element_name = '['+current_element.shortcode.tag+']';
                                    }
                                    if(element_name!=='[last_dnd_limit]'){
                                        var shortcode = current_element.content;
                                        shortcode = shortcode.replace(/"/g, "'").replace(/\r\n|\n|\r/g, "*nl*");
                                        
                                        var element_content = current_element.shortcode.content;
                                        if(element_content!==undefined){
                                            element_content = $('<div>'+element_content.replace(/\[/g,' <').replace(/\]/g,'> ').replace(/\*quot\*/g, '"')+'</div>').text().replace(/[^\w\s]/g, '').substring(0, 200);
                                        }
                                        else{
                                            element_content='';
                                        }

                                        element_content = (element_content!=='') ? '<span class="element_excerpt"> - '+element_content+'...</span>' : '';


                                        output += '<div class="dnd_element" title="'+element_name+'" data-shortcode="'+shortcode+'">';
                                        output += '<span class="element_name">'+element_name+element_content+'</span>'+element_handler_icon;
                                        output += "</div>";
                                    }
                                    column_content = column_content.replace(current_element.content, '').trim();
                                }
                            }
                        }while(column_content.indexOf("[")>=0 && loop_exit<100);
                        // ******* end parsing elements in current column ******* 
                        output += column_handler_icons + '<p>'+current_column.shortcode.attrs.named.span+'/12</p>' + '</div>';
                        column_index = current_column.index + 1;
                    }
                }while(current_column!==undefined);
                // ******* end parsing columns in current section ******* 
                output += '</div>';
                index = current_section.index + 1;
            }
        }while(current_section!==undefined);
        // ******* end parsing sections ******* 
        $dd_tab_content.append(output);
        $('.dnd_content_section').each(function(){
            var count_columns = $(this).find('.dnd_column').length;
            if(count_columns==1){
                $(this).find('.dnd_remove_column').addClass('dnd_disabled');
            }
            else if(count_columns==12){
                $(this).find('.dnd_add_column').addClass('dnd_disabled');
            }
        });
        if(no_of_sections===0){
            $("#dnd_dragdrop_empty").show();
        }
        else{
            $("#dnd_dragdrop_empty").hide();
        }
        dnd_make_elements_resizable();
        dnd_make_elements_sortable();
        dnd_rebuild_widths();

        if(compatibility_changes===1){
            dnd_write_from_dnd_to_editor();
        }
    }


    function dnd_resize_others($item,diff){
        var $sibling = $item.next();
        var new_width = $sibling.data("initial_width") + diff;
        $sibling.css("width", new_width);
        $item.css("height", "auto");
    }


    function dnd_columns_spans($item){
        var total_width=0;
        $item.children('.dnd_column').each(function(){
            total_width += $(this).width();
        }).each(function(){
            var span = Math.round($(this).width() / (total_width / 12));
            if($(this).children('p').length === 0){
                $(this).append('<p></p>');
            }
            $(this).children('p').html(span + '/12');
            $(this).data("span",span);
        });
    }


    function dnd_out_of_grid($item){
        var count = $item.children('.dnd_column').length;
        var i = 0;
        var grid = Math.floor(dnd_total_width($item)/12);
        if(count==5){
            $item.children('.dnd_column').each(function(){
                var col_width = (i<2) ? grid*3 : grid*2;
                i++;
                $(this).css("width", col_width+"px");
            });
        }
        else if(count>6){
            $item.children('.dnd_column').each(function(){
                var col_width = (i<1) ? grid*(12-count+1) : grid*1;
                i++;
                $(this).css("width", col_width+"px");
            });
        }
    }


    function dnd_total_width($item){
        var total_width=0;
        $item.children('.dnd_column').each(function(){
            total_width += $(this).width();
        });
        return total_width;
    }


    function dnd_rebuild_widths(){
        $("#dnd_dragdrop").find('.dnd_content_section').each(function(){
            var resize_sectionWidth = $(this).width();
            var resize_grid = Math.floor(resize_sectionWidth/12);
            $(this).children('.dnd_column').each(function(){
                var resize_col_width = $(this).data("span")*resize_grid;
                $(this).css("width", resize_col_width+"px");
                var max_width = $(this).width() + $(this).next().width();
                if($(this).hasClass('ui-resizable')){
                    $(this).resizable( "option", {
                        grid: [ resize_grid, 10 ],
                        minWidth: resize_grid,
                        maxWidth: max_width
                    });
                }
            });
            var maxHeight = -1;
            var $handlers = $(this).find('.ui-resizable-e');
            $handlers.height('100%');
            $handlers.each(function(){
                if ($(this).height() > maxHeight)
                        maxHeight = $(this).height();
            });
            $handlers.each(function(){
                $(this).height(maxHeight);
            });
        });
    }


    function htmlspecialchars(string, quote_style, charset, double_encode) {
      var optTemp = 0,
        i = 0,
        noquotes = false;
      if (typeof quote_style === 'undefined' || quote_style === null) {
        quote_style = 2;
      }
      string = string.toString();
      if (double_encode !== false) { // Put this first to avoid double-encoding
        string = string.replace(/&/g, '&amp;');
      }
      string = string.replace(/</g, '&lt;')
        .replace(/>/g, '&gt;');

      var OPTS = {
        'ENT_NOQUOTES': 0,
        'ENT_HTML_QUOTE_SINGLE': 1,
        'ENT_HTML_QUOTE_DOUBLE': 2,
        'ENT_COMPAT': 2,
        'ENT_QUOTES': 3,
        'ENT_IGNORE': 4
      };
      if (quote_style === 0) {
        noquotes = true;
      }
      if (typeof quote_style !== 'number') { // Allow for a single string or an array of string flags
        quote_style = [].concat(quote_style);
        for (i = 0; i < quote_style.length; i++) {
          // Resolve string input to bitwise e.g. 'ENT_IGNORE' becomes 4
          if (OPTS[quote_style[i]] === 0) {
            noquotes = true;
          } else if (OPTS[quote_style[i]]) {
            optTemp = optTemp | OPTS[quote_style[i]];
          }
        }
        quote_style = optTemp;
      }
      if (quote_style & OPTS.ENT_HTML_QUOTE_SINGLE) {
        string = string.replace(/'/g, '&#039;');
      }
      if (!noquotes) {
        string = string.replace(/"/g, '&quot;');
      }

      return string;
    }

        
});