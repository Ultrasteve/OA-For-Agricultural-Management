/**
 * Created by lujiajian on 2016/7/28.**/
$(function(){
    $("#change_password").click(function () {
        var i = 0;
        var str = ["处理中", "处理中..", "处理中...."];
        var time = setInterval(function () {
            if (i > 2)
                i = 0;
            else
                $(this).html(str[i++]);
        }, "400");
        var nowpassword=$("#n_password").val();
        var p

    })
    $("#content-1").on("swiperight",function(){

        $("#content-1-left").css("display","block");
        $("#content-1-left") .animate({left:"0"});

    })
    $("#content-1").on("swipeleft",function(){
        $("#content-1-left") .animate({left:-$("#content-1-left").css("width")});
        $("#content-1-left").css("display","none");

    })
    $(".nav li").click(function(){
       // console.log($(this).get(0).tagName);
        $(this).siblings().attr("class","");
        $(this).addClass("active");
    })
    $(".table-striped.aa").click(function(){
        location.href="tjglxx_2.html";
    })
    $("#denglu").click(function () {
        var username=$("#username").val();
        var password=$("#password").val();
        var i = 0;
        var str = ["处理中", "处理中..", "处理中...."];
        var time = setInterval(function () {
            if (i > 2)
                i = 0;
            else
                $(this).html(str[i++]);
        }, "400");
        $.ajax({
            url:'php/denglu.php',
            type:'post',
            dataType:'text',
            data:{username:username,password:password},
            success:function (msg) {
                clearInterval(time);
                $(this).html("登录");

                if(isNaN(msg))
                    console.log(msg);
                else{
                    if (msg>0)
                    {
                        localStorage.setItem("lyt_username",username);
                        localStorage.setItem("lyt_password",password);
                        location.href="main_nhxx.html";
                    }
                    else
                    {
                        $("#tips").text("账号或密码错误");
                    }
                }

            },
            error:function () {
                clearInterval(time);
                $(this).html("登录");

                console.log("denglu.php lost!");
            }
        })
    })
    $("#username").change(function () {
        $("#tips").text('');
    })
    $("#password").change(function () {
        $("#tips").text('');
    })
})
function search(a) {
    var n = $(a).parent().prev().val();
    if(isNaN(n)) {
        localStorage.setItem("search_way_of_nh",0);
        localStorage.name=n;
        location.href = "xgnhxx.html";
    }
    else{
        localStorage.setItem("search_way_of_nh",1);
        localStorage.id=n;
        location.href = "nhxx.html";
    }
}
function search2(a) {
    var n = $(a).parent().prev().val();
    localStorage.name=n;
    location.href = "xgtjglxx.html";
}
function search3(a) {

    var ID = $(a).parent().prev().val();
    localStorage.id=ID;


    $(".fadeout").fadeOut();
    $(".fadein").fadeIn();

    var str=["处理中","处理中..","处理中...."];
    var i=0;

    if(ID){
        var time=setInterval(function(){
            if(i>2)
                i=0;
            else
                $(a).html(str[i++]);
        },"400");
        $.ajax({
            url:'php/id_number.php',
            data:{id:ID,str:'zzzw_num_check'},
            dataType:'text',
            type:'post',
            success:function (msg) {
                clearInterval(time);
                console.log(msg);
                var num=parseInt(msg);
                if(num==0)
                    alert("该农户没有作物信息！")
                else
                    location.href='zzzw.html';
            },
            error:function () {
                console.log("id_number.php lost！")
                alert("意外错误发生!")
                clearInterval(time);
            }


        })
    }
    else
        alert("请输入用户ID！")


}

function slided(a){
    var i=$(a).attr("dada");
    console.log(i)
    if(i<1) {

        var n = $("<div><br><br><br><br></div><div class='input-group' style='width: 80%;margin-right: auto;margin-left: auto'><span class='input-group-addon' onclick=historymodel(this,'nh') change='0'><span class='glyphicon glyphicon-check'></span></span><input type='text' class='form-control' placeholder='请输入农户名'><span class='input-group-addon'><span class='glyphicon glyphicon-search' onclick='search(this)'></span></span></div>");
        $(a).attr("dada", ++i);
        $(a).after(n);
        n.slideDown();
    }
    else {
        $(a).next().next().slideUp();
        $($(a).next().next()).remove();
        $($(a).next()).remove();
        $(a).attr("dada", 0);
    }
}
function slided2(a){
    var i=$(a).attr("dada");
    console.log(i)
    if(i<1) {

        var n = $("<div><br><br><br><br></div><div class='input-group' style='width: 50%;margin-right: auto;margin-left: auto'><input type='text' class='form-control' id='inputfamername' placeholder='请输入农户名'><span class='input-group-addon'><i class='glyphicon glyphicon-search ' onclick='search2(this)'></i></span></div>");
        $(a).attr("dada", ++i);
        $(a).after(n);
        n.slideDown();

        $("#inputfamername").val(localStorage.name);

    }
    else {
        $(a).next().next().slideUp();
        $($(a).next().next()).remove();
        $($(a).next()).remove();
        $(a).attr("dada", 0);
    }
}

