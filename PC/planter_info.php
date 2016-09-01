<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>农户信息管理</title>
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="stylesheet" type="text/css" href="lib/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="stylesheets/theme.css">
    <link rel="stylesheet" href="lib/font-awesome/css/font-awesome.css">

    <script src="lib/jquery-1.7.2.min.js" type="text/javascript"></script>

    <script src="js/myFunction.js" type="text/javascript"></script>
    <!-- Demo page code -->

      <script type="text/javascript">
    var username=<?php echo $_SESSION['username'];?>;
    var password=<?php echo $_SESSION['password'];?>;
	
          var creator=FactoryOne("zhongzhihuxinxi");//改
          window.onload=function(){
              if(username=="" || password==""){
                  return;
              }
			  
          creator.Initializer("nn","*");
          creator.createDragger();
          creator.createTableHead();

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
      <ul id="basicData-menu" class="nav nav-list collapse in">
          <li class="active"><a href="planter_info.php">农户信息</a></li>
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
            
            <h1 class="page-title">农户信息管理</h1>
        </div>
        


        <div class="container-fluid">
            <div class="row-fluid">

                <!--复制开始-->
                <div class="container-fluid">
                    <div class="row-fluid">
                        <div class="search-well">
                            <form class="form-inline">
                                <select name="selection" id="dragger">
                                    <!--下拉框的空-->
                                </select>
                                <input class="input-xlarge" placeholder="Search..." id="resultValue" type="text">
                                <button class="btn" type="button"><i class="icon-search" onclick="creator.onsearch()"></i> 查询</button>
                            </form>
                        </div>

                        <!--开始表格部分-->
                        <div class="well">
                            <table class="table">
                                <thead>
                                <tr id="content_head">
                                    <!--表头的空-->
                                </tr>
                                </thead>
                                <tbody id="content_body">
                                    <!--表体的空-->
                                </tbody>
                            </table>
                        </div>
                        <!--表格部分结束-->
                        <!--开始目录栏部分-->
                        <div class="pagination">
                            <ul id="pagemanager">
                                <!--页码栏挖的空-->
                            </ul>
                        </div>
                        <!--复制结束-->

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
</html>


