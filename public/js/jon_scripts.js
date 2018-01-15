jQuery(document).ready(function ($) {
    $('div.panel-body div.list-group').each(function (i) {
        $(this).find('a#hide-tree-'+i).hide();
        $(this).find('a#hide-tree-'+(i+1)).hide();
        $(this).find('a#hide-tree-'+(i+2)).hide();
        $(this).find('a#hide-tree-'+(i+3)).hide();
        $(this).find('a#hide-tree-'+(i+4)).hide();
    });
});

/**
 * прячем div с деревом, и ссылку "скрыть эту ч. дерева",
 * показываем ссылку "показать дерево" (для послед. отобр.)
 **/
function hideTree(i) {

    $('div#tree-' + i ).hide();
    $('a#hide-tree-' + i).hide();
    $('a#show-tree-' + i).show();
    //$('li#personal-data-' + i).show();

    return false;
}

/**
 * показыв div с деревом, и ссылку "скрыть",
 * скрываем ссылку "показать дерево"
 **/
function showTree(i) {

    $('div#tree-' + i ).show();
    $('a#hide-tree-' + i).show();
    $('a#show-tree-' + i).hide();
    //$('li#personal-data-' + i).hide();
    return false;
}

/**
* Загрузка и оттображение контента (таблицы?) через ajax
**/
function ajaxLoad(id) {
    //console.log('OK! Script was here...');

    content = typeof content !== 'undefined' ? content : 'content';
    //$('.loading').show();

    /* дб где-то в шаблонах (index.blade?)
        <div class="loading">
            <i class="fa fa-refresh fa-spin fa-2x fa-tw"></i><br>
            <span>Loading</span>
        </div> */

    $.ajax({
        type: "GET",
        url: '/tree_table/' + id ,
        dataType: 'JSON',
        success: function (data) {
            //console.log(data);
            //alert('ajaxLoad ajax success...');
            $('div.insert').remove();
            $('div#start').after('<div class="insert">' + data.table + '</div>');
            //$("#" + content).html(data);
            //$('.loading').hide();
        },
        error: function (xhr, status, error) {
            alert('Error in ajaxLoad: - ajax error ');
            //alert(xhr.responseText);
        }
    });
}

/**
 * Удаление div c таблицей рядового персонала
 * по клику на крестике:)
 * @returns {boolean}
 */
function removeTable() {
    $('div.insert').remove();
    return false;
}

/**
 * Попытка аякс пагинации по образцу  https://laraget.com/blog/how-to-create-an-ajax-pagination-using-laravel
 * и код оттуда...неясно что делать с url , тк урл url: '/tree_table/' + id ,
 * дался с кровью ...!!!
 **/
/**
$(function() {
    $('body').on('click', '.pagination a', function(e) {
        e.preventDefault();

        $('#load a').css('color', '#dfecf6');
        $('#load').append('<img style="position: absolute; left: 0; top: 0; z-index: 100000;" src="/images/loading.gif" />');

        var url = $(this).attr('href');
        getArticles(url);
        window.history.pushState("", "", url);
    });
    function getArticles(url) {
        $.ajax({
            url : url
        }).done(function (data) {
            $('.articles').html(data);
        }).fail(function () {
            alert('Articles could not be loaded.');
        });
    }
});
**/