function search_fillHTML(a){
    if (isNaN(a))
    $.ajax({
        type:'post',
        data:{name:a},
        url:'php/xgnhxx_table.php',
        dataTpye:'json',
        success:function(obj){

            var note="";
            $.each(   JSON.parse(obj), function (i,item) {
                note=note+"<tr class='on-click'>"
                $.each(item,function(j,val){
                    note=note+"<td>"+val+"</td>"
                })
                note+="</tr>"
            })

            $("#xgnhxx_table").append(note);
            $(".on-click").on("click",function(){
                localStorage.name=$(this).children().eq(0).html()
                localStorage.id_number=$(this).children().eq(2).html();
                console.log("name:"+localStorage.name+"  id_number:"+localStorage.id_number);
                window.location.href="nhxx.html";
            });


        },
        error:function () {
            alert("连接错误");
        }

    })

}

function insert_for_xjzzzw(a,b){
    console.log(b)
    if(b=='insert') {
        var obj = {
            b:'insert',
            id_of_jidi: $("#id_of_jidi").val(),
            name:$("#name").text(),
            area: $("#area").val(),
            types_of_plant: $("#types_of_plant").val(),
            kinds_of_plant: $("#kinds_of_plant").val(),
            time: $("#time").val(),
            row_spacing: $("#row_spacing").val(),
            column_spacing: $("#column_spacing").val(),
            plant_way: $("#plant_way").val(),
            seed_from: $("#seed_from").val(),
            production_last_season: $("#production_last_season").val(),
            evaluate: $("#evaluate").val()
        }
        var i = 0;
        var str = ["处理中", "处理中..", "处理中...."];
        var time = setInterval(function () {
            if (i > 2)
                i = 0;
            else
                $(a).html(str[i++]);
        }, "400");
        $.each(obj, function (i, val) {
            console.log(i + ":" + val);
        })

        $.ajax({
            type: 'post',
            url: 'php/insert_for_xjzzzw.php',
            data: obj,
            dataType: 'text',
            success: function (msg) {

                console.log(msg);
                clearInterval(time);
                $(a).html("确定");
                if (!isNaN(msg)) {
                    alert("创建成功！");
                    window.location.href = 'main_nhxx.html'
                    history_insert({id:msg,username:localStorage.lyt_username});
                }
                else {
                    alert("错误,错误原因："+msg);
                }
            },
            error:function () {
                clearInterval(time);
                $(a).html("确定");
                alert("连接错误!")
            }
        })
    }
    else if (b=="update"){
            var obj = {
                b:'update',
                id_of_jidi: $("#id_of_jidi").text(),
                name:$("#name").text(),
                area: $("#area").val(),
                types_of_plant: $("#types_of_plant").val(),
                kinds_of_plant: $("#kinds_of_plant").val(),
                time: $("#time").val(),
                row_spacing: $("#row_spacing").val(),
                column_spacing: $("#column_spacing").val(),
                plant_way: $("#plant_way").val(),
                seed_from: $("#seed_from").val(),
                production_last_season: $("#production_last_season").val(),
                evaluate: $("#evaluate").val()
            }
        var i = 0;
        var str = ["处理中", "处理中..", "处理中...."];
        var time = setInterval(function () {
            if (i > 2)
                i = 0;
            else
                $(a).html(str[i++]);
        }, "400");
        $.each(obj, function (i, val) {
            console.log(i + ":" + val);
        })

        $.ajax({
            type: 'post',
            url: 'php/insert_for_xjzzzw.php',
            data: obj,
            dataType: 'text',
            success: function (msg) {

                console.log(msg);
                clearInterval(time);
                $(a).html("保存修改");
                if (!isNaN(msg)) {
                    alert("修改成功！");
                   //window.location.href = 'main_nhxx.html'
                    history_insert({id:msg,type:'zw'});

                }
                else {
                    alert("错误！错误原因："+msg);
                }
            },
            error:function () {
                alert("连接错误！");
            }
        })
    }


}
function insert_for_xjjdxx(a,b) {
    console.log(b)
    if(b=='insert') {
        var obj = {
            b:'insert',
            id: $("#nhbh").html(),
            id_of_jd: $("#id_of_jd").val(),
            address: $("#address").val(),
            area: $("#area").val(),
            rate: $("#rate").val(),
            date: $("#date").val(),
            agreement: $("#agreement").val(),
            surround: $("#surround").val(),
            landform: $("#landform").val(),
            nearby: $("#nearby").val(),
            n_crop: $("#n_crop").val(),
            p_crop: $("#p_crop").val(),
            water_source: $("#water_source").val(),
            tuolaji: $("#tuolaji").val(),
            ph: $("#ph").val(),
        }
        var i = 0;
        var str = ["处理中", "处理中..", "处理中...."];
        var time = setInterval(function () {
            if (i > 2)
                i = 0;
            else
                $(a).html(str[i++]);
        }, "400");
        $.each(obj, function (i, val) {
            console.log(i + ":" + val);
        })

        $.ajax({
            type: 'post',
            url: 'php/insert_for_xjjdxx.php',
            data: obj,
            dataType: 'text',
            success: function (msg) {

                console.log(msg);
                clearInterval(time);
                $(a).html("确定");
                if (msg == 1) {
                    history_insert({
                        username:localStorage.lyt_username,
                        id:obj.id_of_jd,
                        type:'jd'
                    });
                    alert("创建成功！");
                    window.location.href = 'main_nhxx.html';
                }
                else {
                    alert("连接错误！错误原因："+msg);
                }
            }
        })
    }
    else if (b=="update"){
        var obj = {
            b:'update',
            id: $("#nhbh").html(),
            id_of_jd: $("#id_of_jd").html(),
            address: $("#address").val(),
            area: $("#area").val(),
            rate: $("#rate").val(),
            date: $("#date").val(),
            agreement: $("#agreement").val(),
            surround: $("#surround").val(),
            landform: $("#landform").val(),
            nearby: $("#nearby").val(),
            n_crop: $("#n_crop").val(),
            p_crop: $("#p_crop").val(),
            water_source: $("#water_source").val(),
            tuolaji: $("#tuolaji").val(),
            ph: $("#ph").val()
        }
        var i = 0;
        var str = ["处理中", "处理中..", "处理中...."];
        var time = setInterval(function () {
            if (i > 2)
                i = 0;
            else
                $(a).html(str[i++]);
        }, "400");
        $.each(obj, function (i, val) {
            console.log(i + ":" + val);
        })
        $.ajax({
            type: 'post',
            url: 'php/insert_for_xjjdxx.php',
            data: obj,
            dataType: 'text',
            success: function (msg) {

                console.log(msg);
                clearInterval(time);
                $(a).html("确定");
                if (msg == 1) {

                    history_insert({
                        username:localStorage.lyt_username,
                        id:obj.id_of_jd,
                        type:'jd'
                    });
                    alert("修改成功！");
                    window.location.href = 'main_nhxx.html'

                }
                else {
                    alert("修改失败！错误原因："+msg);
                }
            },
            error:function () {
                alert("连接失败");
            }
        })
    }
    
    return false;
}
function insert_for_xjnhxx(a) {
    var obj= {
        age:$("#age").val(),
        goumai:$("#goumai").val(),
        name:$("#name").val(),
        sex: $("#sex").val(),
        id_number : $("#id_number").val(),
        phone_number : $("#phone").val(),
        city : $("#seachcity").val(),
        district : $("#seachdistrict").val(),
        province : $("#seachprov").val(),
        street : $("#street").val(),
        family : $("#family").val(),
        worker:$("#labour_forcen").val(),
        credit : $("#credit").val(),
        fund : $("#fund").val(),
        telephone:$("#telephone").val()


    }
    var i=0;
    var str=["处理中","处理中..","处理中...."];
    var time=setInterval(function(){
        if(i>2)
            i=0;
        else
            $(a).html(str[i++]);
    },"400");
    $.each(obj,function(i,val){
        console.log(i+":"+val);
    })

    $.ajax({
        type:'post',
        url:'php/insert_for_xjnhxx.php',
        data:obj,
        dataType:'text',
        success:function(msg){

                console.log(msg);
                clearInterval(time);
                $(a).html("新建");
                if(!isNaN(msg))
                {
                    alert("创建成功！");
                    window.location.href='main_nhxx.html'

                    history_insert({
                        id:msg,
                        name:obj.name,
                        type:'nh',
                        username:localStorage.lyt_username
                    })
                }
                else{
                    alert("创建失败，失败原因:"+msg)
                }
        },
        error:function () {
            clearInterval(time);
            $(a).html("新建");
                alert("连接失败");

        }
    })

}
function insert_for_ycl(a){
    var obj = {
        zwbh:$('#zwbh').val(),
        pici:$('#pici').val(),
        date:$('#date').val(),
        season:$('#season').val(),
        amount:$('#amount').val(),
    }
    var i = 0;
    var str = ["处理中", "处理中..", "处理中...."];
    var time = setInterval(function () {
        if (i > 2)
            i = 0;
        else
            $(a).html(str[i++]);
    }, "400");
    $.each(obj, function (i, val) {
        console.log(i + ":" + val);
    })

    $.ajax({
        type: 'post',
        url: 'php/insert_for_xjycl.php',
        data: obj,
        dataType: 'text',
        success: function (msg) {

            console.log(msg);
            clearInterval(time);
            $(a).html("确定");
            if (msg == 1) {
                alert("创建成功！");
                window.location.href = 'main_nhxx.html'

            }
            else {
                alert("连接错误！");
            }

        }
    })
}
function insert_for_tzck(a) {
    var obj = {
        NAME:$('#NAME').val(),
        PACK:$('#PACK').val(),
        P_DATE:$('#P_DATE').val(),
        PRICE:$('#PRICE').val(),
        AMOUNT:$('#AMOUNT').val(),
        T_PRICE:$('#T_PRICE').val(),
        PRODUCER:$('#PRODUCER').val(),
        P_LOCATION:$('#P_LOCATION').val(),
        STORAGE:$('#STORAGE').val(),
        NOTE:$('#NOTE').val(),
        N_NOTE:$('#N_NOTE').val(),
        MAIN_C:$('#MAIN_C').val(),
        USAGE:$('#USAGE').val()
    }
    var i = 0;
    var str = ["处理中", "处理中..", "处理中...."];
    var time = setInterval(function () {
        if (i > 2)
            i = 0;
        else
            $(a).html(str[i++]);
    }, "400");
    $.each(obj, function (i, val) {
        console.log(i + ":" + val);
    })

    $.ajax({
        type: 'post',
        url: 'php/insert_for_xjtzck.php',
        data: obj,
        dataType: 'text',
        success: function (msg) {

            console.log(msg);
            clearInterval(time);
            $(a).html("确定");
            if (msg == 1) {
                alert("创建成功！");
                window.location.href = 'main_nhxx.html'

            }
            else {
                alert("连接错误！");
            }

        }
    })
}

