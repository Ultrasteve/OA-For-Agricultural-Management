<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>数据分析</title>
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="stylesheet" type="text/css" href="lib/bootstrap/css/bootstrap.css">
    
    <link rel="stylesheet" type="text/css" href="stylesheets/theme.css">
    <link rel="stylesheet" href="lib/font-awesome/css/font-awesome.css">

    <script src="lib/jquery-1.7.2.min.js" type="text/javascript"></script>

      <script src="js/Area.js" type="text/javascript"></script>
      <script src="js/AreaData_min.js" type="text/javascript"></script>
      <script src="js/myFunction2.js" type="text/javascript"></script>
    <!-- Demo page code -->

      <script type="text/javascript">
          var username=<?php echo $_SESSION['username'];?>;
          var password=<?php echo $_SESSION['password'];?>;
          var creator=FactoryTwo();
          window.onload=function(){
              if(username=="" || password==""){
                  return;
              }
              creator.Initializer("*",1);
              creator.intialselect();
              creator.createTag(1);
          }
      </script>

    <style type="text/css">
        #line-chart {
            height:300px;
            width:800px;
            margin: 0px auto;
            margin-top: 1em;
        }
        .brand { font-family: georgia, serif; }
        .brand .first {
            color: #ccc;
            font-style: italic;
        }
        .brand .second {
            color: #fff;
            font-weight: bold;
        }
    </style>

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="../assets/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="../assets/ico/apple-touch-icon-57-precomposed.png">
  </head>

  <!--[if lt IE 7 ]> <body class="ie ie6"> <![endif]-->
  <!--[if IE 7 ]> <body class="ie ie7 "> <![endif]-->
  <!--[if IE 8 ]> <body class="ie ie8 "> <![endif]-->
  <!--[if IE 9 ]> <body class="ie ie9 "> <![endif]-->
  <!--[if (gt IE 9)|!(IE)]><!--> 
  <body class=""> 
  <!--<![endif]-->

  <div class="navbar">
      <div class="navbar-inner">
          <ul class="nav pull-right">

              <li><a href="loginpage.php" class="hidden-phone visible-tablet visible-desktop" role="button">注销</a></li>

          </ul>
          <a class="brand" href="#"><span class="first">农易通</span></a>
      </div>
  </div>
    

<!--开始菜单部分-->

  <div class="sidebar-nav">

      <a href="#basicData-menu" class="nav-header" data-toggle="collapse">基础数据</a>
      <ul id="basicData-menu" class="nav nav-list collapse">
          <li ><a href="planter_info.php">农户信息</a></li>
          <li ><a href="land_info.php">田块信息</a></li>
      </ul>

      <a href="#plant-menu" class="nav-header" data-toggle="collapse">作物信息</a>
      <ul id="plant-menu" class="nav nav-list collapse">
          <li ><a href="interview.php">田间管理记录信息</a></li>
          <li ><a href="communicate.php">沟通信息</a></li>
          <li ><a href="prediction.php">作物预产报表</a></li>
      </ul>

      <a href="data_analyze.php" class="nav-header" >数据分析</a>

      <a href="#MessageManagement-menu" class="nav-header" data-toggle="collapse">信息管理</a>
      <ul id="MessageManagement-menu" class="nav nav-list collapse">
          <li ><a href="type_info.php">作物品类信息</a></li>
          <li ><a href="sale_info.php">销售渠道信息</a></li>
          <li ><a href="storage_info.php">物流仓储信息</a></li>
      </ul>

      <a href="#userManagement-menu" class="nav-header" data-toggle="collapse">人员管理</a>
      <ul id="userManagement-menu" class="nav nav-list collapse">
          <li ><a href="employee.php">技术员管理</a></li>
          <li ><a href="user.php">用户账号管理</a></li>
      </ul>

  </div>
    
