<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Expires" content="Fri, Jan 01 1900 00:00:00 GMT">
<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="Cache-Control" content="no-cache">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="Lang" content="en">
<meta name="author" content="@ahilespelid">
<meta name="description" content="">
<meta name="keywords" content="">
<meta name="creation-date" content="01/04/2023">
<meta name="revisit-after" content="1 days">
<title>courtcenter@ahilespelid</title>
<style type="text/css">
:root{}
@import url('http://fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300ita‌​lic,400italic,500,500italic,700,700italic,900italic,900');

*{margin:0; padding:0; box-sizing:border-box;}
html,body{height:100%; background: #FFFFFF; border-radius:10px; /* linear-gradient(to right, #ffa6a6, white, #a6adff); */
}

section {
  width: 100%;
  height: 80%;

  display: grid;
  grid-template-rows: 2fr 6fr;
  grid-template-columns: 2fr 10fr 2fr;
  gap: 5px;
}
section * {}
.bar{margin:auto;}
.bar__body{border: 1px solid #aaa; min-height: 80px; width: 1344px;}
.bar__body_title{
    font-family: 'Roboto', sans-serif;
    font-size: 12px;
    color: #aaa;
    position: relative;
    bottom: 10px;
    left: 100px;
    background: #fff;    
}
.bar__body__list{
    display: flex;
    flex-wrap: wrap;
    width: 90%;
    margin: 0 auto; 
}
.bar__body__list_i{
    cursor: pointer;
    width: 130px;
    height: 41px;

    background: rgba(87, 85, 85, 0.16);
    border-radius: 5px;
    float: left;
    margin: 5px 20px;
    font-size: 12px;
    text-align: center;
    line-height: 40px;
}
.form td{padding: 10px;}
.form input{width: 350px;}
button[type="submit"]{
    cursor: pointer;
    font-family: 'Roboto';
    font-style: normal;
    font-weight: 400;
    font-size: 20px;
    line-height: 23px;
    align-items: center;
    text-align: center;
    padding: 10px 30px;
    position: relative;
    top: calc(50vh - 140px);
    left: calc(50% - 130px);
}
footer, header {text-align: center;} footer {color:#00f;} header {color:#f00;} a{text-decoration: none;}

</style>
<script type="text/javascript">
<?if('computer' == $device){?><?}?>
</script>
</head>
<body>
<header id="head"></header>
<section><div></div>
  <div class="bar">
    <div class="bar__body">
        <span class="bar__body_title">Инстанции</span>
        <div class="bar__body__list">
            <div class="bar__body__list_i">Суды-Первая</div>
            <div class="bar__body__list_i">Суды-Апелляционная</div>
            <div class="bar__body__list_i">Суды-Кассационная</div>
            <div class="bar__body__list_i" style="line-height: 20px;">Исполнительное производство</div>
            <div class="bar__body__list_i">Банкротство</div>
            <div class="bar__body__list_i">Медиация</div>
            <div class="bar__body__list_i" style="line-height: 20px;">Суды-Возобновление производства по делу</div>
        </div>
    </div>
  </div><div></div><div></div>
  <div>
    <div class="form">
        <form action="/" method="post">
            <table>
                <tr>
                    <td><label for="name">Название сделки, внутренний номер</label></td>
                    <td><input type="text" id="name" name="name"></td>
                    <td></td>
                </tr>
                <tr>
                    <td><label for="storoni">Стороны по делу</label></td>
                    <td><input type="text" id="storoni" name="storoni"></td>
                    <td></td>
                </tr>
                <tr>
                    <td><label for="strategi">Стратегия</label></td>
                    <td><input type="text" id="strategi" name="strategi" placeholder="Стратегия"></td>
                    <td><span>11.04.2023</span></td>
                </tr>
                <tr>
                    <td><label for="undefine"></label></td>
                    <td><input type="text" id="undefine" name="undefine" value="<?=($name = ($profile['NAME'] ?? false)) ? $name : '';?>"></td>
                    <td><span></span></td>
                </tr>
        
            </table>
        <button type="submit" type="button">Сохранить</button>
        </form>
    </div>
  </div><div></div>
</section>
<footer id="foot"></footer></body></html>