function fillHTML_for_nhxx(a){
    console.log("a="+typeof (a)+":"+a);
    var data;
    if (a==0)
        data={
            id_number:localStorage.id_number,
            way:a
        }
    else
        data={
            id:localStorage.id,
            way:a
        }
    $.ajax({
        type:'post',
        dateType:'json',
        url:'php/fillHTML_for_nhxx.php',
        data:data,
        success:function(obj){
            $.each(JSON.parse(obj),function(key,value){
                if(key=='seachprov'||key=='seachcity'||key=='seachdistrict') {
                    localStorage.setItem(key, value);
                    console.log(key+":"+value);
                }
                else {
                    if(key=='id') {
                        localStorage.setItem(key, value);
                        $("#id").html(value);
                    }
                    $("#" + key).val(value);
                    console.log(key+":"+value)
                }

            })
            history_insert({
                username:localStorage.lyt_username,
                name:localStorage.name,
                id:localStorage.id,
                type:'nh'
            })
            return 1;
        }
    })

}
function fillHTML_for_zzzw(a) {
    $("#types_of_plant").html(localStorage.types_of_plants);
    var data;
    if(a<10000)
        data={id:localStorage.id};
    else
        data={id:a,str:'zw'}
    $.ajax({
        type:'post',
        dateType:'json',
        url:'php/fillHTML_for_zzzw.php',
        data:data,
        success:function(obj){
            localStorage.zzzw_obj=JSON.stringify(JSON.parse(obj));
            foreach_of_zzzw(a);


        }
    })
}
function fillHTML_for_jdxx(a) {
    console.log(localStorage.id)
    $("#n_crop").html(localStorage.types_of_plants);
    $("#p_crop").html(localStorage.types_of_plants);
    $("#nearby").html(localStorage.types_of_plants);

    var data;
    if(a<100)
        data={id:localStorage.id,str:'xx'};
    else
        data={id:a,str:'jd'}


    console.log(data);
    $.ajax({
        type:'post',
        dateType:'json',
        url:'php/fillHTML_for_jdxx.php',
        data:data,
        success:function(obj){
            console.log(obj)
            localStorage.jdxx_obj=JSON.stringify(JSON.parse(obj));
            foreach_of_jdxx(a);
        }
    })
}
function fillHTML_for_gtjl(a){
    $.ajax({
        url:'php/fillHTML_for_gtjl.php',
        type:'post',
        dateType:'json',
        data:{parameter:a},
        success:function (obj) {
            var msg;
            try{
                msg=JSON.parse(obj);
            }catch (e){
                msg=obj;
            }
            $.each(msg,function (key,val) {
                console.log(key+":"+val)
                    if(key=='PHOTO')
                        $("#"+key).attr("src","../../../pic/"+val)
                    else if(key=='NOTE')
                        $("#"+key).val(val);
                    else
                        $("#"+key).html(val)
            })

        },
        error:function (e) {
            console.log("fillHTML_for_gtjl.php lost!");
        }
    })
}
function fillHTML_for_tzck(a){
    $.ajax({
        url:'php/fillHTML_for_tzck.php',
        type:'post',
        dateType:'json',
        data:{parameter:a},
        success:function (obj) {
            var msg;
            try{
                msg=JSON.parse(obj);
            }catch (e){
                msg=obj;
            }
            $.each(msg,function (key,val) {
                console.log(key+":"+val)
                    $("#"+key).val(val)
            })

        },
        error:function (e) {
            console.log("fillHTML_for_tzck.php lost!");
        }
    })
}
function fillHTML_for_tjglxx(a){
    $.ajax({
        url:'php/fillHTML_for_tjglxx.php',
        type:'post',
        dateType:'json',
        data:{parameter:a},
        success:function (obj) {
            var msg;
            try{
                msg=JSON.parse(obj);
            }catch (e){
                msg=obj;
            }
            $.each(msg,function (key,val) {
                console.log(key+":"+val)
                if(key=='PHOTO')
                    $("#"+key).attr("src","../../../pic/"+val);
                $("#"+key).val(val)
            })

        },
        error:function (e) {
            console.log("fillHTML_for_tjglxx.php lost!");
        }
    })
}
function fillHTML_for_ycl(a) {
    $.ajax({
        url:'php/fillHTML_for_ycl.php',
        type:'post',
        dateType:'json',
        data:{parameter:a},
        success:function (obj) {
            console.log(obj)
            if(!isNaN(obj)){
                alert("连接错误，错误码："+obj);
            }
            else
            {
                var msg;
                try{
                    msg=JSON.parse(obj);
                }catch (e){
                    msg=obj;
                }
                $.each(msg,function (key,val) {
                    console.log(key+":"+val)
                    $("#"+key).val(val)
                })
            }

        },
        error:function (e) {
            console.log("fillHTML_for_ycl.php lost!");
        }
    })
}