<!--开始content部分-->
    
    <div class="content">
        
        <div class="header">
            
            <h1 class="page-title">预产量信息管理</h1>
        </div>
        


        <div class="container-fluid">
            <div class="row-fluid">

                <!--复制开始-->
                <div class="container-fluid">
                    <div class="row-fluid">
                        <div class="btn-toolbar">
                            <a class="btn btn-primary" href="#search" role="button" data-toggle="modal"><i class="icon-plus"></i> 设置查询条件</a>
                            <a class="btn">导出报表</a>
                            <div class="btn-group">
                            </div>

                        </div>
                        <!--开始表格部分-->
                        <div class="well">
                            <table class="table">
                                <thead>
                                <tr id="content_head">
                                    <!--表头的空-->
                                    <th>作物编号</th>
                                    <th>预产量</th>
                                    <th>地块编号</th>
                                    <th>农户编号</th>

                                    <th class="none" style="display: none;">姓名</th>
                                    <th class="none" style="display: none;">联系电话</th>
                                    <th class="none" style="display: none;">性别</th>
                                    <th class="none" style="display: none;">年龄</th>
                                    <th class="none" style="display: none;">地址</th>
                                    <th>&nbsp;</th>
                                </tr>
                                </thead>
                                <tbody id="content_body">
                                <!--表体的空-->
                                </tbody>
                            </table>
                        </div>
                        <!--表格部分结束-->
                        <!--开始目录栏部分-->
                        <div class="well">
                            <form class="form-inline">
                                <div style="float:left; width: 30%; display: inline-block;">
                                    <label>需求总量</label>
                                    <input type="text" id="demand" style="width: 30%;"/>
                                </div>
                                <div style="float: none; width: 30%;display: inline-block;">
                                    <label>预产量</label>
                                    <label>&nbsp;</label>
                                    <select style="width: 50px;" id="bigorsmall">
                                        <option value="1">大</option>
                                        <option value="0">小</option>
                                    </select>
                                    <label>&nbsp;</label>
                                    <label>优先</label>
                                    <label>&nbsp;</label>
                                    <a class="btn" onclick="creator.sort()">筛选</a>
                                </div>
                                <div style="float: right; width: 35%;display: inline-block;">
                                    <label>选中产量和</label>
                                    <label>&nbsp;</label>
                                    <input type="text" id="plusresult" style="width: 30%;color: #0e90d2" disabled="true"/>
                                    <label>&nbsp;</label>
                                    <a class="btn btn-danger" data-dismiss="model" id="extendbutton" onclick="creator.expend()">信息扩展</a>
                                </div>


                            </form>
                        </div>
                        <div class="pagination">
                            <ul id="pagemanager">
                                <!--页码栏挖的空-->
                            </ul>
                        </div>
                        <!--复制结束-->
                        <div>
                        </div>
                        <div class="modal small hide fade" id="search" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>

                            </div>
                            <div class="modal-body" style="overflow:scroll;">
                                <form>
                                    <label>品种</label>
                                    <select id="type" class="above" onchange="creator.TypeChange(this.options[this.options.selectedIndex].text)">
                                        <option  selected = "selected">请选择</option>
                                    </select>
                                    <label>品类</label>
                                    <select id="sort" class="above" onchange="creator.SortChange(this.options[this.options.selectedIndex].text)">
                                        <option  selected = "selected">请选择</option>
                                    </select>
                                    <label>等级</label>
                                    <select id="rank" class="above" >
                                        <option  selected = "selected">请选择</option>
                                    </select>
                                    <label>省</label>
                                    <select id="seachprov" name="seachprov" class="above" onChange="changeComplexProvince(this.value, sub_array, 'seachcity', 'seachdistrict');">
                                        <option  selected = "selected">-------</option>
                                    </select>
                                    <label>市</label>
                                    <select id="seachcity" name="homecity" class="above" onChange="changeCity(this.value,'seachdistrict','seachdistrict');">
                                        <option  selected = "selected">-------</option>
                                    </select>
                                    <label>区</label>
                                    <span id="seachdistrict_div">
                                    <select id="seachdistrict" name="seachdistrict" class="above">

                                        <option  selected = "selected">-------</option>
                                    </select>
                                    </span>
                                    <label>开始时间</label>
                                    <input type="date" id="begindate">
                                    <label>结束时间</label>
                                    <input type="date" id="enddate">
                                    <input class="btn" data-dismiss="modal" aria-hidden="true" value="确认筛选条件" onclick="creator.search()">
                                    <input class="btn btn-danger" data-dismiss="modal" value="取消">
                                </form>
                            </div>
                        </div>
                    
            </div>
        </div>
    </div>
    


    <script src="lib/bootstrap/js/bootstrap.js"></script>
    <script type="text/javascript">
        $("[rel=tooltip]").tooltip();
        $(function() {
            $('.demo-cancel-click').click(function(){return false;});
        });
    </script>
    
  </body>
  <script>
      initComplexArea('seachprov', 'seachcity', 'seachdistrict', area_array, sub_array, '44', '0', '0');
  </script>
</html>


