/**
 * Created by Steve_su on 8/14/16.
 */

//约定,如果requestValue为空就等于*,列间间隔用*,行间间隔用#,如果有总页数放在第一个
function FactoryOne(tablename){
        var creator=new Object;
        creator.tablename=tablename;
        creator.requestKey='';
        creator.requestValue='';
        creator.currentpage='';
        creator.mode='';
        creator.HeadResult='';
        creator.totalpage='';
        //用于每次搜索的时候调用,第一次进入也需要调用   用户没有查询(一开始)requestValue是信号
        creator.Initializer=function(requestKey,requestValue){
            creator.requestKey=requestKey;
            creator.requestValue=requestValue;
            creator.currentpage=1;
            creator.mode=0;
            //ajax部分
            $.ajax({
                type: "GET",
                async: false,
                cache : false,
                url:'./php/getResult.php',
                data:{CP:creator.currentpage,TN:creator.tablename,KEY:creator.requestKey,VALUE:creator.requestValue,MODE:creator.mode},
                success: function (respondText)
                {
                
                    var temp=respondText.split("*");
                    //通过respondText初始化非传参常量
                    if(temp[0]==0){
                        alert("查询结果为空!");
                        return;
                    }
                    creator.totalpage=temp[0];
                    //第一次的时候才更新表头
                    if(creator.requestValue=='*') {
                        creator.HeadResult = temp[1];
                        creator.BodyResult = temp[2];
                    }
                    else{
                        creator.HeadResult = temp[1];
                        creator.BodyResult=temp[2];
                    }
                    temp=creator.BodyResult.split("#");
                    var long=creator.HeadResult.split("+").length;
                    var data="";
                    for(var i= 0;i<temp.length;i++){
                        var detaillist=new Array();
                        data=data+"<tr>";
                        var temp2=temp[i].split("+");
                        for(var t=0,p=0;t<temp2.length;t++){
                            //填充内容
                            data=data+"<td>";
                            if(temp2[t].length<=10)
                                data=data+temp2[t];
                            else{
                                data=data+"<a onclick='creator.showhidden(888"+t*10+i+",666"+t*10+i+")' id='666"+t*10+i+"'>查看详情</a>";
                                //这里需要设置弹出框的内容,之后把标号记到一个数组里面,id是(999"+t+")  showhidden()用来显示hidden的东西
                                detaillist[p]=t;
                                p++;
                            }
                            data=data+"</td>"
                        }
                        data=data+"</tr>";
                        //这里需要添加一个循环用于添加 查看详情 的内容,还要获取table的列数---this.HeadResult.split("#").length
                        for(var k=0;k<detaillist.length;k++){
                            data=data+"<tr style='display: none' id='888"+detaillist[k]*10+i+"'>";
                            data=data+"<td colspan='"+long+"'>";
                            data=data+creator.HeadResult.split("+")[detaillist[k]]+":"+temp2[detaillist[k]];
                            data=data+"</td>";
                            data=data+"</tr>";
                        }
                    }
                    document.getElementById("content_body").innerHTML=data;
                }});

        };


        //非传参常量
        //也只有第一次调用的时候会使用
        creator.createDragger=function(){
            //生成下拉
            var temp=creator.HeadResult.split("+");
            var data="";
            for(var i=0;i<temp.length;i++){
                //填充下拉
                data=data+"<option value='"+temp[i]+"'>"+"按"+temp[i]+"</option>";
            }
            document.getElementById("dragger").innerHTML=data;
        };
        //也只有第一次调用的时候会使用
        creator.createTableHead=function(){
            //生成表头

            var temp=creator.HeadResult.split("+");
            var data="";
            for(var i=0;i<temp.length;i++){
                //填充表头
                data=data+"<th>"+temp[i]+"</th>";
            }
            document.getElementById("content_head").innerHTML=data;
        };
        //翻页 第一次进入  搜索 会调用
        creator.createTableBody=function(currentpage){
            creator.mode=1;
            var data="";
            $.ajax({
                type: "GET",
                async: false,
                cache : false,
                url:'./php/getResult.php',
                data:{CP:creator.currentpage,TN:creator.tablename,KEY:creator.requestKey,VALUE:creator.requestValue,MODE:creator.mode},
                success: function (respondText)
                {
                    var temp=respondText.split("*");
                    //通过respondText初始化非传参常量
                    //第一次的时候才更新表头
                    creator.HeadResult = temp[0];
                    creator.BodyResult = temp[1];
                    temp=creator.BodyResult.split("#");
                    var long=creator.HeadResult.split("+").length;
                    var data="";
                    for(var i= 0;i<temp.length;i++){
                        var detaillist=new Array();
                        data=data+"<tr>";
                        var temp2=temp[i].split("+");
                        for(var t=0,p=0;t<temp2.length;t++){
                            //填充内容
                            data=data+"<td>";
                            if(temp2[t].length<=10)
                                data=data+temp2[t];
                            else{
                                data=data+"<a onclick='creator.showhidden(888"+t*10+i+",666"+t*10+i+")' id='666"+t*10+i+"'>查看详情</a>";
                                //这里需要设置弹出框的内容,之后把标号记到一个数组里面,id是(999"+t+")  showhidden()用来显示hidden的东西
                                detaillist[p]=t;
                                p++;
                            }
                            data=data+"</td>"
                        }
                        data=data+"</tr>";
                        //这里需要添加一个循环用于添加 查看详情 的内容,还要获取table的列数---this.HeadResult.split("#").length
                        for(var k=0;k<detaillist.length;k++){
                            data=data+"<tr style='display: none' id='888"+detaillist[k]*10+i+"'>";
                            data=data+"<td colspan='"+long+"'>";
                            data=data+creator.HeadResult.split("+")[detaillist[k]]+":"+temp2[detaillist[k]];
                            data=data+"</td>";
                            data=data+"</tr>";
                        }
                    }
                    document.getElementById("content_body").innerHTML=data;
                }});

        };
        //第一次进入  翻页  搜索  会调用
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
        creator.createTableBody(creator.currentpage);
    };
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
    creator.search=function(){
        var myselect=document.getElementById("dragger");
        var index=myselect.selectedIndex;
        var resultKey=myselect.options[index].value;
        var resultValue=document.getElementById("resultValue").value;
        creator.Initializer(resultKey,resultValue);
        creator.createTag(1);
    };

    return creator;
}
//可能还有需要订正的部分