function foreach_of_zzzw(a) {
    var obj=JSON.parse(localStorage.zzzw_obj);
    var data;
    console.log(a);
    console.log(obj)

    if(a<10000){
        console.log(obj[a].types_of_plant)
        data={p_id:obj[a].types_of_plant};
        $.each(obj,function(i,value){
            if(i==a) {
                $.each(value,function (key,val) {
                    console.log(key+":"+val)
                    if(key=='name' || key=='id_of_jidi'|| key=='id_of_zw')
                        $("#"+key).text(val);
                    else if (key=='kinds_of_plant')
                        localStorage.kinds_of_plant_val=val;
                    else
                        $("#"+key).val(val);
                })
            }
        })
    }
    else{
        $(obj).each(function (i,item) {
            if(item.id_of_zw==a){
                $.each(item,function (key,val) {

                    console.log(key+":"+val)
                    if(key=='name' || key=='id_of_jidi'|| key=='id_of_zw')
                        $("#"+key).text(val);
                    else if (key=='kinds_of_plant')
                        localStorage.kinds_of_plant_val=val;
                    else if (key=='types_of_plant') {
                        data = {p_id:val};
                        $("#"+key).val(val);
                    }
                    else
                        $("#"+key).val(val);
                })
            }
        })
    }
    console.log(data)

    $.ajax({
        url:'php/yujiazai_of_pinlei.php',
        data:data,
        dataType:'json',
        type:'post',
        success:function (obj) {
            console.log("kinds_of_plant  obj:"+obj);
            var object;
            var note='<option value="">请选择</option>'
            try {
                object=   JSON.parse(obj)
            }
            catch (e){
                console.log(e);
                object=obj
            }
            $.each(object,function (i,item) {
                console.log(item['id']+":"+item.name)
                note+="<option value='"+item.id+"'>"+item.id+":  "+item.name+"</option>"
            })
            $("#kinds_of_plant").html(note);
            $("#kinds_of_plant").val(localStorage.kinds_of_plant_val);
        },
        error:function () {
            console.log("yujiazai_of_pinlei.php  lost")
        }
    })

}
function foreach_of_jdxx(a) {
    var obj=JSON.parse(localStorage.jdxx_obj);
    console.log(obj)
    if(a<100){
        $.each(obj,function(i,value){
            if(i==a)
            {
                $.each(value,function (key,val) {
                    console.log(key+":"+val);
                    switch(key){
                        case 'nhbh':$("#nhbh").html(val);break;
                        case 'id'  :$("#id_of_jd").html(val);break;
                        case 'address':$("#address").val(val);break;
                        case 'area'  :$("#area").val(val);break;
                        case 'rate'  :$("#rate").val(val);break;
                        case 'date'  :$("#date").val(val);break;
                        case 'agreement'  :$("#agreement").val(val);break;
                        case 'surround'  :$("#surround").val(val);break;
                        case 'landform'  :$("#landform").val(val);break;
                        case 'ph':$("#ph").val(val);break;
                        case 'water_source'  :$("#water_source").val(val);break;
                        case 'p_crop'  :$("#p_crop").val(val);break;
                        case 'n_crop'  :$("#n_crop").val(val);break;
                        case 'nearby'  :$("#nearby").val(val);break;
                        case 'tuolaji' :$("#tuolaji").val(val);break;
                    }
                })
                return false;
            }

        })
    }
    else{
        console.log(obj)
        $.each(obj,function (i,item) {
           if(item.id==a){
               $.each(item,function (key,val) {
                   console.log(key+":"+val)
                   if(key=='nhbh')
                       $("#"+key).html(val);
                   else if(key=='id')
                       $("#id_of_jd").html(val);
                   else
                       $("#"+key).val(val);
               })
           }
        })
    }
}


