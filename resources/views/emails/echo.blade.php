<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

<!--bootstrap-->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
    
<style>
body,html {
 padding: 0px;
 margin: 0px;
 direction: rtl;
overflow-x: hidden;
}
html {
  scroll-behavior: smooth;
}
@font-face {
     font-family: 'mohammad bold art';
     src: url(assets/fonts/mohammad_bold_art_1_Regular.woff);
     font-style: normal;
}
*{
    font-family: 'mohammad bold art';
}
h1,h2,h3,h4,h5,h6{
    color: #464646;
}

.main-container {
    width: 600px;
    margin: 0 auto;
    padding: 50px 0px;
}
.main-container a{
    text-decoration: none;
    transition:all 0.5s ease;
}
ul{
    list-style-type: none;
}
 .clearfix {
    clear: both;
}
.container {
    width: 90% !important;
    max-width: 90% !important;
    margin: 0 auto !important;
}
img.logo {
    width: 150px;
    margin: 0 auto;
}
header {
    display: flex;
    align-items: center;
    justify-content: center;
}
.container.main-container-inner {
    margin-top: 45px !important;
}
h2 {
    margin-bottom: 28px;
    font-size: 25px;
}
h4, h4 {
    font-size: 1.2rem;
}
h6 {
    margin-top: 30px !important;
    color: #25a8f6;
    font-size: 17px;
    margin-bottom: 30px !important;
}
.download-app.container .col-6 {
    font-size: 20px;
}
.download-app.container a img {
    margin-top: 20px;
    width: 170px;
}
a.click-here.btn.btn-default {
    width: fit-content;
    color: #fff;
    background-color: #25a8f6;
    font-size: 14px;
    margin-right: 7px;
}
.row.row2 {
    margin-top: 40px;
    display: flex;
    align-items: center;
    justify-content: flex-start;
}
.footer {
    margin-top: 80px;
    display: flex;
    align-items: center;
    justify-content: center;
}
p.footer-p {
    font-size: 23px;
    color: #1183c8;
    position: relative;
}
.h5, h5 {
    font-size: 18px;
}
p.footer-p:after {
    content: '';
    position: absolute;
    background-image: url(img/comma-black.png);
    width: 18px;
    height: 20px;
    left: -25px;
    top: -1px;
    z-index: 9999;
    background-repeat: no-repeat;
    background-position: center;
    background-size: contain;
}

/*************************************Responsive***********************************/

@media (max-width:600px){
.main-container {
    width: 100%;
}
.download-app.container a img {
    width: 90%;
}
}


</style>
</head>



<body>
	<div class="main-container">
	<header>
       <img class="logo" src="{{asset('img/Black.png')}}">
	</header>
       <div class="main-container-inner container">
        <h2>
        مرحبا بك في منصة تنظيم
        </h2>
        <h5>
          قام ولي أمرك بتسجيلك في المنصة
ونرحب بك عضواً معنا...
        </h5>
        <h6>يمكنك تحميل التطبيق من خلال:</h6>
        <div class="download-app container">
            <div class="row">
                <div class="col-6">
                ابل ستور:
                    <a href="https://apps.apple.com/eg/app/tanthim/id1614904266"><img class="dowload-img" src="{{asset('img/1.png')}}"></a>
                </div>
                <div class="col-6">
                أندرويد:
                   <a href="https://apps.apple.com/eg/app/tanthim/id1614904266"><img class="dowload-img"   src="{{asset('img/2.png')}}"></a>
                </div>
            </div>
           
        </div>
         <div class="row row2">
            رابط المنصة : <a class="click-here btn btn-default shadow-none" href="https://tanthim.com/">اضغط هنا</a>
            </div>
           
        <div class="footer">
            <p class="footer-p">
        منصة تنظيم .. وجهة الجميع   
        </p></div>
      </div>  
        
    </div>
<!----end of main container----->

</body>
</html>