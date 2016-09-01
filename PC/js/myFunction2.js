/**
 * Created by Steve_su on 8/19/16.
 */
function FactoryTwo(){
    var creator=new Object;
    creator.totalpage='';
    creator.currentpage='';
    creator.sql="";
    creator.BodyResult="";
    creator.pretotal=0;
    //如果currentpage为1,sql为*,则返回totalpage 改php文件名  从那边接受过来的是totalpage bodyresult
    creator.Initializer=function(sql,currentpage){
        var amount=document.getElementById("demand").value;
        var a=document.getElementById("bigorsmall");
        var index=a.selectedIndex;
        var size=a.options[index].value;
        if(amount==""){
            amount=-1;
        }
        creator.pretotal=0;
        document.getElementById("plusresult").value=creator.pretotal;
        $.ajax({
            type: "GET",
            async: false,
            cache : false,
            url:'./php/shuaxin1.php',
            data:{CP:currentpage,sql:sql,amount:amount,size:size},
            success: function (respondText)
            {
                var temp=respondText.split("*");
                //通过respondText初始化非传参常量
                if(currentpage==1) {
                    creator.totalpage = temp[0];
                    creator.BodyResult=temp[1];
                }
                //第一次的时候才更新表头
                else{
                    creator.BodyResult=temp[0];
                }
            }});
        //完成接收,更新表体
        var temp=creator.BodyResult.split("#");
        var long=9;
        var pre="";
        var data="";
        for(var i= 0;i<temp.length;i++){
            var detaillist=new Array();
            data=data+"<tr>";
            var temp2=temp[i].split("+");
            for(var t=0,p=0;t<temp2.length;t++){
                //填充内容
                if(t<4)
                    data=data+"<td>";
                if(t>=4)
                    data=data+"<td class='none' style='display: none;'>";
                if(t==1)
                    pre=temp2[t];
                if(temp2[t].length<=10)
                    data=data+temp2[t];
                else{
                    data=data+"<a onclick='creator.showhidden(888"+t+",666"+t+i+")' id='666"+t+i+"'>查看详情</a>";
                    //这里需要设置弹出框的内容,之后把标号记到一个数组里面,id是(999"+t+")  showhidden()用来显示hidden的东西
                    detaillist[p]=t;
                    p++;
                }
                data=data+"</td>"
            }
            data=data+"<td> <input id='"+i+"' type='checkbox' value='0' onclick='creator.check("+pre+","+i+")'/> </td>";
            data=data+"</tr>";
            //这里需要添加一个循环用于添加 查看详情 的内容,还要获取table的列数---this.HeadResult.split("#").length
            for(var k=0;k<detaillist.length;k++){
                data=data+"<tr style='display: none' id='888"+detaillist[k]+"'>";
                data=data+"<td colspan='"+long+"'>";
                data=data+"</td>";
                data=data+"</tr>";
            }
        }
        document.getElementById("content_body").innerHTML=data;
    };
    //先获得所有下拉的值,再传过去,之后接受表体信息---total,bodyresult,sql语句
    creator.search=function(){
        var temp=document.getElementsByClassName("above");
        var data="";
        var temp1=new Array();
        for(var i=0;i<temp.length;i++){
            var index=temp[i].selectedIndex;
            if(temp[i].options[index].innerHTML!="请选择")
                temp1.push(temp[i].options[index].innerHTML);
            else
                temp1.push(" ");
        }
        temp1.push(document.getElementById("begindate").value.toString());
        temp1.push(document.getElementById("enddate").value.toString());
        creator.pretotal=0;
        document.getElementById("plusresult").value=creator.pretotal;
        //temp1存放有所有参数
        $.ajax({
            type: "GET",
            async: false,
            cache : false,
            url:'./php/shuaxin2.php',
            data:{one:temp1[0],two:temp1[1],three:temp1[2],four:temp1[3],five:temp1[4],six:temp1[5],seven:temp1[6],eight:temp1[7]},
            success: function (respondText)
            {
                temp=respondText.split("/");
                //通过respondText初始化非传参常量
                if(temp[0]==0){
                    alert("查询内容为空!");
                    return;
                }

                creator.totalpage = temp[0];
                creator.BodyResult=temp[1];
                creator.sql = temp[2];

            }});
        //生成表体

        temp=creator.BodyResult.split("#");
        var long=9;
        var pre="";
        for(i= 0;i<temp.length;i++){
            var detaillist=new Array();
            data=data+"<tr>";
            var temp2=temp[i].split("+");
            for(var t=0,p=0;t<temp2.length;t++){
                //填充内容
                if(t<4)
                    data=data+"<td>";
                if(t>=4)
                    data=data+"<td class='none' style='display: none;'>";
                if(t==1)
                    pre=temp2[t];
                if(temp2[t].length<=10)
                    data=data+temp2[t];
                else{
                    data=data+"<a onclick='creator.showhidden(888"+t+",666"+t+i+")' id='666"+t+i+"'>查看详情</a>";
                    //这里需要设置弹出框的内容,之后把标号记到一个数组里面,id是(999"+t+")  showhidden()用来显示hidden的东西
                    detaillist[p]=t;
                    p++;
                }
                data=data+"</td>"
            }
            data=data+"<td> <input id='"+i+"' type='checkbox' value='0' onclick='creator.check("+pre+","+i+")'/> </td>";
            data=data+"</tr>";
            //这里需要添加一个循环用于添加 查看详情 的内容,还要获取table的列数---this.HeadResult.split("#").length
            for(var k=0;k<detaillist.length;k++){
                data=data+"<tr style='display: none' id='888"+detaillist[k]+"'>";
                data=data+"<td colspan='"+long+"'>";
                data=data+"</td>";
                data=data+"</tr>";
            }
        }

        document.getElementById("content_body").innerHTML=data;
        creator.createTag(1);
    };
    //信息扩展
    creator.expend=function(){
        var str=document.getElementById("extendbutton").innerHTML;

        var temp=document.getElementsByClassName("none");
        if(str=="信息扩展"){
            for(var i=0;i<temp.length;i++)
                temp[i].style.display="";
            document.getElementById("extendbutton").className="btn";
            document.getElementById("extendbutton").innerHTML="取消扩展";
        }
        else{
            for(i=0;i<temp.length;i++)
                temp[i].style.display="none";
            document.getElementById("extendbutton").className="btn btn-danger";
            document.getElementById("extendbutton").innerHTML="信息扩展";
        }
    };
    //左下角控件 获得input和下拉的参数
    creator.sort=function sort(){
        var temp=document.getElementById("bigorsmall");
        var index=temp.selectedIndex;
        var size=temp.options[index].innerHTML;
        var amount=document.getElementById("demand").value;
        var data="";
        creator.pretotal=0;
        document.getElementById("plusresult").value=creator.pretotal;
        $.ajax({
            type: "GET",
            async: false,
            cache : false,
            url:'./php/shuaxin3.php',
            data:{size:size,amount:amount,sql:creator.sql},
            success: function (respondText)
            {
                var temp=respondText.split("/");
                //通过respondText初始化非传参常量
                creator.totalpage = temp[0];
                creator.BodyResult=temp[1];
                if(creator.sql!="")
                    creator.sql=temp[2];
            }});
            //更新表体
        temp=creator.BodyResult.split("#");
        var long=9;
        var pre="";
        for(var i= 0;i<temp.length;i++){
            var detaillist=new Array();
            data=data+"<tr>";
            var temp2=temp[i].split("+");
            for(var t=0,p=0;t<temp2.length;t++){
                //填充内容
                if(t<4)
                    data=data+"<td>";
                if(t>=4)
                    data=data+"<td class='none' style='display: none;'>";
                if(t==1)
                    pre=temp2[t];
                if(temp2[t].length<=10)
                    data=data+temp2[t];
                else{
                    data=data+"<a onclick='creator.showhidden(888"+t+",666"+t+i+")' id='666"+t+i+"'>查看详情</a>";
                    //这里需要设置弹出框的内容,之后把标号记到一个数组里面,id是(999"+t+")  showhidden()用来显示hidden的东西
                    detaillist[p]=t;
                    p++;
                }
                data=data+"</td>"
            }
            data=data+"<td> <input id='"+i+"' type='checkbox' value='0' onclick='creator.check("+pre+","+i+")'/> </td>";
            data=data+"</tr>";
            //这里需要添加一个循环用于添加 查看详情 的内容,还要获取table的列数---this.HeadResult.split("#").length
            for(var k=0;k<detaillist.length;k++){
                data=data+"<tr style='display: none' id='888"+detaillist[k]+"'>";
                data=data+"<td colspan='"+long+"'>";
                data=data+temp2[detaillist[k]];
                data=data+"</td>";
                data=data+"</tr>";
            }
        }
        document.getElementById("content_body").innerHTML=data;
        creator.createTag(1);
    };
    //checkbox操作
    creator.check=function(string,id){
        var p=parseFloat(string);
        if(document.getElementById(id).value==0) {
            document.getElementById(id).value = 1;
            creator.pretotal+=p;
            document.getElementById("plusresult").value=creator.pretotal;
        }
        else{
            document.getElementById(id).value = 0;
            creator.pretotal-=p;
            document.getElementById("plusresult").value=creator.pretotal;
        }

    };
    //showhidden功能
    creator.showhidden=function(id,id2){
        if(document.getElementById(id2).innerHTML=="查看详情")
            document.getElementById(id2).innerHTML="取消查看";
        else
            document.getElementById(id2).innerHTML="查看详情";
        if(document.getElementById(id).style.display=="none")
            document.getElementById(id).style.display="";
        else
            document.getElementById(id).style.display="none";
    };
    //生成页标
    creator.createTag=function(currentpage){
        creator.currentpage=currentpage;
        //生成标签页
        var date="";
        if(creator.totalpage>7)
        {
            if(currentpage<6)
            {
                if(currentpage!=1)
                {
                    //如果是在第一页是没有上一页的标签的
                    date="<li><a href='#' onclick='creator.clk(-1)'>上一页</a></li>";
                }
                else
                {   //之后在不是第一页的时候才有
                    date="";
                }
                for(var i=1;i<currentpage;i++)
                {
                    date=date+"<li><a href='#' onclick='creator.clk("+i+")'>"+i+"</a></li>";
                }
                date=date+"<li class='active'><a href='#' onclick='creator.clk("+i+")'>"+i+"</li>";
                i++;
                for(;i<8;i++)
                {
                    date=date+"<li><a href='#' onclick='creator.clk("+i+")'>"+i+"</a></li>";
                }
                date=date+"<strong>....</strong>";
                date=date+"<li><a href='#' onclick='creator.clk("+creator.totalpage+")'>"+creator.totalpage+"</a></li>";
                date=date+"<li><a href='#' onclick='creator.clk(0)'>下一页</a></li>";
            }
            if(currentpage>=6&&currentpage<creator.totalpage-6)
            {
                date="<li><a href='#' onclick='creator.clk(-1)'>上一页</a></li>";
                date=date+"<li><a href='#' onclick='creator.clk("+1+")'>"+1+"</a></li><li><span><strong>....</strong></span></li>";
                var start=currentpage-(currentpage-6)%4;
                for(var i=0;i+start<currentpage;i++)
                {
                    date=date+"<li><a href='#' onclick='creator.clk("+(i+start)+")'>"+(i+start)+"</a></li>";
                }
                date=date+"<li class='active'><a href='#' onclick='creator.clk("+(i+start)+")'>"+(i+start)+"</a></li>";
                i++;
                for(;i<6;i++)
                {
                    date=date+"<li><a href='#' onclick='creator.clk("+(i+start)+")'>"+(i+start)+"</a></li>";
                }
                date=date+"<li><span><strong>....</strong></span></li><li><a href='#' onclick='creator.clk("+creator.totalpage+")'>"+creator.totalpage+"</a></li>";
                date=date+"<li><a href='#' onclick='creator.clk(0)'>下一页</a></li>";
            }
            if(currentpage>=creator.totalpage-6)
            {
                date="<li><a href='#' onclick='creator.clk(-1)'>上一页</a></li>";
                date=date+"<li><a href='#' onclick='creator.clk("+1+")'>"+1+"</a></li><li><span><strong>....</strong></span></li>";
                var start=creator.totalpage-6;
                for(var i=0;i+start<currentpage;i++)
                {
                    date=date+"<li><a href='#' onclick='creator.clk("+(i+start)+")'>"+(i+start)+"</a></li>";
                }
                date=date+"<li class='active'><a href='#' onclick='creator.clk("+(i+start)+")'>"+(i+start)+"</a></li>";
                i++;
                for(;i<7;i++)
                {
                    date=date+"<li><a href='#' onclick='creator.clk("+(i+start)+")'>"+(i+start)+"</a></li>";
                }
                if(currentpage!=creator.totalpage)
                {
                    date=date+"<li><a href='#' onclick='creator.clk(0)'>下一页</a></li>";
                }
            }
        }
        //
        else
        {
            if(currentpage!=1)
            {
                date="<li><a href='#' onclick='creator.clk(-1)'>上一页</a></li>";
            }
            else
            {
                date="";
            }
            for(var i=1;i<currentpage;i++)
            {
                date=date+"<li><a href='#' onclick='creator.clk("+i+")'>"+i+"</a></li>";
            }
            date=date+"<li><a href='#' onclick='creator.clk("+i+")'>"+i+"</a></li>";
            i++;
            for(;i<=creator.totalpage;i++)
            {
                date=date+"<li><a href='#' onclick='creator.clk("+i+")'>"+i+"</a></li>";
            }
            date=date+"<li><a href='#' onclick='creator.clk(0)'>下一页</a></li>";
        }
        //innerHTML要改
        document.getElementById("pagemanager").innerHTML=date;
    };
    //clk()翻页功能
    creator.clk=function(currentpage){
        if(currentpage==creator.currentpage)
            return;
        if(currentpage==-1) {
            if(creator.currentpage-1>0)
                creator.currentpage--;

        }
        if(currentpage==0) {
            if(creator.currentpage+1<=creator.totalpage)
                creator.currentpage++;
        }
        if(currentpage!=0&&currentpage!=-1)
            creator.currentpage=currentpage;
        creator.createTag(creator.currentpage);
        creator.Initializer(creator.sql,creator.currentpage);
    };
    //TypeChange
    creator.TypeChange=function(string){
        $.ajax({
            type: "GET",
            async: false,
            cache : false,
            url:'./php/typechange.php',
            data:{type:string},
            success: function (respondText)
            {
                var data="<option  selected = 'selected'>请选择</option>";
                var temp=respondText.split("+");
                for(var i=0;i<temp.length;i++){
                    data=data+"<option>"+temp[i]+"</option>";
                }
                document.getElementById("sort").innerHTML=data;
            }});
    };
    //SortChange
    creator.SortChange=function(string){
        var index=document.getElementById("type").selectedIndex;
        var string1=document.getElementById("type").options[index].innerHTML;
        $.ajax({
            type: "GET",
            async: false,
            cache : false,
            url:'./php/sortchange.php',
            data:{type:string1,sort:string},
            success: function (respondText)
            {
                var data="<option  selected = 'selected'>请选择</option>";
                var temp=respondText.split("+");
                for(var i=0;i<temp.length;i++){
                    data=data+"<option>"+temp[i]+"</option>";
                }
                document.getElementById("rank").innerHTML=data;
            }});
    };
    //intialselect
    creator.intialselect=function(){
        var data="<option  selected = 'selected'>-------</option>";
        $.ajax({
            type: "GET",
            async: false,
            cache : false,
            url:'./php/type.php',
            success: function (respondText)
            {
                var data="<option  selected = 'selected'>请选择</option>";
                var temp=respondText.split("+");
                for(var i=0;i<temp.length;i++){
                    data=data+"<option>"+temp[i]+"</option>";
                }
                document.getElementById("type").innerHTML=data;
            }});

    };
    return creator;
}