function jdxx_num_check(a) {
    var change=$(a).parent().prev().children().children().eq(1).attr("change");
    console.log(change);
    var ID=$("#nh_ID").val();
    console.log(ID)
    var str=["处理中","处理中..","处理中...."];
    var i=0;

    if(ID){
        var time=setInterval(function(){
            if(i>2)
                i=0;
            else
                $(a).html(str[i++]);
        },"400");
        if (change==0) {
            var data = {id: ID, str: 'jdxx_num_check'};
            localStorage.lyt_jdxx_id=0;
        }
        else {
            var data = {id: ID, str: 'jdxx_num_check2'};
            localStorage.lyt_jdxx_id=ID;
        }
        console.log(data)
        $.ajax({
            url:'php/id_number.php',
            data:data,
            dataType:'text',
            type:'post',
            success:function (msg) {
                clearInterval(time);
                $(a).html("查询");
                console.log(msg);
                if(isNaN(msg))
                    alert("错误："+msg)
                else
                  if (msg==0)
                     alert("该用户无基地信息或该基地信息已被删除");
                  else
                     location.href='jdxx.html';
            },
            error:function () {
                console.log("id_number.php lost！")
                alert("意外错误发生!")
                clearInterval(time);
                $(a).html("查询");
            }


        })
    }
    else
        alert("请输入用户ID！")



}
function zzzw_num_check(a) {
    var change=$(a).parent().prev().children().children().eq(1).attr("change");
    console.log(change);
    var ID=$("#ID").val();
    console.log(ID)
    var str=["处理中","处理中..","处理中...."];
    var i=0;

    if(ID){
        var time=setInterval(function(){
            if(i>2)
                i=0;
            else
                $(a).html(str[i++]);
        },"400");
        if (change==0) {
            var data = {id: ID, str: 'zzzw_num_check'};
            localStorage.lyt_zzzw_id=0;
        }
        else {
            var data = {id: ID, str: 'zzzw_num_check2'};
            localStorage.lyt_zzzw_id=ID;
        }
        $.ajax({
            url:'php/id_number.php',
            data:data,
            dataType:'text',
            type:'post',
            success:function (msg) {
                clearInterval(time);
                $(a).html("查询");
                console.log(msg);
                if(isNaN(msg))
                    alert("错误："+msg)
                else
                  if (msg==0)
                      alert("该用户无作物信息或该作物信息已完结");
                  else
                    location.href='zzzw.html';
            },
            error:function () {
                console.log("id_number.php lost！")
                alert("意外错误发生!")
                clearInterval(time);
                $(a).html("查询");
            }


        })
    }
    else
        alert("请输入用户ID！")
}
function tjglxx_num_check(a) {
    $.ajax({
            url:'php/id_number.php',
            data:{str:'tjglxx_num_check'},
            dataType:'text',
            type:'post',
            success:function (msg) {
                console.log(msg);

                if(isNaN(msg))
                    alert("错误："+msg)
                else
                   if (msg==0){
                       alert("无田间管理记录");
                       location.href='xjtjglxx.html';
                   }
                   else
                     location.href='tjglxx.html';
            },
            error:function () {
                console.log("id_number.php lost！")
                alert("意外错误发生!")
            }
    })
}

