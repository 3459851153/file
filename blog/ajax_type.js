/**
 * @param type(类型)
 * @param url(路径)
 * @param data(数据)
 * @param success(回调函数)
 */

function ajax_type(objct){
    console.log(objct);
    var xml = new XMLHttpRequest();
    if(objct.type == "get" && objct.data){
        objct.url = objct.url+"?"+objct.data;
        objct.data=null;
    }
    xml.open(objct.type,objct.url);
    if(objct.type == "post" && objct.data){
        xml.setRequestHeader("content-type","application/x-www-form-urlencoded");
    }
    xml.onreadystatechange=function(){
        if(xml.status==200&&xml.readyState==4){
            var xml_rp = xml.getResponseHeader("content-type");
            if(xml_rp.indexOf("xml") != -1){
                objct.success(xml.responseXML);
            }
            else if(xml_rp.indexOf("json") != -1){
                objct.success(xml.responseText);
            }
            else{
                objct.success(xml.responseXML);
            } 
        }
    }
    xml.send(objct.data);
}