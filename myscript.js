$(document).ready(function(){
    

    function GetTableFromExcel(data) {
        //Read the Excel File data in binary
        var workbook = XLSX.read(data, {
            type: 'binary'
        });
        //get the name of First Sheet.
        var Sheet = workbook.SheetNames[0];
        //Read all rows from First Sheet into an JSON array.
        var excelRows = XLSX.utils.sheet_to_row_object_array(workbook.Sheets[Sheet]);
        var array = [] ;
        for (var i = 0; i < excelRows.length; i++) {
            array.push(excelRows[i]['cooltechtube.com']);
        }
        var unique = array.filter(function(elem, index, self) {
            return index === self.indexOf(elem);
        });
        $.ajax({
            type: 'post',
            data: {
                data: JSON.stringify(unique),
                state: "upload"
            },
            url: "functions/upload_excel_data.php",
            success: function(res){
                location.reload();
                // alert("You added new "+res+" rows");
            }
        });
    };

    $("#fileUpload").on("change", function(){
        //Validate whether File is valid Excel file.
        if (typeof (FileReader) != "undefined") {
            var reader = new FileReader();

            //For Browsers other than IE.
            reader.onload = function (e) {
                GetTableFromExcel(e.target.result);
            };
            reader.readAsBinaryString(this.files[0]);
            
        } else {
            alert("This browser does not support HTML5.");
        }
    });

    var initial_length, completed;
    function progress_bar() {
        percent = 100*completed/initial_length;
        ele = $(".progress-bar").eq(0);
        ele.css("width", percent.toFixed(0) + "%").css('display', 'flex');
        ele.text(percent.toFixed(0) + "%");
    }
    
    var oneRequest = function() {
        if($(".pending").length > 0){
            var length  = $(".pending").length;
            var pending_ele = $(".pending").eq(0);
            var pending_text = $(".pending").eq(0).prev().text();
            var parent = $(".pending").eq(0).parent();
            var pending_id = parent.attr("id");
            
            parent.find('.nomean').focus();
            $("tr").removeClass('current_row');
            parent.addClass('current_row');
            
            $.ajax({
                url: "functions/get_data.php",
                type: "post",
                data: {
                    state: "get_info",
                    pending_text: pending_text,
                    pending_id: pending_id
                },
                success: function(res){
                    if(res.create_time == "" || res.expire_time == "" || res.age == "" || res.community_score == "" || res.ip == "" || res.name == "" || res.location == "" || res.blacklist == "" || res.test_result == "") {
                        pending_ele.removeClass("pending").addClass("yet");
                    }else if(res.create_time){
                        pending_ele.removeClass("pending").removeClass("yet").addClass("success").text("success");
                        pending_ele.parent().children().eq(3).text(res.create_time);
                        pending_ele.parent().children().eq(4).text(res.expire_time);
                        pending_ele.parent().children().eq(5).text(res.age);
                        pending_ele.parent().children().eq(6).text(res.community_score);
                        pending_ele.parent().children().eq(7).text(res.ip);
                        pending_ele.parent().children().eq(8).text(res.name);
                        pending_ele.parent().children().eq(9).text(res.location);
                        pending_ele.parent().children().eq(10).text('<a href="' + res.blacklist_url + '">' + res.blacklist + "</a>");
                        pending_ele.parent().children().eq(11).text('<a href="' + res.test_url + '">' + res.test_result + "</a>");
                    } 
                    if(res.get_ip == "OK"){
                        pending_ele.removeClass("pending").removeClass("success");
                        pending_ele.parent().children().eq(2).text('success');
                        pending_ele.parent().children().eq(3).text(res.domain);
                        pending_ele.parent().children().eq(4).text('0/85');
                    }
                    ++completed;
                    progress_bar();
                    setTimeout(function() {
                        oneRequest();
                    }, 0);
                }
            });
        } 
    }
    $(".start").on("click", function(){
        initial_length = $(".pending").length;
        completed = 0;
        oneRequest();
    });

    var tablesToExcel = (function() {
        var uri = 'data:application/vnd.ms-excel;base64,'
        , tmplWorkbookXML = '<?xml version="1.0"?><?mso-application progid="Excel.Sheet"?><Workbook xmlns="urn:schemas-microsoft-com:office:spreadsheet" xmlns:ss="urn:schemas-microsoft-com:office:spreadsheet">'
        + '<DocumentProperties xmlns="urn:schemas-microsoft-com:office:office"><Author>Axel Richter</Author><Created>{created}</Created></DocumentProperties>'
        + '<Styles>'
        + '<Style ss:ID="Currency"><NumberFormat ss:Format="Currency"></NumberFormat></Style>'
        + '<Style ss:ID="Date"><NumberFormat ss:Format="Medium Date"></NumberFormat></Style>'
        + '</Styles>' 
        + '{worksheets}</Workbook>'
        , tmplWorksheetXML = '<Worksheet ss:Name="{nameWS}"><Table>{rows}</Table></Worksheet>'
        , tmplCellXML = '<Cell{attributeStyleID}{attributeFormula}><Data ss:Type="{nameType}">{data}</Data></Cell>'
        , base64 = function(s) { return window.btoa(unescape(encodeURIComponent(s))) }
        , format = function(s, c) { return s.replace(/{(\w+)}/g, function(m, p) { return c[p]; }) }
        return function(tables, wsnames, wbname, appname) {
            var ctx = "";
            var workbookXML = "";
            var worksheetsXML = "";
            var rowsXML = "";

            for (var i = 0; i < tables.length; i++) {
                if (!tables[i].nodeType) tables[i] = document.getElementById(tables[i]);
                for (var j = 0; j < tables[i].rows.length; j++) {
                rowsXML += '<Row>'
                for (var k = 0; k < tables[i].rows[j].cells.length; k++) {
                    var dataType = tables[i].rows[j].cells[k].getAttribute("data-type");
                    var dataStyle = tables[i].rows[j].cells[k].getAttribute("data-style");
                    var dataValue = tables[i].rows[j].cells[k].getAttribute("data-value");
                    dataValue = (dataValue)?dataValue:tables[i].rows[j].cells[k].innerHTML;
                    var dataFormula = tables[i].rows[j].cells[k].getAttribute("data-formula");
                    dataFormula = (dataFormula)?dataFormula:(appname=='Calc' && dataType=='DateTime')?dataValue:null;
                    ctx = {  attributeStyleID: (dataStyle=='Currency' || dataStyle=='Date')?' ss:StyleID="'+dataStyle+'"':''
                        , nameType: (dataType=='Number' || dataType=='DateTime' || dataType=='Boolean' || dataType=='Error')?dataType:'String'
                        , data: (dataFormula)?'':dataValue
                        , attributeFormula: (dataFormula)?' ss:Formula="'+dataFormula+'"':''
                        };
                    rowsXML += format(tmplCellXML, ctx);
                }
                rowsXML += '</Row>'
                }
                ctx = {rows: rowsXML, nameWS: wsnames[i] || 'Sheet' + i};
                worksheetsXML += format(tmplWorksheetXML, ctx);
                rowsXML = "";
            }

            ctx = {created: (new Date()).getTime(), worksheets: worksheetsXML};
            workbookXML = format(tmplWorkbookXML, ctx);

            // console.log(workbookXML);

            var link = document.createElement("A");
            link.href = uri + base64(workbookXML);
            link.download = wbname || 'Workbook.xls';
            link.target = '_blank';
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        }
    })();

    $(".download").click(function(){
        tablesToExcel(['domains_table','tbl2'], ['Domains','IPs'], 'TestBook.xls', 'Excel');
        $.ajax({
            url: "functions/mark_download.php",
            success:function(res){
                console.log(res);
                alert("SUCCESSFUL!!!");
                location.reload();
            }
        });
    });
});