function nhxx_backto_main_nhxx(a){
    $("fieldset").attr("disabled","disabled");
    var i=0;
    var str=["处理中","处理中..","处理中...."];
    var time=setInterval(function(){
        if(i>2)
            i=0;
        else
            $(a).html(str[i++]);
    },"400");

    var obj={
        age:$("#age").val(),
        goumai:$("#goumai").val(),
        id:$("#id").html(),
        name:$("#id").val(),
        sex:$("#id").val(),
        id_number:$("#id_number").val(),
        phone:$("#phone").val(),
        seachprov:$("#seachprov").val(),
        seachcity:$("#seachcity").val(),
        seachdistrict:$("#seachdistrict").val(),
        street:$("#street").val(),
        telephone:$("#telephone").val(),
        family:$("#family").val(),
        labour_forcen:$("#labour_forcen").val(),
        credit:$("#credit").val(),
        fund:$("#fund").val()
    }
    $.ajax({
        url:'php/nhxx_backto_main_nhxx.php',
        type:'post',
        data:obj,
        async:false,
        success:function(obj){
            if(obj==1)
            {
                clearInterval(time);
                window.location.href='main_nhxx.html'
            }

        }
    })
}

function xjjdxx(a,b) {
    if (b=='xjzzzw')
        var ID=$("#ID").val();
    else
        var ID=$("#nh_ID").val();
    console.log(ID)
    var str=["处理中","处理中..","处理中...."];
    var i=0;

    if(ID){

        var time=setInterval(function(){
            if(i>2)
                i=0;
            else
                $(a).html(str[i++]);
        },"400");
        $.ajax({
            url:'php/id_number.php',
            data:{id:ID,str:b},
            dataType:'text',
            type:'post',
            success:function (msg) {
                clearInterval(time);
                $(a).html("新建");
                console.log(msg);
                var num=parseInt(msg);
                if(num==0)
                    alert("该农户不存在！")
                else {
                    location.href=b+'.html';
                }
            },
            error:function () {
                console.log("id_number.php lost！")
                alert("意外错误发生!")
                clearInterval(time);
                $(a).html("新建");
            }


        })
    }
    else
       alert("请输入用户ID！")
}

function jiazai_id_of_jidi(str){
    $.ajax({
        url:'php/jiazai_id_of_jidi.php',
        type:'post',
        dataType:'json',
        data:{id:localStorage.id,b:str},
        success:function (msg) {
            console.log(msg)
            var note='<option value="">请选择</option>';
            var msg2;
            try {
                msg2=JSON.parse(msg);
            }catch (e){
                msg2=msg;
            }
            localStorage.jiazai_id_of_jidi=JSON.stringify(msg2);
            $.each(msg2,function (i,item) {
                $.each(item,function (key,val) {

                    if (key=='id_of_jidi')
                        note+="<option value='"+val+"'>"+val+"</option>"
                })
            })
            $("#id_of_jidi").html(note);
        },
        error:function () {
            console.log("jiazai_id_of_jidi.php lost");
        }
    })

}
function finish_for_zw(a){
    var i = 0;
    var str = ["处理中", "处理中..", "处理中...."];
    var time = setInterval(function () {
        if (i > 2)
            i = 0;
        else
            $(a).html(str[i++]);
    }, "400");


    var id=$("#id_of_zw").html();
    if(confirm("作物终结后，将无法查询，确认终结？")) {
         $.ajax({
             url:"php/finish_for_zw.php",
             data:{id:id},
             type:'post',
             dataType:'text',
             success:function (msg) {
                  clearInterval(time);
                  $(a).html("作物完结！");
                 if (!isNaN(msg)){



                     alert("终结成功！");
                     fillHTML_for_zzzw(0);
                     yejiao(localStorage.id,'zzzw_num_check');
                 }

                 else
                     alert("终结失败，失败原因："+msg)
             },
             error:function () {
                 clearInterval(time);
                 $(a).html("作物完结！");
                 alert("连接失败!");

             }
         })
    }

}
function  yejiao(a,b) {
    localStorage.setItem('page',1);
    $.ajax({
        url:'php/yejiao.php',
        dataTypes:'text',
        type:'post',
        data:{parameter:a,str:b},
        success:function (obj) {
            console.log("yejiao:"+obj)

            var num=parseInt(obj);
            if(num<1){
                alert("无作物信息！");
                location.href='main_nhxx.html';
            }
            else
                $("#yejiao").html(" <ul class='list-inline'><li><a class='page_change'>Prev</a></li><li><a  class='page_change' id='middle_page'>"+localStorage.page+"</a></li>"+
                    "<li><a class='page_change'>Next</a></li><li>共"+num+"页</li><li><br><div class='input-group' style='width: 40%;margin-left: auto;margin-right: auto'>"+
                    "<input type='text' class='form-control' id='yejiao-val'><span class='input-group-addon yejiao-button'><i class='glyphicon glyphicon-circle-arrow-right'></i></span></div>"+
                    "</li></ul>");

            $(".page_change").on('click',function () {
                if ($(this).html()=='Prev')
                    if (localStorage.page==1)
                        alert("当前是第一页");
                    else {
                        localStorage.page--;
                        if (b=='jdxx_num_check')
                            foreach_of_jdxx(localStorage.page-1);
                        else if(b=='zzzw_num_check')
                            foreach_of_zzzw(localStorage.page-1);
                        else if(b=="gtjl_num_check")
                            fillHTML_for_gtjl(localStorage.page-1);
                        else if(b=="tzck_num_check")
                            fillHTML_for_tzck(localStorage.page-1);
                        else if(b=='fillHTML_for_ycl')
                            fillHTML_for_ycl(localStorage.page-1);
                        else
                            fillHTML_for_tjglxx(localStorage.page-1);
                    }
                else if ($(this).html()=='Next'){
                    if (localStorage.page==num)
                        alert("当前是最后一页");
                    else {
                        localStorage.page++;
                        if (b=='jdxx_num_check')
                            foreach_of_jdxx(localStorage.page-1);
                        else if(b=='zzzw_num_check')
                            foreach_of_zzzw(localStorage.page-1);
                        else if(b=="gtjl_num_check")
                            fillHTML_for_gtjl(localStorage.page-1);
                        else if(b=="tzck_num_check")
                            fillHTML_for_tzck(localStorage.page-1);
                        else if(b=='fillHTML_for_ycl')
                            fillHTML_for_ycl(localStorage.page-1);
                        else
                            fillHTML_for_tjglxx(localStorage.page-1);
                    }
                }
                else {
                    localStorage.page=$(this).html();
                    if (b=='jdxx_num_check')
                        foreach_of_jdxx(localStorage.page-1);
                    else if(b=='zzzw_num_check')
                        foreach_of_zzzw(localStorage.page-1);
                    else if(b=="gtjl_num_check")
                        fillHTML_for_gtjl(localStorage.page-1);
                    else if(b=="tzck_num_check")
                        fillHTML_for_tzck(localStorage.page-1);
                    else if(b=='fillHTML_for_ycl')
                        fillHTML_for_ycl(localStorage.page-1);
                    else
                        fillHTML_for_tjglxx(localStorage.page-1);
                }
                $("#middle_page").html(localStorage.page);
            })
            $(".yejiao-button").click(function () {
                var val=parseInt($("#yejiao-val").val());
                if(val=='')
                    alert("请输入页码");
                else if(val<0 || val>num)
                    alert("输入有误");

                else {

                    if (b=='jdxx_num_check')
                        foreach_of_jdxx(val-1);
                    else if(b=='zzzw_num_check')
                        foreach_of_zzzw(val-1);
                    else if(b=="gtjl_num_check")
                        fillHTML_for_gtjl(val-1);
                    else if(b=="tzck_num_check")
                        fillHTML_for_tzck(val-1);
                    else if(b=='fillHTML_for_ycl')
                        fillHTML_for_ycl(localStorage.page-1);
                    else
                        fillHTML_for_tjglxx(val-1);
                    localStorage.page=val;
                    $("#middle_page").html(val);
                }

            })
            var ula=$(".page_change");
            ula.each(function () {
                $(this).addClass("btn btn-default")
            })
        },
        error:function () {
            console.log("yejiao.php lost")
        }


    })

}
function historymodel(a,b){
    if($(a).attr("change")=='0'){
        if (b=='jd')
            var select=$("<select class='form-control' id='nh_ID'></select>");
        else
            var select=$("<select class='form-control' id='ID'></select>");
        var note="<option value=''>请选择</option>";
        var msg;

        $.ajax({
            url:'php/history_of_read.php',
            data:{id:localStorage.lyt_username,str:b},
            dataType:'json',
            type:'post',
            success:function (obj) {
                console.log(obj)
                try{
                    msg=JSON.parse(obj);
                }catch (e){
                    msg=obj;
                }


                $.each(msg,function (i,item) {
                    console.log(item)
                    note+="<option value='"+item.id+"'>"+item.name+" : "+item.id+"</option>"

                })
                select.html(note);
                if(b=='nh'){
                    $(a).next().remove();
                    $(a).after(select);
                }
                else{
                    $(a).prev().remove();
                    $(a).before(select);
                }
                $(a).attr("change","1");
            },
            error:function () {
                console.log("history_of_read.php lost")
            }
        });


    }
    else
    {
        if(b=='jd')
            var note=$("<input type='text' class='form-control' placeholder='请输入农户ID' id='nh_ID'>");
        else
            var note=$("<input type='text' class='form-control' placeholder='请输入农户ID' id='ID'>");
        if(b=='nh'){
            $(a).next().remove();
            $(a).after(note);
        }
        else{
            $(a).prev().remove();
            $(a).before(note);
        }

        $(a).attr("change","0");
    }


}
function history_insert(a) {

    $.ajax({
        url:'php/history_of_insert.php',
        data:a,
        type:'post',
        dataType:"text",
        success:function (msg) {
                 console.log(msg)
        }
    })
}
/****各表单检查函数**/
function check() {
    var n_password=$("#n_password").val().trim();
    var f_password=$("#f_password").val().trim();
    var f_password2=$("#f_password2").val().trim();

    if(f_password!=f_password2){
        alert("两次密码输入不一致!");
        return false;
    }
    $("#username").val(localStorage.lyt_username);
}
function jianyi(a) {
    var text=$("#textarea").val().trim();

    var i = 0;
    var str = ["处理中", "处理中..", "处理中...."];
    var time = setInterval(function () {
        if (i > 2)
            i = 0;
        else
            $(a).val(str[i++]);
    }, "400");

    $.ajax({
        url:'php/jianyi.php',
        data:{text:text,username:localStorage.lyt_username},
        dataType:'text',
        type:'post',
        success:function (msg) {
            clearInterval(time);
            $(a).val("提交");
            if (msg==1){
                alert("提交成功！");
                location.href='shezhi.html';
            }
            else{
                alert("提交失败，错误信息:"+msg)
            }
        },
        error:function () {
            clearInterval(time);
            $(a).val("提交");
             alert("连接失败，请检查网络");
        }
    